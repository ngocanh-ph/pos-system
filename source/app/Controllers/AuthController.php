<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';


class AuthController extends Controller {
    
    public function login() {
        if (isset($_SESSION['user'])) {
            $this->redirect('/dashboard');
            return;
        }
        $data = [];
        if (isset($_GET['error'])) {
            $data['error'] = $_GET['error'];
        }
        if (isset($_GET['success'])) {
            $data['success'] = $_GET['success'];
        }
        
        $this->renderAuthView('auth/login', $data);
    }

    public function verifyToken() {
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            $this->redirect('/login?error=Token không hợp lệ');
            return;
        }

        require_once __DIR__ . '/../Models/LoginToken.php';
        $tokenModel = new LoginToken();     
        $tokenData = $tokenModel->findValidToken($token);

        if (!$tokenData) {
            $this->redirect('/login?error=Link đăng nhập đã hết hạn');
            return;
        }
        
        $_SESSION['can_login_first_time'] = true;
        $tokenModel->destroyToken($token);
        $this->redirect('/login?success=Xác thực thành công. Vui lòng nhập Username và Mật khẩu (MSSV) để tiếp tục.');
    }

    public function handleLogin() {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? ''); 

        $userModel = new User();
        $user = $userModel->findByUsername($username);
        if ($user && (password_verify($password, $user->password) || $password === $user->password)) { 
            if ($user->role === 'staff' && $user->is_first_login == 1) {
                if (!isset($_SESSION['can_login_first_time']) || $_SESSION['can_login_first_time'] !== true) {
                    $this->renderAuthView('auth/login', [
                        'error' => 'Vui lòng đăng nhập bằng cách nhấp vào liên kết trong email của bạn.'
                    ]);
                    return;
                }
                
                unset($_SESSION['can_login_first_time']);
                $_SESSION['user'] = $user;
                $this->redirect('/force-change-password');
                return;
            }

            if ($user->status === 'locked') {
                $this->renderAuthView('auth/login', ['error' => 'Tài khoản đã bị khóa.']);
                return;
            }
            session_regenerate_id(true);
            $_SESSION['user'] = $user;
            $this->redirect('/dashboard');
            return;

        } else {
            $this->renderAuthView('auth/login', ['error' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
        }
    }
    
    public function forceChangePassword() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        $this->renderAuthView('auth/force_change_password');
    }

    public function handleForceChangePassword() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($new_password) || strlen($new_password) < 6) {
            $this->renderAuthView('auth/force_change_password', ['error' => 'Mật khẩu mới phải có ít nhất 6 ký tự.']);
            return;
        }
        
        if ($new_password !== $confirm_password) {
             $this->renderAuthView('auth/force_change_password', ['error' => 'Mật khẩu xác nhận không khớp.']);
             return;
        }
        
        $userModel = new User();
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $userModel->updatePassword($_SESSION['user']->id, $hashedPassword);
        $_SESSION['user']->is_first_login = 0;
        
        $this->redirect('/dashboard');
    }

    private function renderAuthView($viewPath, $data = []) {
        extract($data);
        $file = __DIR__ . '/../Views/' . $viewPath . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            echo "View not found: $file";
        }
        exit; 
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        $this->redirect('/login');
    }
}