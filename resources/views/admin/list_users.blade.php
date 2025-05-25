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
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Quyền</th>
                    <th>Chức năng</th>
                </tr>
            </thead>

            <!-- dùng vòng lập để lấy toàn bộ user vào load lên danh sách -->
            <tbody>
                @if($users->count() == 0)
                <tr>
                    <td colspan="5" style="text-align: center; color: #999;">Danh sách rỗng, không có tài khoản nào.</td>
                </tr>
                @else
                @foreach($users as $user)
                <tr>
                    <th>{{ $user->name }}</th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->phone }}</th>
                    <th>
                        @foreach($user->roles as $role)

                        {{ $role->name}}

                        @endforeach
                    </th>

                    <!-- Các nút button chuyển hướng đến trang thông tin user hoặc xóa thẳng user -->
                    <th class="action-buttons">
                        <button class="btn-edit"><a href="{{ route('user.deleteUser', ['id' => $user->id]) }}">Xóa</a></button>
                        <button class="btn-edit"><a href="{{ route('user.updateUser', ['id' => $user->id]) }}">Sửa</a></button>
                    </th>

                </tr>
                @endforeach
                @endif
            </tbody>

        </table>
    </div>

    <!-- Sử dụng boostrap để tạo các thanh pagination -->
    <div class="pagination-container">
        {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>

    <!-- Các nút button giúp load lại danh sách theo role bằng cách chuyển trang qua list_role_user -->
    <div class="navigation-buttons">
        <a href="{{ route('home') }}" class="btn-nav">Quay lại</a>

        <a href="{{ route('user.role.show', ['id' => 1]) }}" class="btn-nav">
            Danh Sách Quản Lý
        </a>

        <a href="{{ route('user.role.show', ['id' => 2]) }}" class="btn-nav">
            Danh Sách Nhân Viên
        </a>

        <a href="{{ route('user.role.show', ['id' => 3]) }}" class="btn-nav">
            Danh Sách Người Dùng
        </a>

        <a href="{{ route('admin.users.add') }}" class="btn-adduser" style="text-decoration: none;"> Thêm Tài Khoản Mới</a>
    </div>


</body>

</html>