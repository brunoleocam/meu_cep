<?php

class Router {
    public static function route($url) {
        // Define o nome do controlador baseado na URL ou usa "HomeController" por padrão
        $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
        
        // Caminho do controlador
        $controllerFile = "../app/controller/" . $controllerName . ".php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();

            $method = isset($url[1]) ? $url[1] : 'index';
            $params = array_slice($url, 2);

            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                require_once "../app/controller/HomeController.php";
                $home = new HomeController();
                $home->index(); 
            }
        } else {
            require_once "../app/controller/HomeController.php";
            $home = new HomeController();
            $home->index();
        }
    }
}
