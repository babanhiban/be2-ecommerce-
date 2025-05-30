<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Không tìm thấy trang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
            background-color: #f4f4f4;
        }

        h1 {
            font-size: 48px;
            color: #c0392b;
        }

        p {
            font-size: 20px;
        }

        a {
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>

<body>
    <h1>Không tìm thấy trang</h1>
    <p>ID bạn nhập không tồn tại trong hệ thống.</p>
    <a href="{{ route('home') }}">Quay lại trang chủ</a>
</body>

</html>