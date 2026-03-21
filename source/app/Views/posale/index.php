<?php ?>
<style>
    :root {
        --pos-bg: #F0F8FF; 
        --pos-navy: #011628; 
        --pos-header: #508ABA;      
        --pos-sky: #9CD1FC; 
        --pos-accent: #044377;      
        --pos-radius-xl: 3rem; 
        --pos-radius-lg: 1.5rem; 
        --pos-radius-md: 1rem;      
    }
    .pos-wrapper {
        background-color: var(--pos-bg); 
        height: calc(100vh - 60px); 
        margin: -1.5rem -2rem; 
        padding: 0.75rem 0.75rem 0.75rem;
        font-family: 'Inter', sans-serif; 
        overflow-y: auto; 
        overflow-x: hidden;
    }
    input[type=number]::-webkit-outer-spin-button, 
    input[type=number]::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

    /*Search Component */
    .search-container { 
        background: white; 
        border-radius: 1.2rem; 
        padding: 0.5rem 1rem; 
        display: flex; 
        gap: 0.75rem; 
        align-items: center; 
        margin-bottom: 0.75rem; 
        box-shadow: 0 4px 15px #b0dafd4d; 
    }
         
    .search-input-group { 
        position: relative; 
        flex-grow: 1; 
    }
    .search-input { 
        width: 100%; 
        height: 42px; 
        background: #F8FAFC; 
        border: 1px solid #e2e8f0; 
        border-radius: 100px; 
        padding-left: 2.8rem; 
        font-size: 0.95rem; 
        font-weight: 500; 
        color: var(--pos-navy); 
        transition: all 0.2s ease; 
        outline: none; 
    }
    .search-input:focus { 
        background: white; 
        border-color: var(--pos-header); 
        box-shadow: 0 0 0 3px #508aba1a; 
    }
    .search-icon { 
        position: absolute; 
        left: 1rem; 
        top: 50%; 
        transform: translateY(-50%); 
        color: #94a3b8; 
        pointer-events: none; 
    }
    .btn-barcode { 
        width: 42px; 
        height: 42px; 
        border-radius: 50%; 
        background: var(--pos-navy); 
        border: none; 
        outline: none; 
        color: white; 
        font-size: 1rem; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        transition: transform 0.1s; 
    }
    .btn-barcode:active { 
        transform: scale(0.95); 
    }
    #search_results { 
        position: absolute; 
        top: 100%; 
        left: 0; 
        right: 0; 
        background: white; 
        border-radius: 1rem; 
        margin-top: 5px; 
        box-shadow: 0 10px 25px #0000001a; 
        z-index: 1000; 
        display: none; 
        overflow: hidden; 
        border: 1px solid #e2e8f0; }
    .search-item { 
        padding: 10px 15px; 
        display: flex; 
        align-items: center; 
        gap: 12px; 
        transition: 0.2s; 
        border-bottom: 1px solid #f1f5f9; 
    }
    .search-item:hover { 
        background: #f8fafc; 
    }
    .search-item img { 
        width: 40px; 
        height: 40px; 
        border-radius: 8px; 
        object-fit: cover; 
    }
    .search-item-info { 
        display: flex; 
        flex-direction: column; 
    }
    .search-item-name { 
        font-weight: 700; 
        color: var(--pos-navy); 
        font-size: 0.9rem; 
    }
    .search-item-barcode { 
        font-size: 0.75rem; 
        color: #94a3b8; 
    }
    /*Cart Component */
    .cart-island { 
        background: white; 
        border-radius: 1.5rem; 
        box-shadow: 0 10px 30px -5px #b0dafd80; 
        height: calc(100% - 70px); 
        display: flex; 
        flex-direction: column; 
        overflow: hidden; 
    }
    .cart-header {
        background: #F8FAFC; 
        padding: 0.75rem 1rem; 
        display: grid; 
        grid-template-columns: 3fr 1.5fr 1.5fr 0.5fr; 
        font-weight: 700; 
        color: #64748b; 
        border-bottom: 1px solid #eff6ff; 
    }
    .cart-body { 
        overflow-y: auto; 
        flex-grow: 1; 
        padding: 0 1rem; 
        position: relative; 
    } 
    .cart-item { 
        display: grid; 
        grid-template-columns: 3fr 1.5fr 1.5fr 0.5fr; 
        align-items: center; 
        padding: 0.5rem 1rem; 
        border-bottom: 1px dashed #e2e8f0; 
    }
    .qty-control { 
        display: flex; 
        align-items: center; 
        gap: 4px; 
        background: #f1f5f9; 
        padding: 4px; 
        border-radius: 12px; 
        width: fit-content; 
    }
    .btn-qty { 
        width: 24px; 
        height: 24px; 
        background: white; 
        border: none; 
        border-radius: 4px; 
        font-weight: 700; 
    }
    #empty_cart_msg { 
        height: 100%; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        color: #94a3b8; 
    }
    /*Customer Component */
    .cust-card { 
        background: white; 
        border-radius: 2rem; 
        padding: 1.25rem;
        box-shadow: 0 10px 30px -5px #b0dafd66; 
        position: relative; 
    }
    .form-input-soft { 
        width: 100%; 
        padding: 8px 8px 8px 2.2rem; 
        background: #F8FAFC; 
        border: 1px solid transparent; 
        border-radius: 1rem; 
        margin-bottom: 0.5rem; 
        outline: none; 
    }
    .form-input-soft:focus { 
        background: white; 
        border-color: var(--pos-header); 
    }
    .badge-cust { 
        position: absolute; 
        right: 12px; top: 12px; 
        font-size: 0.65rem; 
        padding: 3px 8px; 
        border-radius: 10px; 
        color: white; 
        display: none; 
        z-index: 5; 
        font-weight: bold; 
    }
    .badge-new { 
        background-color: #ea580c; 
    } .badge-old { 
        background-color: #16a34a; 
    }

    /*Payment Component */
    .pay-card { 
        background-color: var(--pos-navy); 
        border-radius: 2rem; 
        padding: 1.25rem; 
        flex-grow: 1; 
        color: white; 
        display: flex; 
        flex-direction: column; 
        gap: 8px; 
        min-height: 280px; 
    }
    .total-amount { 
        font-size: 2.25rem; 
        font-weight: 800; 
        color: var(--pos-sky); 
        line-height: 1.1; 
    }
    .btn-finish { 
        width: 100%; 
        background-color: var(--pos-sky); 
        color: var(--pos-navy); 
        font-weight: 800; 
        padding: 1rem; 
        border-radius: 1.25rem; 
        border: none; 
        margin-top: auto; 
    }
    .btn-finish:disabled { 
        background-color: #475569; 
        color: #94a3b8; 
    }
    .btn-view-detail {
        background-color: var(--pos-accent) !important;
        border-color: var(--pos-accent) !important;
        color: #ffffff !important;
        font-weight: 600;
        padding: 0.4rem 1rem;
        border-radius: 0.75rem;
        transition: all 0.2s ease-in-out;
    }

    #orderDetailModal .modal-header {
        background-color: var(--pos-accent) !important;
        border-bottom: none;
    }
    #orderDetailModal .modal-title {
        color: #ffffff !important;
        font-weight: 700;
    }
    #detail_order_id {
        color: var(--pos-sky) !important; 
    }
    #hist_cust_name {
        color: var(--pos-sky) !important;
        font-weight: 700;
    }
    /* Modals & Overlays */
    .overlay-receipt { 
        position: fixed; 
        top: 0; left: 0; 
        width: 100%; 
        height: 100%; 
        background: #011628d9; 
        display: none; 
        align-items: center; 
        justify-content: center; 
        z-index: 9999; 
    }
    .receipt-paper { 
        background: white; 
        width: 360px; 
        border-radius: 12px; 
        padding: 2rem; 
        text-align: center; 
        color: var(--pos-navy); 
    }
    .modal-content { 
        border-radius: 1.5rem; 
        border: none; 
        overflow: hidden; 
        box-shadow: 0 25px 50px -12px #00000040; 
    }
    .btn-close-white { filter: invert(1) grayscale(100%) brightness(200%); }
