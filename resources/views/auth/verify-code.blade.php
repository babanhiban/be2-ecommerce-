<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Mã</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/verify-code.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
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

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <p>Chúng tôi đã gửi mã xác nhận đến email: <strong>{{ session('reset_email') }}</strong></p>
            <br>

            <form method="POST" action="{{ route('verify.code') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="verification_code" class="form-control" placeholder="Nhập mã xác nhận" required>
                </div>
                <button type="submit" class="btn-reset">Tiếp theo</button>
            </form>

            <div class="resend-code">
                <form method="POST" action="{{ route('resend.reset.code') }}">
                    @csrf
                    <button type="submit" class="btn-resend">Gửi lại mã</button>
                </form>
            </div>

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