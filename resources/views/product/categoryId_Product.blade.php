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
            <nav>
                <ul>
                    <li><a href="#">Danh Mục</a></li>
                </ul>
            </nav>
            <div class="search-box">
                <input type="text" placeholder="Tìm kiếm sản phẩm">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            <div class="user-actions">
                <a href="#" class="login-register">Đăng Nhập/Đăng Ký</a>
                <a href="#" class="cart">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        
        <div class="banner">
            <div class="banner-content">
                <h2>Sản phẩm thuộc danh mục:</h2>
            </div>
        </div>

        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card">
                
                <div class="product-image">
                    <img src="https://i.postimg.cc/XY7RL2Pk/oppo-a3.jpg" alt="OPPO A3">
                </div>
                <div class="product-info">
                    <h3>OPPO A3</h3>
                    <p class="product-price">5.990.000₫</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                
                <div class="product-image">
                    <img src="https://i.postimg.cc/ZKCvM8Fj/samsung-a15.jpg" alt="Samsung Galaxy A15">
                </div>
                <div class="product-info">
                    <h3>Samsung Galaxy A15</h3>
                    <p class="product-price">4.490.000₫</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
               
                <div class="product-image">
                    <img src="https://i.postimg.cc/7ZnHRXGH/realme-c55.jpg" alt="realme C55">
                </div>
                <div class="product-info">
                    <h3>realme C55</h3>
                    <p class="product-price">3.690.000₫</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
               
                <div class="product-image">
                    <img src="https://i.postimg.cc/BnGXbCsK/vivo-y17s.jpg" alt="vivo Y17s">
                </div>
                <div class="product-info">
                    <h3>vivo Y17s</h3>
                    <p class="product-price">3.790.000₫</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://i.postimg.cc/8CcMpQdN/iphone-13.jpg" alt="iPhone 13">
                </div>
                <div class="product-info">
                    <h3>iPhone 13</h3>
                    <p class="product-price">14.490.000₫</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://i.postimg.cc/mr0FjGKc/xiaomi-redmi-note-13.jpg" alt="Xiaomi Redmi Note 13">
                </div>
                <div class="product-info">
                    <h3>Xiaomi Redmi Note 13</h3>
                    <p class="product-price">3.990.000₫</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://i.postimg.cc/BnGXbCsK/vivo-y17s.jpg" alt="vivo Y17s">
                </div>
                <div class="product-info">
                    <h3>vivo Y17s</h3>
                    <p class="product-price">3.790.000₫</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://i.postimg.cc/BnGXbCsK/vivo-y17s.jpg" alt="vivo Y17s">
                </div>
                <div class="product-info">
                    <h3>vivo Y17s</h3>
                    <p class="product-price">3.790.000₫</p>
                    <button class="btn-buy">Mua ngay</button>
                    <button class="btn-add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>