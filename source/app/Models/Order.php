<?php
require_once __DIR__ . '/../Core/Model.php';

class Order extends Model {
    protected $table = 'orders';
    public function getByIdWithDetails($id) {
        $sql = "SELECT o.*, c.name as customer_name, c.phone, c.address, u.fullname as staff_name 
                FROM orders o 
                LEFT JOIN customers c ON o.customer_id = c.id
                LEFT JOIN users u ON o.user_id = u.id
                WHERE o.id = :id";
        return $this->query($sql, ['id' => $id])->fetch();
    }
    public function getItemsByOrderId($id) {
        $sql = "SELECT oi.*, p.name as product_name 
                FROM order_items oi 
                LEFT JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = :id";
        return $this->query($sql, ['id' => $id])->fetchAll();
    }
    public function createOrder($data) {
        $sql = "INSERT INTO {$this->table} (customer_id, user_id, total_amount, amount_paid, change_amount) 
                VALUES (:customer_id, :user_id, :total_amount, :amount_paid, :change_amount)";
        $this->db->prepare($sql)->execute($data);
        return $this->db->lastInsertId();
    }
    public function addOrderItem($data) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price, total_price) 
                VALUES (:order_id, :product_id, :quantity, :unit_price, :total_price)";
        $this->db->prepare($sql)->execute($data);
    }
    // Lấy chỉ số KPI (Doanh thu, Đơn hàng, SP, Lợi nhuận)
    public function getKpiStats($startDate, $endDate, $staffId = null) {
        $params = ['start' => $startDate, 'end' => $endDate];
        $whereSql = " WHERE o.created_at BETWEEN :start AND :end ";

        if (!empty($staffId)) {
            $whereSql .= " AND o.user_id = :staff_id";
            $params['staff_id'] = $staffId;
        }
        // Truy vấn 1: Doanh thu & Tổng đơn
        $sqlBasic = "SELECT COUNT(o.id) as total_orders, COALESCE(SUM(o.total_amount), 0) as revenue 
                     FROM orders o $whereSql";
        $basic = $this->query($sqlBasic, $params)->fetch();

        // Truy vấn 2: Tổng sản phẩm & Tổng vốn (để tính lợi nhuận)
        $sqlProd = "SELECT COALESCE(SUM(oi.quantity), 0) as total_products, 
                           COALESCE(SUM(oi.quantity * p.import_price), 0) as total_cost
                    FROM orders o 
                    LEFT JOIN order_items oi ON o.id = oi.order_id 
                    LEFT JOIN products p ON oi.product_id = p.id 
                    $whereSql";
        $prod = $this->query($sqlProd, $params)->fetch();

        return [
            'revenue' => (float)$basic->revenue,
            'orders'  => (int)$basic->total_orders,
            'products'=> (int)$prod->total_products,
            'profit'  => (float)$basic->revenue - (float)$prod->total_cost
        ];
    }

    // Lấy dữ liệu biểu đồ cột (Bar Chart)
    public function getChartData($startDate, $endDate, $mode = 'day', $staffId = null) {
        $params = ['start' => $startDate, 'end' => $endDate];
        $whereSql = " WHERE o.created_at BETWEEN :start AND :end ";

        if (!empty($staffId)) {
            $whereSql .= " AND o.user_id = :staff_id";
            $params['staff_id'] = $staffId;
        }

        $groupBy = ($mode === 'hour') ? "HOUR(o.created_at)" : "DATE(o.created_at)";
        $selectTime = ($mode === 'hour') ? "HOUR(o.created_at)" : "DATE(o.created_at)";

        $sql = "SELECT 
                    $selectTime as time_point, 
                    COALESCE(SUM(oi.quantity * oi.unit_price), 0) as revenue,
                    COALESCE(SUM(oi.quantity * (oi.unit_price - p.import_price)), 0) as profit
                FROM orders o
                LEFT JOIN order_items oi ON o.id = oi.order_id
                LEFT JOIN products p ON oi.product_id = p.id
                $whereSql
                GROUP BY $groupBy
                ORDER BY time_point ASC";

        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy dữ liệu biểu đồ tròn (Category)
    public function getCategoryStats($startDate, $endDate, $staffId = null) {
        $params = ['start' => $startDate, 'end' => $endDate];
        $whereSql = " WHERE o.created_at BETWEEN :start AND :end ";
        
        if (!empty($staffId)) {
            $whereSql .= " AND o.user_id = :staff_id";
            $params['staff_id'] = $staffId;
        }

        $sql = "SELECT c.name, SUM(oi.quantity) as qty 
                FROM order_items oi 
                JOIN orders o ON oi.order_id = o.id 
                JOIN products p ON oi.product_id = p.id 
                JOIN categories c ON p.category_id = c.id 
                $whereSql 
                GROUP BY c.id";
        
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách đơn hàng cho bảng (Audit Table)
    public function getOrdersByRange($startDate, $endDate, $staffId = null) {
        $params = ['start' => $startDate, 'end' => $endDate];
        $whereSql = " WHERE o.created_at BETWEEN :start AND :end ";

        if (!empty($staffId)) {
            $whereSql .= " AND o.user_id = :staff_id";
            $params['staff_id'] = $staffId;
        }

        $sql = "SELECT o.id, o.created_at, c.name as customer_name, o.total_amount 
                FROM orders o 
                LEFT JOIN customers c ON o.customer_id = c.id 
                $whereSql 
                ORDER BY o.created_at DESC";

        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy danh sách đơn hàng gần đây (mặc định lấy 6 đơn)
    public function getRecentOrders($limit = 6) {
        $sql = "SELECT o.id, o.total_amount, o.created_at, c.name as customer_name
                FROM orders o
                LEFT JOIN customers c ON o.customer_id = c.id
                ORDER BY o.created_at DESC 
                LIMIT " . (int)$limit;
        return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }
}