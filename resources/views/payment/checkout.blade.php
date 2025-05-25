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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            background-color: #33ccff;
            color: #000;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logo {
            width: 120px;
            height: auto;
        }

        .container {
            padding: 20px;
            max-width: 1000px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .form-group label {
            width: 80px;
            margin-right: 10px;
        }

        .form-group input {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
        }

        .content-wrapper {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 20px;
        }

        .left-content {
            width: 48%;
        }

        .right-content {
            width: 48%;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .payment-methods {
            margin-bottom: 20px;
        }

        .payment-option {
            margin-bottom: 10px;
        }

        .product-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .product-image {
            width: 60px;
            height: 60px;
            background-color: #f0f0f0;
            margin-right: 15px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button {
            background-color: #33ccff;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        .payment-summary {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            width: 100%;
            height: 50%;
            box-sizing: border-box;
        }

        .voucher-input {
            display: flex;
            margin-bottom: 10px;
        }

        .voucher-result {
            background-color: #f0f0f0;
            padding: 5px 10px;
            margin-top: 5px;
            display: inline-block;
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .checkout-button {
            background-color: #33ccff;
            color: black;
            padding: 10px 30px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        h2,
        h3 {
            text-align: left;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1> <a href="{{ route('home') }}" class="nav-home" style="text-decoration: none; color: black;">Trang chủ</a></h1>
        <img src="{{ asset('images/manhinhthanhtoan/logo.png') }}" alt="STORME Logo" class="logo">
    </div>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="container">
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
                <label for="phone">SĐT:</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}" required>
            </div>

            <div class="content-wrapper">
                <div class="left-content">
                    <div class="payment-methods">
                        <h3>Phương thức thanh toán:</h3>
                        <div class="payment-option">

                            <label style="color:black;text-align: center;">Thanh toán khi nhận hàng</label>
                        </div>

                    </div>
                </div>

                <div class="right-content">
                    <h3>Sản phẩm đã chọn</h3>
                    @foreach ($cartItems as $cartItem)
                    <div class="payment-summary">
                        <img src="{{ asset('storage/products/' . $cartItem->product->image) }}"
                            alt="{{ $cartItem->product->name }} " style="height: 100px;">
                        <div>
                            <strong>{{ $cartItem->product->name }}</strong><br>
                            {{ number_format($cartItem->product->price, 0, ',', '.') }}đ x
                            {{ $cartItem->quantity }} =
                            {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}đ
                        </div>
                    </div>
                    @endforeach
                    <div class="total">
                        Tổng cộng:
                        {{ $total = array_reduce(
$cartItems,
function ($carry, $item) {
return $carry + $item->product->price * $item->quantity;
},
0,
) }}đ
                    </div>
                    <button class="checkout-button">Thanh toán</button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>