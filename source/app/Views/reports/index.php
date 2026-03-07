<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script> 
</head>
<body>

<style>
    :root {
        --r-bg: #F0F8FF; 
        --r-navy: #011628; 
        --r-indigo: #044377;
        --r-sky: #9CD1FC; 
        --r-emerald: #10B981; 
        --r-white: #FFFFFF;
        --r-radius: 1.5rem; 
        --r-radius-sm: 0.75rem;
        --shadow-elevation: 0 10px 30px -5px #01162826;
    }

    .report-wrapper { 
        background-color: var(--r-bg); 
        font-family: 'Inter', sans-serif; 
        color: var(--r-navy); 
        padding: 1.5rem; 
        min-height: 100vh; 
    }
    .font-black { 
        font-weight: 900; 
        letter-spacing: -0.02em; 
    }
    .text-navy { 
        color: var(--r-navy); 
    }
    .text-indigo { 
        color: var(--r-indigo); 
    }

    .report-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: flex-end; 
        margin-bottom: 1.5rem; 
        flex-wrap: wrap; 
        gap: 1rem; 
    }
    .report-title { 
        font-size: 1.8rem; 
        line-height: 1.2; 
        margin-bottom: 0.25rem; 
    }
    .report-subtitle { 
        font-size: 0.85rem; 
        font-weight: 500; 
        color: #64748b; 
    }
    
    .multi-filter-bar { 
        display: flex;
        gap: 0.75rem; 
        background: var(--r-white); 
        padding: 0.35rem; 
        border-radius: 1.5rem; 
        box-shadow: var(--shadow-elevation); 
        align-items: center; 
    }
    .filter-select { 
        border: none; 
        background: #F8FAFC; 
        padding: 0.5rem 1rem; 
        border-radius: var(--r-radius-sm); 
        font-weight: 600; 
        color: var(--r-navy);  
        font-size: 0.875rem; 
        outline: none; 
    }
    .filter-select:hover { 
        background: #e2e8f0; 
    }

    /*KPI CARDS */
    .kpi-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
        gap: 1.5rem; 
        margin-bottom: 1.5rem; 
    }
    .kpi-card { 
        background: var(--r-white); 
        border-radius: var(--r-radius); 
        padding: 1.25rem; 
        position: relative; 
        overflow: hidden; 
        box-shadow: var(--shadow-elevation); 
        transition: transform 0.2s; 
    }
    .kpi-card:hover { 
        transform: translateY(-3px); 
    }
    .kpi-label { 
        font-size: 0.65rem; 
        font-weight: 900; 
        text-transform: uppercase; 
        color: #64748b; 
        display: block; 
        margin-bottom: 0.5rem; 
    }
    .kpi-value { 
        font-size: 1.875rem; 
        font-weight: 800; 
        line-height: 1; 
        margin-top: 0.5rem; 
    }
    .kpi-icon-bg { 
        position: absolute; 
        bottom: -5px; 
        right: -5px; 
        font-size: 4rem; 
        opacity: 0.05; 
        transform: rotate(-15deg); 
    }
    
    /* CHART SECTION */
    .charts-row { 
        display: grid; 
        grid-template-columns: 2fr 1fr; 
        gap: 1.5rem; 
        margin-bottom: 1.5rem; 
    }
    
    .chart-box { 
        background: var(--r-white); 
        border-radius: var(--r-radius); 
        padding: 1.5rem; 
        box-shadow: var(--shadow-elevation); 
        height: auto; 
        min-height: 450px; 
        display: flex; 
        flex-direction: column; 
    }
    
    .chart-header { 
        display: flex; 
        justify-content: space-between; 
        margin-bottom: 1rem; 
    }
    .chart-title { 
        font-weight: 700; 
        color: var(--r-navy); 
        font-size: 1rem; 
    }
    .chart-container {
        position: relative;
        flex-grow: 1;
        width: 100%;
        min-height: 350px;
    }

    /* TABLE */
    .audit-box { 
        background: var(--r-white); 
        border-radius: var(--r-radius); 
        overflow: hidden; 
        box-shadow: var(--shadow-elevation); 
    }
    .audit-table { 
        width: 100%; 
        border-collapse: collapse; 
    }
    .audit-table th { 
        background: #F1F5F9; 
        padding: 0.75rem 1.5rem; 
        font-size: 0.65rem; 
        font-weight: 900; 
        text-transform: uppercase; 
        color: #64748b; 
        text-align: left; 
    }
    .audit-table td { 
        padding: 0.75rem 1.5rem; 
        border-bottom: 1px solid #f1f5f9; 
        font-weight: 500; 
        color: var(--r-navy); 
        font-size: 0.85rem; 
    }
    .btn-audit-detail { 
        background: #e0f2fe; 
        color: var(--r-indigo); 
        border: none; 
        padding: 0.35rem 0.85rem; 
        border-radius: 0.75rem; 
        font-weight: 700; 
        font-size: 0.7rem; 
    }

    /* MODAL*/
    .modal-overlay { 
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        background: #01162899; 
        backdrop-filter: blur(4px); 
        z-index: 9999; 
        display: none; 
        align-items: center; 
        justify-content: center; 
    }
    .date-picker-modal { 
        background: white; 
        border-radius: 1.5rem; 
        width: auto; 
        max-width: 95%; 
        box-shadow: 0 25px 50px -12px #00000040; 
        overflow: hidden; 
        animation: modalFadeIn 0.3s ease; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
    }
    .modal-body { 
        padding: 1.5rem; 
        display: flex; 
        justify-content: center; 
    }
    .flatpickr-calendar { 
        box-shadow: none !important; 
        margin: 0 !important; 
    }
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange { 
        background: var(--r-indigo) !important; 
        border-color: var(--r-indigo) !important; 
    }
    .flatpickr-day.inRange { 
        background: #e0f2fe !important; 
        border-color: #e0f2fe !important; 
        color: var(--r-navy) !important; 
        box-shadow: -5px 0 0 #e0f2fe, 5px 0 0 #e0f2fe !important; 
    }
    .modal-footer { 
        width: 100%; 
        padding: 1rem 1.5rem; 
        display: flex; 
        justify-content: center; 
        gap: 1rem; 
        background: #F8FAFC; 
        border-top: 1px solid #f1f5f9; 
    }
    .btn-cancel { 
        padding: 0.6rem 1.5rem; 
        border-radius: 0.75rem; 
        border: 1px solid #cbd5e1; 
        background: white; 
        font-weight: 600; 
        color: #64748b;
    }
    .btn-apply { 
        padding: 0.6rem 2rem; 
        border-radius: 0.75rem; 
        border: none; 
        background: var(--r-indigo); 
        font-weight: 600; 
        color: white;  
        transition: 0.2s; 
    }
    .btn-apply:hover { 
        background: var(--r-navy); 
        transform: translateY(-1px); 
    }
    @keyframes modalFadeIn { from { 
        opacity: 0; 
        transform: scale(0.95); 
    } to {
        opacity: 1;
        transform: scale(1); 
    } 
}
    
    @media (max-width: 992px) {
        .charts-row { 
            grid-template-columns: 1fr; 
        }
    }
