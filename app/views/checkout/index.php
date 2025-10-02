<?php
// Incluir header
require_once dirname(__DIR__) . '/layouts/header.php';
?>

<div class="container">
    <h1 class="my-4">Checkout - Finalizar Compra</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Información de Envío</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo BASE_URL; ?>/checkout/procesar" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre completo *</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono *</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección *</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="ciudad" class="form-label">Ciudad *</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="codigo_postal" class="form-label">Código Postal *</label>
                                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pais" class="form-label">País *</label>
                                    <select class="form-select" id="pais" name="pais" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="Mexico">México</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="España">España</option>
                                        <option value="Chile">Chile</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje para el destinatario (opcional)</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Escribe un mensaje especial para acompañar tu pedido..."></textarea>
                        </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Método de Pago</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="tarjeta" value="tarjeta" checked>
                            <label class="form-check-label" for="tarjeta">
                                <i class="bi bi-credit-card me-2"></i>Tarjeta de Crédito/Débito
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="paypal" value="paypal">
                            <label class="form-check-label" for="paypal">
                                <i class="bi bi-paypal me-2"></i>PayPal
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="efectivo" value="efectivo">
                            <label class="form-check-label" for="efectivo">
                                <i class="bi bi-cash-coin me-2"></i>Pago contra entrega
                            </label>
                        </div>
                    </div>

                    <!-- Información de tarjeta (se muestra solo si se selecciona tarjeta) -->
                    <div id="info-tarjeta">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numero_tarjeta" class="form-label">Número de tarjeta *</label>
                                    <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" placeholder="1234 5678 9012 3456">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="fecha_vencimiento" class="form-label">Vencimiento *</label>
                                    <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="MM/AA">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="cvv" class="form-label">CVV *</label>
                                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Resumen del Pedido</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($carrito)): ?>
                        <div class="mb-3">
                            <?php foreach ($carrito as $item): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <small class="fw-medium"><?php echo htmlspecialchars($item['nombre']); ?></small>
                                        <br>
                                        <small class="text-muted"><?php echo $item['cantidad']; ?> x $<?php echo number_format($item['precio'], 2); ?></small>
                                    </div>
                                    <small class="fw-bold">$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>$<?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Delivery:</span>
                            <span>$<?php echo number_format($delivery, 2); ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong class="text-success">$<?php echo number_format($total, 2); ?></strong>
                        </div>
                    <?php endif; ?>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terminos" required>
                        <label class="form-check-label small" for="terminos">
                            Acepto los <a href="<?php echo BASE_URL; ?>/terminos" target="_blank">términos y condiciones</a> y la <a href="<?php echo BASE_URL; ?>/privacidad" target="_blank">política de privacidad</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success w-100 btn-lg">
                        <i class="bi bi-lock-fill me-2"></i>Completar Pedido
                    </button>
                    </form>

                    <a href="<?php echo BASE_URL; ?>/carrito" class="btn btn-outline-secondary w-100 mt-2">
                        <i class="bi bi-arrow-left me-2"></i>Volver al Carrito
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Mostrar/ocultar información de tarjeta según método de pago
document.querySelectorAll('input[name="metodo_pago"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const infoTarjeta = document.getElementById('info-tarjeta');
        if (this.value === 'tarjeta') {
            infoTarjeta.style.display = 'block';
        } else {
            infoTarjeta.style.display = 'none';
        }
    });
});

// Inicializar estado
document.getElementById('info-tarjeta').style.display = 'block';
</script>

<?php
// Incluir footer
require_once dirname(__DIR__) . '/layouts/footer.php';
?>