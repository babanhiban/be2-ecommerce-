<?php
namespace App\Http\Controllers\Statistical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherStatisticalController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();

        return view('statistical.voucher.index', compact('vouchers'));
    }
}
