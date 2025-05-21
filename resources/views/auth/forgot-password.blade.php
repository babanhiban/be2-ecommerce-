<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>

    <!-- Định dang form chữ cho tất cả text trong trang -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Kết nối với css của trang quên mật khẩu -->
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">

    <!-- Kết nối đến css thông báo -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>

<body>
    <header class="header">

        <!-- Hiển thị text cho biết Trang đó là trang gì -->
        <div class="nav">
            <a href="#" class="nav-item active">Màn Hình</a>
            <a href="#" class="nav-item">Quên Mật Khẩu</a>
        </div>

        <!-- Hiển thị hình ảnh logo trang web ở thanh tashbar -->
        <div class="logo-container">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">
        </div>

    </header>

    <div class="container">
        <!-- Hiển thị hình ảnh logo trang web ở ngay Form -->
        <div class="login-image">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo">
        </div>

        <div class="login-form">
            <h2>Quên mật khẩu</h2>


            <!-- Thông báo tất cả các lỗi đỏ AuthController -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Thông báo xanh "Mã xác nhận đã gửi" được lấy từ bên AuthController -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Thông báo lỗi đỏ ở trong AuthController  -->
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif


            <!-- Form hiển thị các thông tin yêu cầu nhập các thông tin cần thiết -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Nhập email" required>
                </div>
                <button type="submit" class="btn-reset">Lấy lại mật khẩu</button>
            </form>

            <!-- Text hiển thị chữ hoặc -->
            <div class="divider">
                <span class="divider-text">Hoặc</span>
            </div>

            <!-- Các chữ link với các trang như đăng ký đăng nhập để chuyển hướng tài khoản -->
            <div class="links">
                <div class="register-link">
                    <span>Bạn chưa có tài khoản? </span>
                    <a href="{{ route('register') }}">Đăng ký</a>
                </div>
                <div class="login-link">
                    <span>Bạn đã có tài khoản? </span>
                    <a href="{{ route('login') }}">Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>