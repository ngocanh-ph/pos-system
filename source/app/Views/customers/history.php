<?php ?>
<style>
    :root {
        --c-bg: #F0F8FF; 
        --c-navy: #011628; 
        --c-sky: #9CD1FC; 
        --c-blue: #044377; 
        --c-white: #FFFFFF;
        --c-radius-3xl: 2.5rem; 
        --c-radius-xl: 1.5rem; 
        --c-radius-lg: 1rem;
        --c-shadow-soft: 0 10px 30px -10px #b0dafd80;
    }

    body { 
        background-color: var(--c-bg); 
        font-family: 'Inter', sans-serif; 
        color: var(--c-navy); 
    }

    .history-wrapper { 
        padding: 2rem; 
        max-width: 1400px; 
        margin: 0 auto; 
    }
    
    .card-soft {
        background: var(--c-white); 
        border-radius: var(--c-radius-3xl);
        padding: 2rem; 
        box-shadow: var(--c-shadow-soft); 
        border: none; 
        margin-bottom: 2rem;
    }

    .font-black { 
        font-weight: 900; 
    }
    .text-navy { 
        color: var(--c-navy); 
    }
    .btn-back {
        background: white; 
        color: var(--c-navy); 
        border: 2px solid #e2e8f0;
        padding: 0.75rem 1.5rem; 
        border-radius: var(--c-radius-lg); 
        font-weight: 800;
        text-decoration: none; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        transition: 0.2s;
    }
    .btn-back:hover { 
        border-color: var(--c-navy); 
        transform: translateX(-3px); 
        color: var(--c-navy); 
    }

    /* TABLE STYLES */
    .table-soft { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0 0.75rem; }
    .table-soft th {
        font-size: 0.7rem; 
        font-weight: 900; 
        text-transform: uppercase; 
        color: #94a3b8;
        padding: 0 1.5rem; 
        text-align: left; 
        border: none;
    }
    .table-soft td {
        background: #F8FAFC; 
        padding: 1rem 1.5rem; 
        font-weight: 600; 
        vertical-align: middle;
        border-top: 1px solid white; 
        border-bottom: 1px solid white;
        color: var(--c-navy);
    }
    .table-soft td:first-child { 
        border-top-left-radius: 1rem; 
        border-bottom-left-radius: 1rem; 
    }
    .table-soft td:last-child { 
        border-top-right-radius: 1rem; 
        border-bottom-right-radius: 1rem; 
        text-align: right; 
    }
    .table-soft tr:hover td { 
        background: #e0f2fe; 
        transform: scale(1.005); 
        transition: 0.2s; 
    }

    .btn-view {
        background: var(--c-navy); 
        color: white; 
        border: none;
        padding: 0.5rem 1rem; 
        border-radius: 0.75rem; 
        font-size: 0.8rem; 
        font-weight: 700;
        transition: 0.2s;
    }
    .btn-view:hover { 
        background: #1e293b; 
    }

    /* MODAL STYLES */
    .modal-receipt .modal-content { 
        border-radius: 2rem; 
        border: none; 
        overflow: hidden; 
    }
    .receipt-header { 
        background: #F8FAFC; 
        padding: 2rem; 
        text-align: center; 
        border-bottom: 2px dashed #cbd5e1; 
    }
    .receipt-body { 
        padding: 2rem; 
        max-height: 60vh; 
        overflow-y: auto; 
    }
    .item-row { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 1rem; 
        border-bottom: 1px dashed #e2e8f0; 
        padding-bottom: 1rem; 
    }
</style>

