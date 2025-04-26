<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
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
        
        .payment-info {
            width: 50%;
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
        
        .invoice-details {
            margin-top: 10px;
        }
        
        .payment-details {
            border: 1px solid #ccc;
            padding: 15px;
            margin-top: 10px;
        }
        
        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .total-section {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        
        .total-amount {
            font-size: 18px;
            font-weight: bold;
        }
        
        .btn {
            padding: 10px 25px;
            background-color: #5ad4f1;
            color: #000;
            border: none;
            cursor: pointer;
            text-align: center;
        }
        
        .info-text {
            margin: 5px 0;
        }
        
        .payment-method {
            margin-bottom: 15px;
        }
        
        .payment-method-title {
            font-weight: bold;
            margin-right: 10px;
        }
        
        .payment-method-value {
            font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Hóa Đơn</h1>
        <img src="{{ asset('images/manhinhhoadon/logo.png') }}" alt="Storme Logo" class="logo">
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
            
            <div class="invoice-details">
                <p class="info-text">Mã hóa đơn: HD001</p>
                <p class="info-text">Ngày: 15/01/2025</p>
                <p class="info-text">Tổng Sản Phẩm: 3</p>
            </div>
        </div>
        
        <div class="payment-info">
            <div class="payment-method">
                <span class="payment-method-title">Phương thức thanh toán:</span>
                <span class="payment-method-value">Thanh toán qua ngân hàng liên kết</span>
            </div>
            
            <div class="payment-details">
                <p style="margin-top: 0"><strong>Chi tiết thanh toán:</strong></p>
                
                <div class="payment-row">
                    <span>Sản phẩm 1:</span>
                    <span>500.000đ</span>
                </div>
                
                <div class="payment-row">
                    <span>Sản phẩm 1:</span>
                    <span>5.000.000đ</span>
                </div>
                
                <div class="payment-row">
                    <span>Sản phẩm 1:</span>
                    <span>5.490.000đ</span>
                </div>
                
                <div class="payment-row">
                    <span>Phí ship:</span>
                    <span>20.000đ</span>
                </div>
                
                <div class="payment-row">
                    <span>Tổng tiền hàng:</span>
                    <span>10.990.000đ</span>
                </div>
                
                <div class="payment-row">
                    <span>Tổng Voucher giảm giá:</span>
                    <span>100.000đ</span>
                </div>
            </div>
        </div>
        
        <div class="total-section">
            <button class="btn">Quay lại</button>
            <div class="total-amount">
                <span>Tổng cộng: </span>
                <span>10.910.000đ</span>
            </div>
            <button class="btn">Xuất file</button>
        </div>
    </div>
</body>
</html>