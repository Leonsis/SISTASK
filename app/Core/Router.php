<?php

class Router
{

    public static function dispatch()
    {
        $routes = require '../routes.php';

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $uri = str_replace('/SisTasks/public', '', $uri); // Modifique de acordo com o nome da aplicação

        if (!isset($routes[$uri])) {
            http_response_code(404);
            die('Página não encontrada');
        }

        $controllerName = $routes[$uri]['controller'];
        $method = $routes[$uri]['method'];
        
        require __DIR__ . "/../Controllers/$controllerName.php";

        $controller = new $controllerName();

        $controller->$method();
    }
}