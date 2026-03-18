<?php

require_once __DIR__ . '/../Core/Model.php';

class User extends Model {
    protected $table = 'users';

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findByToken($token) {
        $sql = "SELECT u.* FROM {$this->table} u
                JOIN login_tokens lt ON u.id = lt.user_id
                WHERE lt.token = :token AND lt.expires_at > NOW()";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['token' => $token]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} 
                (fullname, email, username, password, role, status, is_first_login) 
                VALUES 
                (:fullname, :email, :username, :password, :role, :status, :is_first_login)";
        
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute($data)) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function updatePassword($id, $hashedPassword) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password = :password, is_first_login = 0 WHERE id = :id");
        return $stmt->execute(['password' => $hashedPassword, 'id' => $id]);
    }
    public function getAllStaff() {
        return $this->query("SELECT * FROM {$this->table} WHERE role = 'staff'")->fetchAll(PDO::FETCH_OBJ);
    }
    public function getStaffBasicInfo() {
        return $this->query("SELECT id, fullname FROM {$this->table} WHERE role != 'admin'")->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateStatus($id, $status) {
        return $this->query("UPDATE {$this->table} SET status = :status WHERE id = :id", [
            'status' => $status,
            'id' => $id
        ]);
    }

    public function updateProfile($id, $fullname, $avatar, $phone) {
        return $this->query("UPDATE {$this->table} SET fullname = :name, avatar = :avatar, phone = :phone WHERE id = :id", [
            'name' => $fullname,
            'avatar' => $avatar,
            'phone' => $phone,
            'id' => $id
        ]);
    }
}