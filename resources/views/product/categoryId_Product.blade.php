<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng điện thoại</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/categoryID.css') }}">
</head>

<body>
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="{{ asset('images/manhinhsanpham/logo.png') }}" alt="Logo">
            </div>
            <div class="search-box">
                <input type="text" placeholder="Tìm kiếm sản phẩm">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Danh Mục</a></li>
                </ul>
            </nav>


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
              @foreach ($category->products as $product)
            <div class="product-card">
               
                <div class="product-image">
                    <img src="{{ asset('images/manhinhsanpham/'. $product->image) }}" alt="{{ $product->name }}" width="150">            
                </div>               
                <div class="product-info">
                    <p>{{ $product->name }}</p>
                    <p>{{ number_format($product->price) }} VND</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
                
            </div>
            @endforeach           
        </div>
        <button class="btn-add"><a href="{{ route('home') }}"style="text-decoration: none;">Quay lại</a></button>
    </div>
</body>

</html>