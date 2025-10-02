<?php
// Cargar configuración
require_once '../config/config.php';

// Router simple
$url = $_GET['url'] ?? 'home';
$url = rtrim($url, '/');
$urlParts = explode('/', $url);

$controllerName = ucfirst($urlParts[0] ?? 'home') . 'Controller';
$method = $urlParts[1] ?? 'index';
$param = $urlParts[2] ?? null;

// DEBUG: Ver qué URL se está procesando
// echo "Controller: $controllerName, Method: $method, Param: $param<br>";

// Cargar controlador
$controllerPath = "../app/controllers/{$controllerName}.php";

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    
    // Verificar si la clase existe
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        
        if (method_exists($controller, $method)) {
            if ($param) {
                $controller->$method($param);
            } else {
                $controller->$method();
            }
        } else {
            // Método no encontrado
            http_response_code(404);
            echo "Método no encontrado: $method";
        }
    } else {
        http_response_code(404);
        echo "Clase no encontrada: $controllerName";
    }
} else {
    // Controlador no encontrado
    http_response_code(404);
    echo "Controlador no encontrado: $controllerPath";
}