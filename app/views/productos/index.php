<?php
// Obtener parámetros de búsqueda y filtros
$searchTerm = $_GET['search'] ?? '';
$categoriaId = $_GET['categoria'] ?? '';
$orden = $_GET['orden'] ?? 'nombre';
$viewMode = $_GET['view'] ?? 'grid'; // grid o list

// TEMPORAL: Datos de prueba con 10 productos adicionales (eliminar cuando tengas la base de datos)
if (!isset($productos) || empty($productos)) {
    $productos = [
        [
            'id' => 1,
            'nombre' => 'Ramos de Rosas Rojas',
            'descripcion' => 'Hermoso ramo de 12 rosas rojas frescas, perfecto para ocasiones especiales.',
            'precio' => 100.00,
            'precio_original' => 120.00,
            'imagen_principal' => 'flor1.jpg',
            'stock' => 15,
            'destacado' => true,
            'categoria_nombre' => 'Rosas',
            'slug' => 'ramos-rosas-rojas'
        ],
        [
            'id' => 2,
            'nombre' => 'Tulipanes Multicolores',
            'descripcion' => 'Elegante arreglo de tulipanes en diversos colores que alegrarán cualquier espacio.',
            'precio' => 95.00,
            'precio_original' => 100.00,
            'imagen_principal' => 'flor2.jpg',
            'stock' => 8,
            'destacado' => true,
            'categoria_nombre' => 'Tulipanes',
            'slug' => 'tulipanes-multicolores'
        ],
        [
            'id' => 3,
            'nombre' => 'Girasoles Brillantes',
            'descripcion' => 'Radiantes girasoles que transmiten alegría y energía positiva.',
            'precio' => 85.00,
            'precio_original' => null,
            'imagen_principal' => 'flor3.jpg',
            'stock' => 12,
            'destacado' => false,
            'categoria_nombre' => 'Girasoles',
            'slug' => 'girasoles-brillantes'
        ],
        [
            'id' => 4,
            'nombre' => 'Arreglo Premium',
            'descripcion' => 'Lujoso arreglo floral combinado con rosas, lirios y verdes decorativos.',
            'precio' => 200.00,
            'precio_original' => 250.00,
            'imagen_principal' => 'flor4.jpg',
            'stock' => 5,
            'destacado' => true,
            'categoria_nombre' => 'Arreglos',
            'slug' => 'arreglo-premium'
        ],
        [
            'id' => 5,
            'nombre' => 'Lirios Blancos Elegantes',
            'descripcion' => 'Exquisitos lirios blancos que irradian pureza y elegancia natural.',
            'precio' => 110.00,
            'precio_original' => 130.00,
            'imagen_principal' => 'flor5.jpg',
            'stock' => 10,
            'destacado' => false,
            'categoria_nombre' => 'Lirios',
            'slug' => 'lirios-blancos-elegantes'
        ],
        [
            'id' => 6,
            'nombre' => 'Orquídeas Exóticas',
            'descripcion' => 'Hermosas orquídeas de colores vibrantes, ideales para decoración sofisticada.',
            'precio' => 150.00,
            'precio_original' => 180.00,
            'imagen_principal' => 'flor7.jpg',
            'stock' => 6,
            'destacado' => true,
            'categoria_nombre' => 'Orquídeas',
            'slug' => 'orquideas-exoticas'
        ],
        [
            'id' => 7,
            'nombre' => 'Margaritas Frescas',
            'descripcion' => 'Alegres margaritas que aportan un toque de frescura y sencillez.',
            'precio' => 65.00,
            'precio_original' => null,
            'imagen_principal' => 'flor8.jpg',
            'stock' => 20,
            'destacado' => false,
            'categoria_nombre' => 'Margaritas',
            'slug' => 'margaritas-frescas'
        ],
        [
            'id' => 8,
            'nombre' => 'Rosas Blancas Puras',
            'descripcion' => 'Delicadas rosas blancas que simbolizan pureza y nuevos comienzos.',
            'precio' => 90.00,
            'precio_original' => 110.00,
            'imagen_principal' => 'flor1.jpg',
            'stock' => 14,
            'destacado' => false,
            'categoria_nombre' => 'Rosas',
            'slug' => 'rosas-blancas-puras'
        ],
        [
            'id' => 9,
            'nombre' => 'Crisantemos Coloridos',
            'descripcion' => 'Vibrantes crisantemos en una variedad de colores para cada ocasión.',
            'precio' => 75.00,
            'precio_original' => 85.00,
            'imagen_principal' => 'flor2.jpg',
            'stock' => 18,
            'destacado' => false,
            'categoria_nombre' => 'Crisantemos',
            'slug' => 'crisantemos-coloridos'
        ],
        [
            'id' => 10,
            'nombre' => 'Hortensias Azules',
            'descripcion' => 'Magníficas hortensias azules que crean un impacto visual espectacular.',
            'precio' => 120.00,
            'precio_original' => 140.00,
            'imagen_principal' => 'flor3.jpg',
            'stock' => 7,
            'destacado' => true,
            'categoria_nombre' => 'Hortensias',
            'slug' => 'hortensias-azules'
        ],
        [
            'id' => 11,
            'nombre' => 'Claveles Rojos Pasión',
            'descripcion' => 'Intensos claveles rojos que expresan amor y admiración profunda.',
            'precio' => 70.00,
            'precio_original' => 80.00,
            'imagen_principal' => 'flor4.jpg',
            'stock' => 16,
            'destacado' => false,
            'categoria_nombre' => 'Claveles',
            'slug' => 'claveles-rojos-pasion'
        ],
        [
            'id' => 12,
            'nombre' => 'Lavanda Aromática',
            'descripcion' => 'Relajante lavanda con aroma calmante, perfecta para espacios serenos.',
            'precio' => 55.00,
            'precio_original' => null,
            'imagen_principal' => 'flor5.jpg',
            'stock' => 25,
            'destacado' => false,
            'categoria_nombre' => 'Aromáticas',
            'slug' => 'lavanda-aromatica'
        ],
        [
            'id' => 13,
            'nombre' => 'Peonías Rosadas',
            'descripcion' => 'Exuberantes peonías rosadas que simbolizan prosperidad y buen fortune.',
            'precio' => 130.00,
            'precio_original' => 150.00,
            'imagen_principal' => 'flor7.jpg',
            'stock' => 4,
            'destacado' => true,
            'categoria_nombre' => 'Peonías',
            'slug' => 'peonias-rosadas'
        ],
        [
            'id' => 14,
            'nombre' => 'Gerberas Vibrantes',
            'descripcion' => 'Alegres gerberas en colores brillantes que iluminan cualquier ambiente.',
            'precio' => 80.00,
            'precio_original' => 95.00,
            'imagen_principal' => 'flor8.jpg',
            'stock' => 11,
            'destacado' => false,
            'categoria_nombre' => 'Gerberas',
            'slug' => 'gerberas-vibrantes'
        ]
    ];
}

