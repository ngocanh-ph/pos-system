<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Order.php';
require_once __DIR__ . '/../Models/User.php';

class ReportController extends Controller {
    public function index() {
        $this->requireLogin();
        $staffs = [];
        if ($_SESSION['user']->role === 'admin') {
            $userModel = new User();
            $staffs = $userModel->getStaffBasicInfo();
        }
        $this->view('reports/index', [
            'title' => 'Báo cáo',
            'staffs' => $staffs
        ]);
    }

    public function getReportData() {
        if (!isset($_SESSION['user'])) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 401);
            return;
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $range = $_GET['range'] ?? 'today';
        $staffId = $_GET['staff_id'] ?? null;
        if ($staffId === 'undefined' || $staffId === '') $staffId = null;
        if ($_SESSION['user']->role !== 'admin') {
            $staffId = null;
        }

        $startDate = date('Y-m-d 00:00:00');
        $endDate = date('Y-m-d 23:59:59');
        $chartMode = 'day';

        switch ($range) {
            case 'today':
                $chartMode = 'hour';
                break;
            case 'yesterday':
                $startDate = date('Y-m-d 00:00:00', strtotime('-1 day'));
                $endDate = date('Y-m-d 23:59:59', strtotime('-1 day'));
                $chartMode = 'hour';
                break;
            case '7days':
                $startDate = date('Y-m-d 00:00:00', strtotime('-6 days'));
                break;
            case 'month':
                $startDate = date('Y-m-01 00:00:00');
                $endDate = date('Y-m-t 23:59:59');
                break;
            case 'custom':
                if (!empty($_GET['start']) && !empty($_GET['end'])) {
                    $startDate = $_GET['start'] . ' 00:00:00';
                    $endDate = $_GET['end'] . ' 23:59:59';
                    if (date('Y-m-d', strtotime($startDate)) === date('Y-m-d', strtotime($endDate))) {
                         $chartMode = 'hour';
                    }
                }
                break;
        }

        $orderModel = new Order();

        try {
            $kpiStats = $orderModel->getKpiStats($startDate, $endDate, $staffId);
            $chartData = $orderModel->getChartData($startDate, $endDate, $chartMode, $staffId);
            $catData = $orderModel->getCategoryStats($startDate, $endDate, $staffId);
            $orderList = $orderModel->getOrdersByRange($startDate, $endDate, $staffId);
            
            if ($_SESSION['user']->role !== 'admin') {
                $kpiStats['profit'] = null;
                foreach ($chartData as &$row) {
                    $row['profit'] = 0;
                }
            }
            
            $this->json([
                'success' => true,
                'chart_mode' => $chartMode,
                'kpi' => $kpiStats,
                'chart' => $chartData,
                'categories' => $catData,
                'orders' => $orderList
            ]);

        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function getOrderDetail() {
        if (!isset($_SESSION['user'])) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 401);
            return;
        }

        $orderId = $_GET['id'] ?? 0;
        if (!$orderId) {
            $this->json(['success' => false, 'message' => 'ID đơn hàng không hợp lệ!']);
            return;
        }

        try {
            $orderModel = new Order();
            $order = $orderModel->getByIdWithDetails($orderId);
            if (!$order) {
                $this->json(['success' => false, 'message' => 'Không tìm thấy hóa đơn!']);
                return;
            }

            $items = $orderModel->getItemsByOrderId($orderId);

            $this->json([
                'success' => true,
                'data' => [
                    'order' => $order,
                    'items' => $items
                ]
            ]);

        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
}