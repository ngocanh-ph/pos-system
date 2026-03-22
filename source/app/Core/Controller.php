<?php
require_once __DIR__ . '/../Libs/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../Libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../Libs/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Controller {

    public function view($view, $data = []) {
        $this->checkForcePasswordChange();
        extract($data);
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($viewFile)) {
            require_once __DIR__ . '/../Views/layouts/main.php';
        } else {
            die("View does not exist: " . $view);
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
    protected function checkForcePasswordChange() {
        if (!isset($_SESSION['user'])) {
            return; 
        }

        $user = $_SESSION['user'];
        if (!empty($user->is_first_login)) {
            $path = $_SERVER['REQUEST_URI'];
            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
            if ($scriptDir !== '/' && strpos($path, $scriptDir) === 0) {
                $path = substr($path, strlen($scriptDir));
            }
            if (empty($path)) $path = '/';
            $path = parse_url($path, PHP_URL_PATH);
            $allowedPaths = ['/force-change-password', '/logout'];
            if (!in_array($path, $allowedPaths)) {
                $this->redirect('/force-change-password');
            }
        }
    }

    protected function requireLogin() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
            exit;
        }
    }

    protected function requireAdmin() {
        $this->requireLogin();
        if ($_SESSION['user']->role !== 'admin') {
            $this->redirect('/dashboard');
            exit;
        }
    }

    protected function verifyAdminJson() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
            exit;
        }
    }

    protected function requireLoginJson() {
        if (!isset($_SESSION['user'])) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 401);
            exit;
        }
    }

    protected function handleFileUpload($file, $prefix = '', $maxSize = 2097152) {
        $target_dir = __DIR__ . "/../../public/uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        
        if (!in_array($ext, $allowed)) {
            throw new Exception("Chỉ chấp nhận file ảnh (JPG, PNG, WEBP).");
        }
        if ($file['size'] > $maxSize) {
            throw new Exception("File ảnh quá lớn (>" . ($maxSize / 1024 / 1024) . "MB).");
        }

        $filename = $prefix . uniqid() . "." . $ext;
        if (!move_uploaded_file($file['tmp_name'], $target_dir . $filename)) {
            throw new Exception("Lỗi khi lưu file ảnh.");
        }

        return $filename;
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

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}