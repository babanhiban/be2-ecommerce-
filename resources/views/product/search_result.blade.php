<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm iPhone 16</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/search_result.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="category">
                    <span><a href="{{ route('home') }}" style="text-decoration: none; color: white;" >Trang chủ</a></span>
                </div>
                <form class="search-bar" action="{{ route('product.search_result') }}" method="GET">
                    <div class="search-container">
                        <input type="text" name="query" placeholder="Tìm kiếm sản phẩm...">
                        <button class="search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                          

                <div class="cart">
                    <a href="{{ route('cart.index') }}" class="cart-link">
                        <div class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <span>Giỏ Hàng</span>
                    </a>

                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="product-grid">
            @if($products->isEmpty())
            <p>Không tìm thấy sản phẩm nào.</p>
            @else
            @foreach($products as $product)
            <ul>

                <div class="product-card">
                    <div class="product-image">
                        <img src="{{asset('images/manhinhsanpham/'.$product->image)}}" alt="iPhone 16 Blue">
                    </div>
                    <div class="product-name">
                        <h3>{{ $product->name }}</h3>
                    </div>
                    <div style="text-align: center;">
                        <h3>{{ number_format($product->price, 0, ',', '.') }} VND</h3>
                    </div>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>

                </div>

            </ul>
            @endforeach
            @endif
            <!-- Product 1 -->

        </div>

        <div class="pagination">
            {{-- PHÂN TRANG --}}
            <div class="d-flex justify-content-center mt-4">
                {!! $products->appends(request()->query())->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </main>
</body>

</html>