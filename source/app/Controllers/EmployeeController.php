<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';

class EmployeeController extends Controller {

    public function index() {
        $this->requireAdmin();
        $userModel = new User();
        $employees = $userModel->getAllStaff();
        $this->view('employees/index', [
            'title'=> 'Nhân viên',
            'employees' => $employees
        ]);
    }

    public function store() {
        $this->verifyAdminJson();

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

        // Tạo User
        $userId = $userModel->create([
            'fullname' => $fullname,
            'email' => $email,
            'username' => $username,
            'password' => DEFAULT_EMPLOYEE_PASSWORD, // 52400002
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

        $subject = "[MAVPOS] Thông tin tài khoản & hướng dẫn đăng nhập hệ thống POS";
        $body = $this->buildWelcomeEmailBody($fullname, $username, $link);
        $this->sendMail($email, $subject, $body);

        $this->json([
            'success' => true,
            'message' => 'Tạo nhân viên thành công',
            'debug_link' => $link
        ]);
    }

    public function resendEmail() {
        $this->verifyAdminJson();

        $id = $_POST['id'] ?? null;
        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            $this->json(['success' => false, 'message' => 'Không tìm thấy NV']); 
            return;
        }

        require_once __DIR__ . '/../Models/LoginToken.php';
        $tokenModel = new LoginToken();
        $token = $tokenModel->createToken($id);
        
        $link = APP_URL . "/auth/verify-token?token=" . $token;

        $subject = "[MAVPOS] Thông tin tài khoản & hướng dẫn đăng nhập lại hệ thống POS";
        $body = $this->buildWelcomeEmailBody($fullname, $username, $link, true);
        $this->sendMail($user->email, $subject, $body);
        $this->json(['success' => true, 'debug_link' => $link]);
    }

    public function toggleStatus() {
        $this->verifyAdminJson();

        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? null;

        if (!$id || !$status) {
            $this->json(['success' => false]);
            return;
        }

        $userModel = new User();
        $userModel->updateStatus($id, $status);
        
        $this->json(['success' => true]);
    }

    // THÊM HÀM HISTORY Ở ĐÂY ĐỂ XỬ LÝ LỖI KHÔNG KẾT NỐI ĐƯỢC MÁY CHỦ
    public function history() {
        $this->verifyAdminJson();

        $employeeId = $_GET['id'] ?? null;
        if (!$employeeId) {
            $this->json(['success' => false, 'message' => 'Thiếu ID nhân viên']);
            return;
        }

        require_once __DIR__ . '/../Models/Order.php';
        $orderModel = new Order();
        
        // Lấy danh sách order của nhân viên
        $orders = $orderModel->getOrdersByEmployee($employeeId);

        $this->json(['success' => true, 'data' => $orders]);
    }

    private function buildWelcomeEmailBody($fullname, $username, $link, $isResend = false) {
        $action = $isResend ? 'đăng nhập lại' : 'đăng nhập';
        return "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <p>Kính gửi Anh/Chị <strong>{$fullname}</strong>,</p>
            
            <p>Chúng tôi xin gửi đến Anh/Chị thông tin tài khoản để {$action} vào hệ thống quản lý bán hàng MAVPOS.</p>
            
            <h3 style='color: #0d6efd;'>Thông tin đăng nhập</h3>
            <ul style='list-style-type: none; padding-left: 0;'>
                <li><strong>Link đăng nhập:</strong> <a href='{$link}' style='color: #0d6efd;'>{$link}</a></li>
                <li><strong>Tên đăng nhập:</strong> {$username}</li>
                <li><strong>Mật khẩu tạm thời:</strong> 52400002</li>
            </ul>

            <h3 style='color: #dc3545;'>Lưu ý quan trọng</h3>
            <ul>
                <li>Vui lòng đổi mật khẩu ngay sau lần đăng nhập đầu tiên để đảm bảo an toàn.</li>
                <li>Không chia sẻ thông tin tài khoản cho người khác.</li>
                <li>Nếu phát hiện đăng nhập bất thường, hãy báo ngay cho quản trị hệ thống.</li>
            </ul>

            <h3 style='color: #0d6efd;'>Hỗ trợ</h3>
            <p>Nếu Anh/Chị gặp khó khăn trong quá trình đăng nhập hoặc sử dụng hệ thống, vui lòng liên hệ:<br>
            Email: <a href='mailto:mavpos.project@gmail.com'>mavpos.project@gmail.com</a></p>

            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            
            <p>Trân trọng,<br>
            <strong>MAVPOS</strong><br>
            Phòng Quản trị hệ thống</p>
        </div>";
    }
}