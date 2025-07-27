<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Auth;
use app\models\AuthModel;
use app\models\CsrfModel;

class AuthController extends Controller {
    private $authModel;
    private $csrfModel;

    public function __construct() {
        $this->authModel = new AuthModel();
        $this->csrfModel = new CsrfModel();
    }

    public function register() {
        if (Auth::isLoggedIn()) $this->redirect('/dashboard');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = $_POST['password'];
            
            if ($this->authModel->register($username, $password)) {
                $_SESSION['message'] = 'Registration successful! Please login.';
                $this->redirect('/login');
            } else {
                $error = "Username already exists";
            }
        }
        
        $this->render('auth/register', ['error' => $error ?? null]);
    }

    public function login() {
        if (Auth::isLoggedIn()) $this->redirect('/dashboard');
        
        $csrfToken = $this->csrfModel->generateToken();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->csrfModel->validateToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }
            
            $username = htmlspecialchars(trim($_POST['username']));
            $password = $_POST['password'];
            
            if ($this->authModel->login($username, $password)) {
                $this->redirect('/dashboard');
            } else {
                $error = "Invalid username or password";
            }
        }
        
        $vkAuthModel = new \app\models\VkAuthModel();
        $vkAuthUrl = $vkAuthModel->getAuthorizeUrl();
        
        $this->render('auth/login', [
            'error' => $error ?? null,
            'csrfToken' => $csrfToken,
            'vkAuthUrl' => $vkAuthUrl
        ]);
    }

    public function logout() {
        Auth::logout();
        $this->redirect('/');
    }
}