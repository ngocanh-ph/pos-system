<?php

class Controller {
    public function view($view, $data = []) {
        // Giải nén dữ liệu để view có thể dùng biến $data
        extract($data);

        // Xác định đường dẫn file nội dung (ví dụ: dashboard/index.php)
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($viewFile)) {
            // QUAN TRỌNG: Thay vì require $viewFile trực tiếp, 
            // ta gọi file Layout chính (main.php).
            // File main.php sẽ chịu trách nhiệm hiển thị $viewFile bên trong nó.
            require_once __DIR__ . '/../Views/layouts/main.php';
        } else {
            die("View does not exist: " . $view);
        }
    }

    public function redirect($url) {
        header("Location: " . APP_URL . $url);
        exit;
    }

    public function json($data, $status = 200) {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