</style>

<div class="report-wrapper">
    <div class="report-header">
        <div>
            <div class="report-title font-black text-navy">Báo cáo Kinh doanh</div>
            <div class="report-subtitle">Tổng quan hiệu suất bán hàng</div>
        </div>
        
        <div class="multi-filter-bar">
            <select id="timeRange" class="filter-select">
                <option value="today">Hôm nay</option>
                <option value="yesterday">Hôm qua</option>
                <option value="7days">7 ngày qua</option>
                <option value="month">Tháng này</option>
                <option value="custom">Tùy chọn...</option>
            </select>

            <?php if(!empty($staffs)): ?>
            <select id="staffFilter" class="filter-select">
                <option value="">Tất cả nhân viên</option>
                <?php foreach($staffs as $s): ?>
                    <option value="<?= $s->id ?>"><?= htmlspecialchars($s->fullname) ?></option>
                <?php endforeach; ?>
            </select>
            <?php endif; ?>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-label">DOANH THU</div>
            <div class="kpi-value font-black text-indigo" id="kpi_revenue">0</div>
        
        </div>
        <div class="kpi-card">
            <div class="kpi-label">ĐƠN HÀNG</div>
            <div class="kpi-value font-black text-navy" style="color: #10B981" id="kpi_orders">0</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">SỐ LƯỢNG SẢN PHẨM</div>
            <div class="kpi-value font-black text-navy" style="color: #F59E0B" id="kpi_products">0</div>
        </div>
        <?php if($_SESSION['user']->role === 'admin'): ?>
        <div class="kpi-card" style="background: var(--r-navy); color: white;">
            <div class="kpi-label" style="color: rgba(255,255,255,0.6)">LỢI NHUẬN</div>
            <div class="kpi-value font-black" style="color: var(--r-sky)" id="kpi_profit">0</div>
        </div>
        <?php endif; ?>
    </div>

    <div class="charts-row">
        <div class="chart-box">
            <div class="chart-header">
                <div class="chart-title">Biểu đồ Doanh thu & Lợi nhuận</div>
            </div>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="chart-box">
            <div class="chart-header">
                <div class="chart-title">Cơ cấu Danh mục</div>
            </div>
            <div class="chart-container" style="display: flex; align-items: center; justify-content: center;">
                 <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <div class="audit-box">
        <table class="audit-table">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th><th>Thời gian</th><th>Khách hàng</th>
                    <th class="text-end">Tổng tiền</th><th class="text-end">Chi tiết</th>
                </tr>
            </thead>
            <tbody id="auditTableBody"></tbody>
        </table>
    </div>
