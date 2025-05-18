<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm iPhone 16</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/search_result.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="category">
                    <span>Danh Mục</span>
                </div>
                <div class="search-container">
                    <input type="text" placeholder="Tìm kiếm sản phẩm" value="iPhone 16">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                 
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
        <div class="filter-container">
            <div class="filter-options">
                <button class="filter-btn active">Liên Quan</button>
                <button class="filter-btn">Mới nhất</button>
                <div class="dropdown">
                    <button class="filter-btn dropdown-toggle">
                        Giá
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
            <div class="view-toggle">
                <button class="view-btn">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://i.postimg.cc/9FzJcvtL/iphone-16-blue.jpg" alt="iPhone 16 Blue">
                </div>
                <div class="product-name">
                    <h3>iPhone 16</h3>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://i.postimg.cc/VLpvxmKB/iphone-16-white.jpg" alt="iPhone 16 White">
                </div>
                <div class="product-name">
                    <h3>iPhone 16</h3>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://i.postimg.cc/Y0PKTdnb/iphone-16-black.jpg" alt="iPhone 16 Black">
                </div>
                <div class="product-name">
                    <h3>iPhone 16</h3>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://i.postimg.cc/xTHgSd8c/iphone-16-pink.jpg" alt="iPhone 16 Pink">
                </div>
                <div class="product-name">
                    <h3>iPhone 16</h3>
                </div>
            </div>
        </div>

        <div class="pagination">
            <a href="#" class="page-nav prev">
                <i class="fas fa-chevron-left"></i>
            </a>
            <a href="#" class="page-number active">1</a>
            <a href="#" class="page-number">2</a>
            <span class="page-dots">...</span>
            <a href="#" class="page-number">10</a>
            <a href="#" class="page-nav next">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </main>
</body>
</html>