$(document).ready(function () {
    // Thiết lập CSRF token cho mọi request AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ===== SỬA =====
    $('.editBtn').on('click', function () {
        const id = $(this).data('id');
        $.get(`/orders/${id}`, function (res) {
            $('#editForm').attr('action', `/orders/${id}`);
            $('#editForm input[name=customer_name]').val(res.customer_name);
            $('#editForm input[name=phone]').val(res.phone);
            $('#editForm textarea[name=address]').val(res.address);
            $('#editForm select[name=status]').val(res.status);
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        }).fail(() => alert('Không thể tải dữ liệu đơn hàng.'));
    });

    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        const url = $(this).attr('action');
        $.ajax({
            url,
            method: 'PUT',
            data: $(this).serialize(),
            success: function () {
                location.reload();
            },
            error: function () {
                alert('Cập nhật đơn hàng thất bại.');
            }
        });
    });

    // ===== XEM =====
    $('.viewBtn').on('click', function () {
    const id = $(this).data('id');
    $.get(`/orders/${id}`, function (res) {
        $('#view-customer-name').text(res.customer_name);
        $('#view-phone').text(res.phone);
        $('#view-address').text(res.address);
        $('#view-status').text(res.status);
        $('#view-total').text(res.total_price.toLocaleString('vi-VN') + 'đ');

        // Render sản phẩm ra bảng
        const tbody = $('#view-product-list');
        tbody.empty();
        if (res.products && res.products.length > 0) {
            res.products.forEach(product => {
                tbody.append(`<tr><td>${product.name}</td><td>${product.quantity}</td></tr>`);
            });
        } else {
            tbody.append('<tr><td colspan="2">Không có sản phẩm</td></tr>');
        }

        const modal = new bootstrap.Modal(document.getElementById('viewModal'));
        modal.show();
    }).fail(() => alert('Không thể tải dữ liệu.'));
});


    // ===== XOÁ =====
    $('.deleteBtn').on('click', function () {
        const id = $(this).data('id');
        if (confirm('Bạn có chắc muốn xoá đơn hàng này không?')) {
            $.ajax({
                url: `/orders/${id}`,
                method: 'DELETE',
                success: function () {
                    alert('Đã xoá thành công.');
                    location.reload();
                },
                error: function () {
                    alert('Xoá thất bại.');
                }
            });
        }
    });
});
