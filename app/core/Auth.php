<?php
namespace app\core;

class Auth {
    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }

    public static function isVkUser() {
        return isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'vk';
    }

    public static function logout() {
        unset($_SESSION['user']);
        session_destroy();
    }
}