<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Models/Order.php';

class CustomerController extends Controller {

    public function index() {
        $this->requireLogin();

        $perPage = 20;
        $search = trim((string)($_GET['q'] ?? ''));
        $page = max(1, (int)($_GET['page'] ?? 1));

        [$customers, $total] = (new Customer())->paginateWithOrderCount($search, $page, $perPage);

        $this->view('customers/index', [
            'title' => 'Khách hàng',
            'customers' => $customers,
            'search' => $search,
            'page' => $page,
            'totalPages' => max(1, (int)ceil($total / $perPage)),
            'total' => $total
        ]);
    }

    public function getDetails() {
        $this->requireLoginJson();
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
            $this->json(['success' => false, 'message' => 'ID không hợp lệ']);
        }

        $customerModel = new Customer();
        $customer = $customerModel->find($id);

        if (!$customer) {
            $this->json(['success' => false, 'message' => 'Khách hàng không tồn tại']);
        }

        $this->json([
            'success' => true,
            'customer' => $customer,
            'stats' => $customerModel->getSpendingStats($id),
            'history' => $customerModel->getHistory($id)
        ]);
    }

    public function getOrderDetails() {
        $this->requireLoginJson();
        $orderId = (int)($_GET['order_id'] ?? 0);
        $orderModel = new Order();

        $order = $orderModel->getByIdWithDetails($orderId);

        if (!$order) {
            $this->json(['success' => false, 'message' => 'Đơn hàng không tồn tại']);
        }

        $this->json([
            'success' => true,
            'order' => $order,
            'items' => $orderModel->getItemsByOrderId($orderId)
        ]);
    }
}
