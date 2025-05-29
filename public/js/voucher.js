$(document).ready(function () {
    // CSRF Token cho mọi AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Xem chi tiết voucher
    $('.viewBtn').on('click', function () {
        const id = $(this).data('id');
        $.get(`/vouchers/${id}`, function (v) {
            $('#viewModal .modal-body').html(`
                <p><strong>Mã:</strong> ${v.code}</p>
                <p><strong>Giảm giá:</strong> ${v.discount}%</p>
                <p><strong>Bắt đầu:</strong> ${v.start_date}</p>
                <p><strong>Kết thúc:</strong> ${v.end_date}</p>
            `);
            new bootstrap.Modal('#viewModal').show();
        }).fail(() => {
            Swal.fire('Lỗi', 'Không thể tải dữ liệu voucher.', 'error');
        });
    });

    // Hiển thị form sửa
    $('.editBtn').on('click', function () {
        const id = $(this).data('id');
        $.get(`/vouchers/${id}`, function (v) {
            $('#editForm').attr('action', `/vouchers/${id}`);
            $('#editForm input[name=code]').val(v.code);
            $('#editForm input[name=discount]').val(v.discount);
            $('#editForm input[name=start_date]').val(v.start_date);
            $('#editForm input[name=end_date]').val(v.end_date);
            new bootstrap.Modal('#editModal').show();
        }).fail(() => {
            Swal.fire('Lỗi', 'Không thể tải dữ liệu voucher.', 'error');
        });
    });

    // Cập nhật voucher
    let editSubmitted = false;

    $('#editForm button[type=submit]').on('click', function () {
        editSubmitted = true;
    });

    $('#editForm').on('submit', function (e) {
        e.preventDefault();

        if (!editSubmitted) return;
        editSubmitted = false;

        const url = $(this).attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize() + '&_method=PUT',
            success: function () {
                $('#editModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Cập nhật thành công!',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => location.reload(), 1500);
            },
            error: function () {
                Swal.fire('Lỗi', 'Cập nhật voucher thất bại.', 'error');
            }
        });
    });

    // Xoá voucher
    $('.deleteBtn').on('click', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Bạn có chắc muốn xoá?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Xoá',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/vouchers/${id}`,
                    type: 'DELETE',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đã xoá!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        if (response.success) {
                            setTimeout(() => location.reload(), 1500);
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Lỗi', xhr.responseJSON?.message || 'Xóa voucher thất bại.', 'error');
                    }
                });
            }
        });
    });

    // Tạo Voucher
    let createSubmitted = false;

    $('#createForm button[type=submit]').on('click', function () {
        createSubmitted = true;
    });

    $('#createForm').on('submit', function (e) {
        e.preventDefault();

        if (!createSubmitted) return;
        createSubmitted = false;

        $.ajax({
            url: '/vouchers',
            type: 'POST',
            data: $(this).serialize(),
            success: function () {
                $('#createModal').modal('hide');
                $('#createForm')[0].reset();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Tạo voucher thành công!',
                    showConfirmButton: false,
                    timer: 2000
                });

                setTimeout(() => {
                    location.reload();
                }, 2000);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    let messages = Object.values(errors).map(e => `- ${e}`).join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi tạo voucher',
                        html: messages
                    });
                } else {
                    Swal.fire('Lỗi', 'Tạo voucher thất bại.', 'error');
                }
            }
        });
    });
});
