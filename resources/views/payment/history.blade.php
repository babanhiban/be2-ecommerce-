<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử giao dịch</title>
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
        }
        
        .filter-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .date-filter {
            display: flex;
            align-items: center;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
        }
        
        .search-label {
            margin-right: 10px;
        }
        
        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .transaction-table th, 
        .transaction-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        
        .transaction-table th {
            background-color: #f2f2f2;
        }
        
        .pagination {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .pagination-label {
            margin-right: 10px;
        }
        
        .pagination-btn {
            margin: 0 5px;
            cursor: pointer;
        }
        
        .pagination-active {
            color: #5ad4f1;
            font-weight: bold;
        }
        
        .btn {
            padding: 10px 25px;
            background-color: #5ad4f1;
            color: #000;
            border: none;
            cursor: pointer;
            text-align: center;
            margin: 10px 0;
        }
        
        .action-section {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Lịch sử giao dịch</h1>
        <img src="{{ asset('images/manhinhlichsugiaodich/logo.png') }}" alt="Storme Logo" class="logo">
    </div>
    
    <div class="container">
        <div class="filter-section">
            <div class="date-filter">
                <span>Bộ lọc: Ngày bắt đầu: 01/01/2025</span>
                <span style="margin-left: 20px;">Ngày kết thúc: 31/01/2025</span>
            </div>
            
            <div class="search-bar">
                <span class="search-label">Tìm kiếm:</span>
                <input type="text">
            </div>
        </div>
        
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Thời gian</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>HD001</td>
                    <td>15/01/2025</td>
                    <td>NGuyễn Văn A</td>
                    <td>10.000.000đ</td>
                    <td>Chuyển khoản</td>
                    <td>Đã thanh toán</td>
                </tr>
                <tr>
                    <td>HD002</td>
                    <td>20/01/2025</td>
                    <td>Nguyễn Văn B</td>
                    <td>43.000.000đ</td>
                    <td>Tiền mặt</td>
                    <td>Đã thanh toán</td>
                </tr>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
            </tbody>
        </table>
        
        <div class="action-section">
            <div class="pagination">
                <span class="pagination-label">Trang:</span>
                <span class="pagination-btn">&lt;</span>
                <span class="pagination-btn pagination-active">1</span>
                <span class="pagination-btn">2</span>
                <span class="pagination-btn">&gt;</span>
            </div>
            
            <button class="btn">Xuất file</button>
        </div>
        
        <button class="btn">Quay lại</button>
    </div>
</body>
</html>