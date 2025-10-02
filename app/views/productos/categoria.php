<div class="container-fluid py-4">
    <div class="row mb-5 animate-fade-in-up">
        <div class="col-12 text-center">
            <h1 class="display-5 fw-bold text-dark mb-3"><?php echo htmlspecialchars($categoria['nombre']); ?></h1>
            <p class="text-muted lead">Explora nuestra selección especial de <?php echo htmlspecialchars($categoria['nombre']); ?></p>
        </div>
    </div>

    <div class="row g-4">
        <?php if (!empty($productos)): ?>
            <!-- Mismo código de productos que en index.php -->
            <?php foreach ($productos as $index => $producto): ?>
                <div class="col-xl-3 col-lg-4 col-md-6 animate-stagger" style="--stagger-order: <?php echo $index + 1; ?>">
                    <!-- Card de producto (igual que en index.php) -->
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center animate-fade-in-up">
                <div class="card border-0 bg-light py-5 rounded-4">
                    <div class="card-body">
                        <i class="bi bi-flower3 display-1 text-muted mb-3"></i>
                        <h3 class="text-muted mb-3">Próximamente en esta categoría</h3>
                        <p class="text-muted mb-4">Estamos preparando productos especiales para <?php echo htmlspecialchars($categoria['nombre']); ?>.</p>
                        <a href="<?php echo BASE_URL; ?>/producto" class="btn btn-primary btn-lg rounded-pill px-4">
                            Ver Todos los Productos
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>