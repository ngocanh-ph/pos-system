<?php

require_once __DIR__ . '/../Core/Model.php';

class Category extends Model {
    protected $table = 'categories';

    public function getAllWithCreator() {
        $sql = "SELECT c.*, u.fullname as creator_name 
                FROM categories c 
                LEFT JOIN users u ON c.created_by = u.id 
                ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (name, description, created_by) VALUES (:name, :description, :created_by)";
        return $this->db->prepare($sql)->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'created_by' => $data['created_by']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET name = :name, description = :description WHERE id = :id";
        return $this->db->prepare($sql)->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->db->prepare($sql)->execute(['id' => $id]);
    }
}