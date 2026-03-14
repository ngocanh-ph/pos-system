<style>
    /* --- DESIGN SYSTEM: ENTERPRISE SECURITY UI (COMPACT & ROUNDED) --- */
    :root {
        --emp-bg: #F0F8FF;
        --emp-navy: #011628;
        --emp-indigo: #044377;
        --emp-rose: #e11d48;
        --emp-success: #059669;
        --emp-warning: #d97706;
        --emp-white: #FFFFFF;
        
        --radius-box: 3rem;        
        --radius-card: 2rem;      
        --radius-btn: 1.5rem;     
        
        --shadow-card: 0 10px 25px -5px #01162814;
        --shadow-btn: 0 4px 10px -2px #04437733;
    }

    /* Base Layout */
    .emp-wrapper {
        background-color: var(--emp-bg);
        font-family: 'Inter', sans-serif;
        padding: 0.5rem; 
        min-height: 85vh;
    }

    /* Header & Action Bar */
    .emp-header {
        display: flex; 
        justify-content: space-between; 
        align-items: flex-end;
        margin-bottom: 1.5rem; 
        padding: 0 0.5rem; 
    }
    .emp-title {
        font-size: 1.5rem; 
        font-weight: 900; 
        color: var(--emp-navy); 
        line-height: 1.1; 
        letter-spacing: -0.02em;
    }
    .emp-subtitle {
        font-size: 0.8rem; 
        color: #64748b; 
        font-weight: 500; 
        margin-top: 4px;
    }
    
    .btn-add-staff {
        background-color: var(--emp-indigo); 
        color: white;
        padding: 0.6rem 1.25rem; 
        border-radius: var(--radius-btn); 
        font-weight: 700; 
        display: flex; 
        align-items: center; 
        gap: 8px;
        box-shadow: var(--shadow-btn);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        border: none; 
        text-transform: uppercase; 
        font-size: 0.75rem; 
        letter-spacing: 0.05em;
    }
    .btn-add-staff:hover {
        transform: translateY(-2px); 
        box-shadow: 0 10px 20px -5px #04437766;
        background-color: #033055; 
        color: white;
    }

    /* Employee Grid */
    .emp-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
        gap: 1rem; 
        padding-bottom: 2rem;
    }

    /* Employee Card */
    .emp-card {
        background: var(--emp-white);
        border-radius: var(--radius-card); 
        padding: 1.25rem; 
        position: relative;
        border: 1px solid #b0dafd66;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex; 
        flex-direction: column;
    }
    .emp-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-card);
        border-color: #B0DAFD;
    }

    /* Status Ribbon */
    .status-ribbon {
        position: absolute; 
        top: 1rem; 
        right: 1rem; 
        padding: 0.3rem 0.75rem; 
        border-radius: 2rem;
        font-size: 0.65rem; 
        font-weight: 800; 
        text-transform: uppercase; 
        letter-spacing: 0.05em;
    }
    .status-active { 
        background: #ecfdf5; 
        color: var(--emp-success); 
    }
    .status-locked { 
        background: #fff1f2; 
        color: var(--emp-rose); 
    }
    .status-pending { 
        background: #fef3c7; 
        color: var(--emp-warning); 
    }

    /* Profile Section */
    .profile-box { 
        text-align: center; 
        margin-bottom: 1.25rem; 
    }
    
    .avatar-frame {
        width: 60px; 
        height: 60px; 
        margin: 0 auto 0.75rem; 
        border-radius: 1.25rem; 
        padding: 3px; 
        background: white;
        border: 2px solid #e2e8f0;
        box-shadow: 0 5px 10px -3px #0000000d;
        overflow: hidden;
    }
    .avatar-img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        border-radius: 1rem; 
    }

    .staff-name { 
        font-size: 1.1rem; 
        font-weight: 800; 
        color: var(--emp-navy); 
        margin-bottom: 0.15rem; 
    }
    .staff-username {
        background: #e0e7ff; 
        color: var(--emp-indigo);
        padding: 3px 10px; 
        border-radius: 1rem;
        font-size: 0.7rem; 
        font-weight: 700;
        display: inline-block; 
        margin-bottom: 0.75rem;
    }

    .info-row {
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 6px;
        font-size: 0.8rem; 
        color: #64748b; 
        margin-bottom: 0.35rem;
    }
    .activation-dot { 
        width: 6px; 
        height: 6px; 
        border-radius: 50%; 
        display: inline-block; 
    } 
    .dot-green { 
        background: var(--emp-success); 
        box-shadow: 0 0 0 2px #d1fae5; 
    }
    .dot-yellow { 
        background: var(--emp-warning); 
        box-shadow: 0 0 0 2px #fef3c7; 
    }
    /* Action Buttons */
    .actions-grid {
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 8px;
        margin-top: auto;
    }
    .btn-action {
        border-radius: 0.85rem; 
        border: none; 
        padding: 0.6rem; 
        font-weight: 700; 
        font-size: 0.75rem;
        display: flex; 
        align-items: center; 
        justify-content: center;
        gap: 5px;
        transition: 0.2s; 
    }
    .btn-action i { 
        font-size: 0.8rem; 
    }
    
    .btn-lock { 
        background: #fff1f2; 
        color: var(--emp-rose); 
    }
    .btn-lock:hover { 
        background: var(--emp-rose); 
        color: white; 
    }
    
    .btn-unlock { 
        background: #ecfdf5; 
        color: var(--emp-success); 
    }
    .btn-unlock:hover { 
        background: var(--emp-success); 
        color: white; 
    }

    .btn-history { 
        background: #f1f5f9; 
        color: #64748b; 
    }
    .btn-history:hover { 
        background: #e2e8f0; 
        color: var(--emp-navy); 
    }

    .btn-resend {
        grid-column: span 2;
        background: var(--emp-navy); 
        color: white;
        margin-top: 4px; 
        border-radius: 0.85rem;
    }
    .btn-resend:hover { 
        background: #1e293b; 
    }

    /* Modal Design */
    .modal-security .modal-content {
        border-radius: var(--radius-card); 
        border: none; 
        box-shadow: 0 25px 50px -12px #01162833;
        padding: 0.5rem; 
    }
    .modal-backdrop.show { 
        backdrop-filter: blur(4px); 
        background-color: #01162880; }
    
    .modal-header { 
        border-bottom: none; 
        padding: 1.5rem 1.5rem 0.5rem; 
    } 
    .modal-body { 
        padding: 0.5rem 1.5rem 1.5rem; 
    }
    .modal-title-bold { 
        font-weight: 900; 
        color: var(--emp-navy); 
        font-size: 1.35rem; 
    }

    .form-label-caps {
        font-size: 0.65rem; 
        font-weight: 800; 
        text-transform: uppercase;
        letter-spacing: 0.05em; 
        color: #64748b; 
        margin-bottom: 0.25rem; 
        display: block;
    }
    
    .input-with-icon { 
        position: relative; 
        margin-bottom: 1rem; 
    } 
    .input-with-icon i {
        position: absolute; 
        left: 1rem; 
        top: 50%; 
        transform: translateY(-50%);
        color: #94a3b8; 
        font-size: 0.9rem;
    }
    .form-input-secure {
        width: 100%; 
        padding: 0.7rem 1rem 0.7rem 2.5rem; 
        border-radius: 1rem;
        background: #F8FAFC; 
        border: 1px solid #e2e8f0;
        font-weight: 600; 
        color: var(--emp-navy); 
        font-size: 0.9rem;
        transition: 0.2s;
    }
    .form-input-secure:focus { 
        outline: none; 
        border-color: var(--emp-indigo); 
        background: white; 
    }

    .simulation-alert {
        background: #fffbeb; 
        border: 1px solid #fcd34d;
        color: #92400e; 
        padding: 0.75rem; 
        border-radius: 1rem;
        font-size: 0.8rem; 
        display: flex; 
        gap: 8px; 
        align-items: start;
    }

    .success-view { 
        display: none; 
        text-align: center; 
        padding: 0.5rem 0; }
    .link-box {
        background: #1e293b; 
        color: #4ade80;
        font-family: monospace; 
        padding: 0.75rem;
        border-radius: 0.75rem; 
        word-break: break-all;
        margin: 1rem 0;  
        position: relative;
        text-align: left; 
        border: 1px solid #4ade80; 
        font-size: 0.85rem;
    }
    .link-box:hover::after {
        content: "Click để copy"; 
        position: absolute; top: -10px; 
        right: 10px;
        background: #4ade80; 
        color: #064e3b; 
        font-size: 0.65rem; 
        padding: 2px 6px; 
        border-radius: 4px; 
        font-weight: bold;
    }
    
    .zoom-in { 
        animation: zoomIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
    }
    @keyframes zoomIn { from { 
        opacity: 0; 
        transform: scale(0.95); 
        } to { 
        opacity: 1; 
        transform: scale(1); 
        } 
    }
</style>

<div class="emp-wrapper">
    <div class="emp-header">
        <div>
            <div class="emp-title">Nhân viên cửa hàng</div>
            <div class="emp-subtitle">Quản lý tài khoản và quyền truy cập nhân sự</div>
        </div>
        <button type="button" class="btn-add-staff" onclick="openAddModal()">
            <i class="fas fa-user-plus"></i> Thêm nhân viên
        </button>
    </div>

    <div class="emp-grid">
        <?php foreach ($employees as $emp): ?>
            <?php 
                $isActive = $emp->status === 'active';
                $isActivated = $emp->is_first_login == 0; 
            ?>
            <div class="emp-card" id="card-<?= $emp->id ?>" data-activated="<?= $isActivated ? '1' : '0' ?>">
                <?php if(!$isActive): ?>
                    <span class="status-ribbon status-locked">Bị khóa</span>
                <?php elseif(!$isActivated): ?>
                    <span class="status-ribbon status-pending">Chờ kích hoạt</span>
                <?php else: ?>
                    <span class="status-ribbon status-active">Đang hoạt động</span>
                <?php endif; ?>

                <div class="profile-box">
                    <div class="avatar-frame">
                        <img src="<?= APP_URL ?>/uploads/<?= $emp->avatar ?? 'default_avatar.png' ?>" class="avatar-img">
                    </div>
                    <div class="staff-name"><?= htmlspecialchars($emp->fullname) ?></div>
                    <div class="staff-username">@<?= htmlspecialchars($emp->username) ?></div>
                    
                    <div class="info-row">
                        <i class="fas fa-envelope"></i> <?= htmlspecialchars($emp->email) ?>
                    </div>
                    <div class="info-row">
                        <?php if($isActivated): ?>
                            <span class="activation-dot dot-green"></span> Đã kích hoạt
                        <?php else: ?>
                            <span class="activation-dot dot-yellow"></span> Chờ kích hoạt
                        <?php endif; ?>
                    </div>
                </div>

                <div class="actions-grid">
                    <?php if($isActive): ?>
                        <button class="btn-action btn-lock" onclick="toggleStatus(<?= $emp->id ?>, 'locked')">
                            <i class="fas fa-lock"></i> Khóa
                        </button>
                    <?php else: ?>
                        <button class="btn-action btn-unlock" onclick="toggleStatus(<?= $emp->id ?>, 'active')">
                            <i class="fas fa-unlock"></i> Mở khóa
                        </button>
                    <?php endif; ?>
                    
                    <button class="btn-action btn-history" onclick="viewHistory(<?= $emp->id ?>, '<?= htmlspecialchars($emp->fullname) ?>')">
                        <i class="fas fa-history"></i> Lịch sử
                    </button>

                    <button class="btn-action btn-resend" onclick="resendEmail(<?= $emp->id ?>)">
                        <i class="fas"></i> Gửi lại link
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade modal-security" id="addStaffModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content zoom-in">
            <div class="modal-header">
                <h5 class="modal-title-bold" id="modalTitle">Thêm nhân viên mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                
                <form id="addStaffForm">
                    <div class="mb-2">
                        <label class="form-label-caps">Họ và tên</label>
                        <div class="input-with-icon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" class="form-input-secure" name="fullname" required placeholder="Nguyễn Văn A">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-caps">Địa chỉ Gmail</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-input-secure" name="email" required placeholder="nhanvien@gmail.com">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm" style="background: var(--emp-indigo); border:none">
                        TẠO TÀI KHOẢN
                    </button>
                </form>

                <div id="successView" class="success-view">
                    <div style="width: 50px; height: 50px; background: #dcfce7; color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem; font-size: 1.5rem;">
                        <i class="fas fa-check"></i>
                    </div>
                    <h3 class="fw-bold mb-1" style="color: var(--emp-navy); font-size: 1.25rem;">Tạo thành công!</h3>
                    <p class="text-muted" style="font-size: 0.85rem">Link đăng nhập giả lập (1 phút):</p>
                    
                    <div class="link-box" id="generatedLink" onclick="copyLink()">
                        </div>

                    <button class="btn btn-light w-100 rounded-pill py-2 fw-bold" onclick="location.reload()">
                        HOÀN TẤT & LÀM MỚI
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055; margin-top: 60px;">
    <div id="appToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body fw-bold" id="toastMessage">
                </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<div class="modal fade" id="historyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: var(--radius-card); border: none; box-shadow: var(--shadow-card);">
            <div class="modal-header" style="background-color: var(--emp-bg); border-bottom: none; padding: 1.5rem 1.5rem 0.5rem;">
                <h5 class="modal-title" style="color: var(--emp-navy); font-weight: 700;">
                    LỊCH SỬ BÁN HÀNG
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <p style="font-size: 1.1rem; color: var(--emp-indigo); border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 15px;">
                    Nhân viên: <strong id="historyEmployeeName"></strong>
                </p>
                <div class="table-responsive">
                    <table class="table align-middle text-center">
                        <thead style="background-color: var(--emp-navy); color: white;">
                            <tr>
                                <th>HĐ</th>
                                <th>Thời gian</th>
                                <th>Khách</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody id="historyTableBody">
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let staffModal;

    // --- HÀM TIỆN ÍCH: HIỂN THỊ TOAST ---
    function showToast(message, type = 'success') {
        const toastEl = document.getElementById('appToast');
        const toastMessage = document.getElementById('toastMessage');
        
        toastEl.className = `toast align-items-center text-white border-0 bg-${type} shadow-lg`;
        toastMessage.innerText = message;
        
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    }

    function openAddModal() {
        if (!staffModal) {
            const modalElement = document.getElementById('addStaffModal');
            staffModal = new bootstrap.Modal(modalElement);
        }
        $('#addStaffForm').show();
        $('#successView').hide();
        $('#addStaffForm')[0].reset();
        $('#modalTitle').text('Thêm nhân viên mới');
        
        staffModal.show();
    }

    const addStaffForm = document.getElementById('addStaffForm');
    if(addStaffForm){
        addStaffForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerText;

            btn.disabled = true;
            btn.innerText = 'ĐANG XỬ LÝ...';

            fetch('<?= APP_URL ?>/employees/store', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Thêm nhân viên thành công!', 'success');
                    
                    // KHÔNG RELOAD TRANG: Ẩn form và hiện UI thành công kèm link
                    $('#addStaffForm').hide();
                    $('#successView').fadeIn();
                    // Lưu ý: Đảm bảo API store của bạn trả về data.debug_link giống hàm resend
                    $('#generatedLink').text(data.debug_link || 'Link kích hoạt đã được gửi vào email'); 
                } else {
                    showToast(data.message || 'Thêm thất bại!', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Có lỗi xảy ra, vui lòng thử lại.', 'danger');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = originalText;
            });
        });
    }

    function copyLink() {
        const text = $('#generatedLink').text();
        navigator.clipboard.writeText(text).then(() => {
            showToast('Đã copy link vào clipboard!', 'success');
        });
    }

    function toggleStatus(id, status) {
        $.post('<?= APP_URL ?>/employees/toggle-status', {id: id, status: status}, function(res) {
            if(res.success) {
                showToast('Cập nhật trạng thái thành công!', 'success');
                
                // KHÔNG RELOAD TRANG: Cập nhật trực tiếp UI thẻ nhân viên
                const card = $(`#card-${id}`);
                const btn = card.find(`button[onclick="toggleStatus(${id}, '${status}')"]`);
                const ribbon = card.find('.status-ribbon');
                
                // Lấy trạng thái kích hoạt từ attribute
                const isActivated = card.data('activated') == '1';

                if (status === 'locked') {
                    // Cập nhật giao diện thành Bị Khóa
                    ribbon.removeClass('status-active status-pending').addClass('status-locked').text('Bị khóa');
                    btn.removeClass('btn-lock').addClass('btn-unlock')
                       .attr('onclick', `toggleStatus(${id}, 'active')`)
                       .html('<i class="fas fa-unlock"></i> Mở khóa');
                } else {
                    // Cập nhật giao diện thành Đang Hoạt Động hoặc Chờ Kích Hoạt
                    if (isActivated) {
                        ribbon.removeClass('status-locked status-pending').addClass('status-active').text('Đang hoạt động');
                    } else {
                        ribbon.removeClass('status-locked status-active').addClass('status-pending').text('Chờ kích hoạt');
                    }
                    btn.removeClass('btn-unlock').addClass('btn-lock')
                       .attr('onclick', `toggleStatus(${id}, 'locked')`)
                       .html('<i class="fas fa-lock"></i> Khóa');
                }
            } else {
                showToast('Cập nhật thất bại!', 'danger');
            }
        }, 'json');
    }

    function resendEmail(id) {
        if(!confirm('Gửi lại link kích hoạt mới? Link cũ sẽ vô hiệu hóa.')) return;

        $.post('<?= APP_URL ?>/employees/resend-email', {id: id}, function(res) {
            if(res.success) {
                if (!staffModal) {
                    const modalElement = document.getElementById('addStaffModal');
                    staffModal = new bootstrap.Modal(modalElement);
                }
                
                $('#addStaffForm').hide();
                $('#successView').show();
                $('#generatedLink').text(res.debug_link);
                $('#modalTitle').text('Link kích hoạt mới');
                staffModal.show();
                
                showToast('Đã tạo link kích hoạt mới!', 'success');
            }
        }, 'json');
    }
    
    let historyModal;

    function viewHistory(employeeId, employeeName) {
        // Set tên nhân viên lên modal
        $('#historyEmployeeName').text(employeeName);
        $('#historyTableBody').html('<tr><td colspan="4" class="text-center text-muted">Đang tải dữ liệu...</td></tr>');
        
        // Mở modal
        if (!historyModal) {
            historyModal = new bootstrap.Modal(document.getElementById('historyModal'));
        }
        historyModal.show();

        // Gọi AJAX lấy lịch sử bán hàng
        $.get('<?= APP_URL ?>/employees/history', { id: employeeId }, function(res) {
            if (res.success) {
                let rows = '';
                if (res.data.length === 0) {
                    rows = '<tr><td colspan="4" class="text-center">Chưa có giao dịch nào.</td></tr>';
                } else {
                    res.data.forEach(function(order) {
                        // Format số tiền (vd: 6000000 -> 6M, 2500000 -> 2.5M)
                        let totalAmount = parseFloat(order.total_amount);
                        let totalStr = totalAmount >= 1000000 
                            ? (totalAmount / 1000000).toFixed(1).replace('.0', '') + 'M' 
                            : new Intl.NumberFormat('vi-VN').format(totalAmount);

                        rows += `<tr>
                            <td>#${order.id}</td>
                            <td>${order.created_at}</td>
                            <td>${order.customer_name || 'Khách lẻ'}</td>
                            <td class="text-success fw-bold">${totalStr}</td>
                        </tr>`;
                    });
                }
                $('#historyTableBody').html(rows);
            } else {
                $('#historyTableBody').html(`<tr><td colspan="4" class="text-center text-danger">Lỗi: ${res.message}</td></tr>`);
            }
        }, 'json').fail(function() {
            $('#historyTableBody').html('<tr><td colspan="4" class="text-center text-danger">Không thể kết nối đến máy chủ.</td></tr>');
        });
    }
</script>