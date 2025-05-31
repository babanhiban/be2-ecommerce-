<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/list_products.css') }}">
</head>

<body>
    <header class="header d-flex justify-content-between align-items-center px-4 py-2">
        <div class="d-flex align-items-center">
            <div class="header-title me-3">Quản lý sản phẩm</div>
            <a href="{{ route('home') }}" class="nav-home" style="text-decoration: none; color: black;">Trang chủ</a>
        </div>
@if ($products->isEmpty())
    <div class="alert alert-warning" role="alert">
        Không tìm thấy sản phẩm nào.
    </div>
@endif
{{-- Thông báo thành công hoặc lỗi --}}
@if (session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center mt-3">
        {{ session('error') }}
    </div>
@endif
        <div class="search-container">
            <form action="{{ route('product.search') }}" method="GET" style="display: flex; align-items: center;">
                <input type="text" name="query" placeholder="Tìm kiếm sản phẩm..." class="search-input" value="{{ request('query') }}" pattern="^[a-zA-Z0-9À-ỹ\s]+$"
                    title="Không được nhập ký tự đặc biệt (chỉ cho phép chữ, số và khoảng trắng)">
                <button type="submit" class="search-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </form>
        </div>

        <div class="logo-container">
            <img src="{{ asset('images/manhinhsanpham/logo.png')}}" alt="Logo" class="logo">
        </div>
    </header>

    @if(request('query'))
    <p style="margin-left: 20px;">Kết quả tìm kiếm cho: <strong>{{ request('query') }}</strong></p>
    @endif
    <main>
        <table class="product-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>

                @foreach($products as $product)
                <tr>
                    <td><img src="{{ asset('images/manhinhsanpham/' . $product->image) }}" alt="{{ $product->name }}" class="product-image" width="100"></td>
                    <td>{{ $product->name }}</td>

                    <td>
                        {{ $product->category?->name ?? 'Không có danh mục' }}
                    </td>

                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>

                    <td>

                        <button class="btn-edit"><a href="{{ route('products.deleteProduct', ['id' => $product->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a></button>
                        <button class="btn-edit"><a href="{{ route('product.updateProduct', ['id' => $product->id]) }}">Sửa</a></button>
                    </td>
                </tr>
                @endforeach
                <!-- <tr>
                    <td>
                        <img src="{{ asset('images/manhinhsanpham/iphone.png') }}" alt="Iphone 16" class="product-image">
                    </td>
                    <td>Iphone 16</td>
                    <td>Điện Thoại</td>
                    <td>6</td>
                    <td>5.000.000đ</td>
                    <td class="action-buttons">
                        <button class="btn-delete">Xóa</button>
                        <button class="btn-edit">Sửa</button>
                    </td>
                </tr>
-->

            </tbody>
        </table>

        {{-- PHÂN TRANG --}}
        <div class="d-flex justify-content-center mt-4">
            {!! $products->appends(request()->query())->links('pagination::bootstrap-5') !!}
        </div>


        <div class="bottom-buttons">
            <button class="btn-voucher">Thêm voucher</button>
            <button class="btn-add"><a href="{{ route('product.addProduct') }}" style="text-decoration: none;">Them moi</a></button>
            <button class="btn-add"><a href="{{ route('home') }}" style="text-decoration: none;">Quay lại</a></button>

        </div>
    </main>

    <script>
        // JavaScript functionality can be added here
    </script>
</body>

</html>