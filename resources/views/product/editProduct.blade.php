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
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->has('image'))
    <div class="alert alert-danger">
        {{ $errors->first('image') }}
    </div>
    @endif
    <header class="header">
        <div class="header-title">Thêm sản phẩm</div>
        <div class="logo-container">
            <img src="{{ asset('images/manhinhthemsanpham/logo.png') }}" alt="Logo" class="logo">
        </div>
    </header>
    @if (session('msg'))
    <div class="alert alert-info" style="padding:10px; margin-bottom:15px; background-color:#d9edf7; color:#31708f; border-radius:4px;">
        {{ session('msg') }}
    </div>
    @endif
    <form method="POST" action="{{ route('product.saveProduct', ['id' => $product->id])  }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="updated_at" value="{{ $product->updated_at }}">

        <input name="id" type="hidden" value="{{ $product->id }}">
        <main class="main-content">
            <div class="add-product-container">
                <div class="image-upload-container">
                    <div class="image-preview">
                        <img src="{{ asset('images/manhinhsanpham/'. $product->image) }}" alt="Hình ảnh sản phẩm" id="imagePreview" class="preview-image">
                    </div>
                    <label for="fileInput" class="upload-button">Upload hình</label>
                    <input type="file" id="fileInput" name="image" accept="image/*" style="display: none;">
                    {{-- phải là name="image" để Laravel nhận --}}
                </div>

                <div class="product-info">
                    <h2 class="info-title">Thông tin sản phẩm</h2>

                    <div class="form-group">
                        <label for="product-name">Tên sản phẩm:</label>
                        <input type="text" id="product-name" name="name" class="form-control" value="{{ old('name', $product->name) }} " required maxlength="50"
                            pattern="^[a-zA-Z0-9À-ỹ\s]+$"
                            title="Không được chứa ký tự đặc biệt và tối đa 50 ký tự">
                    </div>

                    <div class="form-group">
                        <label for="product-info">Thông tin:</label>
                        <textarea name="description">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="product-quantity">Số lượng:</label>
                        <input type="number" id="product-quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required min="1"
                            max="20"
                            step="1"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);"
                            title="Chỉ được nhập số nguyên dương từ 1 đến 20">
                    </div>

                    <div class="form-group">
                        <label for="product-price">Đơn giá:</label>
                        <input type="text" id="product-price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required
                            min="0"
                            max="1000000000"
                            step="1"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                            title="Chỉ được nhập số và tối đa là 1.000.000.000">
                    </div>

                    <div class="form-group">
                        <label for="product-category">Danh mục:</label>
                        <select id="product-category" name="category_id" class="form-control" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </main>

        <div class="button-container">
            <button type="submit" class="add-product-button">Lưu</button>
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