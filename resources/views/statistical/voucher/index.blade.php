<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thống kê Voucher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- nếu có dùng CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-rounded {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .status-active {
            color: #10b981;
            font-weight: 500;
        }

        .status-expired {
            color: #ef4444;
            font-weight: 500;
        }

        .chart-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        body {
            background: #f9fafb;
            font-family: 'Segoe UI', sans-serif;
        }

        h2 {
            font-weight: 700;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="text-center mb-4">Thống kê Voucher</h2>

    <div class="row align-items-center mb-4 g-2">
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm theo mã hoặc tên voucher...">
        </div>
        <div class="col-md-3">
            <select id="statusFilter" class="form-select" onchange="filterStatus(this)">
                <option value="">Tất cả trạng thái</option>
                <option value="active">Đang hoạt động</option>
                <option value="expired">Hết hạn</option>
            </select>
        </div>
        <div class="col-md-3 text-md-end">
            <a href="{{ route('vouchers.statistical.export') }}" class="btn btn-dark w-100">Xuất CSV</a>
        </div>
    </div>

    <div class="table-responsive table-rounded mb-4">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mã</th>
                    <th>Tên voucher</th>
                    <th>Số lượt áp dụng</th>
                    <th>Đơn hàng thành công</th>
                    <th>Tổng tiền giảm</th>
                    <th>Ngày tạo</th>
                    <th>Hạn sử dụng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody id="voucherTable">
                @foreach ($vouchers as $v)
                    <tr>
                        <td>{{ $v->code }}</td>
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->apply_count }}</td>
                        <td>{{ $v->success_count }}</td>
                        <td>{{ number_format($v->discount_total, 0, ',', '.') }}đ</td>
                        <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($v->expired_at)->format('d/m/Y') }}</td>
                        <td class="{{ $v->status == 'active' ? 'status-active' : 'status-expired' }}">
                            {{ $v->status == 'active' ? 'Đang hoạt động' : 'Hết hạn' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="chart-card">
                <h5 class="mb-3">Tổng tiền giảm</h5>
                <canvas id="discountChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-card">
                <h5 class="mb-3">So sánh lượt áp dụng & đơn thành công</h5>
                <canvas id="usageChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const vouchers = @json($vouchers);

    const labels = vouchers.map(v => v.code);
    const discountTotals = vouchers.map(v => v.discount_total);
    const applyCounts = vouchers.map(v => v.apply_count);
    const successCounts = vouchers.map(v => v.success_count);

    new Chart(document.getElementById('discountChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tổng tiền giảm',
                backgroundColor: '#6366F1',
                data: discountTotals
            }]
        },
        options: {
            scales: {
                y: {
                    ticks: {
                        callback: value => value.toLocaleString('vi-VN') + 'đ'
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('usageChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Áp dụng',
                    borderColor: '#3B82F6',
                    data: applyCounts,
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Thành công',
                    borderColor: '#10B981',
                    data: successCounts,
                    fill: false,
                    tension: 0.3
                }
            ]
        }
    });

    function filterStatus(select) {
        const value = select.value;
        const rows = document.querySelectorAll('#voucherTable tr');
        rows.forEach(row => {
            const statusCell = row.cells[7].textContent.trim();
            if (!value || (value === 'active' && statusCell === 'Đang hoạt động') || (value === 'expired' && statusCell === 'Hết hạn')) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    document.getElementById('searchInput').addEventListener('keyup', function () {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('#voucherTable tr');
        rows.forEach(row => {
            const code = row.cells[0].textContent.toLowerCase();
            const name = row.cells[1].textContent.toLowerCase();
            if (code.includes(value) || name.includes(value)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
