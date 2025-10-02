<?php
class Carrito {
    private $session_key = 'carrito_compras';

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Agregar producto al carrito
    public function agregar($producto_id, $cantidad = 1, $producto_info = []) {
        $carrito = $this->getCarrito();

        if (isset($carrito[$producto_id])) {
            $carrito[$producto_id]['cantidad'] += $cantidad;
        } else {
            $carrito[$producto_id] = [
                'id' => $producto_id,
                'cantidad' => $cantidad,
                'nombre' => $producto_info['nombre'] ?? '',
                'precio' => $producto_info['precio'] ?? 0,
                'imagen' => $producto_info['imagen'] ?? '',
                'slug' => $producto_info['slug'] ?? ''
            ];
        }

        $_SESSION[$this->session_key] = $carrito;
        return true;
    }

    // Actualizar cantidad
    public function actualizar($producto_id, $cantidad) {
        $carrito = $this->getCarrito();

        if (isset($carrito[$producto_id])) {
            if ($cantidad <= 0) {
                unset($carrito[$producto_id]);
            } else {
                $carrito[$producto_id]['cantidad'] = $cantidad;
            }
        }

        $_SESSION[$this->session_key] = $carrito;
        return true;
    }

    // Eliminar producto del carrito
    public function eliminar($producto_id) {
        $carrito = $this->getCarrito();

        if (isset($carrito[$producto_id])) {
            unset($carrito[$producto_id]);
        }

        $_SESSION[$this->session_key] = $carrito;
        return true;
    }

    // Vaciar carrito
    public function vaciar() {
        unset($_SESSION[$this->session_key]);
        return true;
    }

    // Obtener carrito completo
    public function getCarrito() {
        return $_SESSION[$this->session_key] ?? [];
    }

    // Obtener total de items
    public function getTotalItems() {
        $carrito = $this->getCarrito();
        $total = 0;
        
        foreach ($carrito as $item) {
            $total += $item['cantidad'];
        }
        
        return $total;
    }

    // Obtener subtotal
    public function getSubtotal() {
        $carrito = $this->getCarrito();
        $subtotal = 0;
        
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }
        
        return $subtotal;
    }

    // Obtener total con delivery
    public function getTotal($delivery = 15) {
        return $this->getSubtotal() + $delivery;
    }
}