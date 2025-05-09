<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        .cart-container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            border: 2px solid #00bfff;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .cart-header {
            background-color: #00bfff;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #008ecc;
            position: relative;
        }

        .cart-header .brand-logo {
            width: 50px;
            height: 50px;
            margin-left: 10px;
        }

        .cart-header h2 {
            margin: 0;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 15px;
        }

        th {
            background-color: #b3e0ff;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f9ff;
        }

        img {
            width: 60px;
            border-radius: 5px;
        }

        .cart-footer {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 2px solid #008ecc;
        }

        .btn {
            background-color: #00bfff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #008ecc;
        }

        .btn:last-child {
            margin-right: 0;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="cart-container">
        <div class="cart-header">
            <h2>🛒 Giỏ Hàng</h2>
            <div class="header-right">
                <a href="#">Trang Chủ</a> | <strong>Giỏ Hàng</strong>
                <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="brand-logo">
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Chọn</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="https://via.placeholder.com/60x60?text=Iphone"></td>
                    <td>iphone</td>
                    <td>Điện Thoại</td>
                    <td><input type="checkbox"></td>
                    <td>3</td>
                    <td>10.000.000 VNĐ</td>
                    <td>30.000.000 VNĐ</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/60x60?text=Laptop"></td>
                    <td>Laptop</td>
                    <td>Laptop</td>
                    <td><input type="checkbox"></td>
                    <td>2</td>
                    <td>20.000.000 VNĐ</td>
                    <td>40.000.000 VNĐ</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/60x60?text=Camera"></td>
                    <td>Máy ảnh</td>
                    <td>Máy Ảnh</td>
                    <td><input type="checkbox"></td>
                    <td>2</td>
                    <td>5.000.000 VNĐ</td>
                    <td>10.000.000 VNĐ</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/60x60?text=Tai+nghe"></td>
                    <td>Tai nghe</td>
                    <td>Phụ kiện</td>
                    <td><input type="checkbox"></td>
                    <td>1</td>
                    <td>2.000.000 VNĐ</td>
                    <td>2.000.000 VNĐ</td>
                </tr>
                <tr>
                    <td><img src="https://via.placeholder.com/60x60?text=Bluetooth"></td>
                    <td>Tai nghe không dây</td>
                    <td>Phụ kiện</td>
                    <td><input type="checkbox"></td>
                    <td>2</td>
                    <td>1.000.000 VNĐ</td>
                    <td>2.000.000 VNĐ</td>
                </tr>
            </tbody>
        </table>
        <div class="cart-footer">
            <div>
                <button class="btn">Xóa</button>
                <a href="{{ url('/cart/edit') }}">
                    <button class="btn">Sửa</button>
                </a>
            </div>
            <div>
                <span class="total">Tổng cộng: 84.000.000 VNĐ</span>
                <button class="btn">Mua</button>
            </div>
        </div>
    </div>
</body>

</html>
