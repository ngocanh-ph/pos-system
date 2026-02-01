<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';

class AuthController extends Controller {
    
    public function login() {
        if (isset($_SESSION['user'])) {
            $this->redirect('/dashboard');
        }
        $this->renderAuthView('auth/login');
    }

    public function handleLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if ($user && password_verify($password, $user->password)) {
            if ($user->status === 'locked') {
                $this->renderAuthView('auth/login', ['error' => 'Tài khoản của bạn đã bị khóa.']);
                return;
            }
            
            if ($user->role === 'staff' && $user->require_password_change) {
                $this->renderAuthView('auth/login', ['error' => 'Vui lòng đăng nhập bằng liên kết trong email.']);
                return;
            }

            $_SESSION['user'] = $user;
            $this->redirect('/dashboard');

        } else {
            $this->renderAuthView('auth/login', ['error' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('/login');
    }
    
    public function forceChangePassword() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        $this->renderAuthView('auth/force_change_password');
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
     
}