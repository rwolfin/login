<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Auth;

class DashboardController extends Controller {
    public function index() {
        if (!Auth::isLoggedIn()) $this->redirect('/login');
        $this->render('dashboard/index');
    }
}