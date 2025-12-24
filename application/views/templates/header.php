<!DOCTYPE html>
<html lang="es-PE">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
// Configuración SEO dinámica según la página
$ci = get_instance();
$current_controller = $ci->router->fetch_class();
$current_method = $ci->router->fetch_method();

// Título base
$site_name = "Importaciones Codiza";
$page_title = $site_name;
$meta_description = "CODIZA S.A. - Importadores de productos para minería, agroindustria, pesquería e industrias. Especialistas en fajas transportadoras, cangilones, cortinas PVC y empaquetaduras con más de 20 años de experiencia en Perú.";
$meta_keywords = "fajas transportadoras, importaciones industriales, productos minería, agroindustria, cangilones, cortinas pvc, empaquetaduras, codiza, perú";
$canonical_url = current_url();

// Personalizar según la página
if ($current_controller == 'inicio' || $current_controller == '' || $current_method == 'index') {
    $page_title = "Importaciones Codiza - Fajas Transportadoras y Productos Industriales en Perú";
    $meta_description = "CODIZA S.A. líder en importación de fajas transportadoras, cangilones, cortinas PVC y productos industriales para minería, agroindustria y pesquería. +20 años de experiencia en Perú.";
} elseif ($current_controller == 'nosotros') {
    $page_title = "Nosotros - Importaciones Codiza | +20 Años de Experiencia";
    $meta_description = "Conoce CODIZA S.A., empresa con más de 20 años importando productos industriales de calidad para minería, agroindustria y pesquería en todo el Perú.";
    $meta_keywords = "sobre codiza, empresa importadora, experiencia industrial, fajas transportadoras perú";
} elseif ($current_controller == 'productos') {
    $page_title = "Productos Industriales - Importaciones Codiza";
    $meta_description = "Catálogo completo de productos industriales: fajas transportadoras, cangilones para elevadores, cortinas PVC, empaquetaduras y accesorios industriales de alta calidad.";
    $meta_keywords = "catálogo productos industriales, fajas transportadoras, cangilones, cortinas pvc, empaquetaduras";
} elseif ($current_controller == 'servicios') {
    $page_title = "Servicios Industriales - Importaciones Codiza";
    $meta_description = "Servicios de asesoría técnica, instalación de fajas transportadoras, diseño de proyectos industriales y soluciones personalizadas para su empresa.";
    $meta_keywords = "servicios industriales, asesoría técnica, instalación fajas, proyectos industriales";
} elseif ($current_controller == 'proyectos') {
    $page_title = "Proyectos Realizados - Importaciones Codiza";
    $meta_description = "Conoce nuestros proyectos exitosos en minería, agroindustria y pesquería. Soluciones industriales implementadas en todo el Perú.";
    $meta_keywords = "proyectos industriales, casos de éxito, instalaciones fajas, proyectos minería";
} elseif ($current_controller == 'contacto') {
    $page_title = "Contacto - Importaciones Codiza | Cotiza Ahora";
    $meta_description = "Contáctanos para cotizaciones y asesoría en productos industriales. Teléfono: +51 946 385 307 | Email: elsa.calero@codiza.com.pe";
    $meta_keywords = "contacto codiza, cotización productos industriales, asesoría técnica";
} elseif ($current_controller == 'categoria') {
    if (isset($categoria_nombre)) {
        $page_title = htmlspecialchars($categoria_nombre) . " - Venta e Instalación en Perú | Importaciones Codiza";
        $meta_description = "Venta de " . strtolower(htmlspecialchars($categoria_nombre)) . " de alta calidad para industria. ✓ Importación directa ✓ Asesoría técnica ✓ Instalación profesional. Cotiza en Lima, Perú.";
        $meta_keywords = strtolower(htmlspecialchars($categoria_nombre)) . " perú, " . strtolower(htmlspecialchars($categoria_nombre)) . " lima, venta " . strtolower(htmlspecialchars($categoria_nombre)) . ", importación " . strtolower(htmlspecialchars($categoria_nombre));
    }
}

