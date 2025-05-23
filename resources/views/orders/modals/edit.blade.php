<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" class="modal-content" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
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
                        <option value="Đã huỷ">Đã huỷ</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </form>
    </div>
</div>
