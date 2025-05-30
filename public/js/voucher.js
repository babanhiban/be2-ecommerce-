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
      localStorage.removeItem('voucher_updated_' + id);
    $.get(`/vouchers/${id}`, function (v) {
        $('#editForm').attr('action', `/vouchers/${id}`);
        $('#editForm input[name="id"]').val(id);
        $('#editForm input[name=code]').val(v.code);
        $('#editForm input[name=discount]').val(v.discount);
        $('#editForm input[name=start_date]').val(v.start_date);
        $('#editForm input[name=end_date]').val(v.end_date);

        // Thêm dòng này để hiện modal
        new bootstrap.Modal(document.getElementById('editModal')).show();

    }).fail((xhr) => {
        if (xhr.status === 404) {
            Swal.fire('Không tìm thấy', 'Voucher không tồn tại.', 'error');
        } else if (xhr.status === 400) {
            Swal.fire('Lỗi', 'ID không hợp lệ.', 'error');
        } else {
            Swal.fire('Lỗi', 'Không thể tải dữ liệu voucher.', 'error');
        }
    });
});


    // Cập nhật voucher
let editSubmitted = false;
let originalData = null; // Lưu dữ liệu gốc khi mở modal

// Khi mở modal edit, lưu lại dữ liệu ban đầu
$('#editModal').on('show.bs.modal', function () {
    const form = $(this).find('form')[0];
    originalData = $(form).serialize();
});

$('#editForm button[type=submit]').on('click', function () {
    editSubmitted = true;
});

$('#editForm').on('submit', function (e) {
    e.preventDefault();

    if (!editSubmitted) return;
    editSubmitted = false;

    const form = this;
    const currentData = $(form).serialize();

    // So sánh dữ liệu có thay đổi không
    if (currentData === originalData) {
        Swal.fire({
            icon: 'info',
            title: 'Không có thay đổi',
            text: 'Bạn chưa chỉnh sửa dữ liệu nào.',
            timer: 1500,
            showConfirmButton: false
        });
        return; // Dừng gửi ajax
    }

    const voucherId = $(form).find('input[name="id"]').val();

    // Kiểm tra dữ liệu đã thay đổi bên tab khác chưa
    if (localStorage.getItem('voucher_updated_' + voucherId) === 'true') {
        Swal.fire({
            icon: 'warning',
            title: 'Dữ liệu đã thay đổi',
            text: 'Vui lòng tải lại trang trước khi cập nhật.',
            confirmButtonText: 'Tải lại trang'
        }).then(() => location.reload());
        return; // Dừng không gửi ajax
    }

    const url = $(form).attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: currentData + '&_method=PUT',
        success: function () {
            $('#editModal').modal('hide');

            // Đánh dấu voucher đã được update, để tab khác biết
            localStorage.setItem('voucher_updated_' + voucherId, 'true');

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
    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get('page') || 1;

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
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    page: currentPage
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xoá!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        if (response.remainingOnPage === 0 && response.currentPage > 1) {
                            window.location.href = '/vouchers'; // chuyển về trang đầu
                        } else {
                            location.reload();
                        }
                    }, 1500);
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: xhr.responseJSON?.message || 'Xóa voucher thất bại.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => location.reload(), 2000);
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
