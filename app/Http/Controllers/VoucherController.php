<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $page = $request->query('page', 1);

  if (!is_numeric($page) || $page < 1) {
    abort(404); // Hiện trang lỗi 404.blade.php
}

    $vouchers = Voucher::paginate(10);

 if ($vouchers->currentPage() > $vouchers->lastPage()) {
     abort(404);
}
    
    $query = \App\Models\Voucher::query();

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

    return view('vouchers.index', compact('vouchers'));
}

public function store(Request $request)
{
    $request->validate([
        'code' => 'required|unique:vouchers,code',
        'discount' => 'required|numeric|min:1|max:100',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    Voucher::create([
        'code' => $request->code,
        'discount' => $request->discount,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    return redirect()->route('vouchers.index')->with('success', 'Tạo voucher thành công!');
}


public function show($id)
{
    if (!is_numeric($id)) {
        return response()->json(['message' => 'ID không hợp lệ'], 400);
    }

    $voucher = \App\Models\Voucher::find($id);

    if (!$voucher) {
        return response()->json(['message' => 'Không tìm thấy voucher'], 404);
    }

    return response()->json($voucher);
}
public function update(Request $request, Voucher $voucher)
{
    $validated = $request->validate([
        'code' => 'required|string',
       'discount' => 'required|numeric|min:0|max:100',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $voucher->update($validated);

    return response()->json(['success' => true]);
}

public function destroy($id)
{
    $voucher = Voucher::find($id);

    if (!$voucher) {
        return response()->json([
            'success' => false,
            'message' => 'Xóa không hợp lệ: voucher không tồn tại hoặc đã bị xóa.'
        ], 404);
    }

    $voucher->delete();

    // Lấy số trang hiện tại từ request (mặc định 1)
    $page = request()->input('page', 1);

    // Số bản ghi mỗi trang, thay cho đúng paginate của bạn
    $perPage = 10;

    // Lấy voucher paginate theo trang hiện tại
    $vouchers = Voucher::paginate($perPage, ['*'], 'page', $page);

    // Đếm số voucher còn lại trên trang hiện tại
    $remainingOnPage = $vouchers->count();

    return response()->json([
        'success' => true,
        'message' => 'Xóa voucher thành công!',
        'remainingOnPage' => $remainingOnPage,
        'currentPage' => (int)$page
    ]);
}


public function check($code)
{
    $voucher = Voucher::where('code', $code)->first();

    if (!$voucher) {
        return response()->json(['message' => 'Mã không tồn tại'], 404);
    }

    return response()->json($voucher);
}

}
