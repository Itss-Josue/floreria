<?php
// Obtener parámetros de búsqueda y filtros
$searchTerm = $_GET['search'] ?? '';
$categoriaId = $_GET['categoria'] ?? '';
$orden = $_GET['orden'] ?? 'nombre';
$viewMode = $_GET['view'] ?? 'grid'; // grid o list
?>

<div class="container-fluid px-4 py-5">
    <!-- Header Mejorado -->
    <div class="row mb-6">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-4">
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-gradient-primary rounded-3 p-2">
                            <i class="bi bi-flower1 text-white fs-3"></i>
                        </div>
                        <div>
                            <h1 class="display-5 fw-black text-dark mb-1">Nuestra Colección</h1>
                            <p class="text-gradient-primary mb-0 fw-medium">Flores frescas para cada ocasión especial</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-grid-3x3-gap text-primary"></i>
                            <span class="text-muted fw-medium"><?php echo count($productos); ?> productos encontrados</span>
                        </div>
                        <div class="vr"></div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-star text-warning"></i>
                            <span class="text-muted fw-medium"><?php echo count(array_filter($productos, fn($p) => $p['destacado'])); ?> destacados</span>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <!-- Modo de vista -->
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="radio" class="btn-check" name="viewMode" id="gridView" autocomplete="off" 
                               <?php echo $viewMode === 'grid' ? 'checked' : ''; ?>>
                        <label class="btn btn-outline-primary rounded-3" for="gridView" onclick="cambiarVista('grid')">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </label>
                        
                        <input type="radio" class="btn-check" name="viewMode" id="listView" autocomplete="off"
                               <?php echo $viewMode === 'list' ? 'checked' : ''; ?>>
                        <label class="btn btn-outline-primary rounded-3" for="listView" onclick="cambiarVista('list')">
                            <i class="bi bi-list-ul"></i>
                        </label>
                    </div>
                    
                    <div class="dropdown">
                        <button class="btn btn-primary rounded-3 px-4" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-funnel me-2"></i>Filtros
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Ordenar por</label>
                                <select class="form-select border-0 bg-light rounded-2" id="ordenFilter">
                                    <option value="nombre" <?php echo $orden === 'nombre' ? 'selected' : ''; ?>>Nombre A-Z</option>
                                    <option value="precio_asc" <?php echo $orden === 'precio_asc' ? 'selected' : ''; ?>>Precio: Menor a Mayor</option>
                                    <option value="precio_desc" <?php echo $orden === 'precio_desc' ? 'selected' : ''; ?>>Precio: Mayor a Menor</option>
                                    <option value="destacados" <?php echo $orden === 'destacados' ? 'selected' : ''; ?>>Productos Destacados</option>
                                    <option value="nuevos" <?php echo $orden === 'nuevos' ? 'selected' : ''; ?>>Más Recientes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Categoría</label>
                                <select class="form-select border-0 bg-light rounded-2" id="categoriaFilter">
                                    <option value="">Todas las categorías</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?php echo $categoria['id']; ?>" 
                                                <?php echo $categoriaId == $categoria['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($categoria['nombre']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary rounded-2" onclick="aplicarFiltros()">Aplicar Filtros</button>
                                <button class="btn btn-outline-secondary rounded-2" onclick="limpiarFiltros()">Limpiar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra de Búsqueda Avanzada -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-soft rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-lg-8">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-transparent border-0 ps-4">
                                    <i class="bi bi-search text-muted fs-5"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-0 bg-light rounded-3 fs-6" 
                                       id="searchInput" 
                                       placeholder="Buscar por nombre, descripción o categoría..." 
                                       value="<?php echo htmlspecialchars($searchTerm); ?>">
                                <button class="btn btn-primary rounded-3 px-4" onclick="aplicarFiltros()">
                                    <i class="bi bi-search me-2"></i>Buscar
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex align-items-center justify-content-lg-end gap-3">
                                <div class="flex-grow-1">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: 85%"></div>
                                    </div>
                                    <small class="text-muted">85% de productos disponibles</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Productos -->
    <div class="row g-4" id="productosContainer">
        <?php if (!empty($productos)): ?>
            <?php if ($viewMode === 'grid'): ?>
                <!-- Vista Grid -->
                <?php foreach ($productos as $index => $producto): ?>
                    <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
                        <div class="card product-card h-100 border-0 shadow-soft rounded-4 overflow-hidden hover-lift">
                            <div class="card-img-container position-relative overflow-hidden">
                                <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $producto['imagen_principal'] ?: 'default.jpg'; ?>" 
                                     class="card-img-top product-image" 
                                     alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                     loading="lazy">
                                <div class="card-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                    <div class="overlay-content">
                                        <div class="d-flex gap-2 flex-column">
                                            <a href="<?php echo BASE_URL; ?>/carrito/agregar/<?php echo $producto['id']; ?>" 
                                               class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm animate-bounce">
                                                <i class="bi bi-cart-plus me-2"></i>Agregar al Carrito
                                            </a>
                                            <a href="<?php echo BASE_URL; ?>/producto/ver/<?php echo $producto['slug']; ?>" 
                                               class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">
                                                <i class="bi bi-eye me-2"></i>Ver Detalles
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
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-primary-soft text-primary rounded-pill px-2 py-1 small">
                                                <?php echo htmlspecialchars($producto['categoria_nombre']); ?>
                                            </span>
                                            <span class="text-muted small">
                                                <i class="bi bi-clock me-1"></i>Reciente
                                            </span>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm rounded-circle hover-scale favorite-btn">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>
                                
                                <!-- Descripción -->
                                <p class="card-text text-muted small flex-grow-1 line-clamp-3"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                
                                <!-- Precio y Acciones -->
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <?php if ($producto['precio_original']): ?>
                                                <span class="text-muted text-decoration-line-through small">$<?php echo number_format($producto['precio_original'], 2); ?></span>
                                            <?php endif; ?>
                                            <span class="h4 text-primary fw-bold mb-0 d-block">$<?php echo number_format($producto['precio'], 2); ?></span>
                                        </div>
                                        <div class="text-end">
                                            <div class="rating small text-warning mb-1">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </div>
                                            <small class="text-muted">(24 reviews)</small>
                                        </div>
                                    </div>
                                    
                                    <!-- Stock Info -->
                                    <div class="stock-info mb-3">
                                        <?php if ($producto['stock'] > 0): ?>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress flex-grow-1" style="height: 6px;">
                                                    <div class="progress-bar bg-success" 
                                                         style="width: <?php echo min(100, ($producto['stock'] / 20) * 100); ?>%">
                                                    </div>
                                                </div>
                                                <small class="text-success fw-medium">
                                                    <?php echo $producto['stock']; ?> disponibles
                                                </small>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-danger py-2 px-3 rounded-2 mb-0">
                                                <i class="bi bi-x-circle me-1"></i>
                                                <small>Producto agotado</small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Acciones Móviles -->
                                    <div class="d-grid gap-2 d-lg-none">
                                        <?php if ($producto['stock'] > 0): ?>
                                            <a href="<?php echo BASE_URL; ?>/carrito/agregar/<?php echo $producto['id']; ?>" 
                                               class="btn btn-primary rounded-3 py-2">
                                                <i class="bi bi-cart-plus me-2"></i>Agregar al Carrito
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
                
            <?php else: ?>
                <!-- Vista Lista -->
                <?php foreach ($productos as $index => $producto): ?>
                    <div class="col-12">
                        <div class="card product-list-card border-0 shadow-soft rounded-4 overflow-hidden hover-lift mb-3">
                            <div class="row g-0">
                                <div class="col-md-3">
                                    <div class="position-relative h-100">
                                        <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $producto['imagen_principal'] ?: 'default.jpg'; ?>" 
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
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
        <?php else: ?>
            <!-- Estado Vacío -->
            <div class="col-12">
                <div class="card border-0 bg-gradient-primary text-center py-6 rounded-4 shadow-soft">
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
        <?php endif; ?>
    </div>

    <!-- Paginación Mejorada -->
    <?php if (!empty($productos)): ?>
        <div class="row mt-6">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="text-muted">
                        Mostrando <strong>1-<?php echo count($productos); ?></strong> de <strong><?php echo count($productos); ?></strong> productos
                    </div>
                    <nav>
                        <ul class="pagination pagination-lg">
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
    <?php endif; ?>
</div>

<style>
/* Variables CSS Mejoradas */
:root {
    --primary-color: #8e44ad;
    --primary-dark: #732d91;
    --primary-soft: rgba(142, 68, 173, 0.1);
    --gradient-primary: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
    --shadow-soft: 0 4px 20px rgba(0, 0, 0, 0.08);
    --shadow-hover: 0 8px 40px rgba(0, 0, 0, 0.12);
}

/* Utilidades */
.mb-6 { margin-bottom: 4rem; }
.mt-6 { margin-top: 4rem; }
.text-gradient-primary {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.fw-black { font-weight: 900; }
.shadow-soft { box-shadow: var(--shadow-soft); }
.object-fit-cover { object-fit: cover; }

/* Cards Mejoradas */
.product-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-hover);
}

