<?php
namespace app\models;

class User {
    private $id;
    private $username;
    private $role;
    private $email;

    public function __construct($id, $username, $role, $email = null) {
        $this->id = $id;
        $this->username = $username;
        $this->role = $role;
        $this->email = $email;
    }

    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getRole() { return $this->role; }
    public function getEmail() { return $this->email; }
    public function isRegular() { return $this->role === 'regular'; }
    public function isVkUser() { return $this->role === 'vk'; }
}