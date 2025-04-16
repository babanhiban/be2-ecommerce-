<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <header class="header">
        <div class="nav">
            <a href="#" class="nav-item active">Màn Hình</a>
            <a href="#" class="nav-item">Đăng Nhập</a>
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
            <h2>Đăng Nhập</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>
            <a href="#" class="forgot-password">Quên mật khẩu?</a>
            <div class="divider">
                <span class="divider-text">Hoặc</span>
            </div>
            <div class="register-link">
                <span>Bạn chưa có tài khoản? </span>
                <a href="#">Đăng Ký</a>
            </div>
        </div>
    </div>
</body>

</html>