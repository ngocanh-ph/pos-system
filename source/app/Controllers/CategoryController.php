<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Category.php';

class CategoryController extends Controller {

    public function __construct() {
        // Chỉ Admin mới được quản lý danh mục
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            $this->redirect('/dashboard'); 
        }
    }

    public function index(){
        if(!isset($_SESSION['user'])){
            $this->redirect('/login');
            return;
        }
        //Kiểm tra phân quyền
        if($_SESSION['user']->role!='admin'){
            $this->redirect('/posale');
            return;
        }
        $categoryModel = new Category();
        $categories = $categoryModel->getAllWithCreator();
        $this->view('categories/index', [
            'title'      => 'Danh mục',
            'categories' => $categories
        ]);   
    }

    public function store() {
        $this->verifyAdminJson();
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        
        if (empty($name)) {
            $this->json(['success' => false, 'message' => 'Tên danh mục không được để trống.']);
            return;
        }

        $model = new Category();
        try {
            $model->create([
                'name' => $name,
                'description' => $description,
                'created_by' => $_SESSION['user']->id
            ]);
            $this->json(['success' => true]);
        } catch (Exception $e) {
             // Bắt lỗi trùng tên (do cột name là UNIQUE)
             $this->json(['success' => false, 'message' => 'Tên danh mục đã tồn tại hoặc lỗi hệ thống.']);
        }
    }

    public function update() {
        $this->verifyAdminJson();
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        
        $model = new Category();
        $model->update($id, [
            'name' => $name,
            'description' => $description
        ]);
        
        $this->json(['success' => true]);
    }

    public function delete() {
        $this->verifyAdminJson();
        $id = $_POST['id'];
        
        $model = new Category();
        $model->delete($id);
        
        $this->json(['success' => true]);
    }

    private function verifyAdminJson() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
             $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
             exit;
        }
    }
}