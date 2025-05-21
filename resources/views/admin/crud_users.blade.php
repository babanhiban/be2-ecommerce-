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

        <!-- Hiển thị logo trên thanh tashbar -->
        <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="logo-header">

    </div>
    <div class="main-container">
        <div class="sidebar">

            <!-- Hiển thị avatar của user -->
            <img src="{{ asset('images/manhinhchinhsuataikhoan/icon_user.png') }}" alt="Avatar" class="avatar">

            <!-- Lấy tên user đó vào để hiển thị ở dưới Avatar user -->
            <label for="">{{ $user->name }}</label>

            <!-- Các bút button giúp quay lại trang danh sách hoặc xóa thẳng user bạn đang chỉnh sửa -->
            <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}" class="btn-delete" style="text-decoration: none;">Xóa hồ sơ</a>
            <a href="{{ route('home') }}" class="btn-nav" style="text-decoration: none;">Quay lại</a>

        </div>

        <div class="form-container">

            <!-- Form hiển thị các thông tin của user cũng như có thể thay đổi thông tin -->
            <!-- Ở trong form nếu bạn muốn thay đổi 1 thông tin trong nhiều thông tin của user thì dữ liệu user của bạn phải đầy đủ hết thông tin nếu không hệ thống sẽ yêu cầu bạn nhập đầy đủ hết tất cả thông tin -->
            <form action="{{ route('user.postUpdateUser') }}" method="POST">
                @csrf
                <input name="id" type="hidden" value="{{$user->id}}">

                <!-- Lấy tên của user -->
                <div class="form-group">
                    <label for="name">Tên</label>

                    <input ype="text" placeholder="Name" id="name"
                        class="form-control" name="name"
                        value="{{ $user->name }}"
                        required autofocus>
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name')
                            }}</span>
                    @endif

                    <button type="submit" class="btn-edit">Chỉnh sửa</button>
                </div>

                <!-- Lấy email của user -->
                <div class="form-group">
                    <label for="email">Email</label>

                    <input type="text" placeholder="Email"
                        id="email_address" class="form-control"
                        value="{{ $user->email }}"
                        name="email" required autofocus>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email')
                            }}</span>
                    @endif

                    <button type="submit" class="btn-edit">Chỉnh sửa</button>
                </div>

                <!-- Lấy số điện thoại của user -->
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>

                    <input type="number" placeholder="Số Điện Thoại"
                        id="phone" class="form-control"
                        value="{{ $user->phone }}"
                        name="phone" required autofocus>
                    @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone')
                            }}</span>
                    @endif

                    <button type="submit" class="btn-edit">Chỉnh sửa</button>
                </div>

                <!-- Lấy giới tính của user -->
                <div class="form-group gender">
                    <label for="gioitinh">Giới tính</label>
                    <div class="gender-options">
                        <label><input type="radio" name="gioitinh" value="Nam" {{ $user->gioitinh == 'Nam' ? 'checked' : '' }}> Nam</label>
                        <label><input type="radio" name="gioitinh" value="Nữ" {{ $user->gioitinh == 'Nữ' ? 'checked' : '' }}> Nữ</label>
                    </div>
                    <button type="submit" class="btn-edit">Chỉnh sửa</button>
                </div>

                <!-- Lấy ngày sinh của user theo cấu trúc Ngày / Tháng / Năm -->
                <div class="form-group">
                    <label for="ngaysinh">Ngày sinh</label>

                    <input type="text" placeholder="Ngày Sinh"
                        id="ngaysinh" class="form-control"
                        value="{{ \Carbon\Carbon::parse($user->ngaysinh)->format('d/m/Y') }}"
                        name="ngaysinh" required autofocus>
                    @if ($errors->has('ngaysinh'))
                    <span class="text-danger">{{ $errors->first('ngaysinh')
                            }}</span>
                    @endif

                    <button type="submit" class="btn-edit">Chỉnh sửa</button>
                </div>

                <!-- Lấy mật khẩu của user -->
                <!-- Ở đây đang có lỗi bug nếu bạn thay đổi thông tin nào đó trong user mà bạn không thay đổi mật khẩu thì khi bấm lưu thay đổi thì user đó sẽ bị tạo lại một mật khẩu mới -->
                <div class="form-group">
                    <label for="password">Mật khẩu</label>

                    <input type="password" placeholder="Password" id="password" class="form-control"
                        name="password" value="{{ $user->password }}">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif

                    <button type="submit" class="btn-edit">Chỉnh sửa</button>
                </div>

                <!-- Các nút button chức năng chỉnh sửa từng thông tin hoặc thay đổi một lần toàn bộ thông tin -->
                <div class="form-group">
                    <label>Chức năng</label>

                    <input type="text" name="role" value="{{ $user->roles->first()->name }}" readonly>

                    <button type="submit" class="btn-edit">Chỉnh sửa</button>
                </div>
                <div class="navigation-buttons">
                    <button type="submit" class="btn-nav">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>