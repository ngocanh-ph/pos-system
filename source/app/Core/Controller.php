<?php

class Controller {
    public function view($view, $data = []) {
        extract($data);

        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($viewFile)) {
           
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