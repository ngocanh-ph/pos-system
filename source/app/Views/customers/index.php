<?php ?>
<style>
    :root {
        --c-bg: #F0F8FF; 
        --c-navy: #011628; 
        --c-sky: #9CD1FC; 
        --c-blue: #044377; 
        --c-white: #FFFFFF;
        --c-radius-3xl: 2rem; 
        --c-radius-xl: 1.2rem; 
        --c-radius-lg: 0.8rem;
        --c-shadow-soft: 0 5px 20px -5px #b0dafd66;
        --c-shadow-hover: 0 10px 25px -5px #b0dafd99;
    }

    .cust-wrapper {
        background-color: var(--c-bg); 
        font-family: 'Inter', sans-serif; 
        color: var(--c-navy);
        padding: 1.5rem; 
        min-height: 85vh; 
        overflow-x: hidden;
        max-width: 1400px; 
        margin: 0 auto;
    }

    /* TYPOGRAPHY */
    .font-black { 
        font-weight: 800; 
    }
    .text-navy { 
        color: var(--c-navy); 
    }
    .label-caps { 
        font-size: 0.6rem; 
        font-weight: 700; 
        text-transform: uppercase; 
        letter-spacing: 0.05em; 
        color: #64748b; 
        margin-bottom: 0.1rem; 
        display: block; 
    }

    /* toolbar and searchbar */
    .cust-toolbar {
        background: var(--c-white);
        border-radius: 1.2rem; 
        padding: 0.5rem 1rem;
        display: flex; 
        align-items: center;
        box-shadow: var(--c-shadow-soft);
        margin-bottom: 1.5rem;
    }

    .search-box { 
        position: relative; 
        flex-grow: 1; 
    }

    .search-input {
        width: 100%; 
        background: #F8FAFC; 
        border: 1px solid #e2e8f0;
        border-radius: 100px; 
        padding: 0.6rem 1rem 0.6rem 2.8rem; 
        font-size: 0.9rem; font-weight: 500; color: var(--c-navy);
        transition: all 0.2s ease;
        outline: none;
    }
    .search-input:focus { 
        background: #ffffff;
        border-color: var(--c-blue);
        box-shadow: 0 0 0 2px rgba(4, 67, 119, 0.1);
    }

    .search-icon {
        position: absolute; 
        left: 1rem; 
        top: 50%; 
        transform: translateY(-50%);
        color: #94a3b8; 
        font-size: 0.9rem; 
        pointer-events: none;
    }
    .cust-grid {
        display: grid; 
        gap: 1rem;
        grid-template-columns: 1fr; 
    }
    @media (min-width: 768px) { 
        .cust-grid { 
            grid-template-columns: repeat(2, 1fr); 
        } 
    }
    @media (min-width: 1024px) { 
        .cust-grid { 
            grid-template-columns: repeat(3, 1fr); 
        } 
    }
    
    .cust-card {
        background: var(--c-white); 
        border-radius: 1.2rem;
        padding: 1rem; 
        box-shadow: var(--c-shadow-soft);
        transition: all 0.2s ease-out; 
        border: 1px solid transparent;
        position: relative; 
        overflow: hidden;
        display: flex; 
        flex-direction: column; 
        gap: 0.5rem;
    }
    .cust-card:hover { 
        transform: translateY(-3px); 
        box-shadow: var(--c-shadow-hover); 
        border-color: var(--c-sky); 
    }

    .card-header-flex { 
        display: flex; 
        align-items: center; 
        gap: 0.8rem; 
        margin-bottom: 0.2rem; 
    }
    
    .icon-box {
        width: 42px; 
        height: 42px;
        border-radius: 0.8rem; 
        background: #e0f2fe; 
        color: var(--c-blue);
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 1.1rem; 
        flex-shrink: 0;
    }
    
    .info-island {
        background: #F8FAFC; 
        border-radius: 0.6rem;
        padding: 0.5rem 0.8rem; 
        display: flex; 
        align-items: center; 
        gap: 8px;
        font-size: 0.8rem; 
        font-weight: 600; 
        color: #475569;
    }
    .info-island i { 
        color: #94a3b8; 
        font-size: 0.8rem; 
    }

    .stat-badge {
        position: absolute; 
        top: 1rem; 
        right: 1rem;
        background: var(--c-blue); 
        color: white;
        padding: 3px 8px; 
        border-radius: 0.5rem;
        font-size: 0.65rem; 
        font-weight: 700;
    }

    /* detail view */
    #detailView { 
        display: none; 
    }
    .dashboard-grid { 
        display: grid; 
        grid-template-columns: 320px 1fr; 
        gap: 1.5rem; 
    }
    @media (max-width: 992px) { 
        .dashboard-grid { 
            grid-template-columns: 1fr; 
        } 
    }

    /* Left Col */
    .profile-card { 
        background: var(--c-white); 
        border-radius: 1.5rem; 
        padding: 1.5rem; 
        text-align: center; 
        margin-bottom: 1.5rem; 
        box-shadow: var(--c-shadow-soft); 
    }
    .finance-card { 
        background: var(--c-navy); 
        color: white; 
        border-radius: 1.5rem; 
        padding: 1.5rem; 
        box-shadow: 0 10px 25px -5px #01162866; 
    }
    .big-money { 
        font-size: 2.2rem; 
        line-height: 1; 
        margin: 0.5rem 0; 
        color: var(--c-sky); 
        letter-spacing: -0.02em; 
    }
    .sub-stat-row { 
        display: flex; 
        justify-content: space-around; 
        margin-top: 1.5rem; 
        padding-top: 1.5rem; 
        border-top: 1px solid #ffffff1a; 
    }

    /* Right Col */
    .history-card { 
        background: var(--c-white); 
        border-radius: 1.5rem; 
        padding: 1.5rem; 
        min-height: 500px; 
        box-shadow: var(--c-shadow-soft); 
    }
    .history-table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0 0.5rem; 
    }
    .history-table th { 
        font-size: 0.7rem; 
        font-weight: 800; 
        text-transform: uppercase; 
        color: #94a3b8; 
        padding: 0 1rem; 
        text-align: left; 
    }
    .history-table td { 
        background: #F8FAFC; 
        padding: 0.8rem 1rem; 
        font-weight: 600; 
        color: var(--c-navy); 
        font-size: 0.9rem; 
        transition: 0.2s; 
    }
    .history-table td:first-child { 
        border-top-left-radius: 0.8rem; 
        border-bottom-left-radius: 0.8rem; 
    }
    .history-table td:last-child { 
        border-top-right-radius: 0.8rem; 
        border-bottom-right-radius: 0.8rem; 
        text-align: right; 
    }
    .history-table tr:hover td { 
        background: #e0f2fe; 
    }

    .btn-detail { 
        background: var(--c-navy); 
        color: white; 
        border: none; 
        padding: 0.4rem 1rem; 
        border-radius: 0.6rem; 
        font-weight: 700; 
        font-size: 0.75rem; 
    }
    .btn-detail:hover { 
        background: #1e293b; 
    }
    .btn-back { 
        background: transparent; 
        color: var(--c-navy); 
        border: 2px solid #e2e8f0; 
        padding: 0.6rem 1.2rem; 
        border-radius: 0.8rem; 
        font-weight: 700; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        margin-bottom: 1.5rem;  
        transition: 0.2s; 
        font-size: 0.85rem; 
    }
    .btn-back:hover { 
        background: white; 
        border-color: var(--c-navy); 
        transform: translateX(-3px); 
    }

    /* MODAL */
    .modal-receipt .modal-content { 
        border-radius: 1.5rem; 
        border: none; 
        overflow: hidden; 
    }
    .receipt-header { 
        background: #F8FAFC; 
        padding: 1.5rem; 
        text-align: center; 
        border-bottom: 2px dashed #cbd5e1; 
    }
    .receipt-body { 
        padding: 1.5rem; 
        max-height: 60vh; 
        overflow-y: auto; 
    }
    .receipt-footer { 
        background: var(--c-navy); 
        padding: 1.5rem; 
        color: white; 
    }
    .item-row { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 0.8rem; 
        border-bottom: 1px dashed #e2e8f0; 
        padding-bottom: 0.8rem; 
    }
    
    .slide-in { 
        animation: slideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
    }
    @keyframes slideIn { from { 
        opacity: 0; 
        transform: translateX(20px); 
    } to { 
        opacity: 1; 
        transform: translateX(0); } }
    .fade-in { 
        animation: fadeIn 0.3s ease-out; 
    }
    @keyframes fadeIn 
    { from { 
        opacity: 0; 
    } to {
        opacity: 1; 
        } 
    }
