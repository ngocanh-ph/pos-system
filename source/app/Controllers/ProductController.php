<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Category.php';

class ProductController extends Controller {

    public function index() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }

        $productModel = new Product();
        $products = $productModel->findAllWithCategory();
        
        $categoryModel = new Category();
        $categories = $categoryModel->findAll();

        $this->view('products/index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store() {
        $this->verifyAdminJson();
        
        try {
            $image = 'default_product.png';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
               $image = $this->processImage($_FILES['image']);
            }

            $productModel = new Product();
            $result = $productModel->create([
                'barcode' => $_POST['barcode'],
                'name' => $_POST['name'],
                'import_price' => $_POST['import_price'],
                'sale_price' => $_POST['sale_price'],
                'category_id' => $_POST['category_id'],
                'image' => $image
            ]);

            if ($result) {
                $this->json(['success' => true]);
            } else {
                throw new Exception('Mã vạch đã tồn tại.');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update() {
        $this->verifyAdminJson();
        $id = $_POST['id'];
        
        try {
            $data = [
                'barcode' => $_POST['barcode'],
                'name' => $_POST['name'],
                'import_price' => $_POST['import_price'],
                'sale_price' => $_POST['sale_price'],
                'category_id' => $_POST['category_id']
            ];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
               $data['image'] = $this->processImage($_FILES['image']);
            }

            $productModel = new Product();
            if ($productModel->update($id, $data)) {
                 $this->json(['success' => true]);
            } else {
                 throw new Exception('Lỗi cập nhật.');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete() {
        $this->verifyAdminJson();
        $id = $_POST['id'];
        
        $productModel = new Product();
        if ($productModel->delete($id)) {
            $this->json(['success' => true]);
        } else {
            $this->json(['success' => false, 'message' => 'Không thể xóa sản phẩm đã bán.']);
        }
    }

    private function processImage($file) {
        $target_dir = __DIR__ . "/../../public/uploads/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        
        if (!in_array($ext, $allowed)) throw new Exception("File ảnh không hợp lệ.");
        
        $filename = uniqid() . "." . $ext;
        move_uploaded_file($file['tmp_name'], $target_dir . $filename);
        return $filename;
    }

    private function verifyAdminJson() {
        if ($_SESSION['user']->role !== 'admin') {
             $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
             exit;
        }
    }
}