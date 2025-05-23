<div class="mb-2">
    <label class="form-label">Mã Voucher</label>
    <input name="code" class="form-control" value="{{ old('code') }}">
    @error('code')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-2">
    <label class="form-label">Giảm giá (%)</label>
    <input name="discount" type="number" class="form-control" value="{{ old('discount') }}">
    @error('discount')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-2">
    <label class="form-label">Ngày bắt đầu</label>
    <input name="start_date" type="date" class="form-control" value="{{ old('start_date') }}">
    @error('start_date')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-2">
    <label class="form-label">Ngày kết thúc</label>
    <input name="end_date" type="date" class="form-control" value="{{ old('end_date') }}">
    @error('end_date')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
