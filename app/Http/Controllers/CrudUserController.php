<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CrudUserController extends Controller
{
    public function login()
    {
        return view('crud_user.login');
    }

    public function authUser(Request $request)
    {
        // Lấy input và trim khoảng trắng, cả khoảng trắng thường và khoảng trắng Unicode (ví dụ dấu cách toàn bộ)
        $input = $request->only('email', 'password');

        foreach (['email', 'password'] as $field) {
            if (isset($input[$field])) {
                $input[$field] = preg_replace('/^[\s\x{3000}]+|[\s\x{3000}]+$/u', '', $input[$field]);
            }
        }

        // Gán lại dữ liệu đã trim vào request để validate và Auth dùng
        $request->merge($input);

        // Validate dữ liệu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('homepage')->withSuccess('Signed in');
        }

        return redirect("login")->withErrors(['msg' => 'Login details are not valid']);
    }

    public function createUser()
    {
        return view('crud_user.create');
    }

    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        User::create([
            'name' => trim($data['name']),
            'email' => trim($data['email']),
            'phone' => $data['phone'],
            'address' => trim($data['address']),
            'gioitinh' => $data['gioitinh'],
            'ngaysinh' => $data['ngaysinh'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect("login")->withSuccess('Đăng ký thành công');
    }

    public function readUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        if (!$user) {
            return abort(404, 'Người dùng không tồn tại');
        }

        return view('crud_user.read', ['messi' => $user]);
    }

    public function deleteUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        if (!$user) {
            return redirect()->route('admin.users')->withErrors(['msg' => 'Người dùng không tồn tại hoặc đã bị xóa.']);
        }

        $user->delete();

        return redirect()->route('admin.users')->withSuccess('User deleted successfully');
    }

    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        if (!$user) {
            return response()->view('errors.not_found', [], 404); // dùng view tùy chỉnh
        }

        return view('admin.crud_users', ['user' => $user]);
    }

    public function getUpdateUser($id)
    {
        $user = User::with('roles')->find($id);

        if (!$user) {
            return response()->view('errors.not_found', [], 404);
        }

        return view('admin.edit_user', compact('user'));
    }

    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        foreach (['name', 'email', 'address', 'password'] as $field) {
            if (isset($input[$field])) {
                $input[$field] = preg_replace('/^[\s\x{3000}]+|[\s\x{3000}]+$/u', '', $input[$field]);
            }
        }

        $request->merge($input);

        $request->validate([
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email,' . $input['id'],
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'address' => 'required|string|max:255',
            'gioitinh' => 'required|in:Nam,Nữ',
            'ngaysinh' => ['required', 'regex:/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/[0-9]{4}$/'],
            'password' => 'nullable|min:6',
        ], [
            'email.unique' => 'Email đã tồn tại.',
            'phone.regex' => 'Số điện thoại phải từ 10 đến 15 chữ số.',
            'ngaysinh.regex' => 'Ngày sinh không đúng định dạng dd/mm/yyyy.',
        ]);

        $user = User::find($input['id']);

        $formUpdatedAt = Carbon::parse($input['updated_at']);
        $dbUpdatedAt = Carbon::parse($user->updated_at);

        if (!$formUpdatedAt->eq($dbUpdatedAt)) {
            return back()->withErrors(['msg' => 'Thông tin đã bị thay đổi ở nơi khác. Vui lòng tải lại.']);
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->address = $input['address'];
        $user->gioitinh = $input['gioitinh'];

        try {
            $user->ngaysinh = Carbon::createFromFormat('d/m/Y', $input['ngaysinh'])->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['ngaysinh' => 'Ngày sinh không hợp lệ.']);
        }

        if (!empty($input['password'])) {
            $user->password = Hash::make($input['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->withSuccess('User update successfully');
    }

    public function listUser()
    {
        return view('admin.list_users', [
            'user' => optional(Auth::user())->load('roles'),
            'users' => User::with('roles')->paginate(5)
        ]);
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
