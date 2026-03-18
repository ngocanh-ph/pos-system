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
    
    $path = $_SERVER['REQUEST_URI'];
    $path = parse_url($path, PHP_URL_PATH);
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    if ($scriptDir !== '/' && strpos($path, $scriptDir) === 0) {
        $path = substr($path, strlen($scriptDir));
    }
    if (empty($path)) $path = '/';
    if ($path !== '/' && substr($path, -1) === '/') {
        $path = rtrim($path, '/');
    }
    $callback = $this->routes[$method][$path] ?? false;

    if ($callback === false) {
        http_response_code(404);
        echo "404 Not Found: Đường dẫn hiện tại là [$path]";
        return;
    }
    if (is_array($callback)) {
        $controller = new $callback[0]();
        $action = $callback[1];
        call_user_func([$controller, $action]);
    } else {
        call_user_func($callback);
    }
}
}