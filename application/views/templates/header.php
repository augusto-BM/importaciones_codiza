<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Importaciones Codiza</title>
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/logo/Logo-negro.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/logo/Logo-negro.png') ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/logo/Logo-negro.png') ?>">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- jQuery DEBE IR PRIMERO -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- ScrollReveal.js - Para animaciones al hacer scroll -->
<!-- <script src="https://unpkg.com/scrollreveal"></script> -->

<style>
/* ============================= */
/*  BASE                        */
/* ============================= */

body { 
    margin: 0; 
    font-family: Arial, sans-serif; 
}

.page-blur {
    opacity: 0;
    transition: opacity .45s ease, filter .45s ease;
}

.page-blur.show {
    opacity: 1;
}

/* ============================= */
/* HEADER STICKY SHRINK         */
/* ============================= */

header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

/* Fila superior */
.header-top {
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

/* Logo */
.logo img {
    height: 70px;
    transition: height 0.3s ease;
    max-width: 100%;
}

/* Info de contacto */
.contact-info {
    font-size: 14px;
    color: #555;
}

.contact-info .info-item {
    display: flex;
    flex-direction: row;
    align-items: stretch;
    gap: 15px;
}

.contact-info .info-item .item-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-info .info-item .item-icon i {
    color: #2a332bff;
    font-size: 32px;
}

.contact-info .info-item .item-text {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 4px;
}

.contact-info .info-item .item-header {
    font-weight: 500;
    color: #39c44cff;
    font-size: 14px;
    text-transform: uppercase;
    line-height: 1.2;
}

.contact-info .info-item .item-content {
    font-size: 16px;
    color: #555;
    line-height: 1.3;
    font-weight: 500;
}

/* Fila inferior */
.header-bottom {
    padding: 12px 0;
    transition: all 0.3s ease;
}


/* Header achicado al hacer scroll */
header.shrink .header-top {
    padding: 8px 0;
}

header.shrink .logo img {
    height: 50px;
}

header.shrink .header-bottom {
    padding: 8px 0;
}

header.shrink .contact-info .info-item .item-header {
    font-size: 12px;
}

header.shrink .contact-info .info-item .item-content {
    font-size: 14px;
}

header.shrink .contact-info .info-item .item-icon i {
    font-size: 26px;
}

/* Espaciado del body */
body {
    padding-top: 150px;
}

/* ============================= */
/* NAVEGACIÓN                    */
/* ============================= */

.navbar-nav .nav-link {
    color: #fff !important;
    font-weight: 550;
    font-size: 17px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    letter-spacing: 0.5px;
    padding: 8px 12px !important;
    border-radius: 5px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    white-space: nowrap;
}

.navbar-nav .nav-link:hover {
    color: #26532cff !important;
    background-color: #61CE70;
    box-shadow: 0 4px 10px rgba(97, 206, 112, 0.3);
    transform: translateY(-2px);
}

/* ============================= */
/* MEGA MENÚ                     */
/* ============================= */

.mega-dropdown {
    position: static;
}

.mega-dropdown .dropdown-toggle::after {
    display: none;
}

.mega-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    width: 100%;
    max-height: 70vh;
    overflow-y: auto;
    overflow-x: hidden;
    background: #ffffff;
    padding: 40px 60px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-top: 3px solid #61CE70;
    display: none;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.35s ease;
    z-index: 998;
}

.mega-dropdown:hover .mega-menu {
    display: block;
    opacity: 1;
    pointer-events: auto;
}

.columna {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px 40px;
    max-width: 1400px;
    margin: 0 auto;
}

