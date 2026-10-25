<?php

class Router {
    private $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];

        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptDir = str_replace(chr(92), '/', dirname($_SERVER['SCRIPT_NAME']));
        if ($scriptDir !== '/' && strpos($path, $scriptDir) === 0) {
            $path = substr($path, strlen($scriptDir));
        }
        if (empty($path)) $path = '/';
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $otherMethod = false;
            foreach ($this->routes as $m => $list) {
                if (isset($list[$path])) $otherMethod = true;
            }
            http_response_code($otherMethod ? 405 : 404);
            echo $otherMethod ? '405 Method Not Allowed' : '404 Not Found';
            return;
        }

        if ($method === 'POST') {
            Security::verifyCsrf();
        }
        Security::refreshUser();
        Security::enforceForcePassword($path);

        if (is_array($callback)) {
            $controller = new $callback[0]();
            call_user_func([$controller, $callback[1]]);
        } else {
            call_user_func($callback);
        }
    }
}
