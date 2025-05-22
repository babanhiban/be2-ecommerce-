<!DOCTYPE html>
<html lang="vi">
<head>
     <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản lý Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .modal-body p strong {
            display: inline-block;
            width: 120px;
        }
    </style>
</head>
<body class="p-4">
    <h3 class="fw-bold mb-4">🎟️ Danh sách Voucher</h3>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">+ Tạo Voucher</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã</th>
                <th>Giảm (%)</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->code }}</td>
                <td>{{ $voucher->discount }}%</td>
                <td>{{ $voucher->start_date }}</td>
                <td>{{ $voucher->end_date }}</td>
                <td>
                    <button class="btn btn-sm btn-info viewBtn" data-id="{{ $voucher->id }}">Xem</button>
                    <button class="btn btn-sm btn-warning editBtn" data-id="{{ $voucher->id }}">Sửa</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $voucher->id }}">Xoá</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- PHÂN TRANG -->
    <div class="mt-3">
        {{ $vouchers->withQueryString()->links() }}
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm">
                    <div class="modal-header"><h5 class="modal-title">Tạo Voucher</h5></div>
                    <div class="modal-body">
                        <input name="code" class="form-control mb-2" placeholder="Mã Voucher">
                        <input name="discount" type="number" class="form-control mb-2" placeholder="Giảm giá (%)">
                        <input name="start_date" type="date" class="form-control mb-2">
                        <input name="end_date" type="date" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button class="btn btn-primary">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm">
                    <div class="modal-header"><h5 class="modal-title">Sửa Voucher</h5></div>
                    <div class="modal-body">
                        <input name="code" class="form-control mb-2">
                        <input name="discount" type="number" class="form-control mb-2">
                        <input name="start_date" type="date" class="form-control mb-2">
                        <input name="end_date" type="date" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Chi tiết Voucher</h5></div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">Tạo voucher thành công!</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/voucher.js') }}"></script>
</body>
</html>
