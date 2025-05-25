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
            <label>{{ $user->name }}</label>
            <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}" class="btn-delete">Xóa hồ sơ</a>
            <a href="{{ route('home') }}" class="btn-nav">Quay lại</a>
        </div>

        <!-- Hiển thị thông báo -->
        @if (session('msg'))
        <div class="alert alert-info" style="padding:10px; margin-bottom:15px; background-color:#d9edf7; color:#31708f; border-radius:4px;">
            {{ session('msg') }}
        </div>
        @endif

        <div class="form-container">
            <form action="{{ route('user.postUpdateUser') }}" method="POST">
                @csrf

                <input type="hidden" name="updated_at" value="{{ $user->updated_at }}">

                <input name="id" type="hidden" value="{{ $user->id }}">

                <!-- Tên -->
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" id="name" name="name" placeholder="Name"
                        class="form-control" value="{{ old('name', $user->name) }}" pattern="^(?!.*\s$)(?!.*\u3000$).{1,30}$"
                        maxlength="30" required autofocus>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email_address" name="email" placeholder="Email"
                        class="form-control" value="{{ old('email', $user->email) }}"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                        title="Email phải hợp lệ, ví dụ: ten@example.com"
                        required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Số điện thoại -->
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" placeholder="Số điện thoại"
                        class="form-control" value="{{ old('phone', $user->phone) }}"
                        minlength="10" maxlength="15"
                        pattern="[0-9]{10,15}"
                        title="Số điện thoại phải từ 10 đến 15 chữ số"
                        required>
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Địa chỉ -->
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="address" placeholder="Địa chỉ"
                        class="form-control" value="{{ old('address', $user->address) }}"
                        pattern="^[^<>{}]{5,100}$"
                        title="Địa chỉ phải từ 5 đến 100 ký tự, không chứa ký tự đặc biệt như < > { }"
                        required>
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Giới tính -->
                <div class="form-group gender">
                    <label>Giới tính</label>
                    <div class="gender-options">
                        <label><input type="radio" name="gioitinh" value="Nam" {{ old('gioitinh', $user->gioitinh) == 'Nam' ? 'checked' : '' }}> Nam</label>
                        <label><input type="radio" name="gioitinh" value="Nữ" {{ old('gioitinh', $user->gioitinh) == 'Nữ' ? 'checked' : '' }}> Nữ</label>
                    </div>
                    @error('gioitinh')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Ngày sinh -->
                <div class="form-group">
                    <label for="ngaysinh">Ngày sinh</label>
                    <input type="text" id="ngaysinh" name="ngaysinh" placeholder="dd/mm/yyyy"
                        class="form-control"
                        value="{{ old('ngaysinh', $user->ngaysinh ? \Carbon\Carbon::parse($user->ngaysinh)->format('d/m/Y') : '') }}"
                        pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/[0-9]{4}$"
                        title="Nhập đúng định dạng dd/mm/yyyy, ví dụ: 27/11/2004"
                        required>
                    @error('ngaysinh')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mật khẩu -->
                <div class="form-group">
                    <label for="password">Mật khẩu (bỏ trống nếu không đổi)</label>
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="form-control"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$"
                        title="Mật khẩu ít nhất 6 ký tự, gồm chữ hoa, thường và số. Bỏ trống nếu không đổi.">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role (readonly) -->
                <div class="form-group">
                    <label>Vai trò</label>
                    <input type="text" name="role" value="{{ $user->roles->first()->name ?? 'Không có vai trò' }}" readonly>
                </div>

                <!-- Nút lưu -->
                <div class="navigation-buttons">
                    <button type="submit" class="btn-nav">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>