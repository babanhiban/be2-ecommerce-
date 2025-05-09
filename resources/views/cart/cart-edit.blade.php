<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Cập nhật sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6e6e6;
            margin: 0;
            padding: 0;
        }

        .edit-container {
            max-width: 900px;
            margin: 40px auto;
            background-color: #ffffff;
            border: 2px solid #00bfff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .edit-header {
            background-color: #00bfff;
            color: #ffffff;
            padding: 15px 25px;
            font-size: 22px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .edit-header img {
            width: 70px;
        }

        .edit-body {
            display: flex;
            padding: 30px;
            gap: 40px;
        }

        .edit-image {
            flex: 1;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .edit-image img {
            width: 100%;
            max-width: 250px;
            border-radius: 5px;
        }

        .edit-form {
            flex: 2;
        }

        .edit-form h2 {
            margin-top: 0;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .btn {
            padding: 10px 25px;
            background-color: #00bfff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #008ecc;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            appearance: none;
            /* Ẩn style hệ thống nếu cần */
            background-color: #fff;
            background-image: url("data:image/svg+xml;charset=US-ASCII,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><polygon points='0,0 10,0 5,5' fill='gray'/></svg>");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
        }

        input[readonly] {
            background-color: #f9f9f9;
            color: #333;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="edit-container">
        <div class="edit-header">
            <span>Cập nhật</span>
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo">
        </div>

        <div class="edit-body">
            <div class="edit-image">
                <img src="https://via.placeholder.com/250x150?text=Monitor" alt="Sản phẩm">
            </div>

            <div class="edit-form">
                <h2>Cập nhật sản phẩm</h2>

                <div class="form-group">
                    <label>Chọn màu</label>
                    <select name="color">
                        <option value="Xanh" selected>Xanh</option>
                        <option value="Đỏ">Đỏ</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Chọn mẫu</label>
                    <select name="model">
                        <option value="Màn hình 144hz" selected>Màn hình 144hz</option>
                        <option value="Màn hình cong">Màn hình cong</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Chọn số lượng</label>
                    <input type="number" value="2" min="1">
                </div>

                <div class="form-group">
                    <label>Thành tiền</label>
                    <input type="text" name="total_price" value="22.000.000" readonly>
                </div>

                <div class="form-actions">
                    <button class="btn">Xóa</button>
                    <button class="btn" onclick="window.location.href='{{ url('/cart') }}'">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
