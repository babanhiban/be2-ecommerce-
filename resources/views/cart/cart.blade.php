<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>


    <link rel="stylesheet" href="{{ asset('css/CartPage.css') }}">

    <div class="cart-container">
        <!-- Hiển thị thông báo dạng popup (góc phải màn hình) -->
        @if(session('error'))
            <div id="notification" class="notification error">
                <span class="icon">⚠️</span>
                <span>{{ session('error') }}</span>
                <button onclick="closeNotification()" class="close-btn">&times;</button>
            </div>
        @endif

        @if(session('success'))
            <div id="notification" class="notification success">
                <span class="icon">✅</span>
                <span>{{ session('success') }}</span>
                <button onclick="closeNotification()" class="close-btn">&times;</button>
            </div>
        @endif

        <div class="cart-header">
            <h2>🛒 Giỏ Hàng</h2>
            <div class="header-right">
                <a href="{{ route('home') }}">Trang Chủ</a> | <strong>Giỏ Hàng</strong>
                <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" class="brand-logo" />
            </div>
        </div>

        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Chọn</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td><img src="{{ asset('images/manhinhsanpham/' . $item['image']) }}"
                                    alt="Not Found" /></td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['category'] }}</td>
                            <td>
                                <input type="checkbox" name="checked[{{ $item['id'] }}]" value="1"
                                    {{ isset($checked[$item['id']]) ? 'checked' : '' }} />
                            </td>
                            <td>
                                <button type="submit" name="action" value="decrease-{{ $item['id'] }}"
                                    class="btn">-</button>
                                <span style="margin: 0 10px;">{{ $item['quantity'] }}</span>
                                <button type="submit" name="action" value="increase-{{ $item['id'] }}"
                                    class="btn">+</button>
                            </td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                            <td>{{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $cartItemsPaginate->links('pagination::bootstrap-4') }}
            </div>
            <div class="cart-footer">
                <div>
                    <button type="submit" name="action" value="delete" class="btn">Xóa</button>
                </div>
                <div style="display: flex; flex-direction: column; align-items: flex-end;">
                    <span class="total">Tổng cộng: {{ number_format($total, 0, ',', '.') }} VNĐ</span>
                    <span class="total" style="color: #00bfff;">
                        Đã chọn: {{ number_format($selectedTotal, 0, ',', '.') }} VNĐ
                    </span>
                </div>
                <button type="submit" name="action" value="buy" class="btn">Mua</button>
            </div>
        </form>

        <script>
            // Xử lý checkbox
            document.querySelectorAll('input[type="checkbox"][name^="checked"]').forEach(cb => {
                cb.addEventListener('change', () => {
                    // Khi checkbox thay đổi, submit form để cập nhật session và tính lại tổng tiền
                    cb.closest('form').submit();
                });
            });

            // Xử lý thông báo popup
            function closeNotification() {
                const notification = document.getElementById('notification');
                if (notification) {
                    notification.style.animation = 'slideOut 0.3s ease-in';
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }
            }

            // Tự động ẩn thông báo sau 5 giây
            document.addEventListener('DOMContentLoaded', function() {
                const notification = document.getElementById('notification');
                if (notification) {
                    setTimeout(() => {
                        closeNotification();
                    }, 5000);
                }
            });
        </script>
    </div>

</body>

</html>
