<style>
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

    --shadow-card: 0 10px 25px -5px rgba(1, 22, 40, 0.08);
    --shadow-btn: 0 4px 10px -2px rgba(4, 67, 119, 0.2);
}

/* Base Layout */
.emp-wrapper {
    background-color: var(--emp-bg);
    font-family: 'Inter', sans-serif;
    padding: 0.5rem;
    min-height: 85vh;
}

/* 1. Header & Action Bar */
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
    box-shadow: 0 10px 20px -5px rgba(4, 67, 119, 0.4);
    background-color: #033055;
    color: white;
}

/* 2. Employee Grid */
.emp-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1rem;
    padding-bottom: 2rem;
}

/* 3. Employee Card */
.emp-card {
    background: var(--emp-white);
    border-radius: var(--radius-card);
    padding: 1.25rem;
    position: relative;
    border: 1px solid rgba(176, 218, 253, 0.4);
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
    box-shadow: 0 5px 10px -3px rgba(0, 0, 0, 0.05);
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
    /* Compact button */
    font-weight: 700;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    transition: 0.2s;
    cursor: pointer;
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

/* 4. Modal Design */
.modal-security .modal-content {
    border-radius: var(--radius-card);
    border: none;
    box-shadow: 0 25px 50px -12px rgba(1, 22, 40, 0.2);
    padding: 0.5rem;
}

.modal-backdrop.show {
    backdrop-filter: blur(4px);
    background-color: rgba(1, 22, 40, 0.5);
}

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

/* Success State in Modal */
.success-view {
    display: none;
    text-align: center;
    padding: 0.5rem 0;
}

.link-box {
    background: #1e293b;
    color: #4ade80;
    font-family: monospace;
    padding: 0.75rem;
    border-radius: 0.75rem;
    word-break: break-all;
    margin: 1rem 0;
    cursor: pointer;
    position: relative;
    text-align: left;
    border: 1px solid #4ade80;
    font-size: 0.85rem;
}

.link-box:hover::after {
    content: "Click để copy";
    position: absolute;
    top: -10px;
    right: 10px;
    background: #4ade80;
    color: #064e3b;
    font-size: 0.65rem;
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: bold;
}

/* Animations */
.fade-in {
    animation: fadeIn 0.4s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(15px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.zoom-in {
    animation: zoomIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

@keyframes zoomIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }

    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<div class="emp-wrapper fade-in">
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
                $isActivated = $emp->require_password_change == 0; 
            ?>
        <div class="emp-card" id="card-<?= $emp->id ?>">
            <?php if($isActive): ?>
            <span class="status-ribbon status-active">Đang hoạt động</span>
            <?php else: ?>
            <span class="status-ribbon status-locked">Bị khóa</span>
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

                <button class="btn-action btn-history">
                    <i class="fas fa-history"></i> Lịch sử
                </button>

                <button class="btn-action btn-resend" onclick="resendEmail(<?= $emp->id ?>)">
                    <i class="fas fa-paper-plane"></i> Gửi lại link
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>