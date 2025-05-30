<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
@if(session('error'))
    <div id="notification" class="notification error">
        <span class="icon">⚠️</span>
        <span>{{ session('error') }}</span>
        <button onclick="closeNotification()" class="close-btn">&times;</button>
    </div>
@endif

@if(session('success'))
    <div id="notification" class="notification success">
        <span class="icon">✅</span>
        <span>{{ session('success') }}</span>
        <button onclick="closeNotification()" class="close-btn">&times;</button>
    </div>
@endif

    <link rel="stylesheet" href="{{ asset('css/productDetail.css') }}">

    <div class="cart-container">
        <div class="cart-header">
            <h2>Chi tiết sản phẩm</h2>
            <div class="header-right">
                <a href="{{ route('home') }}">Trang Chủ</a> | <a href="{{ route('cart.index') }}"> Giỏ Hàng</a>
                <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="brand-logo" />
            </div>
        </div>
        
        <div class="product-detail">
            <div class="product-detail__wrapper">

                <div class="product-detail__image">
                    <img src="{{ asset('images/manhinhsanpham/' . $product->image) }}"
                                    alt="Not Found" />
                </div>

                {{-- Thông tin sản phẩm --}}
                <div class="product-detail__info">
                    <div class="product-detail__category">
                        {{ $product->category?->name ?? 'Không có danh mục' }}
                    </div>
                    <h2 class="product-detail__name">{{ $product->name }}</h2>

                    <div class="product-detail__price">
                        Giá: {{ number_format($product->price, 0, ',', '.') }}đ
                    </div>

                    <div class="product-detail__policy">
                        Chính Sách Trả Hàng: Trả hàng 15 ngày - Đổi ý miễn phí
                    </div>

                    <div class="product-detail__quantity">
                        Số lượng trong kho còn: {{ $product->quantity }}
                    </div>

                    <div class="product-detail__description">
                        Giới thiệu: {!! nl2br(e($product->description)) !!}
                    </div>

                    <div class="product-detail__description">
                        <strong>Siêu ưu đãi chưa từng có!</strong> 
                        <br>Mua ngay sản phẩm, nhận bảo hành 2 năm an tâm tuyệt đối,
                        <br>và tặng kèm bộ quà tặng trị giá 50.000đ để bạn “cháy” hết mình cùng niềm vui!
                        <br>Giao hàng miễn phí tận nơi trong 24h.
                    </div>

                    <div class="product-detail__actions">
                        @if ($product->quantity > 0)
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
                </div>
            </div>
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
