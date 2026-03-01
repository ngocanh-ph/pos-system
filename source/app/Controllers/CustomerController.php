<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Models/Order.php';

class CustomerController extends Controller {

    // 1. Hiển thị danh sách khách hàng
    public function index() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }

        $customerModel = new Customer();
        $customers = $customerModel->getAllWithOrderCount();

        $this->view('customers/index', ['customers' => $customers]);
    }

    // API: Lấy thông tin chi tiết & Lịch sử mua hàng
    public function getDetails() {
        $id = $_GET['id'] ?? 0;
        
        $customerModel = new Customer();
        $customer = $customerModel->find($id);

        if (!$customer) {
            $this->json(['success' => false, 'message' => 'Khách hàng không tồn tại']);
            return;
        }

        // Lấy thống kê chi tiêu (Đã chuyển logic sang Model)
        $stats = $customerModel->getSpendingStats($id);

        // Lấy lịch sử đơn hàng (Đã chuyển logic sang Model)
        $history = $customerModel->getHistory($id);

        $this->json([
            'success' => true,
            'customer' => $customer,
            'stats' => $stats,
            'history' => $history
        ]);
    }

    // API: Lấy chi tiết một đơn hàng cụ thể (Xem hóa đơn)
    public function getOrderDetails() {
        $orderId = $_GET['order_id'] ?? 0;
        $orderModel = new Order();

        // Tận dụng hàm có sẵn của Order Model (Không viết lại SQL)
        $order = $orderModel->getByIdWithDetails($orderId);

        if (!$order) {
            $this->json(['success' => false, 'message' => 'Đơn hàng không tồn tại']);
            return;
        }
        
        // Tận dụng hàm có sẵn của Order Model
        $items = $orderModel->getItemsByOrderId($orderId);

        $this->json([
            'success' => true,
            'order' => $order,
            'items' => $items
        ]);
    }
}