</style>
<div class="pos-wrapper">
    <div class="row h-100 g-3">
        <div class="col-md-8 h-100 d-flex flex-column">
            
            <div class="search-container">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="product_search" class="search-input" placeholder="Tìm tên sản phẩm hoặc quét mã vạch..." autocomplete="off">
                    <div id="search_results"></div> 
                </div>
                <button class="btn-barcode" title="Quét mã vạch"><i class="fas fa-barcode"></i></button>
            </div>

            <div class="cart-island">
                <div class="cart-header">
                    <span>Sản phẩm</span><span class="text-center">Số lượng</span><span class="text-end">Thành tiền</span><span></span>
                </div>
                <div class="cart-body" id="cart_body">
                    <div id="empty_cart_msg">
                        <i class="fas fa-shopping-basket fa-3x mb-3 opacity-25"></i>
                        <h5 class="fw-bold opacity-50">Giỏ hàng trống</h5>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4 d-flex flex-column gap-3">
            
            <div class="cust-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold m-0">Khách hàng</h5>
                    <button class="btn btn-sm btn-light btn-history" id="btn_view_history" style="display:none; color: #0284c7; background: #e0f2fe;"><i class="fas fa-history me-1"></i> Lịch sử</button>
                </div>
                <div class="position-relative mb-2">
                    <i class="fas fa-phone-alt position-absolute" style="left:12px; top:12px; color:#94a3b8"></i>
                    <input type="text" id="cust_phone" class="form-input-soft mb-0" placeholder="Số điện thoại..." maxlength="10">
                    <span id="cust_badge" class="badge-cust"></span>
                </div>
                <div class="position-relative mb-2">
                    <i class="fas fa-user position-absolute" style="left:12px; top:12px; color:#94a3b8"></i>
                    <input type="text" id="cust_name" class="form-input-soft mb-0" placeholder="Tên khách hàng">
                </div>
                <div class="position-relative">
                    <i class="fas fa-map-marker-alt position-absolute" style="left:12px; top:12px; color:#94a3b8"></i>
                    <input type="text" id="cust_address" class="form-input-soft mb-0" placeholder="Địa chỉ">
                </div>
            </div>

            <div class="pay-card">
                <span class="small text-white-50">TỔNG THANH TOÁN</span>
                <div class="total-amount" id="display_total">0</div>
                <div class="bg-white bg-opacity-10 p-3 rounded-4">
                    <span class="small text-white-50">TIỀN KHÁCH ĐƯA</span>
                    <input type="number" id="cash_given" class="cash-input bg-transparent border-0 text-white w-100 fs-2 fw-bold text-end outline-none" placeholder="0" style="outline:none">
                </div>
                <div class="d-flex justify-content-between align-items-center p-2">
                    <span class="small text-white-50">TIỀN THỪA</span>
                    <span class="fs-4 fw-bold" id="display_change">0</span>
                </div>
                <button id="btn_finish" class="btn-finish" disabled>HOÀN TẤT</button>
            </div>

        </div>
    </div>