// TEMPORAL: Categorías de prueba
if (!isset($categorias)) {
    $categorias = [
        ['id' => 1, 'nombre' => 'Rosas'],
        ['id' => 2, 'nombre' => 'Tulipanes'],
        ['id' => 3, 'nombre' => 'Girasoles'],
        ['id' => 4, 'nombre' => 'Lirios'],
        ['id' => 5, 'nombre' => 'Orquídeas'],
        ['id' => 6, 'nombre' => 'Margaritas'],
        ['id' => 7, 'nombre' => 'Crisantemos'],
        ['id' => 8, 'nombre' => 'Hortensias'],
        ['id' => 9, 'nombre' => 'Claveles'],
        ['id' => 10, 'nombre' => 'Aromáticas'],
        ['id' => 11, 'nombre' => 'Peonías'],
        ['id' => 12, 'nombre' => 'Gerberas'],
        ['id' => 13, 'nombre' => 'Arreglos']
    ];
}
?>

<div class="container-fluid px-0">
    <!-- Header Mejorado -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                        <div class="bg-gradient-primary rounded-3 p-2">
                            <i class="bi bi-flower1 text-white fs-2"></i>
                        </div>
                        <div>
                            <h1 class="display-4 fw-bold text-dark mb-2">Nuestra Colección</h1>
                            <p class="text-muted lead mb-0">Descubre nuestra exclusiva selección de flores frescas</p>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-grid-3x3-gap text-primary"></i>
                            <span class="text-muted fw-medium"><?php echo count($productos); ?> productos</span>
                        </div>
                        <div class="vr"></div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-star-fill text-warning"></i>
                            <span class="text-muted fw-medium"><?php echo count(array_filter($productos, fn($p) => $p['destacado'])); ?> destacados</span>
                        </div>
                        <div class="vr"></div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-tag text-success"></i>
                            <span class="text-muted fw-medium"><?php echo count($categorias); ?> categorías</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barra de Búsqueda y Filtros -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="bi bi-search text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control border-0" 
                                               id="searchInput" 
                                               placeholder="Buscar productos..." 
                                               value="<?php echo htmlspecialchars($searchTerm); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select border-0 bg-light" id="categoriaFilter">
                                        <option value="">Todas las categorías</option>
                                        <?php foreach ($categorias as $categoria): ?>
                                            <option value="<?php echo $categoria['id']; ?>" 
                                                    <?php echo $categoriaId == $categoria['id'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($categoria['nombre']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-primary flex-grow-1 rounded-3" onclick="aplicarFiltros()">
                                            <i class="bi bi-funnel me-2"></i>Filtrar
                                        </button>
                                        <div class="btn-group">
                                            <button class="btn btn-outline-primary rounded-3 <?php echo $viewMode === 'grid' ? 'active' : ''; ?>" 
                                                    onclick="cambiarVista('grid')">
                                                <i class="bi bi-grid-3x3-gap"></i>
                                            </button>
                                            <button class="btn btn-outline-primary rounded-3 <?php echo $viewMode === 'list' ? 'active' : ''; ?>" 
                                                    onclick="cambiarVista('list')">
                                                <i class="bi bi-list-ul"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lista de Productos Centrada -->
    <section class="py-4">
        <div class="container">
            <?php if (!empty($productos)): ?>
                <?php if ($viewMode === 'grid'): ?>
                    <!-- Vista Grid Centrada - Similar a Flores Destacadas -->
                    <div class="row justify-content-center g-4">
                        <?php foreach ($productos as $index => $producto): ?>
                            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="card product-card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                                    <div class="card-img-container position-relative overflow-hidden">
                                        <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $producto['imagen_principal'] ?: 'flor1.jpg'; ?>" 
                                             class="card-img-top product-image" 
                                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                             loading="lazy">
                                        <div class="card-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                            <div class="overlay-content">
                                                <div class="d-flex gap-2 flex-column">
                                                    <?php if ($producto['stock'] > 0): ?>
                                                        <a href="<?php echo BASE_URL; ?>/carrito/agregar/<?php echo $producto['id']; ?>" 
                                                           class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                                                            <i class="bi bi-cart-plus me-2"></i>Agregar
                                                        </a>
                                                    <?php endif; ?>
                                                    <a href="<?php echo BASE_URL; ?>/producto/ver/<?php echo $producto['slug']; ?>" 
                                                       class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">
                                                        <i class="bi bi-eye me-2"></i>Ver
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Badges -->
                                        <div class="position-absolute top-0 start-0 end-0 p-3 d-flex justify-content-between">
                                            <div class="d-flex flex-column gap-2">
                                                <?php if ($producto['destacado']): ?>
                                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 shadow-sm">
                                                        <i class="bi bi-star-fill me-1"></i>Destacado
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ($producto['stock'] <= 5 && $producto['stock'] > 0): ?>
                                                    <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">
                                                        <i class="bi bi-exclamation-triangle me-1"></i>Últimas <?php echo $producto['stock']; ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($producto['precio_original']): ?>
                                                <span class="badge bg-dark rounded-pill px-3 py-2 shadow-sm">
                                                    -<?php echo number_format((($producto['precio_original'] - $producto['precio']) / $producto['precio_original']) * 100, 0); ?>%
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body p-4 d-flex flex-column">
                                        <!-- Header de la Card -->
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title fw-bold text-dark mb-1 line-clamp-2"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                                <div class="d-flex align-items-center gap-2 mt-2">
                                                    <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-1 small">
                                                        <?php echo htmlspecialchars($producto['categoria_nombre']); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <button class="btn btn-outline-primary btn-sm rounded-circle hover-scale favorite-btn">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- Descripción -->
                                        <p class="card-text text-muted small flex-grow-1 line-clamp-2 mb-3">
                                            <?php echo htmlspecialchars($producto['descripcion']); ?>
                                        </p>
                                        
                                        <!-- Precio y Stock -->
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div>
                                                    <?php if ($producto['precio_original']): ?>
                                                        <span class="text-muted text-decoration-line-through small d-block">
                                                            $<?php echo number_format($producto['precio_original'], 2); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <span class="h4 text-primary fw-bold mb-0">
                                                        $<?php echo number_format($producto['precio'], 2); ?>
                                                    </span>
                                                </div>
                                                <div class="text-end">
                                                    <div class="rating small text-warning mb-1">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-half"></i>
                                                    </div>
                                                    <small class="text-muted">24 reviews</small>
                                                </div>
                                            </div>
                                            
                                            <!-- Stock Info -->
                                            <div class="stock-info mb-3">
                                                <?php if ($producto['stock'] > 0): ?>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="progress flex-grow-1" style="height: 4px;">
                                                            <div class="progress-bar bg-success" 
                                                                 style="width: <?php echo min(100, ($producto['stock'] / 20) * 100); ?>%">
                                                            </div>
                                                        </div>
                                                        <small class="text-success fw-medium">
                                                            <?php echo $producto['stock']; ?> disp.
                                                        </small>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="alert alert-danger py-2 px-3 rounded-2 mb-0 text-center">
                                                        <i class="bi bi-x-circle me-1"></i>
                                                        <small>Agotado</small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Acciones Móviles -->
                                            <div class="d-grid gap-2 d-lg-none">
                                                <?php if ($producto['stock'] > 0): ?>
                                                    <a href="<?php echo BASE_URL; ?>/carrito/agregar/<?php echo $producto['id']; ?>" 
                                                       class="btn btn-primary rounded-3 py-2">
                                                        <i class="bi bi-cart-plus me-2"></i>Agregar
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?php echo BASE_URL; ?>/producto/ver/<?php echo $producto['slug']; ?>" 
                                                   class="btn btn-outline-primary rounded-3 py-2">
                                                    Ver Detalles
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                <?php else: ?>
                    <!-- Vista Lista -->
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <?php foreach ($productos as $index => $producto): ?>
                                <div class="card product-list-card border-0 shadow-sm rounded-4 overflow-hidden hover-lift mb-4">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <div class="position-relative h-100">
                                                <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $producto['imagen_principal'] ?: 'flor1.jpg'; ?>" 
                                                     class="img-fluid h-100 w-100 object-fit-cover" 
                                                     alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                                     loading="lazy">
                                                <div class="position-absolute top-0 start-0 p-3">
                                                    <?php if ($producto['destacado']): ?>
                                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 shadow-sm">
                                                            <i class="bi bi-star-fill me-1"></i>Destacado
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body p-4 d-flex flex-column h-100">
                                                <div class="d-flex justify-content-between align-items-start mb-3">
                                                    <div class="flex-grow-1">
                                                        <h5 class="card-title fw-bold text-dark mb-2"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                                        <p class="card-text text-muted mb-3"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-end gap-2">
                                                        <?php if ($producto['precio_original']): ?>
                                                            <span class="text-muted text-decoration-line-through small">$<?php echo number_format($producto['precio_original'], 2); ?></span>
                                                        <?php endif; ?>
                                                        <span class="h3 text-primary fw-bold">$<?php echo number_format($producto['precio'], 2); ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="row align-items-center mt-auto">
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2">
                                                                <?php echo htmlspecialchars($producto['categoria_nombre']); ?>
                                                            </span>
                                                            <?php if ($producto['stock'] > 0): ?>
                                                                <span class="text-success fw-medium">
                                                                    <i class="bi bi-check-circle me-1"></i>
                                                                    <?php echo $producto['stock']; ?> disponibles
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="text-danger fw-medium">
                                                                    <i class="bi bi-x-circle me-1"></i>
                                                                    Agotado
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex gap-2 justify-content-md-end">
                                                            <button class="btn btn-outline-primary rounded-pill hover-scale">
                                                                <i class="bi bi-heart"></i>
                                                            </button>
                                                            <a href="<?php echo BASE_URL; ?>/producto/ver/<?php echo $producto['slug']; ?>" 
                                                               class="btn btn-outline-primary rounded-pill px-4">
                                                                Ver Detalles
                                                            </a>
                                                            <?php if ($producto['stock'] > 0): ?>
                                                                <a href="<?php echo BASE_URL; ?>/carrito/agregar/<?php echo $producto['id']; ?>" 
                                                                   class="btn btn-primary rounded-pill px-4">
                                                                    <i class="bi bi-cart-plus me-2"></i>Agregar
                                                                </a>
                                                            <?php else: ?>
                                                                <button class="btn btn-secondary rounded-pill px-4" disabled>
                                                                    Agotado
                                                                </button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
            <?php else: ?>
                <!-- Estado Vacío Centrado -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0 bg-gradient-primary text-center py-6 rounded-4 shadow-sm">
                            <div class="card-body">
                                <div class="empty-state-icon mb-4">
                                    <i class="bi bi-search display-1 text-white opacity-50"></i>
                                </div>
                                <h3 class="text-white mb-3">No se encontraron productos</h3>
                                <p class="text-white-80 mb-4 lead">Intenta ajustar tus filtros de búsqueda o explorar otras categorías.</p>
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <button class="btn btn-light btn-lg rounded-pill px-4" onclick="limpiarFiltros()">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Ver Todos
                                    </button>
                                    <a href="<?php echo BASE_URL; ?>/producto/categoria/rosas" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                        Explorar Rosas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Paginación Centrada -->
    <?php if (!empty($productos)): ?>
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="text-muted">
                                Mostrando <strong>1-<?php echo count($productos); ?></strong> de <strong><?php echo count($productos); ?></strong> productos
                            </div>
                            <nav>
                                <ul class="pagination pagination-lg mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link rounded-3 mx-1 border-0 text-muted" href="#" tabindex="-1">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link rounded-3 mx-1 border-0 bg-primary text-white" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link rounded-3 mx-1 border-0 text-dark" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link rounded-3 mx-1 border-0 text-dark" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link rounded-3 mx-1 border-0 text-muted" href="#">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>

<style>
/* Variables CSS */
:root {
    --primary-color: #8e44ad;
    --primary-dark: #732d91;
    --primary-soft: rgba(142, 68, 173, 0.1);
    --gradient-primary: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
}

/* Utilidades */
.bg-primary-soft {
    background-color: var(--primary-soft);
}

/* Cards Mejoradas */
.product-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.08);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.15) !important;
}

