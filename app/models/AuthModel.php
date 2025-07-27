<?php
namespace app\models;

use app\core\Model;
use app\models\User;

class AuthModel extends Model {
    private $logger;

    public function __construct() {
        parent::__construct();
        $this->logger = new Logger();
    }

    public function register($username, $password) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->fetch()) return false;
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 'regular';
        
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, $role]);
        return true;
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = new User($user['id'], $user['username'], $user['role']);
            return true;
        }
        
        $this->logger->logFailedAttempt($username);
        return false;
    }

    public function loginWithVk($vkUserId, $username, $email) {
        $stmt = $this->db->prepare("SELECT id, username, role FROM users WHERE vk_user_id = ?");
        $stmt->execute([$vkUserId]);
        $user = $stmt->fetch();
        
        if ($user) {
            $_SESSION['user'] = new User($user['id'], $user['username'], $user['role'], $email);
            return true;
        }
        
        $role = 'vk';
        $stmt = $this->db->prepare("INSERT INTO users (username, role, email, vk_user_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $role, $email, $vkUserId]);
        $userId = $this->db->lastInsertId();
        
        $_SESSION['user'] = new User($userId, $username, $role, $email);
        return true;
    }
}