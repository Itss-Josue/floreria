    </div>

    <!-- Floating Cart Button -->
    <a href="<?php echo BASE_URL; ?>/carrito" class="floating-cart">
        <i class="bi bi-cart3 fs-5"></i>
    </a>

    <!-- Footer -->
    <footer class="custom-footer">
        <div class="container">
            <div class="row footer-content">
                <div class="col-lg-4 mb-4">
                    <div class="footer-logo">
                        <i class="bi bi-flower1 me-2"></i>
                        <?php echo $GLOBALS['config']['app']['name']; ?>
                    </div>
                    <p class="text-light">Transformamos momentos especiales con las flores más frescas y hermosas. Calidad y elegancia en cada arreglo.</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                        <a href="#"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4">
                    <div class="footer-links">
                        <h5>Navegación</h5>
                        <a href="<?php echo BASE_URL; ?>">Inicio</a>
                        <a href="<?php echo BASE_URL; ?>/producto">Productos</a>
                        <a href="<?php echo BASE_URL; ?>/carrito">Carrito</a>
                        <a href="<?php echo BASE_URL; ?>/checkout">Checkout</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="footer-links">
                        <h5>Categorías</h5>
                        <a href="<?php echo BASE_URL; ?>/producto/categoria/rosas">Rosas</a>
                        <a href="<?php echo BASE_URL; ?>/producto/categoria/tulipanes">Tulipanes</a>
                        <a href="<?php echo BASE_URL; ?>/producto/categoria/girasoles">Girasoles</a>
                        <a href="<?php echo BASE_URL; ?>/producto/categoria/orquideas">Orquídeas</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="footer-links">
                        <h5>Contacto</h5>
                        <p class="text-light mb-2">
                            <i class="bi bi-geo-alt me-2"></i>
                            Av. Principal 123, Ciudad
                        </p>
                        <p class="text-light mb-2">
                            <i class="bi bi-phone me-2"></i>
                            +1 234 567 890
                        </p>
                        <p class="text-light mb-2">
                            <i class="bi bi-envelope me-2"></i>
                            info@floreria.com
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="row footer-bottom">
                <div class="col-12">
                    <p class="mb-0">
                        &copy; <?php echo date('Y'); ?> <?php echo $GLOBALS['config']['app']['name']; ?>. 
                        Todos los derechos reservados. | 
                        Diseñado con <i class="bi bi-heart-fill text-danger"></i> para amantes de las flores
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Active link highlighting
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const linkUrl = link.getAttribute('href');
                if (currentUrl.includes(linkUrl) && linkUrl !== '<?php echo BASE_URL; ?>') {
                    link.classList.add('active');
                }
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>