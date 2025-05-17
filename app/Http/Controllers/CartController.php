<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    private $initialItems = [
        1 => [
            'id' => 1,
            'name' => 'iphone',
            'category' => 'Điện Thoại',
            'image' => 'https://via.placeholder.com/60x60?text=Iphone',
            'quantity' => 3,
            'price' => 10000000,
        ],
        2 => [
            'id' => 2,
            'name' => 'Laptop',
            'category' => 'Laptop',
            'image' => 'https://via.placeholder.com/60x60?text=Laptop',
            'quantity' => 2,
            'price' => 20000000,
        ],
        3 => [
            'id' => 3,
            'name' => 'Máy ảnh',
            'category' => 'Máy Ảnh',
            'image' => 'https://via.placeholder.com/60x60?text=Camera',
            'quantity' => 2,
            'price' => 5000000,
        ],
        4 => [
            'id' => 4,
            'name' => 'Tai nghe',
            'category' => 'Phụ kiện',
            'image' => 'https://via.placeholder.com/60x60?text=Tai+nghe',
            'quantity' => 1,
            'price' => 2000000,
        ],
        5 => [
            'id' => 5,
            'name' => 'Tai nghe không dây',
            'category' => 'Phụ kiện',
            'image' => 'https://via.placeholder.com/60x60?text=Bluetooth',
            'quantity' => 2,
            'price' => 1000000,
        ],
    ];

    public function index(Request $request)
    {
        // Lấy giỏ hàng từ session, nếu chưa có thì lấy mặc định
        $items = session('cart.items', $this->initialItems);

        // Lấy checked items từ session (dùng để check checkbox)
        $checked = session('cart.checked', []);

        // Tính tổng
        $total = 0;
        $selectedTotal = 0;
        foreach ($items as $item) {
            $total += $item['quantity'] * $item['price'];
            if (isset($checked[$item['id']])) {
                $selectedTotal += $item['quantity'] * $item['price'];
            }
        }

        return view('cart.cart', compact('items', 'checked', 'total', 'selectedTotal'));
    }

    public function update(Request $request)
    {
        $items = session('cart.items', $this->initialItems);
        $checked = $request->input('checked', []);
        $action = $request->input('action');

        // Cập nhật checkbox (checked)
        session(['cart.checked' => $checked]);

        // Xử lý các action
        if ($action) {
            if (str_starts_with($action, 'increase-')) {
                $id = (int)substr($action, 9);
                if (isset($items[$id])) {
                    $items[$id]['quantity']++;
                }
            } elseif (str_starts_with($action, 'decrease-')) {
                $id = (int)substr($action, 9);
                if (isset($items[$id])) {
                    $items[$id]['quantity'] = max(1, $items[$id]['quantity'] - 1);
                }
            } elseif ($action === 'delete') {
                // Xóa các sản phẩm đã chọn
                foreach ($checked as $id => $val) {
                    unset($items[$id]);
                }
                // Đồng thời clear checked
                $checked = [];
                session(['cart.checked' => $checked]);
            } elseif ($action === 'buy') {
                if (empty($checked)) {
                    return back()->with('error', 'Vui lòng chọn ít nhất một sản phẩm để mua.');
                }
                $names = [];
                $totalAmount = 0;
                foreach ($checked as $id => $val) {
                    if (isset($items[$id])) {
                        $names[] = $items[$id]['name'];
                        $totalAmount += $items[$id]['quantity'] * $items[$id]['price'];
                    }
                }
                // Xóa sản phẩm đã mua
                foreach ($checked as $id => $val) {
                    unset($items[$id]);
                }
                $checked = [];
                session(['cart.checked' => $checked]);

                session(['cart.items' => $items]);

                return back()->with('success', "Bạn đã mua " . implode(', ', $names) . " với giá " . number_format($totalAmount, 0, ',', '.') . " VNĐ thành công!");
            }
        }

        // Lưu lại session
        session(['cart.items' => $items, 'cart.checked' => $checked]);

        return back();
    }
}
