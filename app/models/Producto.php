<?php
class Producto {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    public function getAll() {
        $stmt = $this->db->prepare("SELECT p.*, c.nombre as categoria_nombre 
                                   FROM productos p 
                                   LEFT JOIN categorias c ON p.categoria_id = c.id 
                                   WHERE p.estado = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT p.*, c.nombre as categoria_nombre 
                                   FROM productos p 
                                   LEFT JOIN categorias c ON p.categoria_id = c.id 
                                   WHERE p.id = ? AND p.estado = 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getDestacados() {
        $stmt = $this->db->prepare("SELECT p.*, c.nombre as categoria_nombre 
                                   FROM productos p 
                                   LEFT JOIN categorias c ON p.categoria_id = c.id 
                                   WHERE p.destacado = 1 AND p.estado = 1 
                                   LIMIT 6");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getByCategoria($categoria_id) {
        $stmt = $this->db->prepare("SELECT p.*, c.nombre as categoria_nombre 
                                   FROM productos p 
                                   LEFT JOIN categorias c ON p.categoria_id = c.id 
                                   WHERE p.categoria_id = ? AND p.estado = 1");
        $stmt->execute([$categoria_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscar($termino) {
        $stmt = $this->db->prepare("SELECT p.*, c.nombre as categoria_nombre 
                                   FROM productos p 
                                   LEFT JOIN categorias c ON p.categoria_id = c.id 
                                   WHERE (p.nombre LIKE ? OR p.descripcion LIKE ?) 
                                   AND p.estado = 1");
        $likeTerm = "%$termino%";
        $stmt->execute([$likeTerm, $likeTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBySlug($slug) {
    $stmt = $this->db->prepare("SELECT p.*, c.nombre as categoria_nombre 
                               FROM productos p 
                               LEFT JOIN categorias c ON p.categoria_id = c.id 
                               WHERE p.slug = ? AND p.estado = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}