<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Category.php';

class CategoryController extends Controller {

    public function __construct() {
        // Chỉ Admin mới được quản lý danh mục
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            header("Location: /dashboard"); 
            exit;
        }
    }

    public function index() {
        $categoryModel = new Category();
        
        // Lấy danh sách kèm tên người tạo
        $sql = "SELECT c.*, u.fullname as creator_name 
                FROM categories c 
                LEFT JOIN users u ON c.created_by = u.id 
                ORDER BY c.created_at DESC";
        $stmt = $categoryModel->query($sql);
        $categories = $stmt->fetchAll();

        $this->view('categories/index', ['categories' => $categories]);
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
        $model->create([
            'name' => $name,
            'description' => $description,
            'created_by' => $_SESSION['user']->id
        ]);

        $this->json(['success' => true]);
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
        
        // Có thể thêm logic kiểm tra xem danh mục có sản phẩm không trước khi xóa
        $model = new Category();
        $model->delete($id);
        
        $this->json(['success' => true]);
    }

    private function verifyAdminJson() {
        if ($_SESSION['user']->role !== 'admin') {
             $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
             exit;
        }
    }
}