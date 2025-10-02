<?php
class CarritoController {
    
    public function agregar($id) {
        // Obtener el producto de la base de datos
        $producto = $this->obtenerProductoPorId($id);
        
        if ($producto) {
            // Verificar si el producto ya está en el carrito
            if (isset($_SESSION[CARRITO_SESSION][$id])) {
                $_SESSION[CARRITO_SESSION][$id]['cantidad']++;
            } else {
                // Agregar nuevo producto al carrito
                $_SESSION[CARRITO_SESSION][$id] = [
                    'id' => $producto['id'],
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'imagen' => $producto['imagen_principal'],
                    'cantidad' => 1
                ];
            }
            
            header('Location: ' . BASE_URL . '/carrito');
            exit;
        } else {
            // Producto no encontrado
            header('Location: ' . BASE_URL . '/producto');
            exit;
        }
    }
    
    private function obtenerProductoPorId($id) {
        // Datos de prueba - reemplaza con tu consulta a la base de datos
        $productos = [
            1 => ['id' => 1, 'nombre' => 'Ramos de Rosas Rojas', 'precio' => 100.00, 'imagen_principal' => 'flor1.jpg'],
            2 => ['id' => 2, 'nombre' => 'Tulipanes Multicolores', 'precio' => 95.00, 'imagen_principal' => 'flor2.jpg'],
            3 => ['id' => 3, 'nombre' => 'Girasoles Brillantes', 'precio' => 85.00, 'imagen_principal' => 'flor3.jpg'],
            4 => ['id' => 4, 'nombre' => 'Arreglo Premium', 'precio' => 200.00, 'imagen_principal' => 'flor4.jpg'],
            5 => ['id' => 5, 'nombre' => 'Lirios Blancos Elegantes', 'precio' => 110.00, 'imagen_principal' => 'flor5.jpg'],
            6 => ['id' => 6, 'nombre' => 'Orquídeas Exóticas', 'precio' => 150.00, 'imagen_principal' => 'flor7.jpg'],
            7 => ['id' => 7, 'nombre' => 'Margaritas Frescas', 'precio' => 65.00, 'imagen_principal' => 'flor8.jpg'],
            8 => ['id' => 8, 'nombre' => 'Rosas Blancas Puras', 'precio' => 90.00, 'imagen_principal' => 'flor1.jpg'],
            9 => ['id' => 9, 'nombre' => 'Crisantemos Coloridos', 'precio' => 75.00, 'imagen_principal' => 'flor2.jpg'],
            10 => ['id' => 10, 'nombre' => 'Hortensias Azules', 'precio' => 120.00, 'imagen_principal' => 'flor3.jpg'],
            11 => ['id' => 11, 'nombre' => 'Claveles Rojos Pasión', 'precio' => 70.00, 'imagen_principal' => 'flor4.jpg'],
            12 => ['id' => 12, 'nombre' => 'Lavanda Aromática', 'precio' => 55.00, 'imagen_principal' => 'flor5.jpg'],
            13 => ['id' => 13, 'nombre' => 'Peonías Rosadas', 'precio' => 130.00, 'imagen_principal' => 'flor7.jpg'],
            14 => ['id' => 14, 'nombre' => 'Gerberas Vibrantes', 'precio' => 80.00, 'imagen_principal' => 'flor8.jpg']
        ];
        
        return $productos[$id] ?? null;
    }
    
    public function index() {
        // Obtener carrito de la sesión
        $carrito = $_SESSION[CARRITO_SESSION] ?? [];
        
        // Calcular totales
        $subtotal = 0;
        $totalItems = 0;
        
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
            $totalItems += $item['cantidad'];
        }
        
        $delivery = 15.00;
        $total = $subtotal + $delivery;
        
        // Pasar datos a la vista
        require_once VIEWS_PATH . '/carrito/index.php';
    }
    
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cantidad'])) {
            foreach ($_POST['cantidad'] as $id => $cantidad) {
                $cantidad = intval($cantidad);
                if ($cantidad > 0 && isset($_SESSION[CARRITO_SESSION][$id])) {
                    $_SESSION[CARRITO_SESSION][$id]['cantidad'] = $cantidad;
                } elseif ($cantidad <= 0 && isset($_SESSION[CARRITO_SESSION][$id])) {
                    unset($_SESSION[CARRITO_SESSION][$id]);
                }
            }
        }
        
        header('Location: ' . BASE_URL . '/carrito');
        exit;
    }
    
    public function eliminar($id) {
        if (isset($_SESSION[CARRITO_SESSION][$id])) {
            unset($_SESSION[CARRITO_SESSION][$id]);
        }
        
        header('Location: ' . BASE_URL . '/carrito');
        exit;
    }
    
    public function vaciar() {
        $_SESSION[CARRITO_SESSION] = [];
        header('Location: ' . BASE_URL . '/carrito');
        exit;
    }
}
?>