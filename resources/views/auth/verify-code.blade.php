<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Mã</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/verify-code.css') }}">
</head>

<body>
    <header class="header">
        <div class="nav">
            <a href="#" class="nav-item active">Màn Hình</a>
            <a href="#" class="nav-item">Xác Nhận Mã</a>
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
            <h2>Xác nhận mã</h2>
            <form method="POST" action="{{ route('verify.code') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="verification_code" class="form-control" placeholder="Nhập mã xác nhận" required>
                </div>
                <button type="submit" class="btn-reset">Tiếp theo</button>
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