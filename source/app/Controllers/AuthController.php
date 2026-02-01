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

    $_SESSION['user'] = [
        'id' => $user->id,
        'username' => $user->username,
        'role' => $user->role
    ];

    define('APP_URL', 'http://localhost/mav-web-pos/public');


} else {
    $this->renderAuthView('auth/login', ['error' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
}

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