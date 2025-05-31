<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê voucher</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Thống kê Voucher</h1>

<form method="GET" style="display: flex; gap: 10px; align-items: center; margin-bottom: 20px;">
    <input type="text" name="keyword" placeholder="Tìm theo mã" value="{{ request('keyword') }}"
           style="padding: 6px; border: 1px solid #ccc; border-radius: 5px;">

    <input type="date" name="from_date" value="{{ request('from_date') }}"
           style="padding: 6px; border: 1px solid #ccc; border-radius: 5px;">

    <input type="date" name="to_date" value="{{ request('to_date') }}"
           style="padding: 6px; border: 1px solid #ccc; border-radius: 5px;">

    <select name="status" style="padding: 6px; border: 1px solid #ccc; border-radius: 5px;">
        <option value="">Tất cả</option>
        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Còn hạn</option>
        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Hết hạn</option>
    </select>

    <button type="submit" style="padding: 6px 12px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
        🔍 Lọc
    </button>

    <a href="{{ route('statistics.vouchers.export', request()->query()) }}" 
       style="padding: 6px 12px; background-color: #28a745; color: white; border-radius: 5px; text-decoration: none;">
        📤 Export CSV
    </a>
</form>



    <h2>Danh sách voucher</h2>
<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
    <thead style="background-color: #f0f0f0;">
        <tr>
            <th style="padding: 10px; border: 1px solid #ccc;">Mã</th>
            <th style="padding: 10px; border: 1px solid #ccc;">Giảm (%)</th>
            <th style="padding: 10px; border: 1px solid #ccc;">Ngày bắt đầu</th>
            <th style="padding: 10px; border: 1px solid #ccc;">Ngày kết thúc</th>
            <th style="padding: 10px; border: 1px solid #ccc;">Ngày tạo</th>
        </tr>
    </thead>
   <tbody>
    @forelse ($vouchers as $voucher)
        <tr>
            <td style="padding: 10px; border: 1px solid #ccc;">{{ $voucher->code }}</td>
            <td style="padding: 10px; border: 1px solid #ccc;">{{ $voucher->discount }}%</td>
            <td style="padding: 10px; border: 1px solid #ccc;">
                {{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }}
            </td>
            <td style="padding: 10px; border: 1px solid #ccc;">
                {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}
            </td>
            <td style="padding: 10px; border: 1px solid #ccc;">
                {{ $voucher->created_at->format('d/m/Y H:i') }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" style="padding: 10px; text-align: center;">Không có dữ liệu</td>
        </tr>
    @endforelse
</tbody>

</table>


<div style="margin-top: 20px;">
    {{ $vouchers->links() }}
</div>

    <h2>Biểu đồ voucher theo tháng</h2>
    <canvas id="voucherChart" width="600" height="300"></canvas>

    <script>
        const ctx = document.getElementById('voucherChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Số lượng voucher theo tháng',
                    data: {!! json_encode($chartData['counts']) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
</body>
</html>
