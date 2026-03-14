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

    protected function sendMail($to, $subject, $body)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mavpos.project@gmail.com';
            $mail->Password   = 'pzgzawhxozkdgbmn';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->setFrom('mavpos.project@gmail.com', 'MAVPOS System');
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