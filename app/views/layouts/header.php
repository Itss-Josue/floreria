<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $GLOBALS['config']['app']['name']; ?> - Flores Frescas y Hermosas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #8e44ad;
            --primary-dark: #732d91;
            --secondary-color: #2ecc71;
            --accent-color: #e74c3c;
            --text-light: #6c757d;
            --gradient-primary: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            --gradient-secondary: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        }

        /* Header Styles */
        .navbar {
            background: var(--gradient-primary) !important;
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(142, 68, 173, 0.3);
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            background: rgba(142, 68, 173, 0.95) !important;
            backdrop-filter: blur(20px);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(45deg, #fff, #f8f9fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: #fff !important;
        }

        .cart-badge {
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
            font-size: 0.7rem;
            margin-left: 0.3rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Footer Styles */
        .custom-footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 2rem;
            margin-bottom: 2rem;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(45deg, #8e44ad, #2ecc71);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .footer-links h5 {
            color: #8e44ad;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            margin-bottom: 0.5rem;
        }

        .footer-links a:hover {
            color: #8e44ad;
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #8e44ad;
            transform: translateY(-3px);
        }

        .footer-bottom {
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        /* Floating Action Button */
        .floating-cart {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--gradient-primary);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 20px rgba(142, 68, 173, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            animation: float 3s ease-in-out infinite;
        }

        .floating-cart:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(142, 68, 173, 0.6);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Main Content Animation */
        .main-content {
            animation: fadeInUp 0.8s ease-out;
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

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .nav-link {
                margin: 0.2rem 0;
                text-align: center;
            }
            
            .floating-cart {
                bottom: 1rem;
                right: 1rem;
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
                <i class="bi bi-flower1 me-2"></i>
                <?php echo $GLOBALS['config']['app']['name']; ?>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_GET['url'] ?? '') === 'home' ? 'active' : ''; ?>" 
                           href="<?php echo BASE_URL; ?>">
                            <i class="bi bi-house me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_GET['url'] ?? '') === 'producto' ? 'active' : ''; ?>" 
                           href="<?php echo BASE_URL; ?>/producto">
                            <i class="bi bi-shop me-1"></i>Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- En el navbar -->
<a class="nav-link position-relative" href="<?php echo BASE_URL; ?>/carrito">
    <i class="bi bi-cart3"></i> Carrito
    <?php if (!empty($_SESSION[CARRITO_SESSION])): ?>
        <span class="cart-badge text-white">
            <?php echo array_sum(array_column($_SESSION[CARRITO_SESSION], 'cantidad')); ?>
        </span>
    <?php endif; ?>
</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" style="padding-top: 80px;">