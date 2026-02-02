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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root{
            --bg-body: #F0F8FF;       
            --bg-sidebar: #01121E;    
            --color-primary: #0D6EFD; 
            --color-text-dark: #1F2937;
            --color-text-muted: #6B7280;
            --card-radius: 0.75rem;   
            --sidebar-width: 240px;
        }
        body{
            background-color: var(--bg-body);
            font-family: 'Inter', sans-serif;
            color: var(--color-text-dark);
            font-size: 14px; 
            overflow-x: hidden;
        }
        /*SIDEBAR*/
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
        }
        .brand-logo {
            color: white;
            text-decoration: none;
            font-size: 1.25rem; 
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem; 
            padding-left: 0.5rem;
        }
        .nav-link {
            color: #94A3B8;
            font-weight: 500;
            padding: 0.6rem 0.75rem; 
            margin-bottom: 0.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 10px; 
            font-size: 0.9rem; 
        }
        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .nav-link.active {
            background-color: #0F3D64;
            color: white;
            font-weight: 600;
        }
        
        .nav-link.active .badge-pos {
            background: #fff;
            color: #0F3D64;
        }
        /*Thông tin người dùng */
        .sidebar-footer {
            margin-top: auto;
            background: rgba(255,255,255,0.05);
            border-radius: 0.75rem;
            padding: 0.75rem; 
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-avatar {
            width: 32px; height: 32px; 
            border-radius: 6px;
            object-fit: cover;
        }
        .user-infor h6{
            margin:0;
            color: white;
            font-size: 0.85 rem;
        }
        .btn-logout{
            color: #EF4444;
            text-decoration: none;
            font-size: 0.85rem; 
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-left: 0.5rem;
        } 
        .main-panel {
            margin-left: var(--sidebar-width);
            padding: 1.5rem 2rem; 
            width: calc(100% - var(--sidebar-width));
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem; 
        }
        .breadcrumbs {
            font-size: 0.75rem; 
            font-weight: 700;
            color: #64748B;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .current-date {
            font-weight: 600;
            font-size: 0.85rem; 
            color: #1F2937;
        }
        .badge-pos {
            margin-left: auto;
            background: #3B82F6;
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    
</body>
</html>