// Si hay un producto específico
if (isset($producto) && !empty($producto->nombre)) {
    $page_title = htmlspecialchars($producto->nombre) . " - Importaciones Codiza";
    $meta_description = !empty($producto->descripcion) ? strip_tags(substr($producto->descripcion, 0, 155)) . "..." : "Producto industrial de alta calidad disponible en CODIZA S.A. Cotiza ahora.";
    if (!empty($producto->etiquetas)) {
        $meta_keywords = htmlspecialchars($producto->etiquetas) . ", " . $meta_keywords;
    }
}
?>
<title><?= $page_title ?></title>

<!-- Meta Tags SEO -->
<meta name="description" content="<?= $meta_description ?>">
<meta name="keywords" content="<?= $meta_keywords ?>">
<meta name="author" content="Importaciones Codiza S.A.">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<link rel="canonical" href="<?= $canonical_url ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $canonical_url ?>">
<meta property="og:title" content="<?= $page_title ?>">
<meta property="og:description" content="<?= $meta_description ?>">
<meta property="og:image" content="<?= img_url('images/logo/logo-actual.png') ?>">
<meta property="og:site_name" content="Importaciones Codiza">
<meta property="og:locale" content="es_PE">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?= $canonical_url ?>">
<meta name="twitter:title" content="<?= $page_title ?>">
<meta name="twitter:description" content="<?= $meta_description ?>">
<meta name="twitter:image" content="<?= img_url('images/logo/logo-actual.png') ?>">

<!-- ============================================
     FAVICONS OPTIMIZADOS PARA GOOGLE Y SEO
     Configuración híbrida: raíz + carpeta + manifest
     ============================================ -->
     
<!-- Favicon.ico en RAÍZ (máxima compatibilidad, Google lo busca primero) -->
<link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon" sizes="32x32">
<link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">

<!-- SVG para navegadores modernos (mejor calidad escalable) -->
<link rel="icon" href="<?= base_url('images/favicons/favicon.svg') ?>" type="image/svg+xml">

<!-- PNGs en múltiples tamaños (Google Search usa 192x192) -->
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/favicons/favicon-16x16.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/favicons/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="48x48" href="<?= base_url('images/favicons/favicon-48x48.png') ?>">
<link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('images/favicons/favicon-192x192.png') ?>">
<link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('images/favicons/favicon-512x512.png') ?>">

<!-- Safari pinned tab (SVG monocromático) -->
<link rel="mask-icon" href="<?= base_url('images/favicons/favicon.svg') ?>" color="#0066cc">

<!-- Apple Touch Icons (iOS/Safari) - IMPORTANTE: sin transparencia, fondo sólido -->
<link rel="apple-touch-icon" href="<?= base_url('images/favicons/favicon.ico') ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/favicons/apple-touch-icon-180x180.png') ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('images/favicons/apple-touch-icon-152x152.png') ?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('images/favicons/apple-touch-icon-144x144.png') ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('images/favicons/apple-touch-icon-120x120.png') ?>">

<!-- Microsoft Tiles (Windows 8/10/11) -->
<meta name="msapplication-TileColor" content="#0066cc">
<meta name="msapplication-TileImage" content="<?= base_url('images/favicons/apple-touch-icon-144x144.png') ?>">
<meta name="msapplication-config" content="<?= base_url('browserconfig.xml') ?>">

<!-- Web App Manifest (CRÍTICO para Google Search y PWA) -->
<link rel="manifest" href="<?= base_url('site.webmanifest') ?>">

<!-- Color de tema (barra de navegador en móviles) -->
<meta name="theme-color" content="#0066cc">

<!-- Información de Contacto para Motores de Búsqueda -->
<meta name="geo.region" content="PE-LIM">
<meta name="geo.placename" content="Lima, Perú">
<meta name="geo.position" content="-12.046374;-77.042793">
<meta name="ICBM" content="-12.046374, -77.042793">

