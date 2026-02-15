<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$path = substr($path, strlen($base));

if ($path === '/' || $path === '') {
    if (!isset($_SESSION['user'])) {
        header("Location: " . APP_URL . "/login");
    } else {
        header("Location: " . APP_URL . "/dashboard");
    }
    exit;
}

// Autoload Core
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Controller.php';
require_once __DIR__ . '/../app/Core/Model.php';

// Autoload Controllers (Basic manual autoload or spl_autoload)
spl_autoload_register(function ($class) {
    if (file_exists(__DIR__ . '/../app/Controllers/' . $class . '.php')) {
        require_once __DIR__ . '/../app/Controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/../app/Models/' . $class . '.php')) {
        require_once __DIR__ . '/../app/Models/' . $class . '.php';
    }
});

// Init Router
$router = new Router();

// Define Routes
// Auth
$router->get('/', ['AuthController', 'login']); 
$router->get('/login', ['AuthController', 'login']);
$router->post('/login', ['AuthController', 'handleLogin']);
$router->get('/logout', ['AuthController', 'logout']);
$router->get('/auth/verify-token', ['AuthController', 'verifyToken']);
$router->get('/force-change-password', ['AuthController', 'forceChangePassword']);
$router->post('/force-change-password', ['AuthController', 'handleForceChangePassword']);

// Dashboard
$router->get('/dashboard', ['DashboardController', 'index']);

// Products (Admin)
$router->get('/products', ['ProductController', 'index']);
$router->get('/products/create', ['ProductController', 'create']);
$router->post('/products/store', ['ProductController', 'store']);
$router->get('/products/edit', ['ProductController', 'edit']); 
$router->post('/products/update', ['ProductController', 'update']);
$router->post('/products/delete', ['ProductController', 'delete']);

// POS
$router->get('/pos', ['PosController', 'index']);
$router->get('/pos/search-product', ['PosController', 'searchProduct']); 
$router->get('/pos/search-customer', ['PosController', 'searchCustomer']); 
$router->post('/pos/checkout', ['PosController', 'checkout']); 
$router->get('/pos/invoice', ['PosController', 'printInvoice']);

// Employees
$router->get('/employees', ['EmployeeController', 'index']);
$router->post('/employees/store', ['EmployeeController', 'store']);
$router->post('/employees/resend-email', ['EmployeeController', 'resendEmail']);
$router->post('/employees/toggle-status', ['EmployeeController', 'toggleStatus']);

// Reports
// Reports
$router->get('/reports', ['ReportController', 'index']);
$router->get('/report/getReportData', ['ReportController', 'getReportData']); 

// Customers
$router->get('/customers', ['CustomerController', 'index']);
$router->get('/customers/details', ['CustomerController', 'getDetails']);
$router->get('/customers/order-details', ['CustomerController', 'getOrderDetails']);
$router->get('/customers/history', ['CustomerController', 'history']);

// Categories
$router->get('/categories', ['CategoryController', 'index']);
$router->post('/categories/store', ['CategoryController', 'store']);
$router->post('/categories/update', ['CategoryController', 'update']);
$router->post('/categories/delete', ['CategoryController', 'delete']);

//Profile
$router->get('/profile', ['ProfileController', 'index']);
$router->post('/profile/update-info', ['ProfileController', 'updateInfo']);
$router->post('/profile/change-password', ['ProfileController', 'changePassword']);

// Run
$router->resolve();
