<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        .cart-container {
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

        .checkout-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
        }

        .checkout-wrapper {
            display: flex;
            gap: 40px;
        }

        .checkout-customer-info,
        .checkout-cart-items {
            flex: 1;
        }

        .checkout-customer-info label,
        .checkout-customer-info input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        .checkout-customer-info input {
            padding: 6px;
            box-sizing: border-box;
        }

        .checkout-cart-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .checkout-cart-item img {
            width: 60px;
            height: 60px;
            background-color: #f0f0f0;
            margin-right: 15px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkout-total {
            margin-top: 20px;
            font-weight: 700;
            font-size: 16px;
        }

        .checkout-btn {
            background-color: #33ccff;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        h2,
        h3 {
            text-align: left;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="cart-container">

        <div class="cart-header">
            <h2>Chi tiết sản phẩm</h2>
            <div class="header-right">
                <a href="{{ route('home') }}">Trang Chủ</a> | <a href="{{ route('cart.index') }}"> Giỏ Hàng</a>
                <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="brand-logo" />
            </div>
        </div>
    </div>

    <div class="checkout-container">
        <h2>Thông tin khách hàng</h2>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="checkout-wrapper">
                {{-- Thông tin khách hàng --}}
                <div class="checkout-customer-info">
                    <h3>Thông tin khách hàng</h3>

                    <label>Họ tên:</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

                    <label>Email:</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

                    <label>SĐT:</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>

                    <label>Địa chỉ:</label>
                    <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                </div>

                {{-- Sản phẩm trong giỏ --}}
                <div class="checkout-cart-items">
                    <h3>Sản phẩm đã chọn</h3>
                    @foreach ($cartItems as $cartItem)
                        <div class="checkout-cart-item">
                            <img src="{{ asset('storage/products/' . $cartItem->product->image) }}"
                                alt="{{ $cartItem->product->name }}">
                            <div>
                                <strong>{{ $cartItem->product->name }}</strong><br>
                                {{ number_format($cartItem->product->price, 0, ',', '.') }}đ x
                                {{ $cartItem->quantity }} =
                                {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}đ
                            </div>
                        </div>
                    @endforeach

                    <div class="checkout-total">
                        Tổng cộng:
                        {{ $total = array_reduce(
                            $cartItems,
                            function ($carry, $item) {
                                return $carry + $item->product->price * $item->quantity;
                            },
                            0,
                        ) }}đ
                    </div>

                    <button type="submit" class="checkout-btn">
                        Thanh toán
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
