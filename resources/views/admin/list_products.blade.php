<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/list_products.css') }}">
</head>

<body>
    <header class="header">
        <div class="header-title">Quản lý sản phẩm</div>
        <div class="search-container">
            <input type="text" placeholder="Quần áo" class="search-input">
            <button class="search-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </div>
        <div class="logo-container">
            <img src="{{ asset('images/manhinhsanpham/logo.png')}}" alt="Logo" class="logo">
        </div>
    </header>

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
                    <th> <img src="{{ asset('images/manhinhsanpham/'.$product->image) }}" alt="Iphone 16" class="product-image"> </th>
                    <th>{{ $product->name }}</th>
                    
                    <th>
                        {{ $product->category?->name ?? 'Không có danh mục' }}
                    </th>
                    
                    <th>{{ $product->quantity }}</th>
                    <th>{{ $product->price }}</th>

                    <th class="action-buttons">
                        <button class="btn-edit"><a href="{{ route('products.deleteProduct', ['id' => $product->id]) }}">Xóa</a></button>
                    </th>
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
        

        <div class="bottom-buttons">
            <button class="btn-voucher">Thêm voucher</button>
            <button class="btn-add"><a href="{{ route('product.addProduct') }}"style="text-decoration: none;">Them moi</a></button>
            <button class="btn-add"><a href="{{ route('home') }}"style="text-decoration: none;">Quay lại</a></button>
            
        </div>
    </main>
    {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}

    <script>
        // JavaScript functionality can be added here
    </script>
</body>

</html>