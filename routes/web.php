<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CrudUserController;

use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Đăng nhập
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Đăng ký
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Xác nhận mã đăng ký
Route::get('/verify-register', function () {
    return view('auth.verify-register');
})->name('verify.register');

// Quên mật khẩu
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Nếu bạn muốn xử lý gửi email khôi phục mật khẩu (tùy chọn)
Route::post('/forgot-password', function () {
    // Xử lý logic gửi email
    return back()->with('status', 'Email khôi phục mật khẩu đã được gửi!');
})->name('password.email');

// Xác nhận mã khi quên mật khẩu
Route::get('/verify-code', function () {
    return view('auth.verify-code');
})->name('verify.code.form');

Route::post('/verify-code', function () {
    // Xử lý xác nhận mã ở đây
    return redirect()->route('password.reset'); // ví dụ
})->name('verify.code');

// Xác nhận thay đổi mật khẩu mới sau khi quên mật khẩu
Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');

Route::post('/reset-password', function (\Illuminate\Http\Request $request) {
    // Xử lý cập nhật mật khẩu ở đây...
    // Ví dụ: kiểm tra token/mã hợp lệ, cập nhật vào DB

    return redirect()->route('login')->with('success', 'Mật khẩu đã được cập nhật!');
})->name('password.update');

// Danh sách tài khoản
// Route::get('list_users', [CrudUserController::class, 'listUser'])->name('admin.users');

Route::get('/list_users', [CrudUserController::class, 'listUser'])->name('admin.users');

// Xóa tài khoản
Route::get('delete', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');
// Route::get('delete/{id}', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');

// Sửa tài khoản
Route::get('update', [CrudUserController::class, 'updateUser'])->name('user.updateUser');
Route::post('update', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');


//Roles
Route::get('role', [RoleController::class, 'role'])->name('user.role');
Route::get('/role/{id}', [RoleController::class, 'showRoleUsers'])->name('user.role.show');

// Chỉnh sửa tài khoản
Route::get('crud_users', function () {
    return view('admin.crud_users');
})->name('admin.users.edit');

// Đăng nhập
Route::get('/pay', function () {
    return view('payment.pay');
})->name('pay');

// hoa don
Route::get('/bill', function () {
    return view('payment.bill');
})->name('bill');

// hoan tien
Route::get('/refund', function () {
    return view('payment.refund');
})->name('refund');

// lich su giao dich
Route::get('/history', function () {
    return view('payment.history');
})->name('history');

// trang thai giao dich
Route::get('/statuspay', function () {
    return view('payment.status');
})->name('statuspay');
