@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Thống kê Voucher</h2>

    <form method="GET" action="{{ route('vouchers.statistical.index') }}" class="mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Tìm kiếm</label>
                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Mã hoặc tên voucher">
            </div>
            <div class="col-md-2">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                    <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Hết hạn</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Từ ngày</label>
                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Đến ngày</label>
                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">Lọc</button>
                <a href="{{ route('vouchers.statistical.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-3">
                <label class="form-label">Loại voucher</label>
                <select name="type" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="percent" {{ request('type') === 'percent' ? 'selected' : '' }}>Giảm %</option>
                    <option value="fixed" {{ request('type') === 'fixed' ? 'selected' : '' }}>Giảm cố định</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tổng giảm tối thiểu</label>
                <input type="number" name="min_discount" class="form-control" value="{{ request('min_discount') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Tổng giảm tối đa</label>
                <input type="number" name="max_discount" class="form-control" value="{{ request('max_discount') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <a href="{{ route('vouchers.statistical.export', request()->query()) }}" class="btn btn-dark w-100">Xuất CSV</a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center rounded-3 overflow-hidden">
            <thead class="table-light">
                <tr>
                    <th>Mã</th>
                    <th>Tên voucher</th>
                    <th>Loại</th>
                    <th>Số lượt áp dụng</th>
                    <th>Đơn hàng thành công</th>
                    <th>Tổng tiền giảm</th>
                    <th>Ngày tạo</th>
                    <th>Hạn sử dụng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->name }}</td>
                    <td>{{ $voucher->type_label }}</td>
                    <td>{{ $voucher->usage_count }}</td>
                    <td>{{ $voucher->successful_orders }}</td>
                    <td>{{ number_format($voucher->total_discount, 0, ',', '.') }}đ</td>
                    <td>{{ $voucher->created_at->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</td>
                         <td>
                        <span class="badge text-white {{ $voucher->isExpired() ? 'bg-danger' : 'bg-success' }}">
                            {{ $voucher->isExpired() ? 'Hết hạn' : 'Đang hoạt động' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $vouchers->appends(request()->query())->links() }}
    </div>

    <div class="mt-5">
       
        <canvas id="discountChart" height="100" class="mt-4"></canvas>
        <canvas id="usageChart" height="100" class="mt-4"></canvas>
    </div>
</div>

<style>
    table tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('scripts')
    @parent
   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const vouchers = @json($vouchers->items());

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
    </script>
@endsection