</div>

<div class="overlay-receipt" id="success_overlay">
    <div class="receipt-paper">
        <div class="text-success fs-1 mb-2"><i class="fas fa-check-circle"></i></div>
        <h3 class="fw-bold">Thành công</h3>
        <p class="text-muted">Đơn hàng <span id="receipt_id">#00</span></p>
        <div class="fs-1 fw-bold my-3" id="receipt_amount">0</div>
        <div class="d-grid gap-2">
            <button class="btn btn-dark py-3 fw-bold" id="btn_print">IN HÓA ĐƠN</button>
            <button class="btn btn-outline-secondary py-2" onclick="resetPOS()">ĐƠN MỚI</button>
        </div>
    </div>
</div>

<div class="modal fade" id="historyModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: var(--pos-navy); color: white;">
                <h5 class="modal-title mb-0">Lịch sử mua hàng: <span id="hist_cust_name" class="fw-bold text-info"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã HĐ</th><th>Ngày mua</th><th class="text-end">Tổng tiền</th>
                                <th class="text-end">Tiền khách đưa</th><th class="text-end">Tiền thừa</th>
                                <th class="text-center">Số SP</th><th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="history_table_body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="orderDetailModal" tabindex="-1" style="z-index: 1060;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title mb-0">Chi tiết đơn hàng <span id="detail_order_id" class="fw-bold text-warning"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr><th>Sản phẩm</th><th class="text-end">Giá bán</th><th class="text-center">Số lượng</th><th class="text-end">Thành tiền</th></tr>
                        </thead>
                        <tbody id="detail_table_body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= APP_URL ?>";
    let cart = [];
    let currentInvoiceUrl = '';
    let currentCustomerId = null;

    /* Quản lý giỏ hàng*/
    function renderCart() {
        const tbody = $('#cart_body'); tbody.empty();
        let total = 0;
        if (cart.length === 0) {
            tbody.html(`<div id="empty_cart_msg"><i class="fas fa-shopping-basket fa-3x mb-3 opacity-25"></i><h5 class="fw-bold opacity-50">Giỏ hàng trống</h5></div>`);
            $('#btn_finish').prop('disabled', true);
        } else {
            $('#btn_finish').prop('disabled', false);
            cart.forEach((item, index) => {
                const lineTotal = item.sale_price * item.quantity; total += lineTotal;
                tbody.append(`
                <div class="cart-item">
                    <div><span class="fw-bold d-block">${item.name}</span><small class="text-muted">${item.barcode}</small></div>
                    <div class="qty-control mx-auto">
                        <button class="btn-qty" onclick="updateQty(${index}, -1)">-</button>
                        <span class="px-2 fw-bold">${item.quantity}</span>
                        <button class="btn-qty" onclick="updateQty(${index}, 1)">+</button>
                    </div>
                    <div class="text-end fw-bold">${Number(lineTotal).toLocaleString('vi-VN')}</div>
                    <div class="text-end"><i class="fas fa-times text-danger" style="cursor:pointer;" onclick="removeProduct(${index})"></i></div>
                </div>`);
            });
        }
        $('#display_total').text(total.toLocaleString('vi-VN'));
        calculateChange();
    }

    function addToCart(product) {
        const existing = cart.find(p => p.id === product.id);
        if (existing) { existing.quantity++; } else { cart.push({ ...product, quantity: 1 }); }
        renderCart();
    }

    function updateQty(index, change) {
        if (cart[index].quantity + change <= 0) { cart.splice(index, 1); } else { cart[index].quantity += change; }
        renderCart();
    }

    function removeProduct(index) { cart.splice(index, 1); renderCart(); }

    /* --- ĐÃ ĐIỀU CHỈNH: Tìm kiếm sản phẩm & khách hàng --- */
    let searchTimeout = null;
    $('#product_search').on('input', function() {
        let query = $(this).val();
        clearTimeout(searchTimeout);
        if (query.length < 2) { $('#search_results').hide(); return; }

        searchTimeout = setTimeout(() => {
            $.get(BASE_URL + '/posale/search-product', { q: query }, function(data) {
                if (data && data.length > 0) {
                    let html = '';
                    data.forEach(p => {
                        html += `
                        <div class="search-item" style="cursor:pointer;" onclick='handleSelect(${JSON.stringify(p)})'>
                            <div class="search-item-info">
                                <span class="search-item-name">${p.name}</span>
                                <span class="search-item-barcode">${p.barcode} - ${Number(p.sale_price).toLocaleString('vi-VN')}đ</span>
                            </div>
                        </div>`;
                    });
                    $('#search_results').html(html).show();
                } else {
                    $('#search_results').hide();
                }
            }, 'json');
        }, 300);
    });

    window.handleSelect = function(product) {
        addToCart(product); $('#product_search').val('').focus(); $('#search_results').hide();
    };

    $(document).click(function(e) {
        if (!$(e.target).closest('.search-input-group').length) { $('#search_results').hide(); }
    });

    let customerTimeout = null;
    $('#cust_phone').on('input', function() {
        const phone = $(this).val().trim();
        if (phone.length === 0) {
            $('#cust_name').val('').prop('readonly', false);
            $('#cust_address').val(''); $('#cust_badge').hide(); $('#btn_view_history').hide();
            return;
        }
        if (phone.length >= 10) {
            clearTimeout(customerTimeout);
            customerTimeout = setTimeout(() => {
                $.get(BASE_URL + '/posale/search-customer', { phone: phone }, function(res) {
                    if(res.success && res.customer) {
                        $('#cust_name').val(res.customer.name || res.customer.fullname).prop('readonly', true);
                        $('#cust_address').val(res.customer.address);
                        $('#cust_badge').text('KHÁCH QUEN').removeClass('badge-new').addClass('badge-old').show();
                        currentCustomerId = res.customer.id;
                        $('#btn_view_history').fadeIn();
                    } else {
                        $('#cust_name').val('').prop('readonly', false);
                        $('#cust_address').val('');
                        $('#cust_badge').text('KHÁCH MỚI').removeClass('badge-old').addClass('badge-new').show();
                        currentCustomerId = null;
                        $('#btn_view_history').hide();
                    }
                }, 'json');
            }, 300);
        }
    });

    /*Lịch sử khách hàng */
    $('#btn_view_history').click(function() {
        if(!currentCustomerId) return;
        $.get(BASE_URL + '/customers/details', { id: currentCustomerId }, function(res) {
            if(res.success) {
                $('#hist_cust_name').text(res.customer.name + ' - ' + res.customer.phone);
                const tbody = $('#history_table_body'); tbody.empty();
                
                if(res.history.length === 0) {
                    tbody.html('<tr><td colspan="7" class="text-center text-muted py-4">Khách hàng chưa có lịch sử mua hàng.</td></tr>');
                } else {
                    res.history.forEach(order => {
                        tbody.append(`
                        <tr>
                            <td class="fw-bold">#${order.id}</td>
                            <td>${order.created_at}</td>
                            <td class="text-danger fw-bold text-end">${Number(order.total_amount).toLocaleString('vi-VN')} đ</td>
                            <td class="text-end">${Number(order.amount_paid).toLocaleString('vi-VN')} đ</td>
                            <td class="text-end">${Number(order.change_amount).toLocaleString('vi-VN')} đ</td>
                            <td class="text-center"><span class="badge bg-secondary">${order.items_count}</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary btn-view-detail" data-id="${order.id}">Xem chi tiết</button>
                            </td>
                        </tr>`);
                    });
                }
                $('#historyModal').modal('show');
            } else { alert("Lỗi tải dữ liệu lịch sử!"); }
        }, 'json').fail(function() {
            $.get(BASE_URL + '/customers/order-details', { 
                order_id: currentCustomerId }, function(res) {
                if(res.success) {
                   $('#historyModal').modal('show');
                }
            }, 'json');
        });
    });

    $(document).on('click', '.btn-view-detail', function() {
        const orderId = $(this).data('id');
        $.get(BASE_URL + '/customers/order-details', { order_id: orderId }, function(res) {
            if(res.success) {
                $('#detail_order_id').text('#' + res.order.id);
                const tbody = $('#detail_table_body'); tbody.empty();
                
                res.items.forEach(item => {
                    tbody.append(`
                    <tr>
                        <td class="fw-bold">${item.product_name}</td>
                        <td class="text-end">${Number(item.unit_price).toLocaleString('vi-VN')} đ</td>
                        <td class="text-center">${item.quantity}</td>
                        <td class="fw-bold text-danger text-end">${Number(item.total_price).toLocaleString('vi-VN')} đ</td>
                    </tr>`);
                });
                
                $('#historyModal').modal('hide');
                $('#orderDetailModal').modal('show');
            } else { 
                alert("Không thể tải chi tiết đơn hàng!"); 
            }
        }, 'json').fail(function() {
             $.get(BASE_URL + '/customers/get-order-details', { order_id: orderId }, function(res) {
                $('#historyModal').modal('hide');
                $('#orderDetailModal').modal('show');
             }, 'json');
        });
    });

    /*Thanh toán và in ấn*/
    function calculateChange() {
        const total = parseInt($('#display_total').text().replace(/\./g, '')) || 0;
        const given = parseInt($('#cash_given').val()) || 0;
        const change = given - total;
        $('#display_change').text(change >= 0 ? change.toLocaleString('vi-VN') : '0');
    }
    $('#cash_given').on('input', calculateChange);

    $('#btn_finish').click(function() {
        const payload = {
            cart: cart,
            customer: { phone: $('#cust_phone').val(), name: $('#cust_name').val(), address: $('#cust_address').val() },
            amount_paid: $('#cash_given').val()
        };
        if(!payload.customer.phone) return alert("Nhập SĐT khách!");

        $.ajax({
            url: BASE_URL + '/posale/checkout', type: 'POST', data: JSON.stringify(payload), contentType: 'application/json',
            success: function(res) {
                if(res.success) {
                    $('#receipt_id').text('#' + res.invoice_url.split('=')[1]);
                    $('#receipt_amount').text($('#display_total').text());
                    currentInvoiceUrl = BASE_URL + res.invoice_url;
                    $('#success_overlay').css('display', 'flex');
                } else { alert(res.message || "Có lỗi xảy ra"); }
            }
        });
    });

    $('#btn_print').click(function() { if(currentInvoiceUrl) window.open(currentInvoiceUrl, '_blank'); });
    
    window.resetPOS = function() { 
        cart = []; renderCart(); 
        $('#cust_phone, #cust_name, #cust_address, #cash_given').val(''); 
        $('#cust_badge').hide(); $('#success_overlay').hide(); currentCustomerId = null; $('#btn_view_history').hide();
    };
</script>