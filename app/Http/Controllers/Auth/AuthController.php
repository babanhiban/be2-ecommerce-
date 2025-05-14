<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\VerificationCode;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Xử lý đăng ký người dùng - gửi mã xác nhận email
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
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
     * Xác thực mã đăng ký và tạo tài khoản
     */
    public function verifyRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_register' => 'required|string|min:6|max:6',
            'password' => 'required|string|min:6|confirmed',
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
            'verification_code' => 'required|string|min:6|max:6',
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
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email|exists:users,email',
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
     * Tạo và gửi mã xác minh
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

        // Gửi email với mã xác minh
        $subject = ($type == 'register')
            ? 'Mã xác nhận đăng ký tài khoản'
            : 'Mã xác nhận quên mật khẩu';

        $body = ($type == 'register')
            ? "Mã xác nhận đăng ký tài khoản của bạn là: $code. Mã có hiệu lực trong 10 phút."
            : "Mã xác nhận quên mật khẩu của bạn là: $code. Mã có hiệu lực trong 10 phút.";

        $this->emailService->sendEmail($email, $subject, $body);
    }
}
