<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>404 - Không tìm thấy trang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #56ccf2, #2f80ed);
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .error-container {
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            max-width: 500px;
        }

        .error-code {
            font-size: 100px;
            font-weight: bold;
            line-height: 1;
        }

        .error-message {
            font-size: 22px;
            margin: 20px 0;
        }

        .btn-home {
            background-color: #fff;
            color: #2f80ed;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-home:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>

<body>

    <div class="error-container">
        <div class="error-code">404</div>
        <div class="error-message">Oops! Trang bạn tìm không tồn tại hoặc đã bị xoá.</div>
        <a href="{{ url('/homepage') }}" class="btn-home">🔙 Về trang chủ</a>
    </div>

</body>

</html>
