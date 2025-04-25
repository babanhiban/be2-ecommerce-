<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
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
        h2, h3 {
            text-align: left;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Thanh Toán</h1>
        <img src="{{ asset('images/manhinhthanhtoan/logo.png') }}" alt="STORME Logo" class="logo">
    </div>
    
    <div class="container">
        <h2>Thông tin khách hàng</h2>
        
        <div class="form-group">
            <label for="name">Họ tên:</label>
            <input type="text" id="name">
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email">
        </div>
        
        <div class="form-group">
            <label for="phone">SĐT:</label>
            <input type="tel" id="phone">
        </div>
        
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" id="address">
        </div>
        
        <div class="content-wrapper">
            <div class="left-content">
                <div class="payment-methods">
                    <h3>Phương thức thanh toán:</h3>
                    <div class="payment-option">
                        <input type="radio" id="cash" name="payment" value="cash">
                        <label for="cash">Tiền mặt</label>
                    </div>
                    
                    <div class="payment-option">
                        <input type="radio" id="bank" name="payment" value="bank">
                        <label for="bank">Thanh toán qua ngân hàng liên kết</label>
                    </div>
                    
                    <div class="payment-option">
                        <input type="radio" id="ewallet" name="payment" value="ewallet">
                        <label for="ewallet">Thanh toán ví điện tử</label>
                    </div>
                </div>
                
                <div>
                    <h3>Mã giảm giá</h3>
                    <div class="voucher-input">
                        <input type="text" placeholder="abx-ynx-yuna" style="width: 150px;">
                    </div>
                    <div class="voucher-result">-100.000 đ</div>
                </div>
                
                <div class="product-info">
                    <div class="product-image">
                        <img src="{{ assert('images/manhinhthanhtoan/iphone.jpg') }}" alt="">
                    </div>
                    <div>
                        <h3>Iphone 16 128gb</h3>
                        <p>22.690.000đ x 1 = 22.690.000đ</p>
                        <a href="#" style="font-size: 12px;">Xem chi tiết tại đây</a>
                    </div>
                </div>
                
                <button class="button">Hóa đơn</button>
            </div>
            
            <div class="right-content">
                <div class="payment-summary">
                    <h3>Chi tiết thanh toán:</h3>
                    <p>Tổng tiền hàng : 22.690.000đ</p>
                    <p>Tổng Voucher giảm giá : 100.000đ</p>
                    <p>Phí ship : 20.000đ</p>
                    <p>Tổng thanh toán: <input type="text" value="22.610.000đ" style="width: 120px;"></p>
                </div>
                
                <div class="total">
                    <span>Tổng cộng:</span>
                    <span>22.610.000đ</span>
                </div>
                
                <button class="checkout-button">Thanh toán</button>
            </div>
        </div>
    </div>
</body>
</html>