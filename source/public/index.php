<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$path = substr($path, strlen($base));


// Autoload Core
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Controller.php';
require_once __DIR__ . '/../app/Core/Model.php';

// Autoload Controllers 
spl_autoload_register(function ($class) {
    if (file_exists(__DIR__ . '/../app/Controllers/' . $class . '.php')) {
        require_once __DIR__ . '/../app/Controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/../app/Models/' . $class . '.php')) {
        require_once __DIR__ . '/../app/Models/' . $class . '.php';
    }
});

// Init Router
$router = new Router();

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
$router->get('/posale', ['PosController', 'index']);
$router->get('/posale/search-product', ['PosController', 'searchProduct']); 
$router->get('/posale/search-customer', ['PosController', 'searchCustomer']); 
$router->post('/posale/checkout', ['PosController', 'checkout']); 
$router->get('/posale/invoice', ['PosController', 'printInvoice']);

// Employees
$router->get('/employees', ['EmployeeController', 'index']);
$router->get('/employees/history', ['EmployeeController', 'history']);
$router->post('/employees/store', ['EmployeeController', 'store']);
$router->post('/employees/resend-email', ['EmployeeController', 'resendEmail']);
$router->post('/employees/toggle-status', ['EmployeeController', 'toggleStatus']);

// Reports
$router->get('/reports', ['ReportController', 'index']);
$router->get('/report/getReportData', ['ReportController', 'getReportData']); 
$router->get('/report/getOrderDetail', ['ReportController', 'getOrderDetail']);

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
