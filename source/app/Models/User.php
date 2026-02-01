<?php

require_once __DIR__ . '/../Core/Model.php';

class User extends Model {
    protected $table = 'users';

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
    

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (username, email, role, fullname, status, require_password_change) 
                VALUES (:username, :email, :role, :fullname, :status, :require_password_change)";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'username' => $data['username'],
                'email' => $data['email'],
                'role' => $data['role'],
                'fullname' => $data['fullname'],
                'status' => 'active',
                'require_password_change' => 1 
            ]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updatePassword($id, $hashedPassword) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password = :password, require_password_change = 0 WHERE id = :id");
        return $stmt->execute(['password' => $hashedPassword, 'id' => $id]);
    }
}