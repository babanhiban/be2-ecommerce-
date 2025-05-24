<?php

namespace App\Http\Controllers\Statistical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class VoucherStatisticalController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        $query = Voucher::query()
            ->when($request->search, fn($q) => $q->where(function ($q) use ($request) {
                $q->where('code', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
            }))
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->when($request->min_discount, fn($q) => $q->where('discount', '>=', $request->min_discount))
            ->when($request->max_discount, fn($q) => $q->where('discount', '<=', $request->max_discount))
            ->orderByDesc('created_at');

        $vouchers = $query->paginate(10)->withQueryString();

        $vouchers->getCollection()->transform(function ($voucher) use ($request, $now) {
            $orders = Order::query()
                ->where('voucher_id', $voucher->id)
                ->when($request->from_date, fn($q) => $q->whereDate('created_at', '>=', $request->from_date))
                ->when($request->to_date, fn($q) => $q->whereDate('created_at', '<=', $request->to_date))
                ->get();

            $voucher->apply_count = $orders->count();
            $voucher->success_count = $orders->where('status', 'Hoàn thành')->count();
            $voucher->discount_total = $orders
                ->where('status', 'Hoàn thành')
                ->sum(fn($order) => $order->total_price * ($voucher->discount / 100));

            $voucher->status = $voucher->expired_at >= $now->toDateString() ? 'active' : 'expired';

            return $voucher;
        });

        return view('statistical.voucher.index', [
            'vouchers' => $vouchers,
            'from' => $request->from_date,
            'to' => $request->to_date
        ]);
    }

    public function export(Request $request)
    {
        $now = Carbon::now();

        $query = Voucher::query()
            ->when($request->search, fn($q) => $q->where(function ($q) use ($request) {
                $q->where('code', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
            }))
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->when($request->min_discount, fn($q) => $q->where('discount', '>=', $request->min_discount))
            ->when($request->max_discount, fn($q) => $q->where('discount', '<=', $request->max_discount))
            ->orderByDesc('created_at');

        $vouchers = $query->get();

        $data = [];
        $data[] = ['Mã', 'Tên', 'Loại', 'Áp dụng', 'Hoàn thành', 'Tổng giảm', 'Ngày tạo', 'Hạn sử dụng', 'Trạng thái'];

        foreach ($vouchers as $v) {
            $orders = Order::query()
                ->where('voucher_id', $v->id)
                ->when($request->from_date, fn($q) => $q->whereDate('created_at', '>=', $request->from_date))
                ->when($request->to_date, fn($q) => $q->whereDate('created_at', '<=', $request->to_date))
                ->get();

            $apply_count = $orders->count();
            $success_count = $orders->where('status', 'Hoàn thành')->count();
            $discount_total = $orders
                ->where('status', 'Hoàn thành')
                ->sum(fn($order) => $order->total_price * ($v->discount / 100));
            $status = $v->expired_at >= $now->toDateString() ? 'Đang hoạt động' : 'Hết hạn';

            $data[] = [
                $v->code,
                $v->name,
                $v->type === 'percent' ? 'Giảm %' : 'Giảm cố định',
                $apply_count,
                $success_count,
                number_format($discount_total, 0, ',', '.'),
                $v->created_at->format('d/m/Y'),
                Carbon::parse($v->expired_at)->format('d/m/Y'),
                $status,
            ];
        }

        $filename = 'voucher_statistical_' . now()->format('Ymd_His') . '.csv';

        $handle = fopen('php://temp', 'r+');
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return Response::make($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
