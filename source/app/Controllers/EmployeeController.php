<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/LoginToken.php';

class EmployeeController extends Controller {
    
    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            $this->redirect('/login');
        } 

        $userModel = new User();
        $employees = $userModel->query("SELECT * FROM users WHERE role = 'staff'")->fetchAll();

        $this->view('employees/index', ['employees' => $employees]);
    }

    public function store() {
        if ($_SESSION['user']->role !== 'admin') {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
            return; 
        }

        $fullname = $_POST['fullname'] ?? '';
        $email = $_POST['email'] ?? '';
        
        if (empty($fullname) || empty($email)) {
             $this->json(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
             return; 
        }
        
        $parts = explode('@', $email);
        $username = $parts[0];
    
        $userModel = new User();
        
        $existing = $userModel->findByEmail($email);
        if ($existing) {
             $this->json(['success' => false, 'message' => 'Email đã tồn tại.']);
             return;
        }
        $tempPass = DEFAULT_EMPLOYEE_PASSWORD; 
        
        $userId = $userModel->create([
            'username' => $username,
            'email' => $email,
            'role' => 'staff',
            'fullname' => $fullname
        ]);
        
        if (!$userId) {
            $this->json(['success' => false, 'message' => 'Lỗi khi tạo nhân viên (có thể username trùng).']);
            return;
        }

    
        $userModel->query("UPDATE users SET password = :p WHERE id = :id", [
            'p' => password_hash($tempPass, PASSWORD_DEFAULT),
            'id' => $userId
        ]);
        
        
        $tokenModel = new LoginToken();
        $token = $tokenModel->createToken($userId);
        $link = APP_URL . "/login-via-link?token=" . $token;
        file_put_contents(__DIR__ . '/../../email_log.txt', "To: $email | Link: $link\n", FILE_APPEND);

        $this->json(['success' => true, 'message' => 'Đã tạo nhân viên thành công!', 'debug_link' => $link]);
    }

    public function resendEmail() {
        if ($_SESSION['user']->role !== 'admin') { return; }
        $id = $_POST['id'];
        
        $tokenModel = new LoginToken();
        $token = $tokenModel->createToken($id);
        $link = APP_URL . "/login-via-link?token=" . $token;
        
        file_put_contents(__DIR__ . '/../../email_log.txt', "Resend To ID $id | Link: $link\n", FILE_APPEND);
        
        $this->json(['success' => true, 'message' => 'Đã gửi lại email.', 'debug_link' => $link]);
    }

    public function toggleStatus() {
        if ($_SESSION['user']->role !== 'admin') { return; }
        $id = $_POST['id'];
        $status = $_POST['status']; 
        
        $userModel = new User();
        $userModel->query("UPDATE users SET status = :status WHERE id = :id", [
            'status' => $status,
            'id' => $id
        ]);
        
        $this->json(['success' => true]);
    }
}