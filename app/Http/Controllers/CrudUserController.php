<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{

    /**
     * Login page
     */
    public function login()
    {
        return view('crud_user.login');
    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('homepage')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('crud_user.create');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],

            'phone' => $data['phone'],
            'address' => $data['address'],
            'gioitinh' => $data['gioitinh'],
            'ngaysinh' => $data['ngaysinh'],


            'password' => Hash::make($data['password'])
        ]);

        return redirect("login");
    }

    /**
     * View user detail page
     */
    public function readUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.read', ['messi' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::destroy($user_id);


        // Quay lại trang danh sách người dùng sau khi xóa thành công
        return redirect()->route('admin.users')->withSuccess('User deleted successfully');

        // $user_id = $request->get('id');
        // $user = User::destroy($user_id);

        // return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('admin.crud_users', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {

        $input = $request->all();

        // Xử lý loại bỏ khoảng trắng ở đầu, cuối và khoảng trắng Unicode đặc biệt
        $cleanInput = $input;
        foreach (['name', 'email', 'address', 'password'] as $field) {
            if (isset($cleanInput[$field])) {
                // Loại bỏ khoảng trắng thông thường và khoảng trắng Unicode (full-width space)
                $cleanInput[$field] = preg_replace('/^[\s\x{3000}]+|[\s\x{3000}]+$/u', '', $cleanInput[$field]);
            }
        }

        $request->merge($cleanInput); // Gộp dữ liệu đã làm sạch vào lại request để validate

        // Validation
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email,' . $input['id'],
            'phone' => [
                'required',
                'regex:/^[0-9]{10,15}$/',
            ],
            'address' => 'required|string|max:255',
            'gioitinh' => 'required|in:Nam,Nữ',
            'ngaysinh' => [
                'required',
                'regex:/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/[0-9]{4}$/'
            ],
            'password' => 'nullable|min:6',
        ], [
            'name.max' => 'Tên không được vượt quá 30 ký tự.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.regex' => 'Số điện thoại phải từ 10 đến 15 chữ số và không được chứa chữ.',
            'ngaysinh.regex' => 'Ngày sinh không đúng định dạng dd/mm/yyyy. Ví dụ: 27/11/2004',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự.',
        ]);

        // Kiểm tra tồn tại
        $user = User::find($input['id']);
        if (!$user) {
            return back()->withErrors(['msg' => 'Người dùng không tồn tại']);
        }

        // So sánh updated_at
        $formUpdatedAt = \Carbon\Carbon::parse($input['updated_at']);
        $dbUpdatedAt = \Carbon\Carbon::parse($user->updated_at);

        if (!$formUpdatedAt->eq($dbUpdatedAt)) {
            return back()->withErrors(['msg' => 'Thông tin tài khoản đã được thay đổi ở nơi khác. Vui lòng tải lại trang để cập nhật dữ liệu mới nhất.']);
        }

        // Cập nhật thông tin
        $user->name = $cleanInput['name'];
        $user->email = $cleanInput['email'];
        $user->phone = $input['phone']; // phone không trim để tránh mất số
        $user->address = $cleanInput['address'];
        $user->gioitinh = $input['gioitinh'];

        try {
            $user->ngaysinh = Carbon::createFromFormat('d/m/Y', $input['ngaysinh'])->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['ngaysinh' => 'Ngày sinh không hợp lệ. Định dạng đúng là dd/mm/yyyy']);
        }

        // Cập nhật mật khẩu nếu có
        if (!empty($cleanInput['password'])) {
            $user->password = Hash::make($cleanInput['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->withSuccess('User update successfully');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        return view('admin.list_users', [
            'user' => optional(Auth::user())->load('roles'),
            'users' => User::with('roles')->paginate(5)
        ]);

        // BỎ Auth::check() nếu muốn ai cũng truy cập được
        // return view('admin.list_users', [
        //     'users' => User::with('roles')->paginate(5)
        // ]);


        // if (Auth::check()) {
        //     return view('admin.list_users', [
        //         'users' => User::with('roles')->paginate(10)
        //     ]);
        // }

        // return redirect("login")->withSuccess('You are not allowed to access');
    }


    /**
     * Sign out
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
