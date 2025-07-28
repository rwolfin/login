<?php
require_once 'config/config.php';
require_once 'app/core/Router.php';
require_once 'app/core/Database.php';
require_once 'app/core/Auth.php';
require_once 'app/core/Controller.php';
require_once 'app/core/Model.php';

require_once 'app/models/AuthModel.php';
require_once 'app/models/CsrfModel.php';
require_once 'app/models/Logger.php';
require_once 'app/models/User.php';
require_once 'app/models/VkAuthModel.php';

require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/DashboardController.php';
require_once 'app/controllers/ProtectedController.php';
require_once 'app/controllers/VkAuthController.php';

session_start();


spl_autoload_register(function ($class) {
    $classFile = 'app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});


$router = new app\core\Router();


$router->addRoute('', 'HomeController@index');
$router->addRoute('register', 'AuthController@register');
$router->addRoute('login', 'AuthController@login');
$router->addRoute('logout', 'AuthController@logout');
$router->addRoute('vk_callback', 'VkAuthController@callback');
$router->addRoute('dashboard', 'DashboardController@index');
$router->addRoute('protected', 'ProtectedController@index');


$router->dispatch($_GET['url'] ?? '');