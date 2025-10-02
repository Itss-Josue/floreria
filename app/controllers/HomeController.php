<?php
class HomeController {
    public function index() {
        // Cargar modelos
        require_once '../app/models/Producto.php';
        require_once '../app/models/Categoria.php';
        
        $productoModel = new Producto();
        $categoriaModel = new Categoria();
        
        $productosDestacados = $productoModel->getDestacados();
        $categorias = $categoriaModel->getAll();
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/home/index.php';
        require_once '../app/views/layouts/footer.php';
    }
}