.product-list-card {
    transition: all 0.3s ease;
}

.product-list-card:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-hover);
}

/* Imágenes y Overlays */
.card-img-container {
    height: 280px;
    overflow: hidden;
    position: relative;
}

.product-image {
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card:hover .product-image {
    transform: scale(1.08);
}

.card-overlay {
    background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, transparent 100%);
    opacity: 0;
    transition: all 0.4s ease;
}

.product-card:hover .card-overlay {
    opacity: 1;
}

.overlay-content {
    transform: translateY(20px);
    transition: all 0.4s ease;
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

.animate-bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-5px); }
    60% { transform: translateY(-3px); }
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
    
    .display-5 {
        font-size: 2rem;
    }
}

/* Scroll suave */
html {
    scroll-behavior: smooth;
}

/* Mejoras de accesibilidad */
.btn:focus, .form-control:focus {
    box-shadow: 0 0 0 3px rgba(142, 68, 173, 0.25);
}

/* Estados de carga */
.loading-skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
</style>

<script>
// Funciones mejoradas con más características
function aplicarFiltros() {
    const search = document.getElementById('searchInput').value.trim();
    const categoria = document.getElementById('categoriaFilter').value;
    const orden = document.getElementById('ordenFilter').value;
    const viewMode = document.querySelector('input[name="viewMode"]:checked')?.value || 'grid';
    
    const params = new URLSearchParams();
    
    if (search) params.append('search', search);
    if (categoria) params.append('categoria', categoria);
    if (orden) params.append('orden', orden);
    if (viewMode) params.append('view', viewMode);
    
    // Mostrar estado de carga
    const container = document.getElementById('productosContainer');
    container.style.opacity = '0.6';
    container.style.pointerEvents = 'none';
    
    setTimeout(() => {
        window.location.href = `<?php echo BASE_URL; ?>/producto?${params.toString()}`;
    }, 300);
}

