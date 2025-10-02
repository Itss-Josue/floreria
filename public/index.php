<?php
// Cargar configuración
require_once '../config/config.php';

// Autoload simple
spl_autoload_register(function($className) {
    $paths = [
        '../app/controllers/',
        '../app/models/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Routing básico
$request = $_GET['url'] ?? '';
$request = rtrim($request, '/');

if (empty($request)) {
    $request = 'home';
}

$parts = explode('/', $request);

$controllerName = ucfirst($parts[0]) . 'Controller';
$method = $parts[1] ?? 'index';
$id = $parts[2] ?? null;

if (file_exists("../app/controllers/{$controllerName}.php")) {
    require_once "../app/controllers/{$controllerName}.php";
    
    $controller = new $controllerName();
    
    if (method_exists($controller, $method)) {
        if ($id) {
            $controller->$method($id);
        } else {
            $controller->$method();
        }
    } else {
        http_response_code(404);
        echo "Página no encontrada";
    }
} else {
    http_response_code(404);
    echo "Página no encontrada";
}