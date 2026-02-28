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

    // Xử lý khi người dùng Click Link từ Email
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
            $this->redirect('/login?error=Liên kết đã hết hạn hoặc không hợp lệ.');
            return;
        }
        // Biến này chứng minh người dùng đã click vào link hợp lệ
        $_SESSION['can_login_first_time'] = true;
        
        // Xóa token (để link này không dùng lại được nữa)
        $tokenModel->destroyToken($token);

        // KHÔNG ĐĂNG NHẬP 
        // Mà chuyển hướng về trang LOGIN để người dùng tự nhập User & Password
        $this->redirect('/login?success=Xác thực thành công. Vui lòng nhập Username và Mật khẩu (MSSV) để tiếp tục.');
    }
    // Xử lý khi người dùng bấm nút "Đăng nhập" trên Form
   public function handleLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? ''; // Nhân viên mới sẽ nhập password là 52400002

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        // Kiểm tra User và Pass trước
        if ($user && $password === $user->password) { // (Lưu ý: Dùng password_verify nếu pass đã mã hóa)

            //KIỂM TRA LOGIC NHÂN VIÊN MỚI 
            if ($user->role === 'staff' && $user->is_first_login == 1) {
                
                // Kiểm tra: Người này có đường link từ email chưa?
                if (!isset($_SESSION['can_login_first_time']) || $_SESSION['can_login_first_time'] !== true) {
                    // NẾU KHÔNG CÓ -> CHẶN LẠI
                    $this->renderAuthView('auth/login', [
                        'error' => 'Vui lòng đăng nhập bằng cách nhấp vào liên kết trong email của bạn.'
                    ]);
                    return;
                }

                // NẾU CÓ  -> Hủy (dùng 1 lần thôi)
                unset($_SESSION['can_login_first_time']);
                
                //BÂY GIỜ MỚI CHO ĐĂNG NHẬP
                $_SESSION['user'] = $user;
                
                // Chuyển sang trang bắt buộc đổi mật khẩu
                $this->redirect('/force-change-password');
                return;
            }

            if ($user->status === 'locked') {
                $this->renderAuthView('auth/login', ['error' => 'Tài khoản đã bị khóa.']);
                return;
            }

            // Đăng nhập bình thường (Nhân viên cũ / Admin)
            $_SESSION['user'] = $user;
            $this->redirect('/dashboard');

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
        $userModel->updatePassword($_SESSION['user']->id, $new_password);
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
        // Khởi động session nếu chưa có 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Xóa tất cả dữ liệu trong session
        $_SESSION = [];

        // Hủy session trên server
        session_destroy();
        // Chuyển hướng về trang đăng nhập
        header('Location: /login'); 
        exit;
    }
}