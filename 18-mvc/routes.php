<?php

class Router {

    public function run() {

        // Get URL
        $url = isset($_GET['url']) ? trim($_GET['url'], "/") : "pokemon/index";

        $segments = explode("/", $url);

        $controller = $segments[0] ?? "pokemon";
        $method     = $segments[1] ?? "index";
        $param      = $segments[2] ?? null;

        // Controller name
        $controllerName = ucfirst($controller) . "Controller";

        if (!file_exists("controllers/$controllerName.php")) {
            die("Controlador no encontrado");
        }

        require "controllers/$controllerName.php";
        $obj = new $controllerName();

        if (!method_exists($obj, $method)) {
            die("Método no encontrado");
        }

        $param ? $obj->$method($param) : $obj->$method();
    }
}