</style>

<div class="cust-wrapper">

    <div id="listView" class="fade-in">
        
        <div class="cust-toolbar">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm khách hàng theo tên, số điện thoại...">
            </div>
        </div>

        <div class="cust-grid">
            <?php foreach($customers as $c): ?>
            <div class="cust-card" onclick="showCustomerDetail(<?= $c->id ?>)">
                <div class="stat-badge">
                    <i class="fas fa-shopping-bag me-1"></i> <?= $c->order_count ?>
                </div>
                <div class="card-header-flex">
                    <div class="icon-box"><i class="fas fa-user"></i></div>
                    <div style="overflow: hidden;">
                        <div class="label-caps">KHÁCH HÀNG</div>
                        <h6 class="font-black text-navy m-0 text-truncate" style="font-size: 1rem;"><?= htmlspecialchars($c->name) ?></h6>
                    </div>
                </div>
                
                <div class="info-island">
                    <i class="fas fa-phone-alt"></i> <?= htmlspecialchars($c->phone) ?>
                </div>
                <div class="info-island">
                    <i class="fas fa-map-marker-alt"></i> 
                    <span class="text-truncate"><?= !empty($c->address) ? htmlspecialchars($c->address) : 'Chưa cập nhật' ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="detailView" class="container-fluid">
        <button class="btn-back" onclick="backToList()"><i class="fas fa-arrow-left"></i> QUAY LẠI</button>

        <div class="dashboard-grid">
            <div class="left-col">
                <div class="profile-card">
                    <div style="width: 70px; height: 70px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; color: var(--c-blue); font-size: 1.8rem;">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="font-black text-navy mb-1" id="d_name">Loading...</h3>
                    <p class="text-muted fw-bold small" id="d_phone">...</p>
                    <div class="badge bg-light text-dark p-2 rounded-pill mt-2 small">Tham gia: <span id="d_join_date">...</span></div>
                </div>

                <div class="finance-card">
                    <span class="label-caps text-white-50">TỔNG CHI TIÊU</span>
                    <div class="big-money font-black" id="d_total_spent">0</div>
                    <div class="sub-stat-row">
                        <div class="text-center"><span class="label-caps text-white-50">ĐƠN HÀNG</span><div class="h4 font-black m-0" id="d_order_count">0</div></div>
                        <div class="text-center"><span class="label-caps text-white-50">SẢN PHẨM</span><div class="h4 font-black m-0" id="d_product_count">0</div></div>
                    </div>
                </div>
            </div>

            <div class="right-col">
                <div class="history-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="font-black text-navy m-0">LỊCH SỬ GIAO DỊCH</h4>
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2 fw-bold" style="font-size:0.75rem">HISTORY</span>
                    </div>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Ngày mua</th>
                                <th>SL Sản phẩm</th>
                                <th class="text-end">Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="historyTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-receipt" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="receipt-header">
                <h5 class="font-black text-navy mb-1">HÓA ĐƠN #<span id="m_order_id"></span></h5>
                <p class="text-muted small m-0">Nhân viên: <span id="m_staff" class="fw-bold"></span></p>
                <div class="small text-muted mt-1" id="m_date"></div>
            </div>
            <div class="receipt-body" id="m_items_body"></div>
            <div class="receipt-footer">
                <div class="d-flex justify-content-between mb-2"><span class="text-white-50 small">Tạm tính</span><span class="fw-bold" id="m_subtotal"></span></div>
                 <div class="d-flex justify-content-between mb-2"><span class="text-white-50 small">Khách đưa</span><span class="fw-bold" id="m_paid"></span></div>
                <div class="d-flex justify-content-between pt-3 border-top border-secondary mt-3">
                    <span class="label-caps text-white-50">THÀNH TIỀN</span><span class="h4 font-black m-0 text-sky" id="m_total"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#searchInput').on('keyup', function() {
        const term = $(this).val().toLowerCase();
        $('.cust-card').each(function() {
            const name = $(this).find('h6').text().toLowerCase();
            const phone = $(this).find('.info-island').text().toLowerCase();
            if(name.includes(term) || phone.includes(term)) { $(this).fadeIn(); } else { $(this).fadeOut(); }
        });
    });

    function showCustomerDetail(id) {
        $('body').css('cursor', 'wait');
        $.get('/customer/get-details', {id: id}, function(res) {
            $('body').css('cursor', 'default');
            if(res.success) {
                const c = res.customer; const s = res.stats;
                $('#d_name').text(c.name); $('#d_phone').text(c.phone); $('#d_join_date').text(c.created_at);
                $('#d_total_spent').text(Number(s.total_spent).toLocaleString('vi-VN'));
                $('#d_order_count').text(s.total_orders); $('#d_product_count').text(s.total_products);
                const tbody = $('#historyTableBody'); tbody.empty();
                if(res.history.length === 0) {
                    tbody.html('<tr><td colspan="5" class="text-center text-muted py-4 small">Chưa có giao dịch nào.</td></tr>');
                } else {
                    res.history.forEach(order => {
                        tbody.append(`
                            <tr>
                                <td class="fw-bold">#${order.id}</td>
                                <td>${order.created_at}</td>
                                <td><span class="badge bg-light text-dark border">${order.items_count}</span></td>
                                <td class="text-end font-black text-navy">${Number(order.total_amount).toLocaleString('vi-VN')}</td>
                                <td class="text-end"><button class="btn-detail" onclick="showOrderReceipt(${order.id})">XEM</button></td>
                            </tr>
                        `);
                    });
                }
                $('#listView').hide(); $('#detailView').show().addClass('slide-in'); window.scrollTo(0,0);
            } else { alert('Không thể tải thông tin khách hàng'); }
        }, 'json');
    }

    function backToList() { $('#detailView').hide().removeClass('slide-in'); $('#listView').show().addClass('fade-in'); }

    const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
    function showOrderReceipt(orderId) {
        $.get('/customer/get-order-details', {order_id: orderId}, function(res) {
            if(res.success) {
                const o = res.order;
                $('#m_order_id').text(o.id); $('#m_staff').text(o.staff_name || 'N/A'); $('#m_date').text(o.created_at);
                $('#m_subtotal').text(Number(o.total_amount).toLocaleString('vi-VN'));
                $('#m_paid').text(Number(o.amount_paid).toLocaleString('vi-VN'));
                $('#m_total').text(Number(o.total_amount).toLocaleString('vi-VN') + ' VND');
                const body = $('#m_items_body'); body.empty();
                res.items.forEach(item => {
                    body.append(`
                        <div class="item-row">
                            <div><div class="fw-bold text-navy small">${item.product_name}</div><div class="text-muted small font-monospace" style="font-size:0.75rem">${item.barcode}</div></div>
                            <div class="text-end"><div class="text-muted small">${Number(item.unit_price).toLocaleString('vi-VN')} x ${item.quantity}</div><div class="fw-bold text-navy small">${Number(item.total_price).toLocaleString('vi-VN')}</div></div>
                        </div>
                    `);
                });
                orderModal.show();
            }
        }, 'json');
    }
</script>