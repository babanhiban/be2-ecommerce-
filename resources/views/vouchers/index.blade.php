<!DOCTYPE html>
<html lang="vi">
<head>
     <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản lý Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
    /* Header */
    .custom-header {
        background: linear-gradient(to right, #56ccf2, #2f80ed);
        height: 70px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 30px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        color: #fff;
        border-bottom: 3px solid #fff;
    }

    .custom-header .title {
        font-weight: bold;
        font-size: 22px;
        display: flex;
        align-items: center;
        color: black;
    }

    .custom-header .title i {
        margin-right: 10px;
        font-size: 26px;
        color: black;
    }

    .custom-header .logo img {
        height: 55px;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }

    /* Buttons */
    .btn {
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #3498db;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-info {
        background-color: #1abc9c;
        border: none;
    }

    .btn-warning {
        background-color: #f39c12;
        border: none;
    }

    .btn-danger {
        background-color: #e74c3c;
        border: none;
    }

    .btn-secondary {
        background-color: #7f8c8d;
        border: none;
    }

    .btn-outline-secondary {
        border-color: #7f8c8d;
        color: #7f8c8d;
    }

    /* Table */
    .table {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    /* Form search/filter */
    form .form-control,
    form .form-select {
        border-radius: 8px;
    }

    form .btn {
        min-width: 70px;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        border-radius: 6px; 
    }

 

    /* Modal */
    .modal-content {
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background-color: #f0f0f0;
        border-bottom: none;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .modal-footer {
        background-color: #f8f9fa;
        border-top: none;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .modal-body input {
        border-radius: 6px;
    }

    /* Toast */
    .toast {
        border-radius: 10px;
        font-weight: 500;
    }
</style>



</head>

<body>

    <!-- ✅ Header logo -->
   <header class="custom-header">
    <div class="title">
        <i class="bi bi-clipboard-check-fill"></i> Danh sách voucher
    </div>
    <div class="logo">
        <a href="/homepage"><img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo"></a>
       
    </div>
</header>
<div>
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">+ Tạo Voucher</button>
</div>
<div>
    <!-- Tìm kiếm và lọc -->
<form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm mã hoặc tên..." value="{{ request('keyword') }}">
    </div>
    <div class="col-md-2">
        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
    </div>
    <div class="col-md-2">
        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
    </div>
    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">-- Trạng thái --</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Còn hạn</option>
            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Hết hạn</option>
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-secondary">🔍 Tìm</button>
        <a href="{{ route('vouchers.index') }}" class="btn btn-outline-secondary">🧹 Xoá lọc</a>
    </div>
</form>
</div>
    

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
                <td>{{ rtrim(rtrim(number_format($voucher->discount, 2, '.', ''), '0'), '.') }}%</td>
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
                <form id="createForm" method="POST" action="{{ route('vouchers.store') }}">
                    @csrf
                    <div class="modal-header"><h5 class="modal-title">Tạo Voucher</h5></div>
                    <div class="modal-body">
                        <input name="code" class="form-control mb-2" placeholder="Mã Voucher">
                        <input name="discount" type="number" class="form-control mb-2" placeholder="Giảm giá (%)">
                        <input name="start_date" type="date" class="form-control mb-2">
                        <input name="end_date" type="date" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Tạo</button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
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
