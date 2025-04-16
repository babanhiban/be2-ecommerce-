<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
</head>

<body>
    <header class="header">
        <div class="nav">
            <a href="#" class="nav-item">Màn Hình</a>
            <a href="#" class="nav-item active">Quên Mật Khẩu</a>
        </div>
        <div class="logo-container">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">
        </div>
    </header>

    <div class="container">
        <div class="login-image">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo">
        </div>
        <div class="login-form">
            <h2>Quên mật khẩu</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                </div>
                <button type="submit" class="btn-reset">Lấy lại mật khẩu</button>
            </form>
            <div class="divider">
                <span class="divider-text">Hoặc</span>
            </div>
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