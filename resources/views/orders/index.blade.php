<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản lý đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-body p strong {
            display: inline-block;
            width: 120px;
        }
    </style>
</head>
<body class="p-4">

    <h3 class="fw-bold mb-4">📋 Danh sách đơn hàng</h3>

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
                <td>{{ $order->user->name ?? '(Không có)' }}</td>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

 <script src="{{ asset('js/orders.js') }}"></script>
</body>
</html>
