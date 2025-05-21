<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="createForm" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tạo đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @include('orders.partials.form')
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Tạo</button>
            </div>
        </form>
    </div>
</div>
