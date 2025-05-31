<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trạng thái thanh toán</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .status-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .status-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
        .error-icon {
            font-size: 4rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }
        .status-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .status-message {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 2rem;
        }
        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-success-custom {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            border: none;
        }
        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
            color: white;
        }
        .btn-primary-custom {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
            border: none;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
            color: white;
        }
    </style>
</head>
<body>
    <div class="status-container">
        <div class="status-card">
            @if(session('success'))
                <!-- Trạng thái thành công -->
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1 class="status-title text-success">Đặt hàng thành công!</h1>
                <p class="status-message">
                    {{ session('success') }}
                </p>
                <p class="text-muted mb-4">
                    Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('home') }}" class="btn btn-success-custom">
                        <i class="fas fa-home me-2"></i>Về trang chủ
                    </a>
                    
                </div>
                
            @elseif(session('error'))
                <!-- Trạng thái lỗi -->
                <div class="error-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h1 class="status-title text-danger">Đặt hàng thất bại!</h1>
                <p class="status-message">
                    {{ session('error') }}
                </p>
                <p class="text-muted mb-4">
                    Vui lòng thử lại hoặc liên hệ với chúng tôi để được hỗ trợ.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('cart.index') }}" class="btn btn-primary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại giỏ hàng
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-success-custom">
                        <i class="fas fa-home me-2"></i>Về trang chủ
                    </a>
                </div>
                
            @else
                <!-- Trạng thái mặc định -->
                <div class="text-primary" style="font-size: 4rem; margin-bottom: 1rem;">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h1 class="status-title text-primary">Không có thông tin</h1>
                <p class="status-message">
                    Không tìm thấy thông tin về trạng thái đơn hàng.
                </p>
                <a href="{{ route('home') }}" class="btn btn-primary-custom">
                    <i class="fas fa-home me-2"></i>Về trang chủ
                </a>
            @endif
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>