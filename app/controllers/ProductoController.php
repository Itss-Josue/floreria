<?php
class ProductoController {
    public function index() {
        require_once '../app/models/Producto.php';
        require_once '../app/models/Categoria.php';
        
        $productoModel = new Producto();
        $categoriaModel = new Categoria();
        
        $productos = $productoModel->getAll();
        $categorias = $categoriaModel->getAll();
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/productos/index.php';
        require_once '../app/views/layouts/footer.php';
    }
    
    public function categoria($slug) {
        require_once '../app/models/Producto.php';
        require_once '../app/models/Categoria.php';
        
        $productoModel = new Producto();
        $categoriaModel = new Categoria();
        
        $categoria = $categoriaModel->getBySlug($slug);
        
        if (!$categoria) {
            header('Location: ' . BASE_URL . '/producto');
            exit;
        }
        
        $productos = $productoModel->getByCategoria($categoria['id']);
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/productos/categoria.php';
        require_once '../app/views/layouts/footer.php';
    }
    
    public function ver($slug) {
    require_once '../app/models/Producto.php';
    $productoModel = new Producto();
    
    $producto = $productoModel->getBySlug($slug);
    
    if (!$producto) {
        header('Location: ' . BASE_URL . '/producto');
        exit;
    }
    
    require_once '../app/views/layouts/header.php';
    require_once '../app/views/productos/ver.php';
    require_once '../app/views/layouts/footer.php';
}
    
    public function buscar() {
        if (!isset($_GET['q']) || empty($_GET['q'])) {
            header('Location: ' . BASE_URL . '/producto');
            exit;
        }
        
        require_once '../app/models/Producto.php';
        $productoModel = new Producto();
        
        $termino = $_GET['q'];
        $productos = $productoModel->buscar($termino);
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/productos/buscar.php';
        require_once '../app/views/layouts/footer.php';
    }
}