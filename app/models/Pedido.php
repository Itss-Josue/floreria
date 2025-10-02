<?php
class Pedido {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    public function crear($datos) {
        $codigo_pedido = 'PED' . date('Ymd') . rand(1000, 9999);
        
        $stmt = $this->db->prepare("INSERT INTO pedidos 
            (codigo_pedido, cliente_nombre, cliente_email, cliente_telefono, 
             direccion_entrega, fecha_entrega, hora_entrega, mensaje_tarjeta,
             subtotal, delivery, total) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $codigo_pedido,
            $datos['cliente_nombre'],
            $datos['cliente_email'],
            $datos['cliente_telefono'],
            $datos['direccion_entrega'],
            $datos['fecha_entrega'],
            $datos['hora_entrega'],
            $datos['mensaje_tarjeta'],
            $datos['subtotal'],
            $datos['delivery'],
            $datos['total']
        ]);
        
        return $this->db->lastInsertId();
    }
    
    public function agregarItem($pedido_id, $item) {
        $stmt = $this->db->prepare("INSERT INTO pedido_items 
            (pedido_id, producto_id, producto_nombre, producto_precio, cantidad, subtotal) 
            VALUES (?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $pedido_id,
            $item['producto_id'],
            $item['producto_nombre'],
            $item['producto_precio'],
            $item['cantidad'],
            $item['subtotal']
        ]);
    }
    
    public function getByCodigo($codigo) {
        $stmt = $this->db->prepare("SELECT * FROM pedidos WHERE codigo_pedido = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getItems($pedido_id) {
        $stmt = $this->db->prepare("SELECT * FROM pedido_items WHERE pedido_id = ?");
        $stmt->execute([$pedido_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}