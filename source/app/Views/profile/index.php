<style>
    :root {
        --p-bg: #F0F8FF;           
        --p-navy: #011628;        
        --p-blue-btn: #044377;    
        --p-input-bg: #F0F8FF;     
        --p-icon-gray: #94A3B8;   
        --p-radius-card: 32px;     
        --p-radius-input: 12px;   
        
        --box-blue-bg: #F0F9FF;    
        --box-blue-text: #0284C7;
        --box-pink-bg: #FFF1F2;
        --box-pink-text: #E11D48;
    }

    .profile-wrapper {
        background-color: var(--p-bg);
        font-family: 'Inter', sans-serif;
        color: var(--p-navy);
        padding: 1rem;
        min-height: 85vh;
    }

    /* Typography */
    .font-black { font-weight: 800; letter-spacing: -0.01em; }
    .label-caps {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748B; 
        margin-bottom: 0.5rem;
        display: block;
    }

    /* HERO CARD */
    .hero-card {
        background: white;
        border-radius: var(--p-radius-card);
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        box-shadow: 0 4px 6px -1px #00000005;
        margin-bottom: 2rem;
    }

    .avatar-area {
        position: relative;
        width: 100px; 
        height: 100px;
    }
    .avatar-img {
        width: 100%; 
        height: 100%;
        object-fit: cover;
        border-radius: 20px; 
        border: 4px solid white;
        box-shadow: 0 10px 15px -3px #0000001a;
    }
    .btn-cam {
        position: absolute;
        bottom: -5px; 
        right: -5px;
        background: #044377;
        color: white;
        width: 32px; 
        height: 32px;
        border-radius: 8px; 
        border: 2px solid white;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 0.9rem;
    }

    .hero-info h1 {
        font-size: 1.75rem; 
        margin-bottom: 0.25rem;
        color: var(--p-navy);
    }
    .hero-email {
        color: #508ABA;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 1rem;
        font-style: italic;
    }

    .badge-row { 
        display: flex; 
        gap: 10px; 
    }
    .badge-custom {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
    }
    .bg-role { 
        background: #E0F2FE; 
        color: #0369A1; 
    }
    .bg-status { 
        background: #ECFDF5; 
        color: #059669; 
        display: flex; 
        align-items: center; 
        gap: 6px; 
    }
    .dot { 
        width: 6px; 
        height: 6px; 
        background: #059669; 
        border-radius: 50%; 
    }

    /* MAIN CARDS */
    .content-card {
        background: white;
        border-radius: var(--p-radius-card);
        padding: 2.5rem;
        height: 100%;
        box-shadow: 0 4px 6px -1px #00000005;
    }

    /*Header Icon Box*/
    .card-header-flex {
        display: flex; 
        align-items: center; 
        gap: 1rem; 
        margin-bottom: 2rem;
    }
    .icon-box {
        width: 48px; 
        height: 48px;
        border-radius: 12px;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 1.25rem;
    }
    .box-info { 
        background: var(--box-blue-bg); 
        color: var(--box-blue-text); }
    .box-security { 
        background: var(--box-pink-bg); 
        color: var(--box-pink-text); }

    .card-title {
        font-size: 1.25rem;
        color: var(--p-navy);
        margin: 0;
    }

    /* INPUT STYLES */
    .input-wrapper {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-input {
        width: 100%;
        height: 52px; 
        background-color: var(--p-input-bg);
        border: 1px solid transparent; 
        border-radius: var(--p-radius-input);
        padding-left: 50px; 
        padding-right: 15px;
        font-weight: 700;
        color: var(--p-navy);
        font-size: 0.95rem;
        transition: all 0.2s;
    }
    
    .form-input:focus {
        background-color: white;
        border-color: #38BDF8; 
        outline: none;
        box-shadow: 0 0 0 4px #38bdf81a;
    }

    /* Căn giữa cho Icon */
    .field-icon {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 50px; 
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--p-icon-gray); 
        font-size: 1.1rem;
        pointer-events: none; 
        transition: color 0.2s;
    }
    
    /* Khi focus input thì icon đổi màu */
    .form-input:focus + .field-icon {
        color: #044377;
    }

    .eye-toggle {
        position: absolute;
        right: 0; 
        top: 0; 
        bottom: 0;
        width: 50px;
        display: flex; 
        align-items: center; 
        justify-content: center;
        color: var(--p-icon-gray);
        cursor: pointer;
    }
    .eye-toggle:hover { color: var(--p-navy); }

    /* BUTTONS */
    .btn-action {
        width: 100%;
        height: 52px;
        border-radius: var(--p-radius-input);
        border: none;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.9rem;
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 10px;
        transition: transform 0.1s;
    }
    .btn-action:active { 
        transform: scale(0.98); 
    }

    .btn-blue {
        background-color: var(--p-blue-btn); 
        color: white;
    }
    .btn-navy {
        background-color: var(--p-navy); 
        color: white;
    }

    /* Toast */
    .toast-custom {
        position: fixed; 
        top: -80px; 
        left: 50%; 
        transform: translateX(-50%);
        background: #011628e6; 
        color: white;
        padding: 12px 24px; 
        border-radius: 50px;
        font-weight: 600; 
        font-size: 0.9rem;
        display: flex; 
        align-items: center; 
        gap: 10px;
        z-index: 9999; 
        transition: top 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .toast-custom.show { 
        top: 30px; 
        }
</style>

<div class="profile-wrapper">
    <div id="toast" class="toast-custom">
        <i class="fas fa-check-circle text-success"></i> <span id="toastMsg">Thành công</span>
    </div>

    <div class="hero-card">
        <div class="avatar-area">
            <img id="avatarPreview" src="<?= APP_URL ?>/uploads/<?= $_SESSION['user']->avatar ?? 'default_avatar.png' ?>" class="avatar-img">
            <label for="avatarUpload" class="btn-cam">
                <i class="fas fa-camera"></i>
            </label>
        </div>
        <div class="hero-info">
            <h1 class="font-black"><?= htmlspecialchars($_SESSION['user']->fullname) ?></h1>
            <div class="hero-email"><?= htmlspecialchars($_SESSION['user']->email) ?></div>
            
            <div class="badge-row">
                <span class="badge-custom bg-role">
                    <?= strtoupper($_SESSION['user']->role === 'admin' ? 'ADMINISTRATOR' : 'STAFF') ?>
                </span>
                <span class="badge-custom bg-status">
                    <span class="dot"></span> ACTIVE
                </span>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-6">
            <div class="content-card">
                <div class="card-header-flex">
                    <div class="icon-box box-info"><i class="far fa-user"></i></div>
                    <h3 class="card-title font-black">Hồ sơ cá nhân</h3>
                </div>

                <form id="infoForm" enctype="multipart/form-data">
                    <input type="file" id="avatarUpload" name="avatar" hidden accept="image/*">
                    
                    <div class="mb-4">
                        <label class="label-caps">HỌ TÊN</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-input" name="fullname" value="<?= htmlspecialchars($_SESSION['user']->fullname) ?>" required>
                            <div class="field-icon"><i class="far fa-user"></i></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label-caps">ĐIỆN THOẠI</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-input" name="phone" value="<?= htmlspecialchars($_SESSION['user']->phone ?? '0123456789') ?>">
                            <div class="field-icon"><i class="fas fa-phone-alt" style="font-size: 0.9rem"></i></div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-action btn-blue mt-3">
                        <i class="far fa-save"></i> LƯU HỒ SƠ
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="content-card">
                <div class="card-header-flex">
                    <div class="icon-box box-security"><i class="fas fa-lock"></i></div> <h3 class="card-title font-black">Bảo mật</h3>
                </div>

                <form id="securityForm">
                    <div class="mb-4">
                        <label class="label-caps">MẬT KHẨU MỚI</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-input" id="newPass" name="new_password" placeholder="••••••••" required>
                            <div class="field-icon"><i class="fas fa-unlock-alt"></i></div>
                            <div class="eye-toggle" onclick="togglePass('newPass')"><i class="far fa-eye"></i></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label-caps">XÁC NHẬN</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-input" id="confirmPass" name="confirm_password" placeholder="••••••••" required>
                            <div class="field-icon"><i class="fas fa-shield-alt"></i></div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="current_password" value="demo_bypass"> 

                    <button type="submit" class="btn-action btn-navy mt-3">
                        <i class="fas fa-shield-alt"></i> ĐỔI MẬT KHẨU
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    //  Avatar Preview
    $('#avatarUpload').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) { $('#avatarPreview').attr('src', e.target.result); }
            reader.readAsDataURL(file);
        }
    });

    // Toggle Password
    function togglePass(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    // Toast UI
    function showToast(msg, isError = false) {
        const toast = $('#toast');
        $('#toastMsg').text(msg);
        toast.find('i').attr('class', isError ? 'fas fa-times-circle text-danger' : 'fas fa-check-circle text-success');
        toast.addClass('show');
        setTimeout(() => toast.removeClass('show'), 3000);
    }

    // Update Info
    $('#infoForm').submit(function(e) {
        e.preventDefault();
        const btn = $(this).find('button');
        const formData = new FormData(this);
        
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Đang lưu...');
        
        $.ajax({
            url: '/profile/update-info',
            type: 'POST',
            data: formData,
            contentType: false, processData: false,
            success: function(res) {
                if(res.success) { 
                    showToast(res.message); 
                    $('.hero-info h1').text($('input[name="fullname"]').val()); 
                } else { 
                    showToast(res.message, true); 
                }
            },
            complete: function() { 
                btn.prop('disabled', false).html('<i class="far fa-save"></i> LƯU HỒ SƠ'); 
            }
        });
    });

    // Change Password
    $('#securityForm').submit(function(e) {
        e.preventDefault();
        
        const p1 = $('#newPass').val();
        const p2 = $('#confirmPass').val();
        if(p1 !== p2) { showToast('Mật khẩu xác nhận không khớp', true); return; }

        const btn = $(this).find('button');
        const currentPass = prompt("Vui lòng nhập mật khẩu hiện tại để xác nhận:");
        if(!currentPass) return;

        const data = $(this).serialize() + "&current_password=" + encodeURIComponent(currentPass);
        
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Xử lý...');
        
        $.post('/profile/change-password', data, function(res) {
            if(res.success) { 
                showToast(res.message); 
                $('#securityForm')[0].reset(); 
            } else { 
                showToast(res.message, true); 
            }
        }, 'json').always(function() { 
            btn.prop('disabled', false).html('<i class="fas fa-shield-alt"></i> ĐỔI MẬT KHẨU'); 
        });
    });
</script>