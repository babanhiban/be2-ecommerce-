<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoàn Tiền</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .header {
            background-color: #5ad4f1;
            color: #000;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            width: 120px;
            height: auto;
        }
        
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .customer-info {
            width: 45%;
        }
        
        .refund-reason {
            width: 45%;
        }
        
        h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"], 
        input[type="email"] {
            width: 90%;
            padding: 8px;
            border: 1px solid #ccc;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .radio-option input {
            margin-right: 10px;
        }
        
        .product-info {
            width: 100%;
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        
        .button-group {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .btn {
            padding: 10px 20px;
            background-color: #5ad4f1;
            color: #000;
            border: none;
            cursor: pointer;
            text-align: center;
        }
        
        .btn-primary {
            padding: 15px 30px;
            font-size: 16px;
        }
        
        .other-reason {
            display: flex;
            align-items: center;
        }
        
        .other-reason input[type="text"] {
            margin-left: 10px;
            width: 70%;
        }
        
        .detail-link {
            font-size: 12px;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Hoàn Tiền</h1>
        <img src="{{ asset('images/manhinhhoantien/logo.png') }}" alt="Storme Logo" class="logo">
    </div>
    
    <div class="container">
        <div class="customer-info">
            <h2>Thông tin khách hàng</h2>
            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email">
            </div>
            <div class="form-group">
                <label>SĐT:</label>
                <input type="text">
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text">
            </div>
        </div>
        
        <div class="refund-reason">
            <h2>Lí do hoàn Tiền</h2>
            <div class="radio-option">
                <input type="radio" name="reason" id="reason1">
                <label for="reason1">Hàng bị hư hỏng</label>
            </div>
            <div class="radio-option">
                <input type="radio" name="reason" id="reason2">
                <label for="reason2">Hàng hóa không đúng với yêu cầu</label>
            </div>
            <div class="radio-option">
                <input type="radio" name="reason" id="reason3">
                <label for="reason3">Chưa nhận được hàng</label>
            </div>
            <div class="radio-option other-reason">
                <input type="radio" name="reason" id="reason4">
                <label for="reason4">Lí do khác:</label>
                <input type="text">
            </div>
        </div>
        
        <div class="product-info">
            <h3>Iphone 16 128gb</h3>
            <p>Tổng thanh toán: 22.590.000đ <a href="#" class="detail-link">Xem chi tiết tại đây</a></p>
        </div>
        
        <div class="button-group">
            <button class="btn">Quay lại</button>
            <button class="btn btn-primary">Yêu Cầu Hoàn Tiền</button>
        </div>
    </div>
</body>
</html>