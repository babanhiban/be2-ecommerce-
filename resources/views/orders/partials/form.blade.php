<!-- Thông tin khách hàng -->
<input type="text" name="customer_name" class="form-control mb-2" placeholder="Tên khách hàng" required>
<input type="text" name="phone" class="form-control mb-2" placeholder="Số điện thoại">
<textarea name="address" class="form-control mb-2" placeholder="Địa chỉ"></textarea>

<!-- Chọn danh mục -->
<select id="category-select" class="form-select mb-2">
    <option value="">-- Chọn danh mục --</option>
</select>

<!-- Chọn sản phẩm -->
<select id="product-select" class="form-select mb-2" name="product_id">
    <option value="">-- Chọn sản phẩm --</option>
</select>

<!-- Giá sản phẩm -->
<input type="text" id="product-price" class="form-control mb-2" placeholder="Giá" readonly>

<!-- Nhập số lượng -->
<input type="number" id="quantity" class="form-control mb-2" placeholder="Số lượng" min="1" value="">

<!-- Tổng tiền trước giảm -->
<input type="text" id="total" class="form-control mb-2" placeholder="Tổng tiền" readonly>

<!-- Mã giảm giá -->
<div class="input-group mb-2">
    <input type="text" id="voucher-code" class="form-control" placeholder="Nhập mã voucher">
    <button type="button" id="apply-voucher" class="btn btn-primary">Áp dụng</button>
</div>

<!-- Hiển thị mức giảm -->
<div id="voucher-discount-info" class="mb-2 text-success fw-bold"></div>

<!-- Tổng sau giảm -->
<input type="text" id="final-total" class="form-control mb-2" placeholder="Tổng thanh toán" readonly>

<!-- Gửi hidden voucher -->
<input type="hidden" name="voucher_id" id="hidden-voucher-id">

