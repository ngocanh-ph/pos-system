<?php 
$title = 'Đổi mật khẩu';
$isForced = $_SESSION['user']->is_first_login ?? 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --color-primary: #044377;
            --color-bg-input: #F0F8FF; 
            --color-text-label: #1a4a75;
        }

        body {
            background-color: #f5f9fc;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .card-custom {
            width: 100%;
            max-width: 500px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(4, 67, 119, 0.2);
            padding: 40px;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }
        .logo-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-img {
            width: 80px;
            height: auto;
            object-fit: contain;
        }

        .form-title {
            color: var(--color-primary);
            font-size: 26px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .form-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 15px;
            margin-bottom: 30px;
            font-weight: 500;
        }
        .form-group {
            margin-bottom: 20px;
        }

        .form-label-custom {
            color: var(--color-primary);
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 8px;
            display: block;
            font-family: 'Inter', sans-serif;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control-custom {
            width: 100%;
            background-color: var(--color-bg-input);
            border: 1px solid transparent;
            border-radius: 10px;
            padding: 12px 12px 12px 45px;
            font-size: 15px;
            color: #333;
            transition: all 0.3s;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
        }

        .form-control-custom:focus {
            background-color: #fff;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(4, 67, 119, 0.15);
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6a8db1;
            font-size: 18px;
        }

        .btn-submit {
            background-color: var(--color-primary);
            color: white;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 16px;
            padding: 14px;
            border-radius: 10px;
            width: 100%;
            border: none;
            transition: all 0.3s;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit:hover {
            background-color: #033259;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(4, 67, 119, 0.3);
        }

        .btn-link-custom {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: color 0.2s;
        }
        .btn-link-custom:hover {
            color: var(--color-primary);
        }

        .alert-custom {
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-danger {
            background-color: #fee2e2;
            border: 1px solid #ef4444;
            color: #b91c1c;
        }
    </style>
</head>
<body>

    <div class="card-custom">
        <div class="logo-wrapper">
            <img src="<?= APP_URL ?>/uploads/logoMAV.png" alt="MAVPOS Logo" class="logo-img">
        </div>

        <h2 class="form-title"><?= $isForced ? 'YÊU CẦU ĐỔI MẬT KHẨU' : 'ĐỔI MẬT KHẨU' ?></h2>

        <?php if(!$isForced): ?>
            <p class="form-subtitle">Nhập mật khẩu mới để bảo mật tài khoản</p>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="alert-custom alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= APP_URL ?>/force-change-password" method="POST">
            
            <div class="form-group">
                <label class="form-label-custom">Mật khẩu mới</label>
                <div class="input-wrapper">
                    <i class="fas fa-key input-icon"></i>
                    <input type="password" class="form-control-custom" name="new_password" placeholder="Nhập mật khẩu mới..." required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label-custom">Xác nhận mật khẩu</label>
                <div class="input-wrapper">
                    <i class="fas fa-check-circle input-icon"></i>
                    <input type="password" class="form-control-custom" name="confirm_password" placeholder="Nhập lại mật khẩu..." required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Cập nhật
            </button>

            <?php if(!$isForced): ?>
                <a href="<?= APP_URL ?>/dashboard" class="btn-link-custom">
                    <i class="fas fa-arrow-left"></i> Hủy bỏ
                </a>
            <?php else: ?>
                <a href="<?= APP_URL ?>/logout" class="btn-link-custom">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            <?php endif; ?>

        </form>
    </div>

</body>
</html>