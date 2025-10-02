<?php
class CheckoutController {
    private $carritoModel;
    private $pedidoModel;

    public function __construct() {
        require_once '../app/models/Carrito.php';
        require_once '../app/models/Pedido.php';
        $this->carritoModel = new Carrito();
        $this->pedidoModel = new Pedido();
    }

    public function index() {
        $carrito = $this->carritoModel->getCarrito();
        
        if (empty($carrito)) {
            header('Location: ' . BASE_URL . '/carrito');
            exit;
        }

        $subtotal = $this->carritoModel->getSubtotal();
        $delivery = 15.00;
        $total = $this->carritoModel->getTotal($delivery);

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/checkout/index.php';
        require_once '../app/views/layouts/footer.php';
    }

    public function procesar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/checkout');
            exit;
        }

        $carrito = $this->carritoModel->getCarrito();
        
        if (empty($carrito)) {
            header('Location: ' . BASE_URL . '/carrito');
            exit;
        }

        // Validar datos del formulario
        $datos = [
            'cliente_nombre' => trim($_POST['cliente_nombre']),
            'cliente_email' => trim($_POST['cliente_email']),
            'cliente_telefono' => trim($_POST['cliente_telefono']),
            'direccion_entrega' => trim($_POST['direccion_entrega']),
            'fecha_entrega' => $_POST['fecha_entrega'],
            'hora_entrega' => $_POST['hora_entrega'],
            'mensaje_tarjeta' => trim($_POST['mensaje_tarjeta'] ?? ''),
            'subtotal' => $this->carritoModel->getSubtotal(),
            'delivery' => 15.00,
            'total' => $this->carritoModel->getTotal(15.00)
        ];

        // Validaciones básicas
        if (empty($datos['cliente_nombre']) || empty($datos['cliente_email']) || empty($datos['direccion_entrega'])) {
            $_SESSION['error'] = 'Por favor complete todos los campos requeridos.';
            header('Location: ' . BASE_URL . '/checkout');
            exit;
        }

        // Crear pedido
        $pedido_id = $this->pedidoModel->crear($datos);

        // Agregar items del pedido
        foreach ($carrito as $item) {
            $this->pedidoModel->agregarItem($pedido_id, [
                'producto_id' => $item['id'],
                'producto_nombre' => $item['nombre'],
                'producto_precio' => $item['precio'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $item['precio'] * $item['cantidad']
            ]);
        }

        // Vaciar carrito
        $this->carritoModel->vaciar();

        // Redirigir a confirmación
        header('Location: ' . BASE_URL . '/checkout/confirmacion/' . $pedido_id);
        exit;
    }

    public function confirmacion($pedido_id) {
        // Aquí podrías obtener los detalles del pedido para mostrar
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/checkout/confirmacion.php';
        require_once '../app/views/layouts/footer.php';
    }
}