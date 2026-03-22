<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Category.php';

class ProductController extends Controller {
    public function index() {
        $this->requireLogin();
        
        $productModel = new Product();
        $products = $productModel->findAllWithCategory();
        
        if ($_SESSION['user']->role !== 'admin') {
            foreach ($products as $key => $product) {
                unset($products[$key]->import_price);
            }
        }        
        
        $categoryModel = new Category();
        $categories = $categoryModel->findAll();

        $this->view('products/index', [
            'title'      => 'Sản phẩm',
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store() {
        $this->verifyAdminJson();
        
        try {
            $this->validateProductData();

            $image = 'default_product.png';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
               $image = $this->handleFileUpload($_FILES['image']);
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
                throw new Exception('Lỗi lưu dữ liệu.');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $this->translateSqlError($e->getMessage())]);
        }
    }

    public function update() {
        $this->verifyAdminJson();
        $id = $_POST['id'] ?? null;
        if (!$id) {
            $this->json(['success' => false, 'message' => 'Thiếu ID sản phẩm.']);
            return;
        }
        
        try {
            $this->validateProductData();
            $data = [
                'barcode' => $_POST['barcode'],
                'name' => $_POST['name'],
                'import_price' => $_POST['import_price'],
                'sale_price' => $_POST['sale_price'],
                'category_id' => $_POST['category_id']
            ];
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
               $data['image'] = $this->handleFileUpload($_FILES['image']);
            }
            
            $productModel = new Product();
            if ($productModel->update($id, $data)) {
                 $this->json(['success' => true]);
            } else {
                 throw new Exception('Lỗi cập nhật sản phẩm.');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $this->translateSqlError($e->getMessage())]);
        }
    }

    public function delete() {
        $this->verifyAdminJson();
        $id = $_POST['id'] ?? null;
        if (!$id) {
            $this->json(['success' => false, 'message' => 'Thiếu ID sản phẩm.']);
            return;
        }       
        $productModel = new Product();
        if ($productModel->delete($id)) {
            $this->json(['success' => true]);
        } else {
            $this->json(['success' => false, 'message' => 'Không thể xóa sản phẩm đã có giao dịch mua hàng.']);
        }
    }



    private function validateProductData() {
        if (
            empty($_POST['barcode']) || 
            empty($_POST['name']) || 
            empty($_POST['category_id']) ||
            $_POST['import_price'] === '' ||
            $_POST['sale_price'] === '' 
        ) {
            throw new Exception('Vui lòng điền đầy đủ thông tin.');
        }
        if ($_POST['import_price'] < 0 || $_POST['sale_price'] < 0) {
            throw new Exception('Giá không được âm.');
        }
        if ($_POST['sale_price'] < $_POST['import_price']) {
            throw new Exception('Giá bán phải lớn hơn hoặc bằng giá nhập.');
        }
    }

    private function translateSqlError($msg) {
        if (strpos($msg, '1062') !== false && strpos($msg, 'barcode') !== false) {
            return 'Mã vạch này đã tồn tại. Vui lòng nhập mã khác!';
        } elseif (strpos($msg, '1062') !== false) {
            return 'Dữ liệu này đã bị trùng lặp trong hệ thống!';
        }
        return $msg;
    }
}