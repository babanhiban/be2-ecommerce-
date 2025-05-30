<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Mã</title>

    <!-- Định dang form chữ cho tất cả text trong trang -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Kết nối với css của trang xác nhận mã khi quên mật khẩu -->
    <link rel="stylesheet" href="{{ asset('css/verify-code.css') }}">

    <!-- Kết nối đến css thông báo -->
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>

<body>
    <header class="header">
        <!-- Hiển thị text cho biết Trang đó là trang gì -->
        <div class="nav">
            <a href="#" class="nav-item active">Màn Hình</a>
            <a href="#" class="nav-item">Xác Nhận Mã</a>
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
            <h2>Xác nhận mã</h2>

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

            <!-- Hiển thị text thông báo cho biết hệ thống đã gửi mã xác nhận về email nào  -->
            <p>Chúng tôi đã gửi mã xác nhận đến email: <strong>{{ session('reset_email') }}</strong></p>
            <br>

            <!-- Form hiển thị các thông tin yêu cầu nhập các thông tin cần thiết -->
            <form method="POST" action="{{ route('verify.code') }}">
                @csrf
                <div class="form-group">
                    <input type="text"
                        name="verification_code"
                        class="form-control"
                        placeholder="Nhập mã xác nhận (6 số)"
                        required
                        maxlength="6"
                        pattern="\d{6}"
                        inputmode="numeric"
                        title="Mã xác nhận chỉ được chứa 6 chữ số"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                <!-- Hiển thị các thông báo lỗi dưới input nếu có -->
                @error('verification_register')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <button type="submit" class="btn-reset">Tiếp theo</button>
            </form>

            <!-- Hiển thị text thông báo cho người dùng đọc nếu xác nhận không thành công để người dùng có thể kiểm tra lại mình sai chỗ nào -->
            <br>
            <p style="color: red;">Nếu bạn không nhận được mã thì bạn có thể kiểm tra lại email xem đã đúng hoặc email có tồn tại hay không , bạn có thể chọn gửi lại mã</p>
            <br>

            <!-- Nút gửi lại mã giúp gửi lại mã mới vào email nếu email đó chưa nhận được hoặc mã đã hết hạn -->
            <div class="resend-code">
                <form method="POST" action="{{ route('resend.reset.code') }}">
                    @csrf
                    <button type="submit" class="btn-resend">Gửi lại mã</button>
                </form>
            </div>

            <!-- Text hiển thị chữ hoặc -->
            <div class="divider">
                <span class="divider-text">Hoặc</span>
            </div>

            <!-- Các chữ link với các trang như đăng ký , đăng nhập để chuyển hướng tài khoản -->
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