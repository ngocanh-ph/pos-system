<?php

class Security {
    const FORCE_CHANGE_ALLOWED = ['/force-change-password', '/logout'];

    public static function startSession() {
        if (session_status() !== PHP_SESSION_NONE) {
            return;
        }
        $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/',
            'secure'   => $https,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }

    public static function csrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function csrfField() {
        return '<input type="hidden" name="_csrf" value="' . htmlspecialchars(self::csrfToken()) . '">';
    }

    /** Kiểm tra token CSRF cho mọi request thay đổi dữ liệu. */
    public static function verifyCsrf() {
        $sent = $_POST['_csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
        $valid = !empty($_SESSION['csrf_token']) && is_string($sent) && hash_equals($_SESSION['csrf_token'], $sent);
        if ($valid) {
            return;
        }
        http_response_code(419);
        if (self::wantsJson()) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Phiên làm việc đã hết hạn, vui lòng tải lại trang.']);
        } else {
            echo 'Phiên làm việc đã hết hạn, vui lòng tải lại trang.';
        }
        exit;
    }

    public static function wantsJson() {
        return (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest')
            || stripos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false
            || stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false
            || isset($_SERVER['HTTP_X_CSRF_TOKEN']);
    }

    /**
     * Nạp lại user từ DB cho mỗi request: role/status thay đổi có hiệu lực ngay,
     * tài khoản bị khóa/xóa bị đăng xuất, và hash mật khẩu không nằm trong session.
     */
    public static function refreshUser() {
        if (empty($_SESSION['user'])) {
            return;
        }
        $fresh = (new User())->find($_SESSION['user']->id);
        if (!$fresh || $fresh->status === 'locked') {
            $_SESSION = [];
            session_regenerate_id(true);
            return;
        }
        unset($fresh->password);
        $_SESSION['user'] = $fresh;
    }

    /** User chưa đổi mật khẩu lần đầu chỉ được vào trang đổi mật khẩu / đăng xuất (áp dụng cả API JSON). */
    public static function enforceForcePassword($path) {
        $user = $_SESSION['user'] ?? null;
        if (!$user || empty($user->is_first_login) || in_array($path, self::FORCE_CHANGE_ALLOWED, true)) {
            return;
        }
        if (self::wantsJson()) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Vui lòng đổi mật khẩu trước khi tiếp tục.']);
            exit;
        }
        header('Location: ' . rtrim(APP_URL, '/') . '/force-change-password');
        exit;
    }

    public static function flash($type, $message) {
        $_SESSION['flash'][$type] = $message;
    }

    public static function pullFlash($type) {
        $msg = $_SESSION['flash'][$type] ?? null;
        unset($_SESSION['flash'][$type]);
        return $msg;
    }
}