.columna h3 {
    grid-column: 1 / -1;
    font-size: 20px;
    margin-bottom: 20px;
    font-weight: 700;
    color: #61CE70;
    border-bottom: 2px solid #61CE70;
    padding-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.mega-menu .item {
    display: block;
    padding: 12px 18px;
    text-decoration: none;
    color: #555;
    font-size: 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    border-radius: 8px;
    border-left: 3px solid transparent;
}

.mega-menu .item:hover {
    color: #61CE70;
    font-weight: 600;
    background-color: #f5f9f6;
    border-left-color: #61CE70;
    padding-left: 25px;
    transform: translateX(5px);
}

/* ============================= */
/* BOTÓN HAMBURGUESA (MÓVIL)    */
/* ============================= */

.hamburger {
    display: flex;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    background: transparent;
    border: none;
    padding: 8px;
    z-index: 10001;
    position: relative;
    margin-left: auto;
}

.hamburger span {
    width: 28px;
    height: 3px;
    background: #333;
    border-radius: 4px;
    transition: all 0.3s ease;
    display: block;
}

.hamburger.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 6px);
}

.hamburger.active span:nth-child(2) {
    opacity: 0;
}

.hamburger.active span:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -7px);
}

/* ============================= */
/* MENÚ MÓVIL FULLSCREEN        */
/* ============================= */

.mobile-menu {
    position: fixed;
    top: 0;
    left: -100%;
    height: 100vh;
    width: 80%;
    max-width: 400px;
    background: white;
    box-shadow: 2px 0 15px rgba(0, 0, 0, 0.2);
    transition: left 0.4s ease;
    z-index: 10000;
    overflow-y: auto;
}

.mobile-menu.show {
    left: 0;
}

.mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s ease;
    z-index: 9999;
}

.mobile-menu-overlay.show {
    opacity: 1;
    pointer-events: auto;
}

.mobile-menu-content {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 20px 0;
}

.mobile-menu-header {
    padding: 20px 30px;
    text-align: center;
    border-bottom: 2px solid #e0e0e0;
    margin-bottom: 20px;
}

.mobile-menu-header .mobile-logo img {
    max-height: 60px;
    max-width: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
}

.mobile-menu-links {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.mobile-menu-link {
    color: #222;
    text-decoration: none;
    font-weight: 600;
    font-size: 18px;
    padding: 18px 30px;
    border-bottom: 1px solid #e0e0e0;
    transition: all 0.3s ease;
    display: block;
}

.mobile-menu-link:hover {
    background-color: #f5f5f5;
    color: #61CE70;
    padding-left: 40px;
}

/* Acordeón de categorías en móvil */
.mobile-menu-accordion {
    border-bottom: 1px solid #e0e0e0;
}

.mobile-accordion-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #222;
    font-weight: 600;
    font-size: 18px;
    padding: 18px 30px;
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: transparent;
}

.mobile-accordion-header:hover {
    background-color: #f5f5f5;
    color: #61CE70;
}

.mobile-accordion-header.active {
    background-color: #f5f5f5;
    color: #61CE70;
}

.mobile-accordion-icon {
    transition: transform 0.3s ease;
    font-size: 14px;
}

.mobile-accordion-header.active .mobile-accordion-icon {
    transform: rotate(180deg);
}

.mobile-accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease;
    background-color: #f9f9f9;
}

.mobile-accordion-content.active {
    max-height: 500px;
    overflow-y: auto;
}

.mobile-submenu-item {
    display: block;
    color: #555;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    padding: 12px 30px 12px 50px;
    border-bottom: 1px solid #e8e8e8;
    transition: all 0.2s ease;
}

.mobile-submenu-item:hover {
    background-color: #fff;
    color: #61CE70;
    padding-left: 55px;
}

.mobile-submenu-item:last-child {
    border-bottom: none;
}

.mobile-menu-footer {
    padding: 20px 30px;
    border-top: 2px solid #e0e0e0;
    text-align: center;
}

.whatsapp-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: #25D366;
    color: white;
    text-decoration: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(37, 211, 102, 0.3);
}

.whatsapp-button:hover {
    background: #20BA5A;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(37, 211, 102, 0.4);
    color: white;
}

.whatsapp-button i {
    font-size: 24px;
}

/* ============================= */
/* RESPONSIVE                    */
/* ============================= */

