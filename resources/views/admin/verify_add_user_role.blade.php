<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Thêm Tài Khoản</title>
    <link rel="stylesheet" href="{{ asset('css/admin/crud_users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
</head>

<body>
    <div class="header">
        <div class="header-title">
            <h1>XÁC NHẬN THÊM TÀI KHOẢN</h1>
        </div>
        <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">
    </div>

    <div class="main-container">
        <div class="sidebar">
            <img src="{{ asset('images/manhinhchinhsuataikhoan/icon_user.png') }}" alt="Avatar" class="avatar">
            <a href="{{ route('admin.users') }}" class="btn-nav" style="text-decoration: none;">Quay lại</a>
        </div>

        <div class="form-container">
            <div class="login-form">
                <h2>Xác nhận mã để tạo tài khoản</h2>

                <!-- Thông báo lỗi -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Thông báo thành công -->
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Thông báo lỗi khác -->
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Thông tin tài khoản -->
                <p>Chúng tôi đã gửi mã xác nhận đến email: <strong>{{ session('admin_register_email') }}</strong></p>
                <p>Tên tài khoản: <strong>{{ session('admin_register_name') }}</strong></p>
                <p>Vai trò: <strong>
                        @switch(session('admin_register_role_id'))
                        @case(1)
                        Admin
                        @break
                        @case(2)
                        Staff
                        @break
                        @default
                        Không xác định
                        @endswitch
                    </strong></p>

                <br>

                <!-- Form xác nhận mã và tạo mật khẩu -->
                <form method="POST" action="{{ route('admin.users.verify.post') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text"
                                name="verification_register"
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
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận lại mật khẩu" required>
                    </div>
                    <button type="submit" class="btn-reset" style="background-color: #28a745; color: white; padding: 12px 24px; font-size: 16px; border: none; border-radius: 6px; cursor: pointer; width: 100%;">
                        Xác nhận và tạo tài khoản
                    </button>
                </form>

                <br>
                <p style="color: #666; font-size: 14px;">
                    <strong>Lưu ý:</strong> Nếu bạn không nhận được mã, vui lòng kiểm tra hộp thư spam hoặc chọn "Gửi lại mã" bên dưới. Mã xác nhận có hiệu lực trong 10 phút.
                </p>

                <br>

                <!-- Gửi lại mã xác nhận -->
                <div class="resend-code" style="text-align: center;">
                    <form method="POST" action="{{ route('resend.admin.register.code') }}">
                        @csrf
                        <button type="submit" class="btn-resend" style="background-color: #007bff; color: white; padding: 10px 20px; font-size: 14px; border: none; border-radius: 4px; cursor: pointer;">
                            Gửi lại mã
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>