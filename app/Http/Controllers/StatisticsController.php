<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Giả sử model Order lưu đơn hàng
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Query cơ bản lọc theo ngày nếu có
        $query = Order::query();

        if ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        }
        if ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        // Tổng đơn hàng
        $totalOrders = $query->count();

        // Tổng doanh thu
        $totalRevenue = $query->sum('total_price');

        // Đơn có voucher
        $voucherOrders = (clone $query)->whereNotNull('voucher_id')->count();

        // Thống kê trạng thái đơn hàng
        $ordersByStatus = (clone $query)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        // Thống kê đơn hàng theo tháng (dùng năm hiện tại)
        $year = now()->year;

        $ordersByMonth = Order::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('count(*) as count')
            )
            ->whereYear('created_at', $year)
            ->when($fromDate, fn($q) => $q->whereDate('created_at', '>=', $fromDate))
            ->when($toDate, fn($q) => $q->whereDate('created_at', '<=', $toDate))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Chuẩn hóa để đủ 12 tháng (nếu muốn)
        $allMonths = collect(range(1,12))
            ->mapWithKeys(fn($m) => [sprintf('%04d-%02d', $year, $m) => 0]);

        $ordersByMonth = $allMonths->merge($ordersByMonth);

        return view('statistics.orders', compact(
            'totalOrders', 'totalRevenue', 'voucherOrders',
            'ordersByStatus', 'ordersByMonth'
        ));
    }

    // Export CSV đơn giản
    public function export(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = Order::query();

        if ($fromDate) $query->whereDate('created_at', '>=', $fromDate);
        if ($toDate) $query->whereDate('created_at', '<=', $toDate);

        $orders = $query->get(['id', 'created_at', 'status', 'total_price', 'voucher_id']);

        $filename = 'orders_export_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($orders) {
            $handle = fopen('php://output', 'w');
            // Header row
            fputcsv($handle, ['ID', 'Ngày tạo', 'Trạng thái', 'Tổng tiền', 'Mã voucher']);
            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->id,
                    $order->created_at->format('Y-m-d H:i:s'),
                    $order->status,
                    $order->total_price,
                    $order->voucher_code ?? '-'
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
