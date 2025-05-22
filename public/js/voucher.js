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
        }).fail(() => alert('Không thể tải dữ liệu voucher.'));
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
        }).fail(() => alert('Không thể tải dữ liệu voucher.'));
    });

    // Cập nhật voucher
   let editSubmitted = false;

// Khi người dùng bấm nút "Cập nhật"
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
            location.reload();
        },
        error: function () {
            alert('Cập nhật voucher thất bại.');
        }
    });
});


    // Xoá voucher
    $('.deleteBtn').on('click', function () {
        const id = $(this).data('id');
        if (confirm('Bạn có chắc chắn muốn xoá?')) {
            $.ajax({
                url: `/vouchers/${id}`,
                type: 'DELETE',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert('Xoá voucher thất bại.');
                }
            });
        }
    });
    // Tạo Voucher
 let createSubmitted = false;

// Khi người dùng bấm nút "Tạo"
$('#createForm button[type=submit]').on('click', function () {
    createSubmitted = true;
});

$('#createForm').on('submit', function (e) {
    e.preventDefault();

    // Nếu không bấm nút "Tạo" thì thoát
    if (!createSubmitted) return;
    createSubmitted = false;

    $.post('/vouchers', $(this).serialize())
        .done(function () {
            $('#createModal').modal('hide');
            $('#createForm')[0].reset(); // reset form
            const toast = new bootstrap.Toast(document.getElementById('successToast'));
            toast.show();
        })
        .fail(function () {
            alert('Tạo voucher thất bại.');
        });
});


});
