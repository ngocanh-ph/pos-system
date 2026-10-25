<?php
require_once __DIR__ . '/../Core/Model.php';

/** Ném ra khi không đủ tồn kho để bán. */
class OutOfStockException extends Exception {
    public $productId;

    public function __construct($productId) {
        parent::__construct('OUT_OF_STOCK');
        $this->productId = $productId;
    }
}

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
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price, import_price, total_price) 
                VALUES (:order_id, :product_id, :quantity, :unit_price, :import_price, :total_price)";
        $this->db->prepare($sql)->execute($data);
    }

    /** Tạo đơn và các dòng chi tiết trong một transaction: lỗi giữa chừng thì không để lại đơn dở dang. */
    public function createOrderWithItems($orderData, $items) {
        $this->db->beginTransaction();
        try {
            $orderId = $this->createOrder($orderData);
            // Trừ kho nguyên tử: chỉ trừ khi còn đủ hàng, tồn kho không bao giờ xuống dưới 0
            $deduct = $this->db->prepare("UPDATE products SET stock = stock - :qty WHERE id = :id AND stock >= :qty2");
            foreach ($items as $item) {
                $deduct->execute(['qty' => $item['quantity'], 'qty2' => $item['quantity'], 'id' => $item['product_id']]);
                if ($deduct->rowCount() === 0) {
                    throw new OutOfStockException($item['product_id']);
                }
                $item['order_id'] = $orderId;
                $this->addOrderItem($item);
            }
            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
   
    public function getKpiStats($startDate, $endDate, $staffId = null) {
        list($whereSql, $params) = $this->buildDateFilter($startDate, $endDate, $staffId);
        
        $sqlBasic = "SELECT COUNT(o.id) as total_orders, COALESCE(SUM(o.total_amount), 0) as revenue 
                     FROM orders o $whereSql";
        $basic = $this->query($sqlBasic, $params)->fetch();

        $sqlProd = "SELECT COALESCE(SUM(oi.quantity), 0) as total_products, 
                           COALESCE(SUM(oi.quantity * COALESCE(oi.import_price, p.import_price)), 0) as total_cost
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

    public function getChartData($startDate, $endDate, $mode = 'day', $staffId = null) {
        list($whereSql, $params) = $this->buildDateFilter($startDate, $endDate, $staffId);

        $groupBy = ($mode === 'hour') ? "HOUR(o.created_at)" : "DATE(o.created_at)";
        $selectTime = ($mode === 'hour') ? "HOUR(o.created_at)" : "DATE(o.created_at)";

        $sql = "SELECT 
                    $selectTime as time_point, 
                    COALESCE(SUM(oi.quantity * oi.unit_price), 0) as revenue,
                    COALESCE(SUM(oi.quantity * (oi.unit_price - COALESCE(oi.import_price, p.import_price))), 0) as profit
                FROM orders o
                LEFT JOIN order_items oi ON o.id = oi.order_id
                LEFT JOIN products p ON oi.product_id = p.id
                $whereSql
                GROUP BY $groupBy
                ORDER BY time_point ASC";

        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryStats($startDate, $endDate, $staffId = null) {
        list($whereSql, $params) = $this->buildDateFilter($startDate, $endDate, $staffId);

        $sql = "SELECT c.name, SUM(oi.quantity) as qty 
                FROM order_items oi 
                JOIN orders o ON oi.order_id = o.id 
                JOIN products p ON oi.product_id = p.id 
                JOIN categories c ON p.category_id = c.id 
                $whereSql 
                GROUP BY c.id";
        
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrdersByRange($startDate, $endDate, $staffId = null) {
        list($whereSql, $params) = $this->buildDateFilter($startDate, $endDate, $staffId);

        $sql = "SELECT o.id, o.created_at, c.name as customer_name, o.total_amount 
                FROM orders o 
                LEFT JOIN customers c ON o.customer_id = c.id 
                $whereSql 
                ORDER BY o.created_at DESC";

        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function getRecentOrders($limit = 6, $staffId = null) {
        $where = $staffId ? "WHERE o.user_id = :staff_id" : "";
        $sql = "SELECT o.id, o.total_amount, o.created_at, c.name as customer_name
                FROM orders o
                LEFT JOIN customers c ON o.customer_id = c.id
                $where
                ORDER BY o.created_at DESC 
                LIMIT " . (int)$limit;
        return $this->query($sql, $staffId ? ['staff_id' => $staffId] : [])->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOrdersByEmployee($employeeId) {
        $sql = "SELECT o.id, 
                       DATE_FORMAT(o.created_at, '%d/%m') as created_at, 
                       o.total_amount, 
                       c.name as customer_name 
                FROM {$this->table} o 
                LEFT JOIN customers c ON o.customer_id = c.id 
                WHERE o.user_id = :employee_id 
                ORDER BY o.created_at DESC";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['employee_id' => $employeeId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    private function buildDateFilter($startDate, $endDate, $staffId = null) {
        $params = ['start' => $startDate, 'end' => $endDate];
        $where = " WHERE o.created_at BETWEEN :start AND :end ";
        if (!empty($staffId)) {
            $where .= " AND o.user_id = :staff_id";
            $params['staff_id'] = $staffId;
        }
        return [$where, $params];
    }
}