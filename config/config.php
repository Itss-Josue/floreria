<?php
// Configuración de la aplicación
define('DB_HOST', 'localhost');
define('DB_NAME', 'floreria');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('BASE_URL', 'http://localhost:8888/floreria');
define('CARRITO_SESSION', 'carrito_compras');

// Configuración global
$GLOBALS['config'] = [
    'database' => [
        'host' => DB_HOST,
        'name' => DB_NAME, 
        'user' => DB_USER,
        'pass' => DB_PASS
    ],
    'app' => [
        'name' => 'Florería',
        'url' => BASE_URL
    ]
];

// Conexión a la base de datos
class Database {
    private static $instance = null;
    
    public static function getConnection() {
        if (self::$instance === null) {
            try {
                $config = $GLOBALS['config']['database'];
                $dsn = "mysql:host={$config['host']};dbname={$config['name']};charset=utf8";
                self::$instance = new PDO($dsn, $config['user'], $config['pass']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}