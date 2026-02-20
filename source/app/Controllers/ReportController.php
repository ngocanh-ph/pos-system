<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Order.php';
require_once __DIR__ . '/../Models/User.php';
class ReportController extends Controller {
    public function index() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        $staffs = [];
        // Nếu là Admin, lấy danh sách nhân viên để hiện filter
        if ($_SESSION['user']->role === 'admin') {
            $userModel = new User();
            $staffs = $userModel->query("SELECT id, fullname FROM users WHERE role != 'admin'")->fetchAll();
        }
        $this->view('reports/index', ['staffs' => $staffs]);
    }
    public function getReportData() {
        if (!isset($_SESSION['user'])) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 401);
            return;
        }
        // 1. XỬ LÝ LOGIC THỜI GIAN 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        $range = $_GET['range'] ?? 'today';
        $staffId = $_GET['staff_id'] ?? null;
        if ($staffId === 'undefined' || $staffId === '') $staffId = null;

        // Bảo mật: Nhân viên chỉ được xem của chính mình
        if ($_SESSION['user']->role !== 'admin') {
            $staffId = $_SESSION['user']->id;
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
                $startDate = date('Y-m-d 00:00:00', strtotime('-7 days'));
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

        // 2. GỌI MODEL ĐỂ LẤY DỮ LIỆU 
        $orderModel = new Order();

        try {
            $kpiStats = $orderModel->getKpiStats($startDate, $endDate, $staffId);
            $chartData = $orderModel->getChartData($startDate, $endDate, $chartMode, $staffId);
            $catData = $orderModel->getCategoryStats($startDate, $endDate, $staffId);
            $orderList = $orderModel->getOrdersByRange($startDate, $endDate, $staffId);
            // 3. XỬ LÝ BẢO MẬT HIỂN THỊ (Logic View)
            // Nếu không phải Admin, xóa dữ liệu lợi nhuận trước khi trả về client
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
}