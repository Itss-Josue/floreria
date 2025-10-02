<?php
class CheckoutController {
    
    public function index() {
        // Verificar que el carrito no esté vacío
        if (empty($_SESSION[CARRITO_SESSION])) {
            header('Location: ' . BASE_URL . '/carrito');
            exit;
        }
        
        // Obtener carrito de la sesión
        $carrito = $_SESSION[CARRITO_SESSION];
        
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
        require_once VIEWS_PATH . '/checkout/index.php';
    }
    
    public function procesar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar que el carrito no esté vacío
            if (empty($_SESSION[CARRITO_SESSION])) {
                header('Location: ' . BASE_URL . '/carrito');
                exit;
            }
            
            // Procesar el pedido
            $pedido = [
                'cliente' => [
                    'nombre' => $_POST['nombre'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'telefono' => $_POST['telefono'] ?? '',
                    'direccion' => $_POST['direccion'] ?? '',
                    'ciudad' => $_POST['ciudad'] ?? '',
                    'codigo_postal' => $_POST['codigo_postal'] ?? '',
                    'pais' => $_POST['pais'] ?? '',
                    'mensaje' => $_POST['mensaje'] ?? ''
                ],
                'metodo_pago' => $_POST['metodo_pago'] ?? 'tarjeta',
                'carrito' => $_SESSION[CARRITO_SESSION],
                'fecha' => date('Y-m-d H:i:s'),
                'numero_pedido' => 'PED' . date('YmdHis')
            ];
            
            // Guardar pedido en sesión
            $_SESSION['ultimo_pedido'] = $pedido;
            
            // Vaciar carrito
            $_SESSION[CARRITO_SESSION] = [];
            
            // Redirigir a confirmación
            header('Location: ' . BASE_URL . '/checkout/confirmacion');
            exit;
        } else {
            // Si no es POST, redirigir al checkout
            header('Location: ' . BASE_URL . '/checkout');
            exit;
        }
    }
    
    public function confirmacion() {
        // Verificar que hay un pedido reciente
        if (!isset($_SESSION['ultimo_pedido'])) {
            header('Location: ' . BASE_URL . '/producto');
            exit;
        }
        
        $pedido = $_SESSION['ultimo_pedido'];
        
        // Incluir header
        require_once VIEWS_PATH . '/layouts/header.php';
        
        // Mostrar página de confirmación
        echo '
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mt-5">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="bi bi-check-circle-fill text-success display-1"></i>
                            </div>
                            <h1 class="text-success mb-3">¡Pedido Confirmado!</h1>
                            <p class="lead mb-4">Tu pedido ha sido procesado exitosamente.</p>
                            
                            <div class="card bg-light border-0 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Número de Pedido: <strong>' . $pedido['numero_pedido'] . '</strong></h5>
                                    <p class="card-text">Te hemos enviado un correo de confirmación a: <strong>' . $pedido['cliente']['email'] . '</strong></p>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <a href="' . BASE_URL . '/producto" class="btn btn-primary">
                                    <i class="bi bi-flower1 me-2"></i>Seguir Comprando
                                </a>
                                <a href="' . BASE_URL . '/" class="btn btn-outline-primary">
                                    <i class="bi bi-house me-2"></i>Ir al Inicio
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        
        // Incluir footer
        require_once VIEWS_PATH . '/layouts/footer.php';
        
        // Limpiar pedido de la sesión después de mostrar
        unset($_SESSION['ultimo_pedido']);
    }
}
?>