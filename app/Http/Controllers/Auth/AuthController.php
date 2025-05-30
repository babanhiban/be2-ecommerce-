<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\VerificationCode;
use App\Models\VerificationCodeFromAdmin; // Thêm model mới
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Xử lý khoảng trắng khi nhập các trường dữ liệu
     */
    protected function trimInputFields(Request $request, array $fields)
    {
        $input = $request->all();
        foreach ($fields as $field) {
            if (isset($input[$field])) {
                $input[$field] = preg_replace('/^[\s\x{3000}]+|[\s\x{3000}]+$/u', '', $input[$field]);
            }
        }
        $request->merge($input);
    }

    /**
     * Xử lý đăng ký người dùng - gửi mã xác nhận email
     */
    public function register(Request $request)
    {
        // Trim khoảng trắng đầu cuối cho các trường name, email
        $this->trimInputFields($request, ['name', 'email']);

        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^\S+@\S+\.\S+$/',  // Không cho phép khoảng trắng trong email
            ],
        ], [
            'email.regex' => 'Email không được chứa khoảng trắng.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lưu thông tin người dùng vào session để sử dụng sau khi xác minh
        session(['register_name' => $request->name, 'register_email' => $request->email]);

        // Tạo mã xác minh và gửi email
        $this->sendVerificationCode($request->email, 'register');

        return redirect()->route('verify.register')
            ->with('success', 'Mã xác nhận đã được gửi đến email của bạn.');
    }

    /**
     * Xử lý đăng ký người dùng bởi Admin - gửi mã xác nhận email
     */
    public function registerAddUserFormAdmin(Request $request)
    {
        $this->trimInputFields($request, ['name', 'email']);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|integer|in:1,2', // Chỉ cho phép role admin (1) hoặc staff (2)
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lưu thông tin người dùng vào session để sử dụng sau khi xác minh
        session([
            'admin_register_name' => $request->name,
            'admin_register_email' => $request->email,
            'admin_register_role_id' => $request->role_id
        ]);

        // Tạo mã xác minh và gửi email cho admin
        $this->sendAdminVerificationCode($request->email, $request->role_id, $request->name);

        return redirect()->route('admin.users.verify')
            ->with('success', 'Mã xác nhận đã được gửi đến email của bạn.');
    }

    /**
     * Xác thực mã đăng ký và tạo tài khoản bởi Admin
     */
    public function verifyAddUserFormAdmin(Request $request)
    {

        $this->trimInputFields($request, ['verification_register', 'password', 'password_confirmation']);

        $validator = Validator::make($request->all(), [
            'verification_register' => [
                'required',
                'regex:/^\d{6}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/[a-zA-Z]/',        // ít nhất 1 chữ cái
                'regex:/[0-9]/',           // ít nhất 1 số
                'regex:/[\W]/',            // ít nhất 1 ký tự đặc biệt
            ],
        ], [
            'verification_register.required' => 'Vui lòng nhập mã xác nhận.',
            'verification_register.regex' => 'Mã xác nhận phải gồm đúng 6 chữ số.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái, một số và một ký tự đặc biệt.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = session('admin_register_email');
        if (!$email) {
            return redirect()->route('admin.users.add')
                ->with('error', 'Phiên đăng ký đã hết hạn. Vui lòng thử lại.');
        }

        // Kiểm tra mã xác minh trong bảng verification_codes_from_admin
        $verification = VerificationCodeFromAdmin::where('email', $email)
            ->where('code', $request->verification_register)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verification) {
            return redirect()->back()
                ->with('error', 'Mã xác nhận không hợp lệ hoặc đã hết hạn.');
        }

        // Tạo tài khoản người dùng mới
        $user = User::create([
            'name' => session('admin_register_name'),
            'email' => $email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now()
        ]);

        // Gán role dựa vào role_id trong verification record
        $role = Role::find($verification->role_id);

        if ($role) {
            $user->roles()->attach($role->id);
        } else {
            // Nếu không tìm thấy role thì gán role mặc định
            $defaultRole = Role::where('name', 'member')->first();
            if ($defaultRole) {
                $user->roles()->attach($defaultRole->id);
            }
        }

        // Xóa mã xác minh và thông tin session
        $verification->delete();
        $request->session()->forget(['admin_register_name', 'admin_register_email', 'admin_register_role_id']);

        return redirect()->route('admin.users')
            ->with('success', 'Thêm tài khoản thành công!');
    }

    /**
     * Gửi lại mã xác nhận đăng ký cho Admin
     */
    public function resendAdminRegisterCode(Request $request)
    {
        $email = session('admin_register_email');
        $roleId = session('admin_register_role_id');
        $name = session('admin_register_name');

        if (!$email || !$roleId || !$name) {
            return redirect()->route('admin.users.add')
                ->with('error', 'Phiên đăng ký đã hết hạn. Vui lòng thử lại.');
        }

        // Gửi lại mã xác minh
        $this->sendAdminVerificationCode($email, $roleId, $name);

        return redirect()->back()
            ->with('success', 'Mã xác nhận mới đã được gửi đến email của bạn.');
    }

    /**
     * Xác thực mã đăng ký và tạo tài khoản
     */
    public function verifyRegister(Request $request)
    {
        $this->trimInputFields($request, ['verification_register', 'password', 'password_confirmation']);

        $validator = Validator::make($request->all(), [
            'verification_register' => [
                'required',
                'regex:/^\d{6}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/',
                'regex:/[\W]/',
            ],
        ], [
            'verification_register.required' => 'Vui lòng nhập mã xác nhận.',
            'verification_register.regex' => 'Mã xác nhận phải gồm đúng 6 chữ số.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái, một số và một ký tự đặc biệt.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = session('register_email');
        if (!$email) {
            return redirect()->route('register')
                ->with('error', 'Phiên đăng ký đã hết hạn. Vui lòng thử lại.');
        }

        // Kiểm tra mã xác minh
        $verification = VerificationCode::where('email', $email)
            ->where('code', $request->verification_register)
            ->where('type', 'register')
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verification) {
            return redirect()->back()
                ->with('error', 'Mã xác nhận không hợp lệ hoặc đã hết hạn.');
        }

        // Tạo tài khoản người dùng mới
        $user = User::create([
            'name' => session('register_name'),
            'email' => $email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now()
        ]);

        // Gán role member cho người dùng mới
        $memberRole = Role::where('name', 'member')->first();
        if ($memberRole) {
            $user->roles()->attach($memberRole->id);
        } else {
            // Nếu chưa có role member thì tạo mới
            $memberRole = Role::create(['name' => 'member']);
            $user->roles()->attach($memberRole->id);
        }

        // Xóa mã xác minh và thông tin session
        $verification->delete();
        $request->session()->forget(['register_name', 'register_email']);

        return redirect()->route('login')
            ->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    /**
     * Gửi lại mã xác nhận đăng ký
     */
    public function resendRegisterCode(Request $request)
    {
        $email = session('register_email');
        if (!$email) {
            return redirect()->route('register')
                ->with('error', 'Phiên đăng ký đã hết hạn. Vui lòng thử lại.');
        }

        // Gửi lại mã xác minh
        $this->sendVerificationCode($email, 'register');

        return redirect()->back()
            ->with('success', 'Mã xác nhận mới đã được gửi đến email của bạn.');
    }

    /**
     * Xử lý quên mật khẩu - gửi mã xác nhận email
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lưu email vào session
        session(['reset_email' => $request->email]);

        // Tạo mã xác minh và gửi email
        $this->sendVerificationCode($request->email, 'reset');

        return redirect()->route('verify.code.form')
            ->with('success', 'Mã xác nhận đã được gửi đến email của bạn.');
    }

    /**
     * Xác thực mã quên mật khẩu
     */
    public function verifyResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => ['required', 'string', 'size:6', 'regex:/^\d{6}$/'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.request')
                ->with('error', 'Phiên làm việc đã hết hạn. Vui lòng thử lại.');
        }

        // Kiểm tra mã xác minh
        $verification = VerificationCode::where('email', $email)
            ->where('code', $request->verification_code)
            ->where('type', 'reset')
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verification) {
            return redirect()->back()
                ->with('error', 'Mã xác nhận không hợp lệ hoặc đã hết hạn.');
        }

        // Tạo token cho đặt lại mật khẩu và lưu vào bảng password_reset_tokens
        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['email' => $email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        // Xóa mã xác minh đã sử dụng
        $verification->delete();

        return redirect()->route('password.reset', ['token' => $token, 'email' => $email])
            ->with('success', 'Xác minh thành công. Vui lòng đặt lại mật khẩu của bạn.');
    }

    /**
     * Đặt lại mật khẩu mới
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/',
                'regex:/[\W]/',
            ],
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái, một số và một ký tự đặc biệt.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Kiểm tra token hợp lệ
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset) {
            return redirect()->route('password.request')
                ->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
        }

        // Cập nhật mật khẩu người dùng
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        // Xóa token đã sử dụng
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('success', 'Mật khẩu đã được cập nhật thành công. Vui lòng đăng nhập.');
    }

    /**
     * Gửi lại mã xác nhận quên mật khẩu
     */
    public function resendResetCode(Request $request)
    {
        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.request')
                ->with('error', 'Phiên làm việc đã hết hạn. Vui lòng thử lại.');
        }

        // Gửi lại mã xác minh
        $this->sendVerificationCode($email, 'reset');

        return redirect()->back()
            ->with('success', 'Mã xác nhận mới đã được gửi đến email của bạn.');
    }

    /**
     * Tạo và gửi mã xác minh cho Admin tạo tài khoản
     */
    private function sendAdminVerificationCode($email, $roleId, $userName)
    {
        // Xóa mã xác minh cũ nếu có
        VerificationCodeFromAdmin::where('email', $email)->delete();

        // Tạo mã xác minh mới
        $code = sprintf('%06d', mt_rand(100000, 999999));
        $expiresAt = Carbon::now()->addMinutes(10);

        // Xác định type dựa trên role_id
        $type = $roleId == 1 ? 'admin' : 'staff';

        // Lưu mã xác minh vào database
        VerificationCodeFromAdmin::create([
            'email' => $email,
            'code' => $code,
            'type' => $type,
            'role_id' => $roleId,
            'created_by_admin_id' => Auth::id(), // ID của admin hiện tại
            'expires_at' => $expiresAt
        ]);

        // Tạo subject và body cho email
        $roleName = $roleId == 1 ? 'Admin' : 'Staff';
        $subject = "Mã xác nhận tạo tài khoản $roleName";
        $body = "Chào $userName,\n\n";
        $body .= "Admin đã tạo tài khoản $roleName cho bạn.\n";
        $body .= "Mã xác nhận của bạn là: $code\n";
        $body .= "Mã có hiệu lực trong 10 phút.\n\n";
        $body .= "Vui lòng sử dụng mã này để hoàn tất việc tạo tài khoản và đặt mật khẩu.";

        // Gửi email với mã xác minh
        Mail::raw($body, function ($message) use ($email, $subject) {
            $message->to($email)
                ->subject($subject);
        });
    }

    /**
     * Tạo và gửi mã xác minh (cho register thông thường và reset password)
     */
    private function sendVerificationCode($email, $type)
    {
        // Xóa mã xác minh cũ nếu có
        VerificationCode::where('email', $email)
            ->where('type', $type)
            ->delete();

        // Tạo mã xác minh mới
        $code = sprintf('%06d', mt_rand(100000, 999999));
        $expiresAt = Carbon::now()->addMinutes(10);

        // Lưu mã xác minh vào database
        VerificationCode::create([
            'email' => $email,
            'code' => $code,
            'type' => $type,
            'expires_at' => $expiresAt
        ]);

        // Tạo subject và body cho email
        switch ($type) {
            case 'register':
                $subject = 'Mã xác nhận đăng ký tài khoản';
                $body = "Mã xác nhận đăng ký tài khoản của bạn là: $code. Mã có hiệu lực trong 10 phút.";
                break;
            case 'reset':
                $subject = 'Mã xác nhận quên mật khẩu';
                $body = "Mã xác nhận quên mật khẩu của bạn là: $code. Mã có hiệu lực trong 10 phút.";
                break;
            default:
                $subject = 'Mã xác nhận';
                $body = "Mã xác nhận của bạn là: $code. Mã có hiệu lực trong 10 phút.";
        }

        // Gửi email với mã xác minh bằng Mail::raw
        Mail::raw($body, function ($message) use ($email, $subject) {
            $message->to($email)
                ->subject($subject);
        });
    }

    // Hiển thị form thêm tài khoản từ Admin
    public function showAddUserForm()
    {
        return view('admin.add_users_role_admin_staff');
    }

    // Hiển thị form xác minh mã thêm tài khoản từ Admin
    public function showVerifyAddUserForm()
    {
        return view('admin.verify_add_user_role');
    }
}
