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
            if ($_POST['import_price'] < 0 || $_POST['sale_price'] < 0) {
                throw new Exception('Giá không được âm.');
            }

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
                throw new Exception('Lỗi lưu dữ liệu (có thể trùng mã vạch).');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function update() {
        $this->verifyAdminJson();
        $id = $_POST['id'];
        
        try {
            if ($_POST['import_price'] < 0 || $_POST['sale_price'] < 0) {
                throw new Exception('Giá không được âm.');
            }
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
                 throw new Exception('Lỗi cập nhật sản phẩm.');
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
            $this->json(['success' => false, 'message' => 'Không thể xóa sản phẩm đã có giao dịch mua hàng.']);
        }
    }
    private function processImage($file) {
        $target_dir = __DIR__ . "/../../public/uploads/";       
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }        
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];       
        if (!in_array($ext, $allowed)) throw new Exception("Chỉ chấp nhận file ảnh (JPG, PNG, WEBP).");
        if ($file['size'] > 2 * 1024 * 1024) throw new Exception("File ảnh quá lớn (>2MB).");

        $filename = uniqid() . "." . $ext;       
        if (!move_uploaded_file($file['tmp_name'], $target_dir . $filename)) {
            throw new Exception("Lỗi khi lưu file ảnh.");
        }       
        return $filename;
    }
    private function verifyAdminJson() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
             $this->json(['success' => false, 'message' => 'Bạn không có quyền thực hiện thao tác này.'], 403);
             exit;
        }
    }
}