<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng Quan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-card {
            background-color: #f8f9fa;
            border-radius: 0.75rem;
            padding: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }
        .dashboard-icon {
            font-size: 2rem;
            margin-right: 1rem;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <h3 class="fw-bold mb-4">Tổng Quan</h3>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="dashboard-card d-flex align-items-center">
                <div class="dashboard-icon text-primary">📦</div>
                <div>
                    <div class="h5 mb-0 fw-bold">230</div>
                    <small class="text-muted">Đơn hàng</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card d-flex align-items-center">
                <div class="dashboard-icon text-success">👥</div>
                <div>
                    <div class="h5 mb-0 fw-bold">1020</div>
                    <small class="text-muted">Người dùng</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card d-flex align-items-center">
                <div class="dashboard-icon text-warning">💰</div>
                <div>
                    <div class="h5 mb-0 fw-bold">25.500.000₫</div>
                    <small class="text-muted">Doanh thu hôm nay</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card d-flex align-items-center">
                <div class="dashboard-icon text-info">🎫</div>
                <div>
                    <div class="h5 mb-0 fw-bold">12</div>
                    <small class="text-muted">Mã giảm giá</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card d-flex align-items-center">
                <div class="dashboard-icon text-danger">🧺</div>
                <div>
                    <div class="h5 mb-0 fw-bold">148</div>
                    <small class="text-muted">Giỏ hàng đang hoạt động</small>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
