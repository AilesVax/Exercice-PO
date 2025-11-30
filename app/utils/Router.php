<?php

class Router {
    public function dispatch($url) {
        $url = trim($url, '/');
        $url = explode('/', $url);

        $controllerName = ucfirst($url[1] ?? 'user') . 'Controller'; // Index 1 car /MVC/user/...
        $methodName = $url[2] ?? 'index';
        $params = array_slice($url, 3);

        $controllerFile = "./app/controllers/$controllerName.php";
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName;

            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
            } else {
                die('<p>Méthode introuvable</p>');
            }
        } else {
            die('<p>Controleur introuvable</p>');
        }
    }
}
