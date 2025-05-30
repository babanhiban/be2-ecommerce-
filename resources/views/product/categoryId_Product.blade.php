<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng điện thoại</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/categoryID.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @if (session('error'))
        <div id="notification" class="notification error">
            <span class="icon">⚠️</span>
            <span>{{ session('error') }}</span>
            <button onclick="closeNotification()" class="close-btn">&times;</button>
        </div>
    @endif

    @if (session('success'))
        <div id="notification" class="notification success">
            <span class="icon">✅</span>
            <span>{{ session('success') }}</span>
            <button onclick="closeNotification()" class="close-btn">&times;</button>
        </div>
    @endif
        <div class="cart-header">
            <h2>Danh mục: {{ $category->name }}</h2>
            <form class="search-box" action="{{ route('product.search_result') }}" method="GET">
                <div>
                    <input type="text" name="query" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <div class="header-right">
                <a class="home-link" href="{{ route('home') }}">Trang Chủ</a> | <strong>Danh mục</strong>
                <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="brand-logo" />
            </div>
        </div>

    <div class="container">

        <div class="banner">
            <div class="banner-content">
                <h2>Sản phẩm thuộc danh mục: {{ $category->name }}</h2>
            </div>
        </div>

        <div class="product-grid">
            <!-- Product 1 -->
            @foreach ($products as $product)
                <div class="product-card">

                    <div class="product-image">
                        <img src="{{ asset('images/manhinhsanpham/' . $product->image) }}" alt="{{ $product->name }}"
                            width="150">
                    </div>
                    <div class="product-info">
                        <h2 class="product-detail__name">{{ $product->name }}</h2>
                        <div class="product-detail__quantity">
                            Số lượng trong kho còn: {{ $product->quantity }}
                        </div>
                        <div class="product-detail__price">
                            Giá: {{ number_format($product->price, 0, ',', '.') }}đ
                        </div>


                    </div>
                    @if ($product->quantity > 0)
                        <div class="product-detail-link">
                            <a href="{{ route('product.show', $product->id) }}">Xem chi tiết</a>
                        </div>
                        <div class="product-action">
                            <form action="{{ route('checkout.buynow', ['product_id' => $product->id]) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="buy-button">Mua ngay</button>
                            </form>
                        </div>
                        <div>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-button">Thêm vào giỏ</button>
                            </form>
                        </div>
                    @else
                        <p class="text-muted mt-3">⚠️ <strong>Hết hàng</strong></p>
                        <button class="btn btn-secondary mt-2" disabled>Không thể mua</button>
                    @endif
                </div>
            @endforeach
        </div>
        {{-- PHÂN TRANG --}}
        <div class="d-flex justify-content-center mt-4">
            {!! $products->appends(request()->query())->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    <script>
        // Xử lý thông báo popup
        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.animation = 'slideOut 0.3s ease-in';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }

        // Tự động ẩn thông báo sau 5 giây
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            if (notification) {
                setTimeout(() => {
                    closeNotification();
                }, 5000);
            }
        });
    </script>
</body>

</html>
