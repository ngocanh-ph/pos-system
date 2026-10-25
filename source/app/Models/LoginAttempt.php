<?php
require_once __DIR__ . '/../Core/Model.php';

class LoginAttempt extends Model {
    protected $table = 'login_attempts';
    const MAX_ATTEMPTS = 5;
    const WINDOW_MINUTES = 15;

    // Ngưỡng theo IP cao hơn nhiều để nhiều nhân viên dùng chung một mạng không khóa lẫn nhau
    const MAX_ATTEMPTS_PER_IP = 30;

    public function tooManyAttempts($username, $ip) {
        $window = "created_at > DATE_SUB(NOW(), INTERVAL " . self::WINDOW_MINUTES . " MINUTE)";
        $byUser = (int)$this->query("SELECT COUNT(*) FROM {$this->table} WHERE username = :u AND $window", ['u' => $username])->fetchColumn();
        $byIp = (int)$this->query("SELECT COUNT(*) FROM {$this->table} WHERE ip = :ip AND $window", ['ip' => $ip])->fetchColumn();
        return $byUser >= self::MAX_ATTEMPTS || $byIp >= self::MAX_ATTEMPTS_PER_IP;
    }

    public function record($username, $ip) {
        $this->query("INSERT INTO {$this->table} (username, ip) VALUES (:u, :ip)", ['u' => $username, 'ip' => $ip]);
    }

    public function clear($username) {
        $this->query("DELETE FROM {$this->table} WHERE username = :u", ['u' => $username]);
    }
}
