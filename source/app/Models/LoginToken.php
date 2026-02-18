<?php

require_once __DIR__ . '/../Core/Model.php';

class LoginToken extends Model {
    protected $table = 'login_tokens';

    public function createToken($userId) {
        $token = bin2hex(random_bytes(32));

        // Hash token trước khi lưu DB (an toàn hơn nếu DB bị lộ)
        $hashedToken = hash('sha256', $token);

        // Xóa token cũ của user (đảm bảo chỉ có 1 token hợp lệ)
        $deleteSql = "DELETE FROM {$this->table} WHERE user_id = :user_id";
        $this->db->prepare($deleteSql)->execute([
            'user_id' => $userId
        ]);

        // Dùng DATE_ADD(NOW()...) của MySQL để đồng bộ với hàm findValidToken bên dưới.
        $sql = "INSERT INTO {$this->table} (user_id, token, expires_at) 
                VALUES (:user_id, :token, DATE_ADD(NOW(), INTERVAL 5 MINUTE))";

        $this->db->prepare($sql)->execute([
            'user_id' => $userId,
            'token' => $hashedToken
        ]);
        
        // Trả token thật cho email
        return $token;
    }
    
    public function findValidToken($token) {

        // Hash token để so sánh với DB
        $hashedToken = hash('sha256', $token);

        $sql = "SELECT * FROM {$this->table} 
                WHERE token = :token 
                AND expires_at > NOW()
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['token' => $hashedToken]);

        return $stmt->fetch(PDO::FETCH_OBJ); 
    }

    public function destroyToken($token) {

        // Hash token trước khi xóa
        $hashedToken = hash('sha256', $token);

        $sql = "DELETE FROM {$this->table} WHERE token = :token";
        $this->db->prepare($sql)->execute(['token' => $hashedToken]);
    }
}