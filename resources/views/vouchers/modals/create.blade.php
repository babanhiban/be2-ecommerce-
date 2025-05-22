<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="createForm" class="modal-content" method="POST" action="{{ route('vouchers.store') }}">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tạo voucher</h5>
      </div>
      <div class="modal-body">
        @include('vouchers.partials.form')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
        <button type="submit" class="btn btn-primary">Tạo</button>
      </div>
    </form>
  </div>
</div>
