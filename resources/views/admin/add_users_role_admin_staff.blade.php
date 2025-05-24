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
                <h2>Bạn hãy nhập đầy đủ các thông tin vào</h2>
                <br>
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
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nhập tên tài khoản" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Nhập email" required>
                    </div>
                    <div class="form-group">
                        <select name="role_id" class="form-control" required>
                            <option value="">-- Chọn vai trò --</option>
                            <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-register" style="background-color: #3ab5e0; color: white; padding: 12px 24px; font-size: 16px; border: none; border-radius: 6px; cursor: pointer;">
                        Đăng ký
                    </button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>