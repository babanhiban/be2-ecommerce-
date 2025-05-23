<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng điện thoại</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/categoryID.css') }}">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    >>>>>>> 0d5e6fd69fdde197e7b849e68f3833fd144c2f91
</head>

<body>
    <header>
        <div class="container header-container">
            <nav>
                <ul>
                    <li><a href="#">Danh Mục</a></li>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                </ul>
            </nav>

            <form class="search-box" action="{{ route('product.search_result') }}" method="GET">
                <div>
                    <input type="text" name="query" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <div class="logo">
                <img src="{{ asset('images/manhinhsanpham/logo.png') }}" alt="Logo">
            </div>
        </div>
    </header>

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
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                            width="150">
                    </div>
                    <div class="product-info">
                        <p>{{ $product->name }}</p>
                        <p>{{ number_format($product->price, 0, ',', '.') }} VND</p>


                    </div>
                    @if ($product->quantity > 0)
                        <button class="btn-buy">Mua ngay</button>
                        <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                    @else
                        <p class="text-muted mt-3" style="text-align: center;">⚠️ <strong>Hết hàng</strong></p>
                    @endif
                </div>
            @endforeach
        </div>

        <button class="btn-add"><a href="{{ route('home') }}" style="text-decoration: none;">Quay lại</a></button>
    </div>
    {{-- PHÂN TRANG --}}
    <div class="d-flex justify-content-center mt-4">
        {!! $products->appends(request()->query())->links('pagination::bootstrap-5') !!}
    </div>
    </div>


</body>

</html>