

    <!-- Productos Destacados -->
<section id="destacados" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center animate-fade-in-up">
                <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2 mb-3">Productos Exclusivos</span>
                <h2 class="display-5 fw-bold text-dark mb-3">Flores Destacadas</h2>
                <p class="text-muted lead">Selección especial de nuestras flores más populares</p>
            </div>
        </div>
        
        <?php if (!empty($productosDestacados)): ?>
            <div class="row g-4">
                <?php foreach ($productosDestacados as $index => $producto): ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 animate-stagger" style="--stagger-order: <?php echo $index + 1; ?>">
                        <div class="card product-card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                            <div class="card-img-container position-relative overflow-hidden">
                                <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $producto['imagen_principal'] ?: 'flor1.jpg'; ?>" 
                                     class="card-img-top product-image" 
                                     alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                <div class="card-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                    <div class="overlay-content opacity-0 translate-y-3">
                                        <a href="<?php echo BASE_URL; ?>/carrito/agregar/<?php echo $producto['id']; ?>" 
                                           class="btn btn-primary btn-lg rounded-pill px-4 shadow">
                                            <i class="bi bi-cart-plus me-2"></i>Agregar
                                        </a>
                                    </div>
                                </div>
                                <?php if ($producto['precio_original']): ?>
                                    <span class="badge bg-danger position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow">
                                        -<?php echo number_format((($producto['precio_original'] - $producto['precio']) / $producto['precio_original']) * 100, 0); ?>%
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold text-dark mb-0"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                    <i class="bi bi-heart text-muted hover-scale"></i>
                                </div>
                                <p class="card-text text-muted small flex-grow-1"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <?php if ($producto['precio_original']): ?>
                                            <span class="text-muted text-decoration-line-through small">$<?php echo number_format($producto['precio_original'], 2); ?></span>
                                        <?php endif; ?>
                                        <span class="h4 text-primary fw-bold mb-0">$<?php echo number_format($producto['precio'], 2); ?></span>
                                    </div>
                                    <div class="d-grid">
                                        <a href="<?php echo BASE_URL; ?>/carrito/agregar/<?php echo $producto['id']; ?>" 
                                           class="btn btn-outline-primary rounded-pill d-md-none">
                                            <i class="bi bi-cart-plus me-2"></i>Agregar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="row animate-fade-in-up">
                <div class="col-12">
                    <div class="card border-0 bg-gradient-warning text-center py-5 rounded-4 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-flower3 display-1 text-white mb-3"></i>
                            <h3 class="text-white mb-3">Próximamente Nuevas Flores</h3>
                            <p class="text-white-80 mb-4">Estamos preparando una nueva colección especial para ti.</p>
                            <a href="<?php echo BASE_URL; ?>/producto" class="btn btn-light btn-lg rounded-pill px-4">
                                Ver Colección Actual
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

    <!-- Categorías -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center animate-fade-in-up">
                    <span class="badge bg-success-soft text-success rounded-pill px-3 py-2 mb-3">Explorar</span>
                    <h2 class="display-5 fw-bold text-dark mb-3">Nuestras Categorías</h2>
                    <p class="text-muted lead">Encuentra el tipo de flor perfecta para cada ocasión</p>
                </div>
            </div>
            
            <?php if (!empty($categorias)): ?>
                <div class="row g-4">
                    <?php foreach ($categorias as $index => $categoria): ?>
                        <div class="col-lg-4 col-md-6 animate-stagger" style="--stagger-order: <?php echo $index + 1; ?>">
                            <div class="category-card card border-0 shadow-sm rounded-4 overflow-hidden hover-lift text-white">
                                <div class="card-body p-5 position-relative">
                                    <div class="bg-overlay position-absolute top-0 start-0 w-100 h-100 rounded-4"></div>
                                    <div class="position-relative z-1 text-center">
                                        <div class="icon-container bg-white-20 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="bi bi-flower1 fs-2"></i>
                                        </div>
                                        <h4 class="fw-bold mb-3"><?php echo htmlspecialchars($categoria['nombre']); ?></h4>
                                        <a href="<?php echo BASE_URL; ?>/producto/categoria/<?php echo $categoria['slug']; ?>" 
                                           class="btn btn-outline-light btn-lg rounded-pill px-4 hover-scale">
                                            Explorar <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Banner de Información -->
    <section class="py-5 bg-gradient-primary text-white">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4 animate-fade-in-up">
                    <div class="p-4">
                        <div class="bg-white-20 rounded-circle p-3 d-inline-flex mb-3">
                            <i class="bi bi-truck fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Envío Gratis</h5>
                        <p class="text-white-80 mb-0">En compras mayores a $200</p>
                    </div>
                </div>
                <div class="col-md-4 animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="p-4">
                        <div class="bg-white-20 rounded-circle p-3 d-inline-flex mb-3">
                            <i class="bi bi-shield-check fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Calidad Premium</h5>
                        <p class="text-white-80 mb-0">Flores frescas garantizadas</p>
                    </div>
                </div>
                <div class="col-md-4 animate-fade-in-up" style="animation-delay: 0.4s">
                    <div class="p-4">
                        <div class="bg-white-20 rounded-circle p-3 d-inline-flex mb-3">
                            <i class="bi bi-headset fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Soporte 24/7</h5>
                        <p class="text-white-80 mb-0">Atención personalizada</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Variables CSS */
