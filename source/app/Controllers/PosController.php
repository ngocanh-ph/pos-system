<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Models/Order.php';

class PosController extends Controller {
    const MAX_QTY_PER_LINE = 9999;

    public function index() {
        $this->requireLogin();
        if ($this->isAdmin()) {
            $this->redirect('/dashboard');
            return;
        }
        $this->view('posale/index',[
            'title'=> 'Bán hàng'
        ]);
    }

    public function searchProduct() {
        $this->requireLoginJson();
        $q = trim((string)($_GET['q'] ?? ''));
        $productModel = new Product();
        $exact = $productModel->findByBarcode($q);
        if ($exact) {
            $exact->is_exact = true;
            $this->json([$exact]);
        }
        $this->json($productModel->search($q));
    }

    public function checkout() {
        $this->requireLoginJson();
        if ($this->isAdmin()) {
            $this->json(['success' => false, 'message' => 'Chỉ nhân viên mới được tạo đơn bán hàng.'], 403);
        }

        $data = json_decode(file_get_contents('php://input'), true);
        if (!is_array($data) || empty($data['cart']) || !is_array($data['cart'])) {
            $this->json(['success' => false, 'message' => 'Giỏ hàng trống.']);
        }

        $phone = preg_replace('/[\s.\-]/', '', (string)($data['customer']['phone'] ?? ''));
        if ($phone === '') {
            $this->json(['success' => false, 'message' => 'Vui lòng nhập số điện thoại khách hàng.']);
        }
        if (!preg_match('/^\+?[0-9]{8,15}$/', $phone)) {
            $this->json(['success' => false, 'message' => 'Số điện thoại không hợp lệ.']);
        }
        $name = trim((string)($data['customer']['name'] ?? ''));
        $address = trim((string)($data['customer']['address'] ?? ''));
        if (mb_strlen($name) > 100 || mb_strlen($address) > 500) {
            $this->json(['success' => false, 'message' => 'Tên hoặc địa chỉ khách hàng quá dài.']);
        }

        // Gộp các dòng trùng sản phẩm và kiểm tra số lượng
        $quantities = [];
        foreach ($data['cart'] as $item) {
            $id = (int)($item['id'] ?? 0);
            $qty = $item['quantity'] ?? 0;
            if ($id <= 0 || !is_numeric($qty) || (int)$qty != $qty || (int)$qty < 1 || (int)$qty > self::MAX_QTY_PER_LINE) {
                $this->json(['success' => false, 'message' => 'Số lượng sản phẩm không hợp lệ.']);
            }
            $quantities[$id] = ($quantities[$id] ?? 0) + (int)$qty;
        }

        ksort($quantities); // khóa dòng sản phẩm theo thứ tự cố định để tránh deadlock

        // Giá luôn lấy từ DB, không tin giá từ client
        $productModel = new Product();
        $calculatedTotal = 0;
        $verifiedCart = [];
        foreach ($quantities as $id => $qty) {
            $product = $productModel->find($id);
            if (!$product) {
                $this->json(['success' => false, 'message' => 'Có sản phẩm trong giỏ không còn tồn tại, vui lòng tải lại trang.']);
            }
            $lineTotal = $product->sale_price * $qty;
            $calculatedTotal += $lineTotal;
            $verifiedCart[] = [
                'product_id'   => $product->id,
                'quantity'     => $qty,
                'unit_price'   => $product->sale_price,
                'import_price' => $product->import_price,
                'total_price'  => $lineTotal
            ];
        }

        $paidRaw = $data['amount_paid'] ?? '';
        $amountPaid = ($paidRaw === '' || $paidRaw === null) ? $calculatedTotal : $paidRaw;
        if (!is_numeric($amountPaid) || (float)$amountPaid < $calculatedTotal) {
            $this->json(['success' => false, 'message' => 'Số tiền thanh toán không đủ.']);
        }
        $amountPaid = (float)$amountPaid;

        try {
            $customerModel = new Customer();
            $customer = $customerModel->findByPhone($phone);
            $customerId = $customer ? $customer->id : $customerModel->create([
                'phone' => $phone,
                'name' => $name !== '' ? $name : 'Khách lẻ',
                'address' => $address
            ]);
            if (!$customerId) {
                throw new Exception('Không thể tạo khách hàng.');
            }

            $orderId = (new Order())->createOrderWithItems([
                'customer_id' => $customerId,
                'user_id' => $_SESSION['user']->id,
                'total_amount' => $calculatedTotal,
                'amount_paid' => $amountPaid,
                'change_amount' => $amountPaid - $calculatedTotal
            ], $verifiedCart);
        } catch (OutOfStockException $e) {
            $p = $productModel->find($e->productId);
            $left = $p ? max(0, (int)$p->stock) : 0;
            $this->json([
                'success' => false,
                'message' => ($p ? $p->name : 'Sản phẩm') . ' không đủ hàng (còn ' . $left . ').'
            ]);
        } catch (Exception $e) {
            error_log('Checkout failed: ' . $e->getMessage());
            $this->json(['success' => false, 'message' => 'Không thể tạo đơn hàng, vui lòng thử lại.'], 500);
        }

        $this->json(['success' => true, 'invoice_url' => "/posale/invoice?id=" . $orderId]);
    }

    public function printInvoice() {
        $this->requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $orderModel = new Order();
        $order = $orderModel->getByIdWithDetails($id);
        if (!$order || !$this->canAccessOrder($order)) {
            http_response_code(404);
            die("Hóa đơn không tồn tại.");
        }
        $items = $orderModel->getItemsByOrderId($id);
        require __DIR__ . '/../Views/posale/invoice_pdf_mock.php';
    }

    public function searchCustomer() {
        $this->requireLoginJson();
        $phone = preg_replace('/[\s.\-]/', '', (string)($_GET['phone'] ?? ''));
        $customer = (new Customer())->findByPhone($phone);

        if ($customer) {
            $this->json([
                'success' => true,
                'customer' => [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'address' => $customer->address
                ]
            ]);
        }
        $this->json(['success' => false]);
    }
}
