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
            <h1>DANH SÁCH TẤT TÀI KHOẢN THEO QUYỀN</h1>
        </div>
        <div class="logo-container">
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">
        </div>
    </header>

    <div class="container">
        <table class="accounts-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                </tr>
            </tbody>
        </table>
    </div>

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
                @foreach($role->users as $user)
                <tr>
                    <th>{{$user->id}}</th>
                    <th>{{$user->name}}</th>
                    <th>{{$user->email}}</th>
                </tr>
                @endforeach
                <th class="action-buttons">
                    <button class="btn-delete"><a href="{{ route('user.deleteUser', ['id' => $user->id]) }}">Xóa</a></button>
                    <button class="btn-edit"><a href="{{ route('user.updateUser', ['id' => $user->id]) }}">Sửa</a></button>
                </th>
                </tr>


            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {!! $users->links('pagination::bootstrap-5') !!}
    </div>

    <div class="navigation-buttons">
        <a href="" class="btn-nav">Quay lại</a>
        <a href="" class="btn-nav">Danh Sách Quản Lý</a>
        <a href="" class="btn-nav">Danh Sách Nhân Viên</a>
        <a href="" class="btn-nav">Danh Sách Người Dùng</a>
    </div>
</body>

</html>