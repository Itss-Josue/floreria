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
                                        <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $item['imagen'] ?: 'default.jpg'; ?>" 
                                             alt="<?php echo htmlspecialchars($item['nombre']); ?>" 
                                             class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-4">
                                        <h6><?php echo htmlspecialchars($item['nombre']); ?></h6>
                                        <p class="text-muted mb-0">$<?php echo number_format($item['precio'], 2); ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" 
                                               name="cantidad[<?php echo $item['id']; ?>]" 
                                               value="<?php echo $item['cantidad']; ?>" 
                                               min="1" 
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2">
                                        <p class="mb-0 fw-bold">
                                            $<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="<?php echo BASE_URL; ?>/carrito/eliminar/<?php echo $item['id']; ?>" 
                                           class="btn btn-danger btn-sm">×</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Actualizar Carrito</button>
                            <a href="<?php echo BASE_URL; ?>/carrito/vaciar" class="btn btn-outline-danger">Vaciar Carrito</a>
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
                                <strong>$<?php echo number_format($total, 2); ?></strong>
                            </div>
                            <a href="<?php echo BASE_URL; ?>/checkout" class="btn btn-success w-100">Proceder al Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>