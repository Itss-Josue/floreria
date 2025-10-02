<div class="container py-4">
    <div class="row animate-fade-in-up">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/producto" class="text-decoration-none">Productos</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/producto/categoria/<?php echo $producto['categoria_slug'] ?? ''; ?>" class="text-decoration-none"><?php echo htmlspecialchars($producto['categoria_nombre'] ?? ''); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo htmlspecialchars($producto['nombre']); ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-5">
        <!-- Imágenes del producto -->
        <div class="col-lg-6 animate-fade-in-left">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $producto['imagen_principal'] ?: 'default.jpg'; ?>" 
                     class="img-fluid w-100" 
                     alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                     style="max-height: 500px; object-fit: cover;">
            </div>
        </div>

        <!-- Información del producto -->
        <div class="col-lg-6 animate-fade-in-right">
            <div class="product-details">
                <?php if ($producto['destacado']): ?>
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 mb-3">
                        <i class="bi bi-star-fill me-1"></i>Producto Destacado
                    </span>
                <?php endif; ?>

                <h1 class="display-6 fw-bold text-dark mb-3"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
                
                <div class="d-flex align-items-center mb-3">
                    <?php if ($producto['precio_original']): ?>
                        <span class="text-muted text-decoration-line-through h5 me-3">$<?php echo number_format($producto['precio_original'], 2); ?></span>
                    <?php endif; ?>
                    <span class="display-5 fw-bold text-primary">$<?php echo number_format($producto['precio'], 2); ?></span>
                </div>

                <p class="text-muted lead mb-4"><?php echo htmlspecialchars($producto['descripcion']); ?></p>

                <div class="stock-info mb-4">
                    <?php if ($producto['stock'] > 0): ?>
                        <span class="badge bg-success rounded-pill px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i>
                            <?php echo $producto['stock']; ?> disponibles
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger rounded-pill px-3 py-2">
                            <i class="bi bi-x-circle me-1"></i>
                            Agotado
                        </span>
                    <?php endif; ?>
                </div>

                <?php if ($producto['stock'] > 0): ?>
                    <div class="d-flex gap-3 mb-4">
                        <a href="<?php echo BASE_URL; ?>/carrito/agregar/<?php echo $producto['id']; ?>" 
                           class="btn btn-primary btn-lg rounded-pill px-5 py-3 flex-grow-1">
                            <i class="bi bi-cart-plus me-2"></i>Agregar al Carrito
                        </a>
                        <button class="btn btn-outline-primary btn-lg rounded-circle px-3 py-3 hover-scale">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                <?php else: ?>
                    <button class="btn btn-secondary btn-lg rounded-pill px-5 py-3 w-100" disabled>
                        <i class="bi bi-clock me-2"></i>Producto Agotado
                    </button>
                <?php endif; ?>

                <div class="product-meta mt-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Categoría</small>
                            <strong><?php echo htmlspecialchars($producto['categoria_nombre']); ?></strong>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">SKU</small>
                            <strong>#<?php echo str_pad($producto['id'], 6, '0', STR_PAD_LEFT); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>