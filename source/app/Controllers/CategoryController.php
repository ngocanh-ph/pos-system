<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Category.php';

class CategoryController extends Controller {

    public function index(){
        $this->requireAdmin();
        $categoryModel = new Category();
        $categories = $categoryModel->getAllWithCreator();
        $this->view('categories/index', [
            'title'      => 'Danh mục',
            'categories' => $categories
        ]);
    }

    public function store() {
        $this->verifyAdminJson();
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name === '') {
            $this->json(['success' => false, 'message' => 'Tên danh mục không được để trống.']);
        }
        if (mb_strlen($name) > 100) {
            $this->json(['success' => false, 'message' => 'Tên danh mục tối đa 100 ký tự.']);
        }

        $model = new Category();
        try {
            $model->create([
                'name' => $name,
                'description' => $description,
                'created_by' => $_SESSION['user']->id
            ]);
            $this->json(['success' => true]);
        } catch (PDOException $e) {
            $this->json(['success' => false, 'message' => $this->translateError($e)]);
        }
    }

    public function update() {
        $this->verifyAdminJson();
        $id = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$id || $name === '') {
            $this->json(['success' => false, 'message' => 'Thiếu thông tin bắt buộc.']);
        }
        if (mb_strlen($name) > 100) {
            $this->json(['success' => false, 'message' => 'Tên danh mục tối đa 100 ký tự.']);
        }

        $model = new Category();
        try {
            $model->update($id, [
                'name' => $name,
                'description' => $description
            ]);
            $this->json(['success' => true]);
        } catch (PDOException $e) {
            $this->json(['success' => false, 'message' => $this->translateError($e)]);
        }
    }

    public function delete() {
        $this->verifyAdminJson();
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) {
            $this->json(['success' => false, 'message' => 'Thiếu ID danh mục.']);
        }
        try {
            $categoryModel = new Category();
            if (!$categoryModel->delete($id)) {
                throw new Exception('Lỗi không xác định khi xóa danh mục.');
            }
            $this->json(['success' => true]);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            if ($msg === 'HAS_PRODUCTS' || strpos($msg, '1451') !== false) {
                $msg = 'Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này.';
            } else {
                error_log($msg);
                $msg = 'Lỗi hệ thống khi xóa danh mục.';
            }
            $this->json(['success' => false, 'message' => $msg]);
        }
    }

    private function translateError(PDOException $e) {
        if (strpos($e->getMessage(), '1062') !== false) {
            return 'Tên danh mục đã tồn tại.';
        }
        error_log($e->getMessage());
        return 'Lỗi hệ thống, vui lòng thử lại.';
    }
}