:root {
    --primary-color: #8e44ad;
    --primary-soft: rgba(142, 68, 173, 0.1);
    --success-soft: rgba(46, 204, 113, 0.1);
    --white-20: rgba(255, 255, 255, 0.2);
}

/* Estilos personalizados */
.bg-gradient-primary {
    background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
}

.bg-primary-soft {
    background-color: var(--primary-soft);
}

.bg-success-soft {
    background-color: var(--success-soft);
}

.bg-white-20 {
    background-color: var(--white-20);
}

.text-white-80 {
    color: rgba(255, 255, 255, 0.8);
}

.min-vh-80 {
    min-height: 80vh;
}

/* Animaciones */
.animate-fade-in-left {
    animation: fadeInLeft 1s ease-out;
}

.animate-fade-in-right {
    animation: fadeInRight 1s ease-out;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

.animate-stagger {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
    animation-delay: calc(var(--stagger-order) * 0.1s);
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* Efectos hover */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.hover-scale {
    transition: transform 0.3s ease;
}

.hover-scale:hover {
    transform: scale(1.05);
}

/* Cards especiales */
.hero-image-container {
    position: relative;
}

.floating-card {
    position: absolute;
    bottom: -20px;
    right: -20px;
    background: white;
    z-index: 10;
}

.product-card {
    transition: all 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-image {
    transition: transform 0.3s ease;
    height: 250px;
    object-fit: cover;
}

.card-img-container {
    height: 250px;
    overflow: hidden;
}

.card-overlay {
    background: rgba(0, 0, 0, 0.7);
    opacity: 0;
    transition: all 0.3s ease;
}

.product-card:hover .card-overlay {
    opacity: 1;
}

.overlay-content {
    transition: all 0.3s ease;
}

.product-card:hover .overlay-content {
    opacity: 1;
    transform: translateY(0);
}

/* Category cards con colores diferentes */
.category-card:nth-child(1) .bg-overlay { background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); }
.category-card:nth-child(2) .bg-overlay { background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); }
.category-card:nth-child(3) .bg-overlay { background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); }
.category-card:nth-child(4) .bg-overlay { background: linear-gradient(135deg, #f39c12 0%, #d35400 100%); }
.category-card:nth-child(5) .bg-overlay { background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%); }
.category-card:nth-child(6) .bg-overlay { background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%); }

.icon-container {
    backdrop-filter: blur(10px);
}

.rounded-4 {
    border-radius: 1rem !important;
}
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<script>
// Animación adicional al hacer scroll
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Pausar animaciones inicialmente
    document.querySelectorAll('.animate-fade-in-up, .animate-stagger').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
});
</script>