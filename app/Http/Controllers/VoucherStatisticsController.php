<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherStatisticsController extends Controller
{
    public function index(Request $request)
    {
        $query = Voucher::query();

        if ($request->filled('keyword')) {
            $query->where('code', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('from_date')) {
            $query->whereDate('start_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('end_date', '<=', $request->to_date);
        }

        if ($request->status === 'active') {
            $query->where('end_date', '>=', now());
        } elseif ($request->status === 'expired') {
            $query->where('end_date', '<', now());
        }

        $vouchers = $query->orderByDesc('created_at')->paginate(10);

        $chartData = Voucher::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->reduce(function ($carry, $item) {
                $carry['labels'][] = $item->month;
                $carry['counts'][] = $item->count;
                return $carry;
            }, ['labels' => [], 'counts' => []]);

        return view('statistics.voucher', compact('vouchers', 'chartData'));
    }
    public function export(Request $request)
{
    $query = Voucher::query();

    if ($request->filled('keyword')) {
        $query->where('code', 'like', '%' . $request->keyword . '%');
    }

    if ($request->filled('from_date')) {
        $query->whereDate('start_date', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('end_date', '<=', $request->to_date);
    }

    if ($request->status === 'active') {
        $query->where('end_date', '>=', now());
    } elseif ($request->status === 'expired') {
        $query->where('end_date', '<', now());
    }

    $vouchers = $query->orderByDesc('created_at')->get();

    $filename = 'voucher_statistics_' . now()->format('Ymd_His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function () use ($vouchers) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Mã Voucher', 'Phần trăm giảm', 'Ngày bắt đầu', 'Ngày kết thúc', 'Ngày tạo']);

        foreach ($vouchers as $voucher) {
            fputcsv($handle, [
                $voucher->code,
                $voucher->discount . '%',
                $voucher->start_date,
                $voucher->end_date,
                $voucher->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
}

}
