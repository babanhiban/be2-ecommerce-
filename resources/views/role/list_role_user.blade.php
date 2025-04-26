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
            <h1>DANH SÁCH TẤT TÀI KHOẢN THUỘC {{ $role->name }}</h1>
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
            <tbody>
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
                    <th class="action-buttons">
                        <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}" class="btn-delete">Xóa</a>
                        <button class="btn-edit"><a href="{{ route('user.updateUser', ['id' => $user->id]) }}">Sửa</a></button>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {!! $users->links('pagination::bootstrap-5') !!}
    </div>

    <div class="navigation-buttons">
        <a href="{{ route('admin.users') }}" class="btn-nav">Quay lại</a>

        @foreach($user->roles as $role)
        <a href="{{ route('user.role', ['id' => $role->id]) }}">
            <a href="{{ route('user.role.show', ['id' => 1]) }}" class="btn-nav">
                Danh Sách Quản Lý
            </a>

            <a href="{{ route('user.role.show', ['id' => 2]) }}" class="btn-nav">
                Danh Sách Nhân Viên
            </a>

            <a href="{{ route('user.role.show', ['id' => 3]) }}" class="btn-nav">
                Danh Sách Người Dùng
            </a>
        </a>
        @endforeach
    </div>
</body>

</html>