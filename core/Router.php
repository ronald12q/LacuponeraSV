<?php

class Router {

    public function route($url) {

        $parts = explode('/', $url);

        $controller = ucfirst($parts[0]) . 'Controller';

        $action = isset($parts[1]) ? $parts[1] : 'index';

        $file = 'controllers/' . $controller . '.php';

        if (file_exists($file)) {

            require_once $file;

            $controllerInstance = new $controller();

            if (method_exists($controllerInstance, $action)) {

                $controllerInstance->$action();

            } else {

                echo '404 Action not found';

            }

        } else {

            echo '404 Controller not found';

        }

    }

}