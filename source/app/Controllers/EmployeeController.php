<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/LoginToken.php';

class EmployeeController extends Controller {
    
    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            $this->redirect('/login');
        } 

        $userModel = new User();
        $employees = $userModel->query("SELECT * FROM users WHERE role = 'staff'")->fetchAll();

        $this->view('employees/index', ['employees' => $employees]);
    }

}