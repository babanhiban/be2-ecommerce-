<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\StatisticsController;
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
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Xác nhận mã đăng ký
Route::get('/verify-register', function () {
    return view('auth.verify-register');
})->name('verify.register');
Route::post('/verify-register', [AuthController::class, 'verifyRegister'])->name('verify.register.post');
Route::post('/resend-register-code', [AuthController::class, 'resendRegisterCode'])->name('resend.register.code');

// Quên mật khẩu
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

// Xác nhận mã khi quên mật khẩu
Route::get('/verify-code', function () {
    return view('auth.verify-code');
})->name('verify.code.form');
Route::post('/verify-code', [AuthController::class, 'verifyResetCode'])->name('verify.code');
Route::post('/resend-reset-code', [AuthController::class, 'resendResetCode'])->name('resend.reset.code');

// Xác nhận thay đổi mật khẩu mới sau khi quên mật khẩu
Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Đăng nhập xử lý
Route::post('/login', [CrudUserController::class, 'authUser'])->name('login.post');

// Đăng xuất
Route::get('/logout', [CrudUserController::class, 'signOut'])->name('logout');

// Danh sách tài khoản
Route::get('/list_users', [CrudUserController::class, 'listUser'])->name('admin.users');

// Xóa tài khoản
Route::get('delete', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');

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

// Thêm tài khoản bởi Admin
Route::get('add_users_role_admin_staff', [AuthController::class, 'showAddUserForm'])->name('admin.users.add');
Route::post('add_users_role_admin_staff', [AuthController::class, 'registerAddUserFormAdmin'])->name('admin.users.add.post');

// Xác nhận mã khi thêm tài khoản mới bởi Admin
Route::get('verify_add_user_role', [AuthController::class, 'showVerifyAddUserForm'])->name('admin.users.verify');
Route::post('verify_add_user_role', [AuthController::class, 'verifyAddUserFormAdmin'])->name('admin.users.verify.post');
Route::post('/resend-admin-register-code', [AuthController::class, 'resendAdminRegisterCode'])->name('resend.admin.register.code');


// Thanh toán
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
// Route::get('/statuspay', function () {
//     return view('payment.status');
// })->name('statuspay');

Route::get('/payment/status', function() {
    return view('payment.status');
})->name('payment.status');

Route::get('/addProduct', function () {
    return view('product.addProduct');
})->name('addProduct');
// danh sach san pham
Route::get('/list_products', [ProductController::class, 'listProduct'])->name('admin.products');
// lay taat ca category
Route::get('/addProduct', [ProductController::class, 'create'])->name('product.addProduct');
// theem san phaam
Route::post('/addProduct', [ProductController::class, 'store'])->name('products.store');
// Xóa san pham
Route::get('delete2', [ProductController::class, 'deleteProduct'])->name('products.deleteProduct');
// sua san phẩmphẩm
Route::get('/editProduct', function () {
    return view('product.editProduct');
})->name('editProduct');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.updateProduct');

Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.saveProduct');

// danh sach loại sản phẩm
Route::get('/categoryId_Product', function () {
    return view('product.categoryId_Product');
})->name('categoryId_Product');


Route::get('/search_result', function () {
    return view('product.search_result');
})->name('search_result');


Route::get('/category/{id}', [CategoryController::class, 'showProducts'])->name('product.categoryId_Product');

Route::get('/search', [HomeController::class, 'search'])->name('product.search_result');

Route::get('/admin/products/search', [ProductController::class, 'search'])->name('product.search');


//Trang chủ
Route::get('/homepage', function () {
    $user = null;
    $products = Products::all();
    $categories = Category::all(); // ✅ Lấy danh mục
    if (Auth::check()) {
        $user = Auth::user();
        if ($user) {
            $user->load('roles');
        }
    }
    return view('homepage', compact('products', 'categories', 'user'));
})->name('home');

// gio hang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

//chi tiết sản phẩm
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// thanh toán 
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

Route::match(['GET', 'POST'], '/checkout/buynow', [CheckoutController::class, 'buynow'])->name('checkout.buynow');

//đơn hàng

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::get('/orders/{id}', [OrderController::class, 'show']);


//Voucher
Route::resource('vouchers', VoucherController::class);
Route::put('/vouchers/{id}', [VoucherController::class, 'update']);
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/vouchers/check/{code}', [VoucherController::class, 'check']);

    // Thống kê voucher
Route::get('/statistics/vouchers', [VoucherController::class, 'statistics'])->name('statistics.vouchers');

// Thống kê đơn hàng
Route::get('/statistics/orders', [StatisticsController::class, 'index'])->name('statistics.orders');
Route::get('/statistics/orders/export', [StatisticsController::class, 'export'])->name('statistics.orders.export');

// thanh toan san pham
//Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