.product-list-card {
    transition: all 0.3s ease;
}

.product-list-card:hover {
    transform: translateX(5px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.15) !important;
}

/* Imágenes y Overlays */
.card-img-container {
    height: 250px;
    overflow: hidden;
    position: relative;
}

.product-image {
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.card-overlay {
    background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, transparent 100%);
    opacity: 0;
    transition: all 0.3s ease;
}

.product-card:hover .card-overlay {
    opacity: 1;
}

.overlay-content {
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.product-card:hover .overlay-content {
    transform: translateY(0);
}

/* Estados Vacíos */
.empty-state-icon {
    animation: float 3s ease-in-out infinite;
}

/* Efectos Hover */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-scale {
    transition: transform 0.2s ease;
}

.hover-scale:hover {
    transform: scale(1.05);
}

.favorite-btn:hover {
    background-color: var(--primary-color) !important;
    color: white !important;
}

/* Utilidades de Texto */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Animaciones */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Rating */
.rating {
    color: #ffc107;
}

/* Responsive */
@media (max-width: 768px) {
    .card-img-container {
        height: 200px;
    }
    
    .display-4 {
        font-size: 2rem;
    }
}

/* Mejoras de accesibilidad */
.btn:focus, .form-control:focus {
    box-shadow: 0 0 0 3px rgba(142, 68, 173, 0.25);
}

/* Espaciado consistente */
.container {
    padding-left: 2rem;
    padding-right: 2rem;
}

@media (max-width: 576px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}
</style>

<script>
// Funciones de filtrado
function aplicarFiltros() {
    const search = document.getElementById('searchInput').value.trim();
    const categoria = document.getElementById('categoriaFilter').value;
    const orden = 'nombre'; // Por defecto
    const viewMode = '<?php echo $viewMode; ?>';
    
    const params = new URLSearchParams();
    
    if (search) params.append('search', search);
    if (categoria) params.append('categoria', categoria);
    if (orden) params.append('orden', orden);
    if (viewMode) params.append('view', viewMode);
    
    window.location.href = `<?php echo BASE_URL; ?>/producto?${params.toString()}`;
}

function limpiarFiltros() {
    window.location.href = '<?php echo BASE_URL; ?>/producto';
}

function cambiarVista(mode) {
    const params = new URLSearchParams(window.location.search);
    params.set('view', mode);
    window.location.href = `<?php echo BASE_URL; ?>/producto?${params.toString()}`;
}

// Búsqueda en tiempo real
let searchTimeout;
document.getElementById('searchInput').addEventListener('input', function(e) {
    const value = e.target.value.trim();
    clearTimeout(searchTimeout);
    
    if (value.length === 0 || value.length >= 3) {
        searchTimeout = setTimeout(() => {
            aplicarFiltros();
        }, 800);
    }
});

// Enter para buscar
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        aplicarFiltros();
    }
});

// Favoritos
document.querySelectorAll('.favorite-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const icon = this.querySelector('i');
        
        if (icon.classList.contains('bi-heart-fill')) {
            icon.classList.replace('bi-heart-fill', 'bi-heart');
            this.classList.replace('btn-primary', 'btn-outline-primary');
        } else {
            icon.classList.replace('bi-heart', 'bi-heart-fill');
            this.classList.replace('btn-outline-primary', 'btn-primary');
        }
    });
});
</script>