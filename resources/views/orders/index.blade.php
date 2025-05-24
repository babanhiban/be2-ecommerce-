<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản lý đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
    .custom-header {
        background-color:#87CEFA;
        height: 70px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .custom-header .title {
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 20px;
        color: #202020;
    }

    .custom-header .title i {
        font-size: 24px;
        margin-right: 10px;
    }

    .custom-header .logo img {
        height: 55px;
        border-radius: 10px;
    }
</style>


</head>

<body>

    <!-- ✅ Header logo -->
   <header class="custom-header">
    <div class="title">
        <i class="bi bi-clipboard-check-fill"></i> Danh sách đơn hàng
    </div>
    <div class="logo">
        <a href="/homepage"><img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo"></a>
       
    </div>
</header>



    <!-- ✅ Nội dung chính -->
    <div class="p-4">
        <!-- Tạo đơn -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">+ Tạo đơn hàng</button>

        <!-- Danh sách đơn -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr id="row-{{ $order->id }}">
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ number_format($order->total_price) }}₫</td>
                    <td>
                        <button class="btn btn-sm btn-info viewBtn" data-id="{{ $order->id }}">Xem</button>
                        <button class="btn btn-sm btn-warning editBtn" data-id="{{ $order->id }}">Sửa</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $order->id }}">Xoá</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modals -->
        @include('orders.modals.create')
        @include('orders.modals.edit')
        @include('orders.modals.view')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/orders.js') }}"></script>
</body>

</html>