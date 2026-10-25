<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Order.php';

class DashboardController extends Controller {

    public function index() {
        $this->requireLogin();
        $orderModel = new Order();
        $todayStart = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');

        // Nhân viên chỉ thấy số liệu của chính mình
        $staffId = $this->isAdmin() ? null : $_SESSION['user']->id;

        $kpi = $orderModel->getKpiStats($todayStart, $todayEnd, $staffId);
        $chartRaw = $orderModel->getChartData($todayStart, $todayEnd, 'hour', $staffId);
        $chartData = array_fill(0, 24, 0);
        foreach ($chartRaw as $row) {
            $hour = (int)$row['time_point'];
            if (isset($chartData[$hour])) {
                $chartData[$hour] = (int)$row['revenue'];
            }
        }
        $recentOrders = $orderModel->getRecentOrders(6, $staffId);
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
