<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Auth;

class ProtectedController extends Controller {
    public function index() {
        if (!Auth::isLoggedIn()) $this->redirect('/login');
        $this->render('protected/index');
    }
}