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
            return false;
        }
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
        $sql = "SELECT o.*, COUNT(oi.id) as items_count 
                FROM orders o 
                LEFT JOIN order_items oi ON o.id = oi.order_id 
                WHERE o.customer_id = :cid 
                GROUP BY o.id 
                ORDER BY o.created_at DESC";
        return $this->query($sql, ['cid' => $customerId])->fetchAll();
    }
}