@media (max-width: 1200px) {
    .navbar-nav .nav-link {
        font-size: 14px;
        padding: 8px 10px !important;
    }
    
    /* Mega menú: 2 columnas en tablets grandes */
    .columna {
        grid-template-columns: repeat(2, 1fr);
        gap: 18px 30px;
    }
    
    .mega-menu {
        padding: 30px 40px;
    }
    
    .columna h3 {
        font-size: 18px;
    }
    
    .mega-menu .item {
        font-size: 14px;
        padding: 10px 15px;
    }
}

@media (max-width: 991px) {
    body {
        padding-top: 90px;
    }

    .logo img {
        height: 60px;
    }

    header.shrink .logo img {
        height: 45px;
    }
}

@media (max-width: 768px) {
    body {
        padding-top: 80px;
    }

    .header-top {
        padding: 10px 0;
    }

    .logo img {
        height: 50px;
    }

    header.shrink .header-top {
        padding: 8px 0;
    }

    header.shrink .logo img {
        height: 40px;
    }

    .mobile-menu-link {
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    body {
        padding-top: 70px;
    }

    .logo img {
        height: 45px;
    }

    header.shrink .logo img {
        height: 35px;
    }

    .mobile-menu-link {
        font-size: 18px;
        gap: 20px;
    }
}

/* ============================= */
/* TOOLTIPS Z-INDEX             */
/* ============================= */
.tooltip {
    z-index: 99999 !important;
}
</style>

</head>
<body class="page-blur">

<header id="mainHeader">
    <!-- FILA SUPERIOR: Logo + Info de Contacto -->
    <div class="header-top">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-6 col-lg-3">
                    <div class="logo d-flex justify-content-end justify-content-lg-end pe-lg-4">
                        <a href="<?= base_url(); ?>">
                            <img src="<?= base_url('images/logo/logo-actual.png') ?>" alt="Logo" class="img-fluid">
                        </a>
                    </div>
                </div>

                <!-- Info de Contacto (Desktop) -->
                <div class="col-lg-9 d-none d-lg-flex justify-content-start ps-lg-4">
                    <div class="contact-info d-flex flex-wrap gap-5 align-items-center">
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="item-text">
                                <div class="item-header">Información y ventas</div>
                                <div class="item-content">+51 985 410 410</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="item-text">
                                <div class="item-header">Escríbenos</div>
                                <div class="item-content">codiza@importacionescodiza.com</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="item-text">
                                <div class="item-header">Horario de atención</div>
                                <div class="item-content">L - V: 8am - 6pm / S: 8am - 1pm</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón hamburguesa (Móvil) -->
                <div class="col-6 d-lg-none text-end">
                    <button class="navbar-toggler hamburger" type="button" id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- FILA INFERIOR: Menú de Navegación (Desktop) -->
    <div class="header-bottom d-none d-lg-block" style="background-color: #61CE70;">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="collapse navbar-collapse justify-content-center">
                    <ul class="navbar-nav menu">
                        <?php 
                        $ci = get_instance();
                        $current_controller = $ci->router->fetch_class();
                        $current_method = $ci->router->fetch_method();
                        
                        // Detectar área administrativa: cualquier método de Login excepto los públicos
                        $metodos_publicos = ['index', 'validar', 'salir'];
                        $es_area_admin = ($current_controller === 'login' && !in_array($current_method, $metodos_publicos));
                        
                        if ($ci->session->userdata('logeado') && $ci->session->userdata('usuario_id') == 1 && $es_area_admin): 
                            // Menú para administrador logueado EN ÁREA ADMINISTRATIVA
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/dashboard'); ?>">
                                    <i class="fas fa-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/productos'); ?>">
                                    <i class="fas fa-shopping-bag"></i> Productos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/categorias'); ?>">
                                    <i class="fas fa-folder"></i> Categorías
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="< ?= base_url('login/clientes'); ?>">
                                    <i class="fas fa-users"></i> Clientes
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/tiposcategorias'); ?>" title="TIPO DE CATEGORIAS">
                                    <i class="fas fa-tags"></i> Tipo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/salir'); ?>">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </a>
                            </li>
                        <?php else: 
                            // Menú público normal (incluso si está logueado pero en páginas públicas)
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('inicio'); ?>">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('nosotros'); ?>">Nosotros</a>
                            </li>
                            
                            <?php if (isset($menuTiposCategorias) && !empty($menuTiposCategorias)): ?>
                                <?php foreach ($menuTiposCategorias as $tipoCategoria => $categorias): ?>
                                    <li class="nav-item dropdown mega-dropdown">
                                        <a class="nav-link dropdown-toggle" role="button">
                                            <?= $tipoCategoria ?> <i class="fas fa-chevron-down"></i>
                                        </a>
                                        <?php if (!empty($categorias)): ?>
                                            <div class="dropdown-menu mega-menu">
                                                <div class="columna">
                                                    <h3><?= $tipoCategoria ?></h3>
                                                    <?php foreach ($categorias as $cat): ?>
                                                        <a href="<?= base_url('categoria/ver/' . $cat['id']); ?>" class="dropdown-item item">
                                                            <?= $cat['nombre'] ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('proyectos'); ?>">Proyectos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('servicios'); ?>">Servicios</a>
                            </li>
                            
                            <?php if ($ci->session->userdata('logeado') && $ci->session->userdata('usuario_id') == 1): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('login/salir'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cerrar Sesión">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('login'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Iniciar Sesión">
                                        <i class="fa-solid fa-user"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- OVERLAY DEL MENÚ MÓVIL -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- MENÚ MÓVIL -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-content">
            <!-- Logo en el menú móvil -->
            <div class="mobile-menu-header">
                <div class="mobile-logo">
                    <img src="<?= base_url('images/logo/logo.png') ?>" alt="Logo">
                </div>
            </div>

            <div class="mobile-menu-links">
                <?php 
                $ci = get_instance();
                $current_controller = $ci->router->fetch_class();
                $current_method = $ci->router->fetch_method();
                
                // Detectar área administrativa: cualquier método de Login excepto los públicos
                $metodos_publicos = ['index', 'validar', 'salir'];
                $es_area_admin = ($current_controller === 'login' && !in_array($current_method, $metodos_publicos));
                
                if ($ci->session->userdata('logeado') && $ci->session->userdata('usuario_id') == 1 && $es_area_admin): 
                    // Menú móvil para administrador logueado EN ÁREA ADMINISTRATIVA
                ?>
                    <a href="<?= base_url('login/dashboard'); ?>" class="mobile-menu-link">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="<?= base_url('login/productos'); ?>" class="mobile-menu-link">
                        <i class="fas fa-shopping-bag"></i> Productos
                    </a>
                    <a href="<?= base_url('login/categorias'); ?>" class="mobile-menu-link">
                        <i class="fas fa-folder"></i> Categorías
                    </a>
                    <!-- <a href="< ?= base_url('login/clientes'); ?>" class="mobile-menu-link">
                        <i class="fas fa-users"></i> Clientes
                    </a> -->
                    <a href="<?= base_url('login/tiposcategorias'); ?>" class="mobile-menu-link" title="TIPO DE CATEGORIAS">
                        <i class="fas fa-tags"></i> Tipo
                    </a>
                    <a href="<?= base_url('login/salir'); ?>" class="mobile-menu-link">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                <?php else: 
                    // Menú móvil público normal (incluso si está logueado pero en páginas públicas)
                ?>
                    <a href="<?= base_url('inicio'); ?>" class="mobile-menu-link">Inicio</a>
                    <a href="<?= base_url('nosotros'); ?>" class="mobile-menu-link">Nosotros</a>
                    
                    <!-- Menú acordeón de productos -->
                    <?php if (isset($menuTiposCategorias) && !empty($menuTiposCategorias)): ?>
                        <?php foreach ($menuTiposCategorias as $tipoCategoria => $categorias): ?>
                            <div class="mobile-menu-accordion">
                                <div class="mobile-accordion-header" data-target="mobile-accordion-<?= preg_replace('/[^a-zA-Z0-9]/', '-', $tipoCategoria); ?>">
                                    <span><?= $tipoCategoria ?></span>
                                    <i class="fas fa-chevron-down mobile-accordion-icon"></i>
                                </div>
                                <div class="mobile-accordion-content" id="mobile-accordion-<?= preg_replace('/[^a-zA-Z0-9]/', '-', $tipoCategoria); ?>">
                                    <?php if (!empty($categorias)): ?>
                                        <?php foreach ($categorias as $cat): ?>
                                            <a href="<?= base_url('categoria/ver/' . $cat['id']); ?>" class="mobile-submenu-item">
                                                <?= $cat['nombre'] ?>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                    <a href="<?= base_url('proyectos'); ?>" class="mobile-menu-link">Proyectos</a>
                    <a href="<?= base_url('servicios'); ?>" class="mobile-menu-link">Servicios</a>
                    
                    <?php if ($ci->session->userdata('logeado') && $ci->session->userdata('usuario_id') == 1): ?>
                        <a href="<?= base_url('login/salir'); ?>" class="mobile-menu-link" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cerrar Sesión">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('login'); ?>" class="mobile-menu-link" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Iniciar Sesión">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="mobile-menu-footer">
                <!-- Espacio reservado para otros elementos si es necesario -->
            </div>
        </div>
    </div>
</header>

<script>
// ============================= 
// FORZAR SCROLL AL INICIO
// ============================= 
// Prevenir restauración automática del scroll
if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}
// Forzar scroll a 0 inmediatamente
window.scrollTo(0, 0);

// ============================= 
// FADE IN PÁGINA
// ============================= 
$(document).ready(function() {
    $('body').addClass('show');
});

// ============================= 
// HEADER SHRINK AL HACER SCROLL
// ============================= 
$(window).on('scroll', function() {
    const header = $('#mainHeader');
    
    if ($(window).scrollTop() > 20) {
        header.addClass('shrink');
    } else {
        header.removeClass('shrink');
    }
});

// ============================= 
// INICIALIZAR TOOLTIPS DE BOOTSTRAP
// ============================= 
$(document).ready(function() {
    // Inicializar todos los tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// ============================= 
// MENÚ HAMBURGUESA MÓVIL
// ============================= 
$(document).ready(function() {
    const $hamburger = $('#hamburger');
    const $mobileMenu = $('#mobileMenu');
    const $overlay = $('#mobileMenuOverlay');
    
    // Función para cerrar el menú
    function closeMenu() {
        $hamburger.removeClass('active');
        $mobileMenu.removeClass('show');
        $overlay.removeClass('show');
        $('body').css('overflow', '');
    }
    
    // Toggle del menú hamburguesa
    $hamburger.on('click', function() {
        $(this).toggleClass('active');
        $mobileMenu.toggleClass('show');
        $overlay.toggleClass('show');
        
        // Prevenir scroll del body cuando el menú está abierto
        if ($mobileMenu.hasClass('show')) {
            $('body').css('overflow', 'hidden');
        } else {
            $('body').css('overflow', '');
        }
    });
    
    // Cerrar menú al hacer clic en un enlace
    $('.mobile-menu-link, .mobile-submenu-item').on('click', function() {
        closeMenu();
    });
    
    // Cerrar menú al hacer clic en el overlay
    $overlay.on('click', function() {
        closeMenu();
    });
    
    // Cerrar menú al cambiar tamaño de ventana a desktop
    $(window).on('resize', function() {
        if ($(window).width() >= 992) {
            closeMenu();
        }
    });
    
    // Manejar acordeón de categorías en móvil
    $('.mobile-accordion-header').on('click', function() {
        const targetId = $(this).data('target');
        const $content = $('#' + targetId);
        const $icon = $(this).find('.mobile-accordion-icon');
        
        // Toggle del acordeón actual
        $(this).toggleClass('active');
        $content.toggleClass('active');
        
        // Cerrar otros acordeones
        $('.mobile-accordion-header').not(this).removeClass('active');
        $('.mobile-accordion-content').not($content).removeClass('active');
    });
});
</script>

