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
    .font-black {
        font-weight: 800;
        letter-spacing: -0.01em;
    }

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

    .avatar-text {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        background: #E2E8F0;
        color: #334155;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 800;
        text-transform: uppercase;
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
        cursor: pointer;
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
        color: var(--box-blue-text);
    }

    .box-security {
        background: var(--box-pink-bg);
        color: var(--box-pink-text);
    }

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
        border-color: #044377;
        outline: none;
        box-shadow: 0 10px 25px #0000001a;
    }

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

    .eye-toggle:hover {
        color: var(--p-navy);
    }

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
        cursor: pointer;
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
</style>

<div class="profile-wrapper">
    <div class="hero-card">
        <div class="avatar-area">
            <?php
                $fullName = trim($_SESSION['user']->fullname);
                $firstLetter = mb_strtoupper(mb_substr($fullName, 0, 1, 'UTF-8'), 'UTF-8');
                $avatar = $_SESSION['user']->avatar ?? '';
                $hasAvatar = !empty($avatar) && $avatar !== 'default_avatar.png';
            ?>

            <?php if($hasAvatar): ?>
                <img 
                    id="avatarPreview"
                    src="<?= APP_URL ?>/uploads/<?= $avatar ?>"
                    class="avatar-img"
                    onerror="this.outerHTML='<div class=\'avatar-text\'><?= $firstLetter ?></div>'"
                >
            <?php else: ?>
                <div id="avatarPreview" class="avatar-text"><?= $firstLetter ?></div>
            <?php endif; ?>

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
                            <input type="text" class="form-input" name="phone" value="<?= htmlspecialchars($_SESSION['user']->phone ?? '') ?>">
                            <div class="field-icon"><i class="fas fa-phone-alt" style="font-size: 0.9rem"></i></div>
                        </div>
                    </div>

                    <button type="submit" class="btn-action btn-blue mt-3">
                        LƯU HỒ SƠ
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="content-card">
                <div class="card-header-flex">
                    <div class="icon-box box-security"><i class="fas fa-lock"></i></div>
                    <h3 class="card-title font-black">Bảo mật</h3>
                </div>

                <form id="securityForm">
                    <div class="mb-4">
                        <label class="label-caps">MẬT KHẨU HIỆN TẠI</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-input" id="currentPass" name="current_password" placeholder="••••••••" required>
                            <div class="field-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="eye-toggle" onclick="togglePass('currentPass')"><i class="far fa-eye"></i></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label-caps">MẬT KHẨU MỚI</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-input" id="newPass" name="new_password" placeholder="••••••••" required>
                            <div class="field-icon"><i class="fas fa-unlock-alt"></i></div>
                            <div class="eye-toggle" onclick="togglePass('newPass')"><i class="far fa-eye"></i></div>
                        </div>
                    </div>

                    <button type="submit" class="btn-action btn-navy mt-3">
                        ĐỔI MẬT KHẨU
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1060;">
    <div id="profileActionToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="profileToastMessage" style="font-weight: 500; font-size: 0.95rem;">
                Thành công!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= APP_URL ?>";

    // Xử lý xem trước ảnh đại diện
    $('#avatarUpload').change(function() {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement("img");
            img.id = "avatarPreview";
            img.className = "avatar-img";
            img.src = e.target.result;
            $('#avatarPreview').replaceWith(img);
        }
        reader.readAsDataURL(file);
    });

    // Ẩn/hiện mật khẩu
    function togglePass(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    // Hiển thị thông báo Toast
    function showToast(msg, isError = false) {
        const toastEl = document.getElementById('profileActionToast');
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl, {
                delay: 3000
            });

            if (isError) {
                $('#profileActionToast').removeClass('bg-success').addClass('bg-danger');
            } else {
                $('#profileActionToast').removeClass('bg-danger').addClass('bg-success');
            }

            $('#profileToastMessage').text(msg);
            toast.show();
        } else {
            alert((isError ? "LỖI: " : "THÀNH CÔNG: ") + msg);
        }
    }

    // Xử lý form lưu hồ sơ
    $('#infoForm').submit(function(e) {
        e.preventDefault();
        const btn = $(this).find('button');
        const formData = new FormData(this);

        btn.prop('disabled', true).text('Đang lưu...');

        $.ajax({
            url: BASE_URL + '/profile/update-info',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.success) {
                    showToast("Cập nhật hồ sơ thành công!");
                    $('.hero-info h1').text($('input[name="fullname"]').val());
                } else {
                    showToast(res.message, true);
                }
            },
            error: function() {
                showToast("Có lỗi xảy ra khi kết nối máy chủ", true);
            },
            complete: function() {
                btn.prop('disabled', false).text('LƯU HỒ SƠ');
            }
        });
    });

    // Xử lý form đổi mật khẩu
    $('#securityForm').submit(function(e) {
        e.preventDefault();

        const btn = $(this).find('button');
        const data = $(this).serialize();

        btn.prop('disabled', true).text('Đang xử lý...');

        $.post(BASE_URL + '/profile/change-password', data, function(res) {
                if (res.success) {
                    showToast("Cập nhật mật khẩu thành công!");
                    $('#securityForm')[0].reset();
                } else {
                    showToast(res.message, true);
                }
            }, 'json')
            .fail(function() {
                showToast("Có lỗi xảy ra khi kết nối máy chủ", true);
            })
            .always(function() {
                btn.prop('disabled', false).text('ĐỔI MẬT KHẨU');
            });
    });
</script>