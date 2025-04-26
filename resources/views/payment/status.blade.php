<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiện Thị Trạng Thái Thanh Toán</title>
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
        }
        
        .customer-info {
            width: 40%;
            padding-right: 20px;
        }
        
        .status-section {
            width: 55%;
            border-left: 1px solid #ddd;
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
        
        .product-info {
            margin-top: 20px;
        }
        
        .congratulations {
            text-align: center;
            padding: 30px 0;
        }
        
        .congratulations img {
            max-width: 100%;
        }
        
        .status-options {
            padding: 20px;
            border-top: 1px solid #ddd;
        }
        
        .status-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .radio-custom {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin-right: 10px;
            display: inline-block;
        }
        
        .radio-success {
            background-color: #5ad4f1;
        }
        
        .radio-default {
            border: 2px solid #333;
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
        <h1>Hiện Thị Trạng Thái Thanh Toán</h1>
        <img src="{{ asset('images/manhinhtrangthaigiaodich/logo.png') }}" alt="Storme Logo" class="logo">
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
            
            <div class="product-info">
                <p><strong>Iphone 16 128gb</strong></p>
                <p>Tổng Thanh Toán: 22.590.000đ <a href="#" class="detail-link">Xem chi tiết tại đây</a></p>
            </div>
        </div>
        
        <div class="status-section">
            <div class="congratulations">
                <img src="{{ asset('images/manhinhtrangthaigiaodich/chucmung.png') }}" alt="Congratulations" />
            </div>
            
            <div class="status-options">
                <div class="status-title">Trạng Thái Thanh Toán</div>
                
                <div class="radio-option">
                    <span class="radio-custom radio-success"></span>
                    <span>Đã Thanh Toán Thành Công</span>
                </div>
                
                <div class="radio-option">
                    <span class="radio-custom radio-default"></span>
                    <span>Thanh Toán Thủ Công</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>