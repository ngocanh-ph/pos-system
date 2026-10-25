<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/LoginToken.php';
require_once __DIR__ . '/../Models/LoginAttempt.php';

class AuthController extends Controller {

    public function login() {
        if (isset($_SESSION['user'])) {
            $this->redirect('/dashboard');
            return;
        }
        $data = [];
        if ($error = Security::pullFlash('error')) {
            $data['error'] = $error;
        }
        if ($success = Security::pullFlash('success')) {
            $data['success'] = $success;
        }

        $this->renderAuthView('auth/login', $data);
    }

    public function verifyToken() {
        $token = $_GET['token'] ?? '';

        if (empty($token) || !is_string($token)) {
            Security::flash('error', 'Token không hợp lệ');
            $this->redirect('/login');
        }

        $tokenModel = new LoginToken();
        $tokenData = $tokenModel->findValidToken($token);

        if (!$tokenData) {
            Security::flash('error', 'Link đăng nhập đã hết hạn');
            $this->redirect('/login');
        }

        // Chỉ cho phép đúng tài khoản được mời đăng nhập lần đầu
        $_SESSION['can_login_first_time'] = (int)$tokenData->user_id;
        $tokenModel->destroyToken($token);
        Security::flash('success', 'Xác thực thành công. Vui lòng nhập Username và Mật khẩu để tiếp tục.');
        $this->redirect('/login');
    }

    public function handleLogin() {
        $username = trim($_POST['username'] ?? '');
        $password = (string)($_POST['password'] ?? '');
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';

        $attempts = new LoginAttempt();
        if ($attempts->tooManyAttempts($username, $ip)) {
            $this->renderAuthView('auth/login', [
                'error' => 'Đăng nhập sai quá nhiều lần. Vui lòng thử lại sau ' . LoginAttempt::WINDOW_MINUTES . ' phút.'
            ]);
        }

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if (!$user || !$userModel->verifyPassword($user, $password)) {
            $attempts->record($username, $ip);
            $this->renderAuthView('auth/login', ['error' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
        }

        if ($user->status === 'locked') {
            $this->renderAuthView('auth/login', ['error' => 'Tài khoản đã bị khóa.']);
        }

        if ($user->role === 'staff' && $user->is_first_login == 1) {
            if (($_SESSION['can_login_first_time'] ?? null) !== (int)$user->id) {
                $this->renderAuthView('auth/login', [
                    'error' => 'Vui lòng đăng nhập bằng cách nhấp vào liên kết trong email của bạn.'
                ]);
            }
            unset($_SESSION['can_login_first_time']);
        }

        $attempts->clear($username);
        unset($user->password);
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        $this->redirect($user->is_first_login ? '/force-change-password' : '/dashboard');
    }

    public function forceChangePassword() {
        $this->requireLogin();
        $this->renderAuthView('auth/force_change_password');
    }

    public function handleForceChangePassword() {
        $this->requireLogin();

        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($new_password)) {
            $this->renderAuthView('auth/force_change_password', ['error' => 'Vui lòng nhập mật khẩu mới']);
        }
        if (strlen($new_password) < 6) {
            $this->renderAuthView('auth/force_change_password', ['error' => 'Mật khẩu mới phải có ít nhất 6 ký tự.']);
        }
        if ($new_password !== $confirm_password) {
            $this->renderAuthView('auth/force_change_password', ['error' => 'Mật khẩu xác nhận không khớp.']);
        }

        $userModel = new User();
        $userModel->updatePassword($_SESSION['user']->id, password_hash($new_password, PASSWORD_DEFAULT));
        $_SESSION['user']->is_first_login = 0;

        $this->redirect('/dashboard');
    }

    private function renderAuthView($viewPath, $data = []) {
        extract($data);
        $file = __DIR__ . '/../Views/' . $viewPath . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            http_response_code(500);
            echo "View not found";
        }
        exit;
    }

    public function logout() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
        header('Location: ' . rtrim(APP_URL, '/') . '/login');
        exit;
    }
}
