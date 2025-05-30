$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const categorySelect = $('#category-select');
    const productSelect = $('#product-select');
    const priceInput = $('#product-price');
    const quantityInput = $('#quantity');
    const totalInput = $('#total');
    const finalTotalInput = $('#final-total');
    const voucherCodeInput = $('#voucher-code');
    const applyVoucherBtn = $('#apply-voucher');
    const voucherInfo = $('#voucher-discount-info');
    const hiddenVoucherId = $('#hidden-voucher-id');

    let discountAmount = 0;

    $.get('/api/categories', function (data) {
        data.forEach(category => {
            categorySelect.append(`<option value="${category.id}">${category.name}</option>`);
        });
    });

    categorySelect.on('change', function () {
        const categoryId = $(this).val();
        if (!categoryId) return;

        $.get(`/api/categories/${categoryId}/products`, function (data) {
            productSelect.html('<option value="">-- Chọn sản phẩm --</option>');
            data.forEach(product => {
                productSelect.append(`<option value="${product.id}" data-price="${product.price}">${product.name}</option>`);
            });

            priceInput.val('');
            totalInput.val('');
            finalTotalInput.val('');
            discountAmount = 0;
            voucherInfo.text('');
        });
    });

    productSelect.on('change', function () {
        const selectedOption = $(this).find('option:selected');
        const price = selectedOption.data('price') || 0;
        priceInput.val(price);
        discountAmount = 0;
        voucherInfo.text('');
        updateTotal();
    });

    quantityInput.on('input', updateTotal);

    applyVoucherBtn.on('click', function () {
        const code = voucherCodeInput.val().trim();
        const total = parseFloat(totalInput.val().replace(/\./g, '').replace(',', '.') || 0);
        if (!code || total <= 0) return;

        $.get(`/vouchers/check/${code}`)
            .done(function (voucher) {
                const now = new Date().toISOString().slice(0, 10);
                if (voucher.end_date < now) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Voucher đã hết hạn',
                    });
                    throw new Error("Voucher đã hết hạn");
                }

                discountAmount = Math.round((voucher.discount / 100) * total);
                voucherInfo.text(`Áp dụng mã "${voucher.code}" - Giảm ${discountAmount.toLocaleString('vi-VN')}đ`);
                hiddenVoucherId.val(voucher.id);
                updateTotal();
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: `Áp dụng voucher "${voucher.code}" thành công!`,
                });
            })
            .fail(function () {
                discountAmount = 0;
                hiddenVoucherId.val('');
                voucherInfo.text('');
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mã không hợp lệ hoặc đã hết hạn',
                });
                updateTotal();
            });
    });

    function updateTotal() {
        const price = parseFloat(priceInput.val() || 0);
        const qty = parseInt(quantityInput.val() || 0);
        const total = price * qty;
        totalInput.val(total > 0 ? total.toLocaleString('vi-VN') : '');
        finalTotalInput.val(total > 0 ? Math.max(total - discountAmount, 0).toLocaleString('vi-VN') : '');
    }

    $('#createForm').on('submit', function (e) {
        e.preventDefault();

        const data = {
            customer_name: $('input[name=customer_name]').val(),
            phone: $('input[name=phone]').val(),
            address: $('textarea[name=address]').val(),
            status: 'Đang xử lý',
            product_id: productSelect.val(),
            quantity: quantityInput.val(),
            voucher_id: hiddenVoucherId.val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        if (!data.product_id || !data.quantity) {
            Swal.fire({
                icon: 'warning',
                title: 'Chú ý',
                text: 'Vui lòng chọn sản phẩm và nhập số lượng',
            });
            return;
        }

        $.post('/orders', data)
            .done(function () {
                $('#createModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Tạo đơn hàng thành công!',
                }).then(() => {
                    location.reload();
                });
            })
            .fail(function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Tạo đơn hàng thất bại.',
                });
                console.error(xhr.responseText);
            });
    });

    $('.editBtn').on('click', function () {
        const id = $(this).data('id');

        $.get(`/orders/${id}`, function (res) {
            $('#editForm').attr('action', `/orders/${id}`);
            $('#edit_customer_name').val(res.customer_name);
            $('#edit_phone').val(res.phone);
            $('#edit_address').val(res.address);
            $('#edit_status').val((res.status || '').trim());

            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        }).fail(() => {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Không thể tải dữ liệu đơn hàng.',
            });
        });
    });

    $('#editForm').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const actionUrl = form.attr('action');
        const formData = form.serialize();

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            success: function () {
                $('#editModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Cập nhật đơn hàng thành công!',
                }).then(() => {
                    location.reload();
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Cập nhật đơn hàng thất bại.',
                });
                console.error(xhr.responseText);
            }
        });
    });

    $('.viewBtn').on('click', function () {
        const id = $(this).data('id');
        $.get(`/orders/${id}`, function (res) {
            $('#view-customer-name').text(res.customer_name);
            $('#view-phone').text(res.phone);
            $('#view-address').text(res.address);
            $('#view-status').text(res.status);
            $('#view-total').text(res.total_price.toLocaleString('vi-VN') + 'đ');

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
        }).fail(() => {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Không thể tải dữ liệu.',
            });
        });
    });

    $('.deleteBtn').on('click', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Bạn có chắc muốn xoá đơn hàng này không?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xoá đi',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/orders/${id}`,
                    method: 'DELETE',
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đã xoá thành công.',
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Xoá thất bại.',
                        });
                    }
                });
            }
        });
    });
});
