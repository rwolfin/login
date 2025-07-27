<?php
namespace app\core;

class Router {
    protected $routes = [];

    public function addRoute($route, $controllerAction) {
        $this->routes[$route] = $controllerAction;
    }

    public function dispatch($url) {
        $url = trim($url, '/');
        
        $controllerAction = $this->routes[$url] ?? null;

        if ($controllerAction) {
            list($controllerName, $method) = explode('@', $controllerAction);
            $controllerClass = 'app\\controllers\\' . $controllerName;
            
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                
                if (method_exists($controller, $method)) {
                    $controller->$method();
                    return;
                }
            }
        }

        http_response_code(404);
        echo 'Page not found';
    }
}