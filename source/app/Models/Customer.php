<?php

require_once __DIR__ . '/../Core/Model.php';

class Customer extends Model {
    protected $table = 'customers';
    public function findByPhone($phone) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE phone = :phone");
        $stmt->execute(['phone' => $phone]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (phone, name, address) VALUES (:phone, :name, :address)";
        try {
            $this->db->prepare($sql)->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // Trùng SĐT do request song song: dùng lại khách hàng đã có
            $existing = $this->findByPhone($data['phone']);
            return $existing ? $existing->id : false;
        }
    }

   
    /** Danh sách khách hàng có tìm kiếm và phân trang: trả về [rows, total]. */
    public function paginateWithOrderCount($search, $page, $perPage) {
        $where = '';
        $params = [];
        if ($search !== '') {
            $where = "WHERE c.name LIKE :s1 OR c.phone LIKE :s2";
            $params = ['s1' => "%$search%", 's2' => "%$search%"];
        }
        $total = (int)$this->query("SELECT COUNT(*) FROM customers c $where", $params)->fetchColumn();
        $sql = "SELECT c.*, COUNT(o.id) as order_count
                FROM customers c
                LEFT JOIN orders o ON c.id = o.customer_id
                $where
                GROUP BY c.id
                ORDER BY c.created_at DESC, c.id DESC
                LIMIT " . (int)$perPage . " OFFSET " . (int)(($page - 1) * $perPage);
        return [$this->query($sql, $params)->fetchAll(), $total];
    }

    public function getAllWithOrderCount() {
        $sql = "SELECT c.*, COUNT(o.id) as order_count 
                FROM customers c 
                LEFT JOIN orders o ON c.id = o.customer_id 
                GROUP BY c.id 
                ORDER BY c.created_at DESC";
        return $this->query($sql)->fetchAll();
    }

 
    public function getSpendingStats($customerId) {
       
        $sqlStats = "SELECT 
                        COUNT(id) as total_orders, 
                        COALESCE(SUM(total_amount), 0) as total_spent 
                     FROM orders WHERE customer_id = :cid";
        $basic = $this->query($sqlStats, ['cid' => $customerId])->fetch();

     
        $sqlProd = "SELECT SUM(oi.quantity) as total_products 
                    FROM order_items oi 
                    JOIN orders o ON oi.order_id = o.id 
                    WHERE o.customer_id = :cid";
        $prod = $this->query($sqlProd, ['cid' => $customerId])->fetch();

        return [
            'total_spent' => $basic->total_spent,
            'total_orders' => $basic->total_orders,
            'total_products' => $prod->total_products ?? 0
        ];
    }

    
    public function getHistory($customerId) {
        $sql = "SELECT o.*, COALESCE(SUM(oi.quantity), 0) as items_count 
                FROM orders o 
                LEFT JOIN order_items oi ON o.id = oi.order_id 
                WHERE o.customer_id = :cid 
                GROUP BY o.id 
                ORDER BY o.created_at DESC";
        return $this->query($sql, ['cid' => $customerId])->fetchAll();
    }
}