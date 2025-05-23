<!-- Thông tin khách hàng -->
<input type="text" name="customer_name" class="form-control mb-2" placeholder="Tên khách hàng" required>
<input type="text" name="phone" class="form-control mb-2" placeholder="Số điện thoại">
<textarea name="address" class="form-control mb-2" placeholder="Địa chỉ"></textarea>

<!-- Trạng thái: Luôn là "Đang xử lý", không cho chỉnh -->
<select name="status" class="form-select mb-2" disabled>
    <option value="Đang xử lý" selected>Đang xử lý</option>
</select>
<input type="hidden" name="status" value="Đang xử lý">

<!-- Chọn danh mục -->
<select id="category-select" class="form-select mb-2">
    <option value="">-- Chọn danh mục --</option>
    <!-- sẽ được fill bằng JS -->
</select>

<!-- Chọn sản phẩm -->
<select id="product-select" class="form-select mb-2" name="product_id">
    <option value="">-- Chọn sản phẩm --</option>
</select>

<!-- Giá sản phẩm -->
<input type="text" id="product-price" class="form-control mb-2" placeholder="Giá" readonly>

<!-- Nhập số lượng -->
<input type="number" id="quantity" class="form-control mb-2" placeholder="Số lượng" min="1" value="1">

<!-- Tổng tiền -->
<input type="text" id="total" class="form-control mb-2" placeholder="Tổng tiền" readonly>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category-select');
    const productSelect = document.getElementById('product-select');
    const priceInput = document.getElementById('product-price');
    const quantityInput = document.getElementById('quantity');
    const totalInput = document.getElementById('total');

    // Load danh mục
    fetch('/api/categories')
        .then(res => res.json())
        .then(data => {
            data.forEach(category => {
                categorySelect.innerHTML += `<option value="${category.id}">${category.name}</option>`;
            });
        });

    // Khi chọn danh mục, load sản phẩm tương ứng
    categorySelect.addEventListener('change', function () {
        const categoryId = this.value;
        if (!categoryId) return;

        fetch(`/api/categories/${categoryId}/products`)
            .then(res => res.json())
            .then(data => {
                productSelect.innerHTML = '<option value="">-- Chọn sản phẩm --</option>';
                data.forEach(product => {
                    productSelect.innerHTML += `<option value="${product.id}" data-price="${product.price}">${product.name}</option>`;
                });
                priceInput.value = '';
                totalInput.value = '';
            });
    });

    // Khi chọn sản phẩm, hiển thị giá
    productSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        priceInput.value = price || '';
        updateTotal();
    });

    // Khi thay đổi số lượng, tính lại tổng
    quantityInput.addEventListener('input', updateTotal);

    function updateTotal() {
        const price = parseFloat(priceInput.value || 0);
        const qty = parseInt(quantityInput.value || 0);
        if (price > 0 && qty > 0) {
            totalInput.value = (price * qty).toLocaleString('vi-VN');
        } else {
            totalInput.value = '';
        }
    }
});
</script>

