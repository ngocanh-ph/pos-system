<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Order.php';

class DashboardController extends Controller {

    public function index() {
        $this->requireLogin();
        $orderModel = new Order();
        $todayStart = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');

        $kpi = $orderModel->getKpiStats($todayStart, $todayEnd);
        $chartRaw = $orderModel->getChartData($todayStart, $todayEnd, 'hour');
        $chartData = array_fill(0, 24, 0);
        foreach ($chartRaw as $row) {
            $hour = (int)$row['time_point'];
            if (isset($chartData[$hour])) {
                $chartData[$hour] = (int)$row['revenue'];
            }
        }
        $recentOrders = $orderModel->getRecentOrders(6);
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