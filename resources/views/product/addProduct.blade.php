<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/addProduct.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header-title">Thêm sản phẩm</div>
        <div class="logo-container">
            <img src="{{ asset('images/manhinhthemsanpham/logo.png') }}" alt="Logo" class="logo">
        </div>
    </header>
    @if ($errors->has('image'))
    <div class="alert alert-danger">
        {{ $errors->first('image') }}
    </div>
    @endif

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <main class="main-content">
            <div class="add-product-container">
                <div class="image-upload-container">
                    <div class="image-preview">
                        <img src="/api/placeholder/300/220" alt="Hình ảnh sản phẩm" id="imagePreview" class="preview-image">
                    </div>
                    <label for="fileInput" class="upload-button">Upload hình</label>
                    <input type="file" id="fileInput" name="image" accept="image/*" style="display: none;">
                    {{-- phải là name="image" để Laravel nhận --}}
                </div>

                <div class="product-info">
                    <h2 class="info-title">Thông tin sản phẩm</h2>

                    <div class="form-group">
                        <label for="product-name">Tên sản phẩm:</label>
                        <input type="text" id="product-name" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="product-info">Thông tin:</label>
                        <input type="text" id="product-info" name="description" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="product-quantity">Số lượng:</label>
                        <input type="number" id="product-quantity" name="quantity" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="product-price">Đơn giá:</label>
                        <input type="text" id="product-price" name="price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="product-category">Danh mục:</label>
                        <select id="product-category" name="category_id" class="form-control">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </main>

        <div class="button-container">
            <button type="submit" class="add-product-button">Thêm mới</button>
            <button class="add-product-button"><a href="{{ route('admin.products') }}" style="text-decoration: none;">Quay lại</a></button>
        </div>
    </form>



    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0]; // lấy file đầu tiên
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Đặt ảnh xem trước
                    document.getElementById('imagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file); // đọc file thành dạng base64
            }
        });
    </script>
</body>

</html>