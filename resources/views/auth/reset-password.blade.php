<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>

    <!-- Kết nối với css của trang tạo lại mật khẩu mới -->
    <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">

    <!-- Kết nối đến css thông báo -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">

    <!-- Định dang form chữ cho tất cả text trong trang -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">

        <!-- Hiển thị text cho biết Trang đó là trang gì -->
        <div class="nav">
            <a href="#" class="nav-item active">Màn Hình</a>
            <span class="nav-label">Nhập Mật Khẩu Mới</span>
        </div>

        <!-- Hiển thị hình ảnh logo trang web ở thanh tashbar -->
        <div class="logo-container">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">
        </div>

    </header>

    <div class="container">

        <!-- Hiển thị hình ảnh logo trang web ở ngay Form -->
        <div class="left-image">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo">
        </div>

        <div class="form-area">
            <h2>Tạo mật khẩu mới</h2>

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
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ old('email', request('email')) }}">
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" attern="^(?!^\s)(?!^\u3000)(?!.*\s$)(?!.*\u3000$)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$"
                        title="Mật khẩu ít nhất 6 ký tự, gồm chữ hoa, thường và số" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận lại mật khẩu" attern="^^(?!^\s)(?!^\u3000)(?!.*\s$)(?!.*\u3000$)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$"
                        title="Mật khẩu ít nhất 6 ký tự, gồm chữ hoa, thường và số" required>
                </div>
                <button type="submit" class="btn-submit">Đặt lại mật khẩu</button>
            </form>

            <!-- Text hiển thị chữ hoặc -->
            <div class="divider"><span>Hoặc</span></div>

            <!-- Các chữ link với các trang như đăng ký , đăng nhập để chuyển hướng tài khoản -->
            <div class="links">
                <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></p>
                <br>
                <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
            </div>


        </div>
    </div>
</body>

</html>