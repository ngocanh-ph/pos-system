<style>
    :root {
        --d-bg: #F0F8FF;          
        --d-navy: #011628;        
        --d-indigo: #044377;       
        --d-sky: #9CD1FC;          
        --d-emerald: #10B981;      
        --d-rose: #E11D48;        
        --d-white: #FFFFFF;
        --d-radius-3xl: 2rem;      
        --d-radius-xl: 1rem;       
        --d-radius-lg: 0.75rem;    
        --d-shadow-card: 0 10px 40px -10px #b0dafd80;
        --d-shadow-hover: 0 20px 50px -12px #04437740;
    }

    .dash-wrapper {
        background-color: var(--d-bg);
        font-family: 'Inter', sans-serif;
        color: var(--d-navy);
        padding: 0;
        min-height: 85vh;
        /* Đảm bảo wrapper không bị tràn */
        width: 100%;
        overflow-x: hidden;
    }

    .font-black { 
        font-weight: 900; 
        letter-spacing: -0.02em; 
    }
    .text-navy { 
        color: var(--d-navy); 
    }
    .text-indigo { 
        color: var(--d-indigo); 
    }

    .meta-label {
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #508ABA;
        display: block;
        margin-bottom: 4px;
    }

    .hero-card {
        background: var(--d-white);
        border-radius: var(--d-radius-3xl);
        padding: 2rem;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(176, 218, 253, 0.3);
        box-shadow: var(--d-shadow-card);
        display: flex; 
        justify-content: space-between; 
        align-items: flex-end;
        margin-bottom: 1.5rem;
    }

    .hero-watermark {
        position: absolute;
        top: -20px; right: -20px;
        font-size: 180px;
        color: var(--d-navy);
        opacity: 0.03;
        transform: rotate(12deg);
        pointer-events: none;
        transition: transform 0.5s ease;
    }
    .hero-card:hover .hero-watermark { 
        transform: rotate(0deg) scale(1.1); 
    }

    .btn-hero-action {
        background-color: var(--d-navy); 
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: var(--d-radius-xl);
        font-weight: 700; 
        font-size: 0.85rem;
        display: flex; 
        align-items: center; 
        gap: 10px;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(1, 22, 40, 0.2);
    }
    .btn-hero-action:hover { 
        background-color: var(--d-indigo); 
        transform: translateY(-2px); 
        color: white; 
    }

    .kpi-grid {
        display: grid; 
        /* FIX: Dùng minmax(0, 1fr) thay vì 1fr để thẻ tự ép nhỏ lại khi sidebar mở ra */
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1.5rem; margin-bottom: 1.5rem;
    }

    .kpi-card {
        background: var(--d-white);
        border-radius: var(--d-radius-3xl);
        padding: 1.5rem;
        box-shadow: var(--d-shadow-card);
        border: 1px solid #b0dafd4d;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative; overflow: hidden;
    }
    .kpi-card:hover { 
        transform: translateY(-4px); 
        box-shadow: var(--d-shadow-hover); 
    }

    .kpi-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: flex-start; 
        margin-bottom: 1rem; 
    }
    
    .icon-square {
        width: 48px; 
        height: 48px;
        border-radius: var(--d-radius-xl);
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 1.25rem; 
        color: white;
        box-shadow: 0 8px 16px -4px #00000033;
    }
    .bg-navy { background: var(--d-navy); }
    .bg-indigo { background: var(--d-indigo); }
    .bg-emerald { background: var(--d-emerald); }
    
    .kpi-value { 
        font-size: 2rem; 
        line-height: 1; 
        margin-top: 0.5rem; 
        /* Cắt chữ nếu dài quá để tránh tràn */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .main-split {
        display: grid; 
        /* FIX: Áp dụng tương tự cho chia cột 2/1 */
        grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
        gap: 1.5rem;
    }

    .chart-card {
        background: var(--d-white);
        border-radius: var(--d-radius-3xl);
        padding: 1.5rem;
        box-shadow: var(--d-shadow-card);
        border: 1px solid #b0dafd4d;
        height: 380px;
        display: flex;
        flex-direction: column;
    }
    
    .feed-card {
        background: var(--d-white);
        border-radius: var(--d-radius-3xl);
        padding: 1.5rem;
        box-shadow: var(--d-shadow-card);
        border: 1px solid #b0dafd4d;
        height: 380px; display: flex; flex-direction: column;
    }

    .card-header-flex {
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .tx-list { 
        flex-grow: 1; 
        overflow-y: auto; 
        padding-right: 4px; 
    }
    
    .tx-item {
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        padding: 0.85rem;
        border-radius: var(--d-radius-xl);
        margin-bottom: 0.5rem;
        transition: all 0.2s;
        border: 1px solid transparent;
    }
    .tx-item:hover {
        background-color: #F8FAFC;
        border-color: #E2E8F0;
        transform: scale(1.01);
    }

    .tx-icon {
        width: 36px; 
        height: 36px; 
        border-radius: 10px;
        background: #F1F5F9; 
        color: var(--d-indigo);
        display: flex; 
        align-items: center; 
        justify-content: center;
        margin-right: 12px; 
        transition: 0.2s;
    }
    .tx-item:hover .tx-icon { 
        background: var(--d-navy); 
        color: white; 
    }

    .tx-info h6 { 
        margin: 0; 
        font-size: 0.85rem; 
        font-weight: 700; 
        color: var(--d-navy); 
    }
    .tx-info span { 
        font-size: 0.65rem; 
        color: #64748b; 
        font-weight: 600; 
        text-transform: uppercase; 
    }
    .tx-amount { 
        font-weight: 900; 
        color: var(--d-indigo); 
        font-size: 0.9rem; 
    }

    /* Scrollbar */
    .tx-list::-webkit-scrollbar { width: 4px; }
    .tx-list::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 4px; }

    /* Responsive */
    @media (max-width: 1024px) {
        .kpi-grid { grid-template-columns: minmax(0, 1fr); }
        .main-split { grid-template-columns: minmax(0, 1fr); }
        .hero-watermark { font-size: 100px; }
    }
</style>

<div class="dash-wrapper">
    
    <div class="hero-card">
        <i class="fas fa-chart-line hero-watermark"></i>
        <div class="hero-content">
            <h1 class="font-black text-navy" style="font-size: 2rem; margin-bottom: 0.5rem;">
                Chào ngày mới <?= htmlspecialchars($_SESSION['user']->fullname) ?>!
            </h1>
            <p class="text-muted fw-bold" style="font-size: 0.9rem; margin: 0;">
                Hệ thống MAVPOS đã sẵn sàng, chúc bạn một ngày kinh doanh hiệu quả.
            </p>
        </div>
        
        <?php if($_SESSION['user']->role === 'staff'): ?>
        <a href="<?= APP_URL ?>/posale" class="btn-hero-action">
            <i class="fas fa-shopping-cart"></i> BÁN HÀNG
        </a>
        <?php endif; ?>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-header">
                <div class="icon-square bg-navy"><i class="fas fa-dollar-sign"></i></div>
            </div>
            <div>
                <span class="meta-label">Doanh thu hôm nay</span>
                <div class="kpi-value font-black text-navy"><?= number_format($revenueToday) ?></div>
            </div>
        </div>
        
        <div class="kpi-card">
            <div class="kpi-header">
                <div class="icon-square bg-indigo"><i class="fas fa-receipt"></i></div>
            </div>
            <div>
                <span class="meta-label">Đơn hàng mới</span>
                <div class="kpi-value font-black text-navy"><?= number_format($ordersToday) ?></div>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-header">
                <div class="icon-square bg-emerald"><i class="fas fa-cube"></i></div>
            </div>
            <div>
                <span class="meta-label">Sản phẩm bán ra</span>
                <div class="kpi-value font-black text-navy"><?= number_format($productsSold) ?></div>
            </div>
        </div>
    </div>

    <div class="main-split">
        <div class="chart-card">
            <div class="card-header-flex">
                <div>
                    <span class="meta-label">Phân tích</span>
                    <h5 class="font-black text-navy m-0">Hiệu suất bán hàng</h5>
                </div>
            </div>
            <div style="position: relative; width: 100%; flex-grow: 1; min-height: 0;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="feed-card">
            <div class="card-header-flex">
                <div>
                    <span class="meta-label">Giao dịch gần đây</span>
                    <h5 class="font-black text-navy m-0">Dòng tiền</h5>
                </div>
            </div>
            
            <div class="tx-list">
                <?php if(empty($recentOrders)): ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-inbox fa-2x mb-2 opacity-25"></i>
                        <p class="small mb-0 fw-bold">Chưa có giao dịch</p>
                    </div>
                <?php else: ?>
                    <?php foreach($recentOrders as $order): ?>
                    <div class="tx-item">
                        <div class="d-flex align-items-center">
                            <div class="tx-icon"><i class="fas fa-shopping-bag"></i></div>
                            <div class="tx-info">
                                <h6><?= htmlspecialchars($order->customer_name ?? 'Khách lẻ') ?></h6>
                                <span><?= date('H:i', strtotime($order->created_at)) ?> • #<?= $order->id ?></span>
                            </div>
                        </div>
                        <div class="tx-amount">
                            +<?= number_format($order->total_amount) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="mt-auto pt-3 border-top text-center">
                <a href="<?= APP_URL ?>/reports" class="text-decoration-none fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.1em; color: #64748b;">
                    Xem toàn bộ lịch sử <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    let gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, '#04437733');   
    gradient.addColorStop(1, '#f0f8ff00');   

    const labels = <?= json_encode($chartLabels) ?>.map(h => h + 'h');
    const data = <?= json_encode(array_values($chartValues)) ?>;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: data,
                borderColor: '#044377', 
                backgroundColor: gradient,
                borderWidth: 3,
                tension: 0.4,           
                pointRadius: 0,         
                pointHoverRadius: 6,
                pointBackgroundColor: '#011628',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Bắt buộc false để chart co giãn chuẩn theo div
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#011628',
                    titleFont: { family: 'Inter', size: 12 },
                    bodyFont: { family: 'Inter', size: 13, weight: 'bold' },
                    padding: 12,
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return new Intl.NumberFormat('vi-VN').format(context.parsed.y) + ' đ';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [4, 4], color: '#f1f5f9', drawBorder: false },
                    ticks: { 
                        color: '#94a3b8', 
                        font: { family: 'Inter', weight: '600', size: 10 },
                        maxTicksLimit: 5
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { 
                        color: '#94a3b8', 
                        font: { family: 'Inter', weight: '700', size: 9 },
                        maxTicksLimit: 8
                    }
                }
            },
            interaction: {
                mode: 'index',
                intersect: false,
            },
        }
    });
});
</script>