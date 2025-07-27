<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Auth.php';

session_start();


spl_autoload_register(function ($class) {
    $classFile = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
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