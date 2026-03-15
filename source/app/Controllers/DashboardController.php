<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Order.php';

class DashboardController extends Controller {

    public function index() {
        $this->requireLogin();
        $orderModel = new Order();
        
        // Thiết lập thời gian
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $todayStart = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');

        $kpi = $orderModel->getKpiStats($todayStart, $todayEnd);
        // Lấy dữ liệu biểu đồ (Theo giờ) từ Model
        $chartRaw = $orderModel->getChartData($todayStart, $todayEnd, 'hour');
        // Xử lý dữ liệu biểu đồ
        $chartData = array_fill(0, 24, 0);
        foreach ($chartRaw as $row) {
            $hour = (int)$row['time_point'];
            if (isset($chartData[$hour])) {
                $chartData[$hour] = (int)$row['revenue'];
            }
        }

        // Lấy danh sách đơn hàng gần đây 
        $recentOrders = $orderModel->getRecentOrders(6);
        // Truyền dữ liệu sang View
        $this->view('dashboard/index', [
            'title' => 'Tổng quan',
            'revenueToday' => $kpi['revenue'],
            'ordersToday'  => $kpi['orders'],
            'productsSold' => $kpi['products'],
            'recentOrders' => $recentOrders,
            'chartLabels'  => range(0, 23), 
            'chartValues'  => $chartData
        ]);
    }
}