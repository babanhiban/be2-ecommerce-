<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg"> <!-- modal-lg cho rộng -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <p><strong>Khách hàng:</strong> <span id="view-customer-name"></span></p>
                <p><strong>Số điện thoại:</strong> <span id="view-phone"></span></p>
                <p><strong>Địa chỉ:</strong> <span id="view-address"></span></p>
                <p><strong>Trạng thái:</strong> <span id="view-status"></span></p>

                <h6>Sản phẩm:</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody id="view-product-list">
                        <!-- JS sẽ render vào đây -->
                    </tbody>
                </table>

                <p><strong>Tổng tiền:</strong> <span id="view-total"></span></p>

            </div>
        </div>
    </div>
</div>
