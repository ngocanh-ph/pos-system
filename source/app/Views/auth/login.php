<?php 
$title = 'Đăng nhập MAVPOS'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --color-primary: #042642;
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

    .login-container {
        width: 1000px;
        max-width: 95%;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 20px #044377;
        overflow: hidden;
        display: flex;
        min-height: 600px;
    }

    .left-panel {
        background-color: var(--color-primary);
        width: 45%;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        position: relative;
    }

    .logo-img {
        width: 100px;
        height: auto;
        object-fit: contain;
    }

    .brand-title {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 28px;
        line-height: 1.3;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .brand-subtitle {
        font-weight: 700;
        font-size: 30px;
        color: #9CD1FC;
    }

    .right-panel {
        width: 55%;
        padding: 50px 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: white;
        font-family: 'Times New Roman', serif;
    }

    .greeting-text {
        font-family: 'Times New Roman', serif;
        color: var(--color-primary);
        font-size: 32px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 40px;
        text-transform: uppercase;
    }
    .form-group {
        margin-bottom: 25px;
    }

    .form-label-custom {
        color: var(--color-primary);
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 8px;
        display: block;
        font-family: 'Times New Roman', serif;
    }

    .input-wrapper {
        position: relative;
    }

    .form-control-custom {
        width: 100%;
        background-color: var(--color-bg-input);
        border: 1px solid transparent;
        border-radius: 10px;
        padding: 15px 15px 15px 45px;
        font-size: 14px;
        color: #333;
        transition: all 0.3s;
        font-family: 'Times New Roman', serif;
    }

    .form-control-custom::placeholder {
        color: #8faec7;
        font-family: 'Times New Roman', serif;
    }

    .form-control-custom:focus {
        background-color: #fff;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 4px rgba(4, 38, 66, 0.1);
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

    .btn-login {
        background-color: var(--color-primary);
        color: white;
        font-family: 'Times New Roman', serif;
        font-weight: 700;
        font-size: 20px;
        padding: 12px;
        border-radius: 10px;
        width: 100%;
        border: none;
        margin-top: 20px;
        transition: all 0.3s;
    }

    .btn-login:hover {
        background-color: #021629;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(4, 38, 66, 0.3);
    }

    .alert-error {
        background-color: #fee2e2;
        border: 1px solid #ef4444;
        color: #b91c1c;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: 'Times New Roman', serif;
    }
    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
            height: auto;
            min-height: auto;
        }

        .left-panel,
        .right-panel {
            width: 100%;
            padding: 30px;
        }

        .left-panel {
            padding: 40px 20px;
        }

        .brand-title {
            font-size: 30px;
        }

        .greeting-text {
            font-size: 24px;
            margin-bottom: 25px;
        }
    }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="left-panel">
            <div class="logo-wrapper">
                <img src="<?= BASE_URL ?>/uploads/logoMAV.png" alt="MAVPOS Logo" class="logo-img">
            </div>

            <div class="brand-text">
                <div class="brand-title">ĐĂNG NHẬP</div>
                <div class="brand-title">HỆ THỐNG</div>
                <div class="brand-subtitle">MAVPOS</div>
            </div>
        </div>

        <div class="right-panel">
            <h2 class="greeting-text">XIN CHÀO!</h2>

            <?php if(!empty($error)): ?> <div class="alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
            <?php endif; ?>

            <form action="login" method="POST">

                <div class="form-group">
                    <label class="form-label-custom">Tài khoản</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="username" class="form-control-custom"
                            placeholder="Nhập tên đăng nhập..." required autocomplete="username">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label-custom">Mật khẩu</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i> <input type="password" name="password"
                            class="form-control-custom" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    Đăng nhập
                </button>

            </form>
        </div>
    </div>

</body>

</html>