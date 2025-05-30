<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .cart-header {
            background-color: #00bfff;
            color: white;
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
            color: white;
            font-size: 24px;
        }

        .home-link {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .home-link:hover {
            text-decoration: underline;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .logo {
            width: 120px;
            height: auto;
        }

        .main-container {
            margin: 20px auto;
            padding: 0 20px;
            display: flex;
            gap: 20px;
        }

        .left-column {
            width: 33.33%;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .right-column {
            width: 66.67%;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #33ccff;
            box-shadow: 0 0 5px rgba(51, 204, 255, 0.3);
        }

        .payment-methods {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
        }

        .payment-option input[type="radio"] {
            margin-right: 10px;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 15px;
            background-color: #fafafa;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .product-price {
            color: #666;
            margin-bottom: 5px;
        }

        .product-total {
            font-weight: bold;
            color: #33ccff;
        }

        .total-section {
            border-top: 2px solid #33ccff;
            padding-top: 15px;
            margin-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total-final {
            font-size: 18px;
            font-weight: bold;
            color: #33ccff;
        }

        .checkout-button {
            width: 100%;
            background-color: #33ccff;
            color: black;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .checkout-button:hover {
            background-color: #2bb3e6;
        }
    </style>
</head>

<body>
    <div class="cart-header">
        <h2>Thanh toán</h2>
        <div class="header-right">
            <a class="home-link" href="{{ route('home') }}">Trang Chủ</a> | <strong>Thanh toán</strong>
            <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="brand-logo" />
        </div>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="main-container">
            <!-- Cột trái: Thông tin khách hàng (1/3) -->
            <div class="left-column">
                <h2>Thông tin khách hàng</h2>

                <div class="form-group">
                    <label for="name">Họ tên:</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                </div>

                <div class="payment-methods">
                    <h3>Phương thức thanh toán</h3>
                    <div class="payment-option">
                        <input type="radio" id="cod" name="payment_method" value="cod" checked>
                        <label for="cod">Thanh toán khi nhận hàng</label>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Sản phẩm đã chọn (2/3) -->
            <div class="right-column">
                <h2>Sản phẩm đã chọn</h2>

                @foreach ($cartItems as $cartItem)
                    <div class="product-item">
                        <img src="{{ asset('storage/products/' . $cartItem->product->image) }}"
                            alt="{{ $cartItem->product->name }}" class="product-image">
                        <div class="product-details">
                            <div class="product-name">{{ $cartItem->product->name }}</div>
                            <div class="product-price">
                                Đơn giá: {{ number_format($cartItem->product->price, 0, ',', '.') }}đ
                            </div>
                            <div>Số lượng: {{ $cartItem->quantity }}</div>
                            <div class="product-total">
                                Thành tiền:
                                {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}đ
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="total-section">
                    <div class="total-row total-final">
                        <span>Tổng cộng:</span>
                        <span>{{ number_format(
                            array_reduce(
                                $cartItems,
                                function ($carry, $item) {
                                    return $carry + $item->product->price * $item->quantity;
                                },
                                0,
                            ),
                            0,
                            ',',
                            '.',
                        ) }}đ</span>
                    </div>
                </div>

                <button type="submit" class="checkout-button">Xác nhận thanh toán</button>
            </div>
        </div>
    </form>
</body>

</html>
