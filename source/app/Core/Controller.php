<?php
require_once __DIR__ . '/../Libs/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../Libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../Libs/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;

class Controller {

    public function view($view, $data = []) {
        extract($data);
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($viewFile)) {
            require_once __DIR__ . '/../Views/layouts/main.php';
        } else {
            http_response_code(500);
            die("View does not exist: " . htmlspecialchars($view));
        }
    }

    public function redirect($url) {
        if (strpos($url, 'http') === 0) {
            header("Location: " . $url);
        } else {
            header("Location: " . rtrim(APP_URL, '/') . '/' . ltrim($url, '/'));
        }
        exit;
    }

    public function json($data, $status = 200) {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    protected function isAdmin() {
        return isset($_SESSION['user']) && $_SESSION['user']->role === 'admin';
    }

    protected function requireLogin() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
    }

    protected function requireAdmin() {
        $this->requireLogin();
        if (!$this->isAdmin()) {
            $this->redirect('/dashboard');
        }
    }

    protected function verifyAdminJson() {
        if (!$this->isAdmin()) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
    }

    protected function requireLoginJson() {
        if (!isset($_SESSION['user'])) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
    }

    /** Admin xem mọi đơn; nhân viên chỉ xem đơn do mình tạo. */
    protected function canAccessOrder($order) {
        return $order && ($this->isAdmin() || (int)$order->user_id === (int)$_SESSION['user']->id);
    }

    protected function handleFileUpload($file, $prefix = '', $maxSize = 2097152) {
        $target_dir = __DIR__ . "/../../public/uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (!is_uploaded_file($file['tmp_name'])) {
            throw new \Exception("File tải lên không hợp lệ.");
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedTypes = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp'];

        if (!isset($allowedTypes[$ext])) {
            throw new \Exception("Chỉ chấp nhận file ảnh (JPG, PNG, WEBP).");
        }
        if ($file['size'] > $maxSize) {
            throw new \Exception("File ảnh quá lớn (>" . ($maxSize / 1024 / 1024) . "MB).");
        }

        // Kiểm tra nội dung thực sự là ảnh, khớp với phần mở rộng
        $info = @getimagesize($file['tmp_name']);
        if ($info === false || $info['mime'] !== $allowedTypes[$ext]) {
            throw new \Exception("File không phải ảnh hợp lệ.");
        }

        $filename = $prefix . bin2hex(random_bytes(8)) . "." . $ext;
        if (!move_uploaded_file($file['tmp_name'], $target_dir . $filename)) {
            throw new \Exception("Lỗi khi lưu file ảnh.");
        }

        return $filename;
    }

    /** Xóa ảnh cũ trong thư mục uploads (bỏ qua ảnh mặc định). */
    protected function deleteUpload($filename) {
        if (empty($filename) || strpos($filename, 'default_') === 0 || $filename !== basename($filename)) {
            return;
        }
        $path = __DIR__ . '/../../public/uploads/' . $filename;
        if (is_file($path)) {
            @unlink($path);
        }
    }

    protected function sendMail($to, $subject, $body)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USERNAME;
            $mail->Password   = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = SMTP_PORT;
            $mail->setFrom(SMTP_USERNAME, SMTP_FROM_NAME);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            if (!$mail->send()) {
                return $mail->ErrorInfo;
            }

            return true;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
