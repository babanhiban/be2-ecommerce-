<input type="hidden" name="updated_at" id="edit_updated_at">
<div class="mb-3">
    <label for="edit_customer_name" class="form-label">Tên khách hàng</label>
    <input type="text" class="form-control" id="edit_customer_name" name="customer_name" required>
</div>

<div class="mb-3">
    <label for="edit_phone" class="form-label">Số điện thoại</label>
    <input type="text" class="form-control" id="edit_phone" name="phone" required>
</div>

<div class="mb-3">
    <label for="edit_address" class="form-label">Địa chỉ</label>
    <textarea class="form-control" id="edit_address" name="address" rows="2" required></textarea>
</div>

<div class="mb-3">
    <label for="edit_status" class="form-label">Trạng thái</label>
    <select class="form-select" id="edit_status" name="status" required>
        <option value="Đang xử lý">Đang xử lý</option>
        <option value="Đang giao">Đang giao</option>
        <option value="Hoàn thành">Hoàn thành</option>
        <option value="Đã hủy">Đã hủy</option>
    </select>
</div>
