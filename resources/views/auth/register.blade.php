<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>

    <!-- Định dang form chữ cho tất cả text trong trang -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Kết nối với css của trang đăng ký -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <!-- Kết nối đến css thông báo -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>

<body>
    <header class="header">

        <!-- Hiển thị text cho biết Trang đó là trang gì -->
        <div class="nav">
            <a href="#" class="nav-item active">Màn Hình</a>
            <a href="#" class="nav-item">Đăng Ký</a>
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
            <h2>Đăng Ký</h2>

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
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nhập tên tài khoản" pattern="^(?!.*\s$)(?!.*\u3000$).{1,30}$"
                        maxlength="30" required autofocus>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Nhập email" pattern="^(?!^\s)(?!^\u3000)(?!.*\s$)(?!.*\u3000$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                        title="Email phải hợp lệ, ví dụ: ten@example.com"
                        required>
                </div>
                <button type="submit" class="btn-register">Đăng ký</button>
            </form>

            <!-- Text hiển thị chữ hoặc -->
            <div class="divider">
                <span class="divider-text">Hoặc</span>
            </div>

            <!-- Chữ link với trang đăng nhập để chuyển hướng tài khoản -->
            <div class="login-link">
                <span>Bạn đã có tài khoản? </span>
                <a href="{{ route('login') }}">Đăng Nhập</a>
            </div>
        </div>
    </div>
</body>

</html>