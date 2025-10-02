<?php
// Configuración de la aplicación para XAMPP
define('DB_HOST', 'localhost');
define('DB_NAME', 'floreria');
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', 'http://localhost/floreria');
define('CARRITO_SESSION', 'carrito_compras');

// Rutas de directorios
define('ROOT_PATH', dirname(dirname(__FILE__)));
define('APP_PATH', ROOT_PATH . '/app');
define('CONTROLLERS_PATH', APP_PATH . '/controllers');
define('MODELS_PATH', APP_PATH . '/models');
define('VIEWS_PATH', APP_PATH . '/views');
define('PUBLIC_PATH', ROOT_PATH . '/public');

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
                $dsn = "mysql:host={$config['host']};dbname={$config['name']};charset=utf8mb4";
                self::$instance = new PDO($dsn, $config['user'], $config['pass']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inicializar carrito si no existe
if (!isset($_SESSION[CARRITO_SESSION])) {
    $_SESSION[CARRITO_SESSION] = [];
}