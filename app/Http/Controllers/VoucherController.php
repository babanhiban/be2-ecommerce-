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
    return response()->json(\App\Models\Voucher::findOrFail($id));
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

    return response()->json([
        'success' => true,
        'message' => 'Xóa voucher thành công!'
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
