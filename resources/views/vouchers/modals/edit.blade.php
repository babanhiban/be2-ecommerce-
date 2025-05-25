<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editForm" class="modal-content" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Sửa Voucher</h5>
      </div>
      <div class="modal-body">
        @include('vouchers.partials.form')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </div>
    </form>
  </div>
</div>
