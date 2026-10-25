<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/LoginToken.php';
require_once __DIR__ . '/../Models/Order.php';

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

        $fullname = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($fullname === '' || $email === '') {
            $this->json(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
        }
        if (mb_strlen($fullname) > 100 || strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['success' => false, 'message' => 'Họ tên hoặc email không hợp lệ.']);
        }

        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            $this->json(['success' => false, 'message' => 'Email đã tồn tại.']);
        }

        $username = preg_replace('/[^A-Za-z0-9._-]/', '', explode('@', $email)[0]);
        if ($username === '') {
            $username = 'user';
        }
        $username = substr($username, 0, 40);
        if ($userModel->findByUsername($username)) {
            $username .= '_' . bin2hex(random_bytes(2));
        }

        $tempPassword = $this->generateTempPassword();
        try {
            $userId = $userModel->create([
                'fullname' => $fullname,
                'email' => $email,
                'username' => $username,
                'password' => password_hash($tempPassword, PASSWORD_DEFAULT),
                'role' => 'staff',
                'status' => 'active',
                'is_first_login' => 1
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $this->json(['success' => false, 'message' => 'Lỗi khi tạo nhân viên.']);
        }

        if (!$userId) {
            $this->json(['success' => false, 'message' => 'Lỗi khi tạo nhân viên.']);
        }

        $sent = $this->sendActivationMail($userId, $fullname, $email, $username, $tempPassword, false);
        $this->json([
            'success' => true,
            'email_sent' => $sent === true,
            'message' => $sent === true
                ? 'Link đăng nhập và mật khẩu tạm thời đã được gửi vào email nhân viên.'
                : 'Đã tạo nhân viên nhưng gửi email thất bại. Hãy dùng nút "Gửi lại" trên thẻ nhân viên.'
        ]);
    }

    public function resendEmail() {
        $this->verifyAdminJson();

        $userModel = new User();
        $user = $userModel->find((int)($_POST['id'] ?? 0));

        if (!$user || $user->role !== 'staff') {
            $this->json(['success' => false, 'message' => 'Không tìm thấy NV']);
        }
        if ($user->is_first_login != 1) {
            $this->json(['success' => false, 'message' => 'Nhân viên này đã kích hoạt tài khoản.']);
        }

        // Mật khẩu tạm thời chỉ lưu dạng hash nên phải cấp mật khẩu mới cho lần gửi lại
        $tempPassword = $this->generateTempPassword();
        $userModel->query("UPDATE users SET password = :p WHERE id = :id", [
            'p' => password_hash($tempPassword, PASSWORD_DEFAULT),
            'id' => $user->id
        ]);

        $sent = $this->sendActivationMail($user->id, $user->fullname, $user->email, $user->username, $tempPassword, true);
        $this->json([
            'success' => $sent === true,
            'message' => $sent === true
                ? 'Đã gửi lại link đăng nhập và mật khẩu tạm thời mới vào email nhân viên.'
                : 'Gửi email thất bại, vui lòng thử lại sau.'
        ]);
    }

    public function toggleStatus() {
        $this->verifyAdminJson();

        $id = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? null;

        if (!$id || !in_array($status, ['active', 'locked'], true)) {
            $this->json(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
        }

        $userModel = new User();
        $target = $userModel->find($id);
        if (!$target || $target->role !== 'staff' || $id === (int)$_SESSION['user']->id) {
            $this->json(['success' => false, 'message' => 'Không thể thay đổi trạng thái tài khoản này.']);
        }

        $userModel->updateStatus($id, $status);
        $this->json(['success' => true]);
    }

    public function history() {
        $this->verifyAdminJson();

        $employeeId = (int)($_GET['id'] ?? 0);
        if (!$employeeId) {
            $this->json(['success' => false, 'message' => 'Thiếu ID nhân viên']);
        }

        $orderModel = new Order();
        $this->json(['success' => true, 'data' => $orderModel->getOrdersByEmployee($employeeId)]);
    }

    private function generateTempPassword() {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
        $pw = '';
        for ($i = 0; $i < 10; $i++) {
            $pw .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $pw;
    }

    private function sendActivationMail($userId, $fullname, $email, $username, $tempPassword, $isResend) {
        $token = (new LoginToken())->createToken($userId);
        $link = APP_URL . "/auth/verify-token?token=" . $token;

        $subject = $isResend
            ? "[MAVPOS] Thông tin tài khoản & hướng dẫn đăng nhập lại hệ thống POS"
            : "[MAVPOS] Thông tin tài khoản & hướng dẫn đăng nhập hệ thống POS";
        $body = $this->buildWelcomeEmailBody($fullname, $username, $link, $tempPassword, $isResend);
        $result = $this->sendMail($email, $subject, $body);
        if ($result !== true) {
            error_log('Send mail failed: ' . $result);
        }
        return $result;
    }

    private function buildWelcomeEmailBody($fullname, $username, $link, $tempPassword, $isResend = false) {
        $action = $isResend ? 'đăng nhập lại' : 'đăng nhập';
        $fullname = htmlspecialchars($fullname);
        $username = htmlspecialchars($username);
        $link = htmlspecialchars($link);
        $tempPassword = htmlspecialchars($tempPassword);
        return "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <p>Kính gửi Anh/Chị <strong>{$fullname}</strong>,</p>

            <p>Chúng tôi xin gửi đến Anh/Chị thông tin tài khoản để {$action} vào hệ thống quản lý bán hàng MAVPOS.</p>

            <h3 style='color: #0d6efd;'>Thông tin đăng nhập</h3>
            <ul style='list-style-type: none; padding-left: 0;'>
                <li><strong>Link đăng nhập:</strong> <a href='{$link}' style='color: #0d6efd;'>{$link}</a></li>
                <li><strong>Tên đăng nhập:</strong> {$username}</li>
                <li><strong>Mật khẩu tạm thời:</strong> {$tempPassword}</li>
            </ul>

            <h3 style='color: #dc3545;'>Lưu ý quan trọng</h3>
            <ul>
                <li>Link đăng nhập chỉ có hiệu lực trong 30 phút.</li>
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
