<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Models/Order.php';

class CustomerController extends Controller {

    public function index() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }

        $customerModel = new Customer();
        
        $customers = $customerModel->getAllWithOrderCount();

        $this->view('customers/index', ['customers' => $customers]);
    }

    public function getDetails() {
        $id = $_GET['id'] ?? 0;
        
        $customerModel = new Customer();
        $customer = $customerModel->find($id);

        if (!$customer) {
            $this->json(['success' => false, 'message' => 'Khách hàng không tồn tại']);
            return;
        }

        $stats = $customerModel->getSpendingStats($id);

        $history = $customerModel->getHistory($id);

        $this->json([
            'success' => true,
            'customer' => $customer,
            'stats' => $stats,
            'history' => $history
        ]);
    }

    public function getOrderDetails() {
        $orderId = $_GET['order_id'] ?? 0;
        $orderModel = new Order();

        $order = $orderModel->getByIdWithDetails($orderId);

        if (!$order) {
            $this->json(['success' => false, 'message' => 'Đơn hàng không tồn tại']);
            return;
        }
        $items = $orderModel->getItemsByOrderId($orderId);

        $this->json([
            'success' => true,
            'order' => $order,
            'items' => $items
        ]);
    }
}