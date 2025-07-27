<?php
namespace app\controllers;

use app\core\Controller;
use app\models\AuthModel;
use app\models\VkAuthModel;

class VkAuthController extends Controller {
    public function callback() {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $vkAuthModel = new VkAuthModel();
            $userData = $vkAuthModel->getUserData($code);
            
            if ($userData) {
                $authModel = new AuthModel();
                $vkUserId = $userData['id'];
                $username = $userData['first_name'] . ' ' . $userData['last_name'];
                $email = $userData['email'] ?? null;
                
                $authModel->loginWithVk($vkUserId, $username, $email);
                $this->redirect('/dashboard');
                return;
            }
        }
        
        $_SESSION['error'] = 'VK authorization failed';
        $this->redirect('/login');
    }
}