<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <header class="header">
        <div class="nav">
            <a href="#" class="nav-item">Màn Hình</a>
            <a href="#" class="nav-item active">Đăng Ký</a>
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
            <h2>Đăng Ký</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên tài khoản" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
                </div>
                <button type="submit" class="btn-register">Đăng ký</button>
            </form>
            <div class="divider">
                <span class="divider-text">Hoặc</span>
            </div>
            <div class="login-link">
                <span>Bạn đã có tài khoản? </span>
                <a href="{{ route('login') }}">Đăng Nhập</a>
            </div>
        </div>
    </div>
</body>

</html>