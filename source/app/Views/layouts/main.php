<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SmartPOS Dashboard' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --bg-body: #F0F8FF;       
            --bg-sidebar: #01121E;    
            --color-primary: #0D6EFD; 
            --color-text-dark: #1F2937;
            --color-text-muted: #6B7280;
            --card-radius: 0.75rem;   
            --sidebar-width: 260px; 
            --sidebar-width-collapsed: 80px;  
            --transition-speed: 0.3s;
        }
        .preload * {
            -webkit-transition: none !important;
            -moz-transition: none !important;
            -ms-transition: none !important;
            -o-transition: none !important;
            transition: none !important;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Inter', sans-serif;
            color: var(--color-text-dark);
            font-size: 14px; 
            overflow-x: hidden;
        }

        /*Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--bg-sidebar);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            padding: 1rem 0.75rem; 
            z-index: 1000;
            transition: width var(--transition-speed) ease;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none;  
            -ms-overflow-style: none;  
        }
        
        /* Ẩn scrollbar */
        .sidebar::-webkit-scrollbar {
            display: none;
        }

        /* Header Sidebar */
        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
            min-height: 50px;
            flex-shrink: 0; 
        }

        .brand-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            overflow: hidden;
            white-space: nowrap;
            gap: 15px; 
            transition: all var(--transition-speed);
        }

        .brand-logo img {
            height: 50px; 
            width: auto;
            object-fit: contain;
            transition: all var(--transition-speed);
        }

        .brand-text {
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            font-size: 2rem; 
            color: #FFFFFF;
        }

        /* Nút Toggle Menu */
        #sidebarToggle {
            background: transparent;
            border: none;
            color: #94A3B8;
            font-size: 1.4rem;
            padding: 0 5px;
            transition: color 0.2s;
        }
        #sidebarToggle:hover {
            color: white;
        }

        /* Navigation Links */
        .nav-link {
            color: #94A3B8;
            font-weight: 500;
            padding: 0.85rem 0.75rem; 
            margin-bottom: 0.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 12px; 
            font-size: 0.95rem; 
            white-space: nowrap; 
            overflow: hidden;
            flex-shrink: 0;
        }

        .nav-link i {
            min-width: 24px; 
            text-align: center;
            font-size: 1.2rem;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .nav-link.active {
            background-color: #0F3D64;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        /* Sidebar Footer */
        .sidebar-footer {
            margin-top: auto;
            background: rgba(255,255,255,0.05);
            border-radius: 0.75rem;
            padding: 0.75rem; 
            display: flex;
            align-items: center;
            gap: 10px;
            overflow: hidden;
            transition: all var(--transition-speed);
            flex-shrink: 0;
        }
        .user-avatar {
            width: 36px; 
            height: 36px; 
            min-width: 36px;
            border-radius: 8px;
            object-fit: cover;
            display:block;
        }
        .user-avatar-text{
            width:36px;
            height:36px;
            border-radius:8px;
            background:#E2E8F0;
            color:#334155;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:800;
            font-size:0.9rem;
        }
       
        .user-info {
            white-space: nowrap;
            transition: opacity var(--transition-speed);
        }
        .user-info h6 { 
            margin: 0; 
            color: white; 
            font-size: 0.9rem; 
        }
        .user-info span { 
            font-size: 0.75rem; 
            color: #94A3B8; 
            text-transform: uppercase; 
        }

        .btn-logout {
            color: #EF4444;
            text-decoration: none;
            font-size: 0.9rem; 
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.5rem 0.75rem;
            white-space: nowrap;
            overflow: hidden;
            border-radius: 0.5rem;
            flex-shrink: 0;
        }
        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* Main Panel */
        .main-panel {
            margin-left: var(--sidebar-width);
            padding: 1.5rem 2rem; 
            width: calc(100% - var(--sidebar-width));
            transition: margin-left var(--transition-speed), width var(--transition-speed);
        }

        /* TRẠNG THÁI COLLAPSED */
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-width-collapsed);
        }

        body.sidebar-collapsed .main-panel {
            margin-left: var(--sidebar-width-collapsed);
            width: calc(100% - var(--sidebar-width-collapsed));
        }

        body.sidebar-collapsed .nav-link span,
        body.sidebar-collapsed .btn-logout span,
        body.sidebar-collapsed .user-info,
        body.sidebar-collapsed .brand-text,
        body.sidebar-collapsed .sidebar-footer {
            opacity: 0;
            width: 0;
            display: none; 
        }

        body.sidebar-collapsed .sidebar-header {
            flex-direction: column; 
            gap: 20px;
            padding-left: 0;
            align-items: center;
            justify-content: center;
        }

        body.sidebar-collapsed .brand-logo {
            gap: 0;
            justify-content: center;
            width: 100%;
        }

        body.sidebar-collapsed .brand-logo img {
            height: 40px; 
            width: auto;
        }

        body.sidebar-collapsed .nav-link,
        body.sidebar-collapsed .btn-logout {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        body.sidebar-collapsed .sidebar-footer {
            background: transparent;
            padding: 0;
            justify-content: center;
            display: flex;
            opacity: 1;
            width: auto;
        }
        body.sidebar-collapsed .user-avatar {
            margin: 0 auto 10px auto;
        }

        /* Top Bar & Others */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem; 
        }
        .breadcrumbs {
            font-size: 0.8rem; 
            font-weight: 700;
            color: #64748B;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .current-date {
            font-weight: 600;
            font-size: 0.9rem; 
            color: #1F2937;
        }
    </style>