<div class="history-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-black text-navy mb-1">Chi tiết khách hàng</h2>
            <p class="text-muted m-0">Đang xem hồ sơ: <strong><?= htmlspecialchars($customer->name) ?></strong></p>
        </div>
        <a href="/customers" class="btn-back"><i class="fas fa-arrow-left"></i> Quay lại DS</a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card-soft text-center h-100">
                <div style="width: 80px; height: 80px; background: #eff6ff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem; color: var(--c-blue); font-size: 2rem;">
                    <i class="fas fa-user"></i>
                </div>
                <h4 class="font-black text-navy"><?= htmlspecialchars($customer->name) ?></h4>
                <div class="text-muted mb-3 fw-bold"><?= htmlspecialchars($customer->phone) ?></div>
                <hr style="opacity: 0.1">
                <div class="text-start small text-muted">
                    <i class="fas fa-map-marker-alt me-2"></i> 
                    <?= !empty($customer->address) ? htmlspecialchars($customer->address) : 'Chưa cập nhật địa chỉ' ?>
                </div>
                <div class="mt-4 text-start">
                    <span class="text-muted small text-uppercase fw-bold">Ngày tham gia</span>
                    <div class="fw-bold text-navy"><?= date('d/m/Y', strtotime($customer->created_at)) ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card-soft" style="min-height: 500px">
                <h4 class="font-black text-navy mb-4">Lịch sử giao dịch</h4>
                <table class="table-soft">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Ngày mua</th>
                            <th class="text-center">SL SP</th>
                            <th class="text-end">Tổng tiền</th>
                            <th class="text-end">Khách đưa</th>
                            <th class="text-end">Tiền thừa</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($orders)): ?>
                            <?php foreach ($orders as $o): ?>
                            <tr>
                                <td class="fw-bold">#<?= $o->id ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($o->created_at)) ?></td>
                                <td class="text-center">
                                    <span class="badge bg-white text-dark border">
                                        <?= isset($o->items_count) ? $o->items_count : '-' ?> SP
                                    </span>
                                </td>
                                <td class="text-end fw-bold text-navy"><?= number_format($o->total_amount) ?></td>
                                <td class="text-end text-muted"><?= number_format($o->amount_paid) ?></td>
                                <td class="text-end text-success fw-bold"><?= number_format($o->change_amount) ?></td>
                                <td class="text-end">
                                    <button class="btn-view" onclick="showOrderReceipt(<?= $o->id ?>)">
                                        Chi tiết
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center py-5 text-muted">Khách hàng này chưa có đơn hàng nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-receipt" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="receipt-header">
                <h4 class="font-black text-navy mb-2">HÓA ĐƠN #<span id="m_order_id"></span></h4>
                <p class="text-muted m-0">Nhân viên: <span id="m_staff" class="fw-bold"></span></p>
                <small class="text-muted" id="m_date"></small>
            </div>
            <div class="receipt-body" id="m_items_body">
                </div>
            <div class="receipt-footer">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-white-50">Tổng tiền hàng</span>
                    <span class="fw-bold text-white" id="m_subtotal"></span>
                </div>
                <div class="d-flex justify-content-between pt-3 border-top border-secondary mt-3">
                    <span class="small text-uppercase text-white-50 fw-bold">THANH TOÁN</span>
                    <span class="h4 font-black m-0 text-sky" id="m_total"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));

    function showOrderReceipt(orderId) {
        $.get('/customer/get-order-details', {order_id: orderId}, function(res) {
            if(res.success) {
                const o = res.order;
                
                $('#m_order_id').text(o.id);
                $('#m_staff').text(o.staff_name || 'N/A');
                $('#m_date').text(o.created_at);
                $('#m_subtotal').text(Number(o.total_amount).toLocaleString('vi-VN'));
                $('#m_total').text(Number(o.total_amount).toLocaleString('vi-VN') + ' VND');

                const body = $('#m_items_body');
                body.empty();

                res.items.forEach(item => {
                    const html = `
                        <div class="item-row">
                            <div>
                                <div class="fw-bold text-navy">${item.product_name}</div>
                                <div class="text-muted small font-monospace">${item.barcode}</div>
                            </div>
                            <div class="text-end">
                                <div class="text-muted small">${Number(item.unit_price).toLocaleString('vi-VN')} x ${item.quantity}</div>
                                <div class="fw-bold text-navy">${Number(item.total_price).toLocaleString('vi-VN')}</div>
                            </div>
                        </div>
                    `;
                    body.append(html);
                });

                orderModal.show();
            } else {
                alert('Không thể tải dữ liệu hóa đơn.');
            }
        }, 'json');
    }
</script>