function limpiarFiltros() {
    document.getElementById('searchInput').value = '';
    document.getElementById('categoriaFilter').value = '';
    document.getElementById('ordenFilter').value = 'nombre';
    
    // Mostrar estado de carga
    const container = document.getElementById('productosContainer');
    container.style.opacity = '0.6';
    
    setTimeout(() => {
        window.location.href = '<?php echo BASE_URL; ?>/producto';
    }, 300);
}

function cambiarVista(mode) {
    const params = new URLSearchParams(window.location.search);
    params.set('view', mode);
    window.location.href = `<?php echo BASE_URL; ?>/producto?${params.toString()}`;
}

// Búsqueda en tiempo real mejorada
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

// Favoritos con animación
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
        
        // Animación de like
        this.style.transform = 'scale(1.2)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 200);
    });
});

// Intersection Observer para animaciones
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.product-card, .product-list-card').forEach(card => {
        card.style.animation = 'fadeInUp 0.6s ease-out';
        card.style.animationPlayState = 'paused';
        observer.observe(card);
    });
});

// Contador de productos en el título
function updateProductCount() {
    const count = <?php echo count($productos); ?>;
    document.title = `(${count}) Productos - <?php echo $GLOBALS['config']['app']['name']; ?>`;
}

updateProductCount();
</script>