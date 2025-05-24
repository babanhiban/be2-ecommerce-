<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Tài Khoản</title>
    <link rel="stylesheet" href="{{ asset('css/admin/crud_users.css') }}">

    <!-- Kết nối đến css thông báo -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>

<body>
    <div class="header">
        <div class="header-title">
            <h1>THÊM TÀI KHOẢN</h1>
        </div>

        <!-- Hiển thị logo trên thanh tashbar -->
        <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">

    </div>
    <div class="main-container">
        <div class="sidebar">

            <!-- Hiển thị avatar của user -->
            <img src="{{ asset('images/manhinhchinhsuataikhoan/icon_user.png') }}" alt="Avatar" class="avatar">

            <!-- Các bút button giúp quay lại trang danh sách user bạn đang chỉnh sửa -->
            <a href="{{ route('home') }}" class="btn-nav" style="text-decoration: none;">Quay lại</a>

        </div>

        <div class="form-container">

            <div class="login-form">
                <h2>Xác nhận mã để đăng ký</h2>

                <!-- Thông báo tất cả các lỗi lỗi đỏ AuthController -->
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

                <!-- Thông báo lỗi đỏ ở trong AuthController -->
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Hiển thị text thông báo cho biết hệ thống đã gửi mã xác nhận về email nào  -->
                <p>Chúng tôi đã gửi mã xác nhận đến email: <strong>{{ session('register_email') }}</strong></p>
                <br>

                <!-- Form hiển thị các thông tin yêu cầu nhập các thông tin cần thiết -->
                <form method="POST" action="{{ route('admin.users.verify.post') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="verification_register" class="form-control" placeholder="Nhập mã xác nhận" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận lại mật khẩu" required>
                    </div>
                    <button type="submit" class="btn-reset">Xác nhận</button>
                </form>

                <!-- Hiển thị text thông báo cho người dùng đọc nếu xác nhận không thành công để người dùng có thể kiểm tra lại mình sai chỗ nào -->
                <br>
                <p style="color: red;">Nếu bạn không nhận được mã thì bạn có thể kiểm tra lại email xem đã đúng hoặc email có tồn tại hay không , bạn có thể chọn gửi lại mã</p>
                <br>

                <!-- Nút gửi lại mã giúp gửi lại mã mới vào email nếu email đó chưa nhận được hoặc mã đã hết hạn -->
                <div class="resend-code">
                    <form method="POST" action="{{ route('resend.register.code') }}">
                        @csrf
                        <button type="submit" class="btn-resend">Gửi lại mã</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>