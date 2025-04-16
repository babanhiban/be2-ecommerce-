<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>
    <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="nav">
            <a href="#" class="nav-item active">Màn Hình</a>
            <span class="nav-label">Nhập Mật Khẩu Mới</span>
        </div>
        <div class="logo-container">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">
        </div>
    </header>

    <div class="container">
        <div class="left-image">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo">
        </div>
        <div class="form-area">
            <h2>Tạo mật khẩu mới</h2>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ old('email', request('email')) }}">
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận lại mật khẩu" required>
                </div>
                <button type="submit" class="btn-submit">Đăng nhập</button>
            </form>
            <div class="divider"><span>Hoặc</span></div>
            <div class="links">
                <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></p>
                <br>
                <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
            </div>
        </div>
    </div>
</body>

</html>