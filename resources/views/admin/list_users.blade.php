<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Tài Khoản</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/list_users.css') }}">
</head>

<body>
    <header class="header">
        <div class="header-title">
            <h1>DANH SÁCH TẤT CẢ TÀI KHOẢN</h1>
        </div>
        <div class="logo-container">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">
        </div>
    </header>

    <div class="container">
        <table class="accounts-table">
            <thead>
                <tr>
                    <th>Tài khoản</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Quyền</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Username1</td>
                    <td>user1@gmail.com</td>
                    <td>123456789</td>
                    <td>Người dùng</td>
                    <td class="action-buttons">
                        <button class="btn-delete">Xóa</button>
                        <button class="btn-edit">Sửa</button>
                    </td>
                </tr>
                <tr>
                    <td>Username2</td>
                    <td>user2@gmail.com</td>
                    <td>123456789</td>
                    <td>Người dùng</td>
                    <td class="action-buttons">
                        <button class="btn-delete">Xóa</button>
                        <button class="btn-edit">Sửa</button>
                    </td>
                </tr>
                <tr>
                    <td>Username3</td>
                    <td>user3@gmail.com</td>
                    <td>123456789</td>
                    <td>Người dùng</td>
                    <td class="action-buttons">
                        <button class="btn-delete">Xóa</button>
                        <button class="btn-edit">Sửa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="navigation-buttons">
        <a href="" class="btn-nav">Quay lại</a>
        <a href="" class="btn-nav">Danh Sách Quản Lý</a>
        <a href="" class="btn-nav">Danh Sách Nhân Viên</a>
        <a href="" class="btn-nav">Danh Sách Người Dùng</a>
    </div>
</body>

</html>