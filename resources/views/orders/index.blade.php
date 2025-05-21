<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
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

    <script>
    $(function () {
        // Xem
        $('.viewBtn').on('click', function () {
            const id = $(this).data('id');
            $.get(`/orders/${id}`, function (res) {
                $('#viewModal .modal-body').html(`
                    <p><strong>Khách hàng:</strong> ${res.customer_name}</p>
                    <p><strong>SĐT:</strong> ${res.phone}</p>
                    <p><strong>Địa chỉ:</strong> ${res.address}</p>
                    <p><strong>Trạng thái:</strong> ${res.status}</p>
                    <p><strong>Tổng tiền:</strong> ${res.total_price}₫</p>
                `);
                const modal = new bootstrap.Modal(document.getElementById('viewModal'));
                modal.show();
            });
        });

        // Sửa
        $('.editBtn').on('click', function () {
            const id = $(this).data('id');
            $.get(`/orders/${id}`, function (res) {
                $('#editForm').attr('action', `/orders/${id}`);
                $('#editForm input[name=customer_name]').val(res.customer_name);
                $('#editForm input[name=phone]').val(res.phone);
                $('#editForm textarea[name=address]').val(res.address);
                $('#editForm select[name=status]').val(res.status);
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                modal.show();
            });
        });

        // Cập nhật đơn hàng
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            const url = $(this).attr('action');
            $.ajax({
                url,
                method: 'PUT',
                data: $(this).serialize(),
                success: function () {
                    location.reload();
                }
            });
        });

        // Tạo mới
        $('#createForm').on('submit', function (e) {
            e.preventDefault();
            $.post("{{ route('orders.store') }}", $(this).serialize(), function () {
                location.reload();
            });
        });

        // Xoá (không reload)
        $(document).on('click', '.deleteBtn', function () {
            const id = $(this).data('id');
            if (confirm('Bạn có chắc chắn muốn xoá?')) {
                $.ajax({
                    url: `/orders/${id}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        $(`#row-${id}`).remove(); // Xoá khỏi DOM ngay
                    },
                    error: function () {
                        alert('Xoá thất bại!');
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