<!-- Librerías locales (vendor) -->
<!-- Preload de fuentes FontAwesome para evitar parpadeos/FOIT en la primera carga -->
<link rel="preload" href="<?= base_url('assets/vendor/fontawesome/webfonts/fa-solid-900.woff2'); ?>" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?= base_url('assets/vendor/fontawesome/webfonts/fa-regular-400.woff2'); ?>" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?= base_url('assets/vendor/fontawesome/webfonts/fa-brands-400.woff2'); ?>" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css'); ?>" crossorigin="anonymous">
<link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

<!-- DataTables CSS -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/css/dataTables.bootstrap5.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/css/responsive.bootstrap5.min.css'); ?>">

<!-- jQuery DEBE IR PRIMERO -->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>


<link rel="stylesheet" href="<?= css_url('assets/css/header.css'); ?>">

</head>
<body class="page-blur">

<header id="mainHeader">
    <!-- FILA SUPERIOR: Logo + Info de Contacto -->
    <div class="header-top">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-6 col-lg-3">
                    <div class="logo d-flex justify-content-end justify-content-lg-end pe-lg-4" title="Inicio">
                        <a href="<?= base_url(); ?>">
                            <img src="<?= img_url('images/logo/logo-actual.png') ?>" alt="Importaciones Codiza - Logo" class="img-fluid" width="100%" height="auto">
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
                                <div class="item-content">+51 946 385 307</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div class="item-text">
                                <div class="item-header">Escríbenos</div>
                                <div class="item-content">elsa.calero@codiza.com.pe</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fa-solid fa-clock-rotate-left"></i>
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
    <div class="header-bottom d-none d-lg-block" style="background: #0117E5;">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg p-0" role="navigation" aria-label="Navegación principal">
                <div class="collapse navbar-collapse justify-content-center">
                    <ul class="navbar-nav menu">
                        <?php 
                        $ci = get_instance();
                        $current_controller = $ci->router->fetch_class();
                        $current_method = $ci->router->fetch_method();
                        // ID de categoría cuando la URL es /categoria/ver/{id}
                        $current_category_id = (int) $ci->uri->segment(3);
                        // Detectar primera segment y si estamos en la raíz (/) tratar como inicio
                        $uri_segment1 = $ci->uri->segment(1);
                        $is_home = ($current_controller == 'inicio' || $uri_segment1 == '');
                        
                        // Detectar área administrativa: cualquier método de Login excepto los públicos
                        $metodos_publicos = ['index', 'validar', 'salir'];
                        $es_area_admin = ($current_controller === 'login' && !in_array($current_method, $metodos_publicos));
                        
                        if ($ci->session->userdata('logeado') && $es_area_admin): 
                            // Menú para administrador logueado EN ÁREA ADMINISTRATIVA
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/inicio'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Inicio">
                                    <i class="fas fa-home"></i> Inicio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/dashboard'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dashboard">
                                    <i class="fas fa-user-shield"></i> Bienvenido
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/productos'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Productos">
                                    <i class="fas fa-shopping-bag"></i> Productos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/categorias'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Categorías">
                                    <i class="fas fa-folder"></i> Categorías
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="< ?= base_url('login/clientes'); ?>">
                                    <i class="fas fa-users"></i> Clientes
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/tiposcategorias'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tipo de Categorías">
                                    <i class="fas fa-tags"></i> Tipo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login/salir'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cerrar Sesión">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </a>
                            </li>
                        <?php else: 
                            // Menú público normal (incluso si está logueado pero en páginas públicas)
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $is_home ? 'active' : '' ?>" href="<?= base_url('inicio'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Inicio">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($current_controller == 'nosotros') ? 'active' : '' ?>" href="<?= base_url('nosotros'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Home">HOME</a>
                            </li>
                            
                            <?php if (isset($menuTiposCategorias) && !empty($menuTiposCategorias)): ?>
                                <?php foreach ($menuTiposCategorias as $tipoCategoria => $categorias): ?>
                                    <?php
                                        // Determinar si alguno de los items del grupo coincide con la categoría actual
                                        $isParentActive = false;
                                        if ($current_controller === 'categoria' && $current_method === 'ver' && $current_category_id > 0) {
                                            foreach ($categorias as $catCheck) {
                                                if ((int) $catCheck['id'] === $current_category_id) {
                                                    $isParentActive = true;
                                                    break;
                                                }
                                            }
                                        }
                                    ?>
                                    <li class="nav-item dropdown mega-dropdown <?= $isParentActive ? 'active' : '' ?>">
                                        <a class="nav-link dropdown-toggle <?= $isParentActive ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Ver categorías de <?= $tipoCategoria ?>">
                                                <?= $tipoCategoria ?> <i class="fas fa-chevron-down"></i>
                                            </a>
                                        <?php if (!empty($categorias)): ?>
                                            <div class="dropdown-menu mega-menu">
                                                <div class="columna">
                                                    <h3><?= $tipoCategoria ?></h3>
                                                    <?php foreach ($categorias as $cat): ?>
                                                        <?php $isItemActive = ($current_controller === 'categoria' && $current_method === 'ver' && $current_category_id > 0 && (int) $cat['id'] === $current_category_id); ?>
                                                        <a href="<?= base_url('categoria/ver/' . $cat['id']); ?>" class="dropdown-item item <?= $isItemActive ? 'active' : '' ?>" <?= $isItemActive ? 'aria-current="true"' : '' ?> title="Ver productos de la categoria <?= $cat['nombre'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver productos de la categoria <?= $cat['nombre'] ?>">
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
                                <a class="nav-link <?= ($current_controller == 'proyectos') ? 'active' : '' ?>" href="<?= base_url('proyectos'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Industrias">INDUSTRIAS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($current_controller == 'servicios') ? 'active' : '' ?>" href="<?= base_url('servicios'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Vulcanizados">Vulcanizados</a>
                            </li>
                            
                            <?php if ($ci->session->userdata('logeado')): ?>
                                <!-- Si está logueado, mostrar botón para ir al panel admin -->
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('login/dashboard'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Panel Administrativo">
                                        <i class="fas fa-user-shield"></i>
                                    </a>
                                </li>
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
                    <img src="<?= img_url('images/logo/logo-actual.png') ?>" alt="Importaciones Codiza - Logo" width="100%" height="auto" loading="lazy">
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
                    <a href="<?= base_url('/'); ?>" class="mobile-menu-link">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <a href="<?= base_url('login/dashboard'); ?>" class="mobile-menu-link">
                        <i class="fas fa-user-shield"></i> Bienvenido
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
                    <a href="<?= base_url('inicio'); ?>" class="mobile-menu-link">INICIO</a>
                    <a href="<?= base_url('nosotros'); ?>" class="mobile-menu-link">HOME</a>
                    
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
                    
                    <a href="<?= base_url('proyectos'); ?>" class="mobile-menu-link">INDUSTRIAS</a>
                    <a href="<?= base_url('servicios'); ?>" class="mobile-menu-link">VULCANIZADOS</a>
                    
                    <?php if ($ci->session->userdata('logeado')): ?>
                        <!-- Si está logueado, mostrar botón para ir al panel admin -->
                        <a href="<?= base_url('login/dashboard'); ?>" class="mobile-menu-link">
                            <i class="fas fa-user-shield"></i> PANEL ADMIN
                        </a>
                        <a href="<?= base_url('login/salir'); ?>" class="mobile-menu-link">
                            <i class="fas fa-sign-out-alt"></i> CERRAR SESIÓN
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('login'); ?>" class="mobile-menu-link">
                            <i class="fa-solid fa-user"></i> INICIAR SESIÓN
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

<script src="<?= js_url('assets/js/header.js'); ?>"></script>

