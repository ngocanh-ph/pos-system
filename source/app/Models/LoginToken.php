<?php

require_once __DIR__ . '/../Core/Model.php';

class LoginToken extends Model {
    protected $table = 'login_tokens';

    public function createToken($userId) {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 minute')); // 1 minute validity per requirements
        
        $sql = "INSERT INTO {$this->table} (user_id, token, expires_at) VALUES (:user_id, :token, :expires_at)";
        $this->db->prepare($sql)->execute([
            'user_id' => $userId,
            'token' => $token,
            'expires_at' => $expires
        ]);
        
        return $token;
    }
    
    public function findValidToken($token) {
        $sql = "SELECT * FROM {$this->table} WHERE token = :token AND expires_at > NOW() AND used = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['token' => $token]);
        return $stmt->fetch();
    }
    
    public function markAsUsed($id) {
        $sql = "UPDATE {$this->table} SET used = 1 WHERE id = :id";
        $this->db->prepare($sql)->execute(['id' => $id]);
    }
}
