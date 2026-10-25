<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Category.php';

class ProductController extends Controller {
    public function index() {
        $this->requireLogin();

        $productModel = new Product();
        $products = $productModel->findAllWithCategory();

        if (!$this->isAdmin()) {
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
            $clean = $this->validateProductData();

            $image = 'default_product.png';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->handleFileUpload($_FILES['image']);
            }

            $productModel = new Product();
            if (!$productModel->create($clean + ['image' => $image])) {
                throw new Exception('Lỗi lưu dữ liệu.');
            }
            $this->json(['success' => true]);
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $this->translateSqlError($e->getMessage())]);
        }
    }

    public function update() {
        $this->verifyAdminJson();
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) {
            $this->json(['success' => false, 'message' => 'Thiếu ID sản phẩm.']);
        }

        try {
            $productModel = new Product();
            $current = $productModel->find($id);
            if (!$current) {
                throw new Exception('Sản phẩm không tồn tại.');
            }

            $data = $this->validateProductData();

            $newImage = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $newImage = $data['image'] = $this->handleFileUpload($_FILES['image']);
            }

            if (!$productModel->update($id, $data)) {
                throw new Exception('Lỗi cập nhật sản phẩm.');
            }
            if ($newImage) {
                $this->deleteUpload($current->image);
            }
            $this->json(['success' => true]);
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $this->translateSqlError($e->getMessage())]);
        }
    }

    public function delete() {
        $this->verifyAdminJson();
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) {
            $this->json(['success' => false, 'message' => 'Thiếu ID sản phẩm.']);
        }
        $productModel = new Product();
        $product = $productModel->find($id);
        if ($product && $productModel->delete($id)) {
            $this->deleteUpload($product->image);
            $this->json(['success' => true]);
        }
        $this->json(['success' => false, 'message' => 'Không thể xóa sản phẩm đã có giao dịch mua hàng.']);
    }

    /** Kiểm tra và chuẩn hóa dữ liệu sản phẩm; trả về mảng đã ép kiểu. */
    private function validateProductData() {
        $barcode = trim((string)($_POST['barcode'] ?? ''));
        $name = trim((string)($_POST['name'] ?? ''));
        $categoryId = (int)($_POST['category_id'] ?? 0);
        $importPrice = $_POST['import_price'] ?? '';
        $salePrice = $_POST['sale_price'] ?? '';
        $stock = $_POST['stock'] ?? '0';

        if ($barcode === '' || $name === '' || !$categoryId || $importPrice === '' || $salePrice === '') {
            throw new Exception('Vui lòng điền đầy đủ thông tin.');
        }
        if (strlen($barcode) > 50 || mb_strlen($name) > 200) {
            throw new Exception('Mã vạch hoặc tên sản phẩm quá dài.');
        }
        if (!is_numeric($importPrice) || !is_numeric($salePrice)) {
            throw new Exception('Giá phải là số.');
        }
        if (!is_numeric($stock) || (int)$stock != $stock || (int)$stock < 0 || (int)$stock > 1000000) {
            throw new Exception('Tồn kho phải là số nguyên không âm.');
        }
        $importPrice = (float)$importPrice;
        $salePrice = (float)$salePrice;
        if ($importPrice < 0 || $salePrice < 0) {
            throw new Exception('Giá không được âm.');
        }
        if ($salePrice < $importPrice) {
            throw new Exception('Giá bán phải lớn hơn hoặc bằng giá nhập.');
        }
        if ($salePrice > 9999999999999) {
            throw new Exception('Giá vượt quá giới hạn cho phép.');
        }

        return [
            'barcode' => $barcode,
            'name' => $name,
            'import_price' => $importPrice,
            'sale_price' => $salePrice,
            'category_id' => $categoryId,
            'stock' => (int)$stock
        ];
    }

    private function translateSqlError($msg) {
        if (strpos($msg, '1062') !== false && strpos($msg, 'barcode') !== false) {
            return 'Mã vạch này đã tồn tại. Vui lòng nhập mã khác!';
        } elseif (strpos($msg, '1062') !== false) {
            return 'Dữ liệu này đã bị trùng lặp trong hệ thống!';
        } elseif (strpos($msg, 'SQLSTATE') !== false) {
            error_log($msg);
            return 'Lỗi cơ sở dữ liệu, vui lòng thử lại.';
        }
        return $msg;
    }
}