</head>
<body class="preload">
    <script>
        if (sessionStorage.getItem('sidebar-collapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                document.body.classList.remove('preload');
            }, 50);
        });
    </script>

    <?php if(isset($_SESSION['user'])): ?>
    <div class="wrapper">
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="<?= APP_URL ?>/dashboard" class="brand-logo">
                    <img src="<?= APP_URL ?>/uploads/logoMAV.png" alt="MAVPOS">
                    <span class="brand-text">POS</span>
                </a>
                <button id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="d-flex flex-column w-100">
                <a href="<?= APP_URL ?>/dashboard" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false) ? 'active' : '' ?>" title="Tổng quan">
                    <i class="fas fa-th-large"></i> <span>Tổng quan</span>
                </a>
                
                <?php if($_SESSION['user']->role === 'staff'): ?>
                <a href="<?= APP_URL ?>/posale" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/pos') !== false) ? 'active' : '' ?>" title="Bán hàng">
                    <i class="fas fa-shopping-basket"></i> <span>Bán hàng</span>
                </a>
                <?php endif; ?>
                
                <a href="<?= APP_URL ?>/products" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/products') !== false) ? 'active' : '' ?>" title="Sản phẩm">
                    <i class="fas fa-box"></i> <span>Sản phẩm</span>
                </a>

                <?php if($_SESSION['user']->role === 'admin'): ?>
                <a href="<?= APP_URL ?>/categories" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/categories') !== false) ? 'active' : '' ?>" title="Danh mục">
                    <i class="fas fa-tags"></i> <span>Danh mục</span>
                </a>
                <a href="<?= APP_URL ?>/employees" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/employees') !== false) ? 'active' : '' ?>" title="Nhân viên">
                    <i class="fas fa-users"></i> <span>Nhân viên</span>
                </a>
                <?php endif; ?>
                
                <a href="<?= APP_URL ?>/reports" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/reports') !== false) ? 'active' : '' ?>" title="Báo cáo">
                    <i class="fas fa-chart-bar"></i> <span>Báo cáo</span>
                </a>
                <a href="<?= APP_URL ?>/profile" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/profile') !== false) ? 'active' : '' ?>" title="Hồ sơ">
                    <i class="fas fa-cog"></i> <span>Hồ sơ cá nhân</span>
                </a>
            </div>

            <div class="mt-auto w-100">
                <div class="sidebar-footer">
                    <?php
                    $fullName = trim($_SESSION['user']-> fullname ?? '');
                    $firstLetter = mb_strtoupper(mb_substr($fullName,0,1,'UTF-8'),'UTF-8');
                    $avatar = $_SESSION['user']->avatar ?? '';
                    $hasAvatar = !empty($avatar) && $avatar !== 'default_avatar.png';
                    ?>
                    <?php if($hasAvatar): ?>
                        <img src="<?= APP_URL ?>/uploads/<?= $avatar ?>" class="user-avatar" onerror="this.outerHTML='<div class=\'user-avatar-text\'><?= $firstLetter ?></div>'">
                        <?php else: ?>
                            <div class="user-avatar-text"><?= $firstLetter ?></div>
                        <?php endif; ?>    
                    <div class="user-info">
                        <h6>Hệ thống Quản trị</h6>
                        <span><?= htmlspecialchars($_SESSION['user']->fullname ?? 'Người dùng') ?></span>
                    </div>
                </div>
                <a href="<?= APP_URL ?>/logout" class="btn-logout" title="Đăng xuất">
                    <i class="fas fa-sign-out-alt"></i> <span>Đăng xuất</span>
                </a>
            </div>
        </nav>

        <div class="main-panel">
            <div class="top-bar">
               <div class="breadcrumbs">
                <span style="color: #3B82F6;">Trang chủ</span> 
                <i class="fas fa-chevron-right fa-xs mx-2" style="color: #94A3B8;"></i>
                <span style="color: #64748B;"><?= mb_strtoupper($title ?? 'TỔNG QUAN', 'UTF-8') ?></span>
               </div>
                <div class="current-date">
                    <?= mb_strtoupper(['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'][date('w')] . date(', d \t\h\á\n\g m \n\ă\m Y'), 'UTF-8') ?>
                </div>
            </div>

            <?php require $viewFile; ?>
        </div>
    </div>
    <?php else: ?>
        <?php require $viewFile; ?>
    <?php endif; ?>

    <script>
        $(document).ready(function() {
            $('#sidebarToggle').click(function() {
                $('body').toggleClass('sidebar-collapsed');
                if ($('body').hasClass('sidebar-collapsed')) {
                    sessionStorage.setItem('sidebar-collapsed', 'true');
                } else {
                    sessionStorage.setItem('sidebar-collapsed', 'false');
                }
            });
        });
    </script>
</body>
</html>