<?php
// Incluir header
require_once dirname(__DIR__) . '/layouts/header.php';
?>

<div class="container">
    <h1 class="my-4">Carrito de Compras</h1>

    <?php if (empty($carrito)): ?>
        <div class="alert alert-info">
            <p>Tu carrito está vacío.</p>
            <a href="<?php echo BASE_URL; ?>/producto" class="btn btn-primary">Ver Productos</a>
        </div>
    <?php else: ?>
        <form action="<?php echo BASE_URL; ?>/carrito/actualizar" method="POST">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Productos en el Carrito</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach ($carrito as $item): ?>
                                <div class="row align-items-center mb-3 border-bottom pb-3">
                                    <div class="col-md-2">
                                        <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $item['imagen'] ?: 'flor1.jpg'; ?>" 
                                             alt="<?php echo htmlspecialchars($item['nombre']); ?>" 
                                             class="img-fluid rounded"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="mb-1"><?php echo htmlspecialchars($item['nombre']); ?></h6>
                                        <p class="text-muted mb-0 small">$<?php echo number_format($item['precio'], 2); ?> c/u</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-sm">
                                            <input type="number" 
                                                   name="cantidad[<?php echo $item['id']; ?>]" 
                                                   value="<?php echo $item['cantidad']; ?>" 
                                                   min="1" 
                                                   max="50"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p class="mb-0 fw-bold text-primary">
                                            $<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="<?php echo BASE_URL; ?>/carrito/eliminar/<?php echo $item['id']; ?>" 
                                           class="btn btn-outline-danger btn-sm" 
                                           title="Eliminar producto">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-arrow-clockwise me-1"></i>Actualizar Carrito
                            </button>
                            <a href="<?php echo BASE_URL; ?>/carrito/vaciar" class="btn btn-outline-danger">
                                <i class="bi bi-cart-x me-1"></i>Vaciar Carrito
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Resumen del Pedido</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal (<?php echo $totalItems; ?> items):</span>
                                <span>$<?php echo number_format($subtotal, 2); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Delivery:</span>
                                <span>$15.00</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <strong class="text-success">$<?php echo number_format($total, 2); ?></strong>
                            </div>
                            
                            <!-- BOTÓN CORREGIDO - Verificación adicional -->
                            <a href="<?php echo BASE_URL; ?>/checkout" class="btn btn-success w-100" id="checkoutBtn">
                                <i class="bi bi-credit-card me-2"></i>Proceder al Checkout
                            </a>
                            
                            <!-- Botón para seguir comprando -->
                            <a href="<?php echo BASE_URL; ?>/producto" class="btn btn-outline-primary w-100 mt-2">
                                <i class="bi bi-arrow-left me-2"></i>Seguir Comprando
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Debug info -->
        <div class="mt-3 p-3 bg-light rounded">
            <small class="text-muted">
                <strong>Información de Debug:</strong><br>
                URL Base: <?php echo BASE_URL; ?><br>
                Enlace Checkout: <?php echo BASE_URL; ?>/checkout<br>
                Total Items: <?php echo $totalItems; ?><br>
                Carrito vacío: <?php echo empty($carrito) ? 'Sí' : 'No'; ?>
            </small>
        </div>
    <?php endif; ?>
</div>

<script>
// Script para verificar que el botón funciona
document.addEventListener('DOMContentLoaded', function() {
    const checkoutBtn = document.getElementById('checkoutBtn');
    
    if (checkoutBtn) {
        console.log('Botón checkout encontrado');
        console.log('URL del botón:', checkoutBtn.href);
        
        checkoutBtn.addEventListener('click', function(e) {
            console.log('Checkout clickeado - Redirigiendo a:', this.href);
            // No prevenir el comportamiento por defecto - dejar que redirija
        });
    } else {
        console.log('Botón checkout NO encontrado');
    }
});

// Función alternativa si hay problemas con el enlace
function irACheckout() {
    window.location.href = '<?php echo BASE_URL; ?>/checkout';
}
</script>

<?php
// Incluir footer
require_once dirname(__DIR__) . '/layouts/footer.php';
?>