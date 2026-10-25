<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Giá trị riêng của môi trường (mật khẩu DB, SMTP...) nằm trong config.local.php, không commit.
if (file_exists(__DIR__ . '/config.local.php')) {
    require_once __DIR__ . '/config.local.php';
}

function mav_define($name, $default) {
    if (!defined($name)) {
        $env = getenv($name);
        define($name, $env !== false ? $env : $default);
    }
}

mav_define('DB_HOST', 'localhost');
mav_define('DB_NAME', 'MAVPOS');
mav_define('DB_USER', 'root');
mav_define('DB_PASS', '');

mav_define('APP_URL', 'http://localhost/mav-web-pos/source/public');
mav_define('APP_NAME', 'MAVPOS');
mav_define('APP_DEBUG', false);

// BASE_URL suy ra từ APP_URL để không phải khai báo hai lần
mav_define('BASE_URL', rtrim((string)parse_url(APP_URL, PHP_URL_PATH), '/'));

// SMTP Mail Settings
mav_define('SMTP_HOST', 'smtp.gmail.com');
mav_define('SMTP_USERNAME', 'mavpos.project@gmail.com');
mav_define('SMTP_PASSWORD', '');
mav_define('SMTP_PORT', 587);
mav_define('SMTP_FROM_NAME', 'MAVPOS System');
