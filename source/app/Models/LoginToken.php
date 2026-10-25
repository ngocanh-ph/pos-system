<?php

require_once __DIR__ . '/../Core/Model.php';

class LoginToken extends Model {
    protected $table = 'login_tokens';

    public function createToken($userId) {
        // Mỗi user chỉ có một token còn hiệu lực
        $this->db->prepare("DELETE FROM {$this->table} WHERE user_id = :uid")->execute(['uid' => $userId]);
        $token = bin2hex(random_bytes(32));
        $sql = "INSERT INTO {$this->table} (user_id, token, expires_at) 
                VALUES (:user_id, :token, DATE_ADD(NOW(), INTERVAL 30 MINUTE))";
        $this->db->prepare($sql)->execute([
            'user_id' => $userId,
            'token' => $token
        ]);
        
        return $token;
    }
    
    public function findValidToken($token) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE token = :token 
                AND expires_at > NOW()
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['token' => $token]);

        return $stmt->fetch(PDO::FETCH_OBJ); 
    }

    public function destroyToken($token) {
        $sql = "DELETE FROM {$this->table} WHERE token = :token";
        $this->db->prepare($sql)->execute(['token' => $token]);
    }
}