</div>

<div id="dateRangeModal" class="modal-overlay">
    <div class="date-picker-modal">
        <div class="modal-body">
            <div id="inline-calendar"></div>
        </div>
        <div class="modal-footer">
            <button id="btnCancelDate" class="btn-cancel">Hủy</button>
            <button id="btnApplyDate" class="btn-apply">Xác nhận</button>
        </div>
    </div>
</div>

<script>
    let revenueChartInstance = null;
    let categoryChartInstance = null;
    let selectedRange = { start: null, end: null };

    $(document).ready(function() {
        loadReportData(); 
        const fp = flatpickr("#inline-calendar", {
            mode: "range",
            inline: true,
            dateFormat: "Y-m-d",
            locale: "vn"
        });

        // Handle Dropdown Change
        let previousRangeValue = 'today';
        $('#timeRange').change(function() {
            const val = $(this).val();
            if (val === 'custom') {
                $('#dateRangeModal').css('display', 'flex');
                fp.clear();
            } else {
                previousRangeValue = val;
                loadReportData();
            }
        });

        // Modal Logic
        $('#btnCancelDate').click(function() {
            $('#dateRangeModal').fadeOut(200);
            $('#timeRange').val(previousRangeValue);
        });

        $('#btnApplyDate').click(function() {
            const selectedDates = fp.selectedDates;
            if (selectedDates.length < 2) {
                alert("Vui lòng chọn khoảng thời gian bắt đầu và kết thúc!");
                return;
            }

            // Format YYYY-MM-DD
            const formatDate = (date) => {
                let d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();
                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;
                return [year, month, day].join('-');
            };

            selectedRange.start = formatDate(selectedDates[0]);
            selectedRange.end = formatDate(selectedDates[1]);

            $('#dateRangeModal').fadeOut(200);
            loadReportData();
        });

        // Filter by Staff
        if($('#staffFilter').length) {
            $('#staffFilter').change(function() { loadReportData(); });
        }
    });

    //FETCH DATA
    function loadReportData() {
        const range = $('#timeRange').val();
        const staffId = $('#staffFilter').val() || '';
        let params = { range: range, staff_id: staffId };

        if (range === 'custom') {
            if (!selectedRange.start || !selectedRange.end) return;
            params.start = selectedRange.start;
            params.end = selectedRange.end;
        }

        $.get('<?= APP_URL ?>/report/getReportData', params, function(res) {
            if(res.success) {
                const fmt = (n) => Number(n).toLocaleString('vi-VN');
                $('#kpi_revenue').text(fmt(res.kpi.revenue));
                $('#kpi_orders').text(res.kpi.orders);
                $('#kpi_products').text(res.kpi.products);
                if(res.kpi.profit !== null) $('#kpi_profit').text(fmt(res.kpi.profit));

                renderAuditTable(res.orders);
                renderRevenueChart(res.chart, res.chart_mode);
                renderCategoryChart(res.categories);
            }
        }, 'json');
    }

    //Render Table 
    function renderAuditTable(data) {
        const tbody = $('#auditTableBody'); tbody.empty();
        if(!data || data.length === 0) { 
            tbody.html('<tr><td colspan="5" class="text-center py-4 text-muted">Không có dữ liệu</td></tr>'); 
            return; 
        }
        data.forEach(row => {
            tbody.append(`<tr>
                <td class="font-black text-indigo">#${row.id}</td>
                <td>${row.created_at}</td>
                <td>${row.customer_name ?? 'Khách lẻ'}</td>
                <td class="text-end font-black text-navy">${Number(row.total_amount).toLocaleString('vi-VN')}</td>
                <td class="text-end"><button class="btn-audit-detail"><i class="fas fa-eye"></i></button></td>
            </tr>`);
        });
    }

    //Render Revenue & Profit Chart 
    function renderRevenueChart(data, mode) {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        // Xử lý Labels
        const labels = data.map(d => {
            if (mode === 'hour') return `${d.time_point}:00`;
            const parts = d.time_point.split('-'); 
            return `${parts[2]}/${parts[1]}`;
        });

        const revenueData = data.map(d => d.revenue);
        const profitData = data.map(d => d.profit);

        if(revenueChartInstance) revenueChartInstance.destroy();

        revenueChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Doanh thu',
                        data: revenueData,
                        backgroundColor: '#011628', 
                        borderRadius: 6,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8,
                        order: 1
                    },
                    {
                        label: 'Lợi nhuận',
                        data: profitData,
                        backgroundColor: '#9CD1FC', 
                        borderRadius: 6,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8,
                        order: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { 
                    mode: 'index', 
                    intersect: false 
                },
                plugins: { 
                    legend: { 
                        position: 'top', 
                        align: 'end', 
                        labels: { 
                            usePointStyle: true, 
                            boxWidth: 8, 
                            font: { 
                                family: 'Inter', 
                                size: 11 
                            } 
                        } 
                    }, 
                    tooltip: {
                        backgroundColor: '#011628f2',
                        titleColor: '#9CD1FC', 
                        bodyColor: '#fff',
                        padding: 12, 
                        cornerRadius: 8, 
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        border: { 
                            display: false 
                        },
                        grid: { 
                            borderDash: [4, 4], 
                            color: '#f1f5f9', 
                            drawBorder: false 
                        },
                        ticks: {
                            font: { 
                                size: 10, 
                                family: 'Inter' 
                            }, 
                            color: '#64748b',
                            callback: function(value) {
                                if(value >= 1000000) return (value/1000000) + 'M';
                                if(value >= 1000) return (value/1000) + 'k';
                                return value;
                            }
                        }
                    },
                    x: { 
                        grid: {
                            display: false 
                        }, ticks: {
                            font: {
                                size: 11, 
                                family: 'Inter', 
                                weight: '600' 
                            }, 
                            color: '#011628' 
                        } 
                    }
                }
            }
        });
    }

    // Render Category Chart
    function renderCategoryChart(data) {
        const ctx = document.getElementById('categoryChart').getContext('2d');
        
        if (!data || data.length === 0) {
            if(categoryChartInstance) categoryChartInstance.destroy();
            return;
        }

        const labels = data.map(d => d.name);
        const values = data.map(d => d.qty);
        const colors = ['#044377', '#3B82F6', '#10B981', '#F59E0B', '#6366F1', '#EC4899'];

        if(categoryChartInstance) categoryChartInstance.destroy();

        categoryChartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { 
                        position: 'right', 
                        labels: { 
                            usePointStyle: true, 
                            pointStyle: 'circle', 
                            padding: 15, 
                            font: { 
                                size: 11 
                            } 
                        } 
                    }
                }
            }
        });
    }
</script>

</body>
</html>