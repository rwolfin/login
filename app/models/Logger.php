<?php
namespace app\models;

class Logger {
    private $logFile = __DIR__ . '/../../logs/auth_attempts.log';
    
    public function logFailedAttempt($username) {
        $entry = sprintf(
            "[%s] Failed login attempt for user: %s (IP: %s)\n",
            date('Y-m-d H:i:s'),
            $username,
            $_SERVER['REMOTE_ADDR']
        );
        file_put_contents($this->logFile, $entry, FILE_APPEND);
    }
}