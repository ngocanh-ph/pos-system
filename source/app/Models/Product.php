<?php

require_once __DIR__ . '/../Core/Model.php';

class Product extends Model {
    protected $table = 'products';

    public function findAllWithCategory() {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findByBarcode($barcode) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE barcode = :barcode");
        $stmt->execute(['barcode' => $barcode]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (barcode, name, import_price, sale_price, category_id, image) 
                VALUES (:barcode, :name, :import_price, :sale_price, :category_id, :image)";
        return $this->db->prepare($sql)->execute($data);
    }

    public function update($id, $data) {
        // Build query dynamically based on whether image is updated
        $sql = "UPDATE {$this->table} SET 
                barcode = :barcode, 
                name = :name, 
                import_price = :import_price, 
                sale_price = :sale_price, 
                category_id = :category_id";
        
        if (!empty($data['image'])) {
            $sql .= ", image = :image";
        }
        
        $sql .= " WHERE id = :id";
        
        $params = [
            'barcode' => $data['barcode'],
            'name' => $data['name'],
            'import_price' => $data['import_price'],
            'sale_price' => $data['sale_price'],
            'category_id' => $data['category_id'],
            'id' => $id
        ];
        
        if (!empty($data['image'])) {
            $params['image'] = $data['image'];
        }

        return $this->db->prepare($sql)->execute($params);
    }

    public function canDelete($id) {
        // "Chỉ xóa nếu chưa từng bán" -> Check order_items
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM order_items WHERE product_id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row->count == 0;
    }

    public function delete($id) {
        if ($this->canDelete($id)) {
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        }
        return false;
    }
}
