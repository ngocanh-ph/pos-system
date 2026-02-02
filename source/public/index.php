<?php
session_start();

define('APP_URL', 'http://localhost/mav-web-pos/public');

// Autoload controller
require_once __DIR__ . '/../app/Controllers/AuthController.php';

// Lấy path URL
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/mav-web-pos/public', '', $uri);

// Router đơn giản để test
switch ($uri) {
    case '/':
    case '/login':
        (new AuthController())->login();
        break;

    case '/handle-login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new AuthController())->handleLogin();
        }
        break;

    case '/dashboard':
        echo "<h1>Login thành công</h1>";
        echo "<pre>";
        print_r($_SESSION['user']);
        exit;

    default:
        http_response_code(404);
        echo "404 - Not Found";
}