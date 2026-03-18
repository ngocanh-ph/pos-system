<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Category.php';

class CategoryController extends Controller {

    public function __construct() {
        $this->requireAdmin();
    }

    public function index(){
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
        try {
            $categoryModel = new Category();
            if ($categoryModel->delete($id)) {
                $this->json(['success' => true]);
            } else {
                throw new Exception('Lỗi không xác định khi xóa danh mục.');
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();
            if ($msg === 'HAS_PRODUCTS') {
                $msg = 'Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này.';
            } 
            elseif (strpos($msg, '1451') !== false || strpos($msg, 'foreign key constraint') !== false) {
                $msg = 'Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này';
            }
            $this->json(['success' => false, 'message' => $msg]);
        }
    }
}