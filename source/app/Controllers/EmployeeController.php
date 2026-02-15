<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';

class EmployeeController extends Controller {

    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            $this->redirect('/login');
        } 

        $userModel = new User();
        $employees = $userModel->getAllStaff();
        $this->view('employees/index', ['employees' => $employees]);
    }

    public function store() {

        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
            return; 
        }

        $fullname = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (empty($fullname) || empty($email)) {
            $this->json(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
            return; 
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['success' => false, 'message' => 'Email không hợp lệ.']);
            return;
        }

        $parts = explode('@', $email);
        $username = $parts[0];

        $userModel = new User();

        // Kiểm tra email tồn tại
        $existing = $userModel->findByEmail($email);
        if ($existing) {
            $this->json(['success' => false, 'message' => 'Email đã tồn tại.']);
            return;
        }

        // Kiểm tra username trùng
        if ($userModel->findByUsername($username)) {
            $username .= rand(100,999);
        }

        // Hash password mặc định
        $hashedPassword = password_hash(DEFAULT_EMPLOYEE_PASSWORD, PASSWORD_DEFAULT);

        // Tạo User
        $userId = $userModel->create([
            'fullname' => $fullname,
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword, 
            'role' => 'staff',
            'status' => 'active',
            'is_first_login' => 1
        ]);

        if (!$userId) {
            $this->json(['success' => false, 'message' => 'Lỗi khi tạo nhân viên.']);
            return;
        }

        // Tạo Token & Gửi Email 
        require_once __DIR__ . '/../Models/LoginToken.php';

        $tokenModel = new LoginToken();
        $token = $tokenModel->createToken($userId);

        $link = APP_URL . "/auth/verify-token?token=" . $token;

        $subject = "Hệ thống MAVPOS - Xác nhận tài khoản";
        $body = "<p>Xin chào {$fullname},</p><p><a href='{$link}'>Đăng nhập ngay</a></p>";

        $this->sendMail($email, $subject, $body);

        $this->json([
            'success' => true,
            'message' => 'Tạo nhân viên thành công',
            'debug_link' => $link
        ]);
    }

    public function resendEmail() {

        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
            return;
        }

        $id = $_POST['id'] ?? null;

        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user || $user->role !== 'staff') {
            $this->json(['success' => false, 'message' => 'Không tìm thấy NV']);
            return;
        }

        require_once __DIR__ . '/../Models/LoginToken.php';

        $tokenModel = new LoginToken();
        $token = $tokenModel->createToken($id);

        $link = APP_URL . "/auth/verify-token?token=" . $token;

        $this->sendMail($user->email, "MAVPOS - Resend Link", "Click: <a href='$link'>Login</a>");

        $this->json(['success' => true, 'debug_link' => $link]);
    }

    public function toggleStatus() {

        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
            return;
        }

        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? null;

        // Chỉ cho phép active / locked
        if (!$id || !in_array($status, ['active','locked'])) {
            $this->json(['success' => false]);
            return;
        }

        $userModel = new User();
        $userModel->updateStatus($id, $status);
        
        $this->json(['success' => true]);
    }
}