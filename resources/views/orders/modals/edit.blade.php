<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editForm" class="modal-content" method="POST">
            @csrf @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @include('orders.partials.form')
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Lưu</button>
            </div>
        </form>
    </div>
</div>
