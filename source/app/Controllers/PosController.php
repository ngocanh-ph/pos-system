<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Models/Order.php';

class PosController extends Controller {
    public function index() {
        if (!isset($_SESSION['user'])){ 
            $this->redirect('/login');
            return;
        }
        $this->view('posale/index',[
            'title'=> 'Bán hàng'
        ]);
    }
    public function searchProduct() {
        $q = $_GET['q'] ?? '';
        $productModel = new Product();        
        $exact = $productModel->findByBarcode($q);
        if ($exact) {
            $exact->is_exact = true;
            return $this->json([$exact]);
        }        
        // Nếu không phải mã vạch, gọi hàm search từ Model
        $this->json($productModel->search($q));
    }
    public function checkout() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['cart'])) return $this->json(['success' => false, 'message' => 'Giỏ hàng trống.']);
        $productModel = new Product();
        $calculatedTotal = 0;
        $verifiedCart = [];
        // Xác thực giá từ DB
        foreach($data['cart'] as $item){
            $product = $productModel->find($item['id']);
            if($product){
                $price = $product->sale_price;
                $qty = (int)$item['quantity'];
                $lineTotal = $price * $qty;
                $calculatedTotal += $lineTotal;
                $verifiedCart[] = [
                    'id' => $product->id,
                    'sale_price' => $price,
                    'quantity' => $qty,
                    'total_price' => $lineTotal
                ];
            }
        }
        // Xử lý Khách hàng qua Model
        $customerModel = new Customer();
        $customer = $customerModel->findByPhone($data['customer']['phone']);
        $customerId = $customer ? $customer->id : $customerModel->create([
            'phone' => $data['customer']['phone'],
            'name' => $data['customer']['name'] ?? 'Khách lẻ',
            'address' => $data['customer']['address'] ?? ''
        ]);
        // Tạo Đơn hàng qua Model
        $orderModel = new Order();
        $orderId = $orderModel->createOrder([
            'customer_id' => $customerId,
            'user_id' => $_SESSION['user']->id,
            'total_amount' => $calculatedTotal,
            'amount_paid' => $data['amount_paid'] ?? $calculatedTotal,
            'change_amount' => ($data['amount_paid'] ?? $calculatedTotal) - $calculatedTotal
        ]);
        foreach ($verifiedCart as $vItem) {
             $orderModel->addOrderItem([
                 'order_id' => $orderId,
                 'product_id' => $vItem['id'],
                 'quantity' => $vItem['quantity'],
                 'unit_price' => $vItem['sale_price'],
                 'total_price' => $vItem['total_price']
             ]);
        }
        $this->json(['success' => true, 'invoice_url' => "/posale/invoice?id=" . $orderId]);
    }

    public function printInvoice() {
        $id = $_GET['id'] ?? 0;
        $orderModel = new Order();        
        // Gọi dữ liệu đã được Model xử lý JOIN
        $order = $orderModel->getByIdWithDetails($id);
        if (!$order) die("Hóa đơn không tồn tại.");
        $items = $orderModel->getItemsByOrderId($id);
        require __DIR__ . '/../Views/posale/invoice_pdf_mock.php';
    }
public function searchCustomer() {
    $phone = $_GET['phone'] ?? '';   
    // Sử dụng Model Customer để tìm khách theo số điện thoại
    $customerModel = new Customer(); 
    $customer = $customerModel->findByPhone($phone);

    if ($customer) {
        $this->json([
            'success' => true,
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'address' => $customer->address
            ]
        ]);
    } else {
        $this->json(['success' => false]);
    }
}
}