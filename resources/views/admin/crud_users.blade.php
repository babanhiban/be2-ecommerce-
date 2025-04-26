<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Tài Khoản</title>
    <link rel="stylesheet" href="{{ asset('css/admin/crud_users.css') }}">
</head>

<body>
    <div class="header">
        <div class="header-title">
            <h1>CHỈNH SỬA TÀI KHOẢN</h1>
        </div>
        <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">
    </div>
    <div class="main-container">
        <div class="sidebar">
            <img src="{{ asset('images/manhinhchinhsuataikhoan/icon_user.png') }}" alt="Avatar" class="avatar">
            <h2>Username</h2>
            <button class="btn-nav">Xóa hồ sơ</button>
            <button class="btn-nav">Quay lại</button>
        </div>

        <div class="form-container">
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="username" value="username">
                    <button class="btn-edit">Chỉnh sửa</button>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="username@gmail.com">
                    <button class="btn-edit">Chỉnh sửa</button>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="123456789">
                    <button class="btn-edit">Chỉnh sửa</button>
                </div>
                <div class="form-group gender">
                    <label>Giới tính</label>
                    <div class="gender-options">
                        <label><input type="radio" name="gender" value="Nam" checked> Nam</label>
                        <label><input type="radio" name="gender" value="Nữ"> Nữ</label>
                    </div>
                    <button class="btn-edit">Chỉnh sửa</button>
                </div>
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="text" name="dob" value="27/11/2004">
                    <button class="btn-edit">Chỉnh sửa</button>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" value="password123">
                    <button class="btn-edit">Chỉnh sửa</button>
                </div>
                <div class="form-group">
                    <label>Chức năng</label>
                    <input type="text" name="role" value="Người dùng">
                    <button class="btn-edit">Chỉnh sửa</button>
                </div>
                <div class="navigation-buttons">
                    <button type="submit" class="btn-nav">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>