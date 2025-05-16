<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/addProduct.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-title">Thêm sản phẩm</div>
        <div class="logo-container">
            <img src="{{ asset('images/manhinhthemsanpham/logo.png') }}" alt="Logo" class="logo">
        </div>
    </header>

    <main class="main-content">
        <div class="add-product-container">
            <div class="image-upload-container">
                <div class="image-preview">
                    <img src="/api/placeholder/300/220" alt="Hình ảnh sản phẩm" class="preview-image">
                </div>
                <button class="upload-button">Upload hình</button>
            </div>

            <div class="product-info">
                <h2 class="info-title">Thông tin sản phẩm</h2>
                
                <div class="form-group">
                    <label for="product-name">Tên sản phẩm:</label>
                    <input type="text" id="product-name" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="product-info">Thông tin:</label>
                    <input type="text" id="product-info" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="product-quantity">Số lượng:</label>
                    <input type="number" id="product-quantity" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="product-price">Đơn giá:</label>
                    <input type="text" id="product-price" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="product-category">Danh mục:</label>
                    <select id="product-category" class="form-control">
                        <option value="">-- Chọn danh mục --</option>
                        <option value="1">Điện thoại</option>
                        <option value="2">Laptop</option>
                        <option value="3">Máy tính bảng</option>
                        <option value="4">Phụ kiện</option>
                        <option value="5">Đồ điện tử</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="button-container">
            <button class="add-product-button">Thêm mới</button>
        </div>
    </main>

    <script>
        // JavaScript có thể được thêm vào đây
        // Xử lý upload hình, submit form, etc.
    </script>
</body>
</html>