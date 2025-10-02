<?php
class CarritoController {
    private $carritoModel;

    public function __construct() {
        require_once '../app/models/Carrito.php';
        $this->carritoModel = new Carrito();
    }

    public function index() {
        $carrito = $this->carritoModel->getCarrito();
        $subtotal = $this->carritoModel->getSubtotal();
        $total = $this->carritoModel->getTotal();
        $totalItems = $this->carritoModel->getTotalItems();

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/carrito/index.php';
        require_once '../app/views/layouts/footer.php';
    }

    public function agregar($id = null) {
        if (!$id) {
            header('Location: ' . BASE_URL . '/producto');
            exit;
        }

        // Obtener información del producto
        require_once '../app/models/Producto.php';
        $productoModel = new Producto();
        $producto = $productoModel->getById($id);

        if ($producto) {
            $this->carritoModel->agregar($id, 1, [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'imagen' => $producto['imagen'],
                'slug' => $producto['slug'] ?? ''
            ]);
        }

        header('Location: ' . BASE_URL . '/carrito');
        exit;
    }

    public function actualizar() {
        if ($_POST) {
            foreach ($_POST['cantidad'] as $producto_id => $cantidad) {
                $this->carritoModel->actualizar($producto_id, $cantidad);
            }
        }

        header('Location: ' . BASE_URL . '/carrito');
        exit;
    }

    public function eliminar($id = null) {
        if ($id) {
            $this->carritoModel->eliminar($id);
        }

        header('Location: ' . BASE_URL . '/carrito');
        exit;
    }

    public function vaciar() {
        $this->carritoModel->vaciar();
        header('Location: ' . BASE_URL . '/carrito');
        exit;
    }
}