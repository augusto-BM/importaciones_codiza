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

<link rel="stylesheet" href="<?= base_url('assets/css/header.css'); ?>">

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
                        // ID de categoría cuando la URL es /categoria/ver/{id}
                        $current_category_id = (int) $ci->uri->segment(3);
                        // Detectar primera segment y si estamos en la raíz (/) tratar como inicio
                        $uri_segment1 = $ci->uri->segment(1);
                        $is_home = ($current_controller == 'inicio' || $uri_segment1 == '');
                        
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
                                <a class="nav-link <?= $is_home ? 'active' : '' ?>" href="<?= base_url('inicio'); ?>">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($current_controller == 'nosotros') ? 'active' : '' ?>" href="<?= base_url('nosotros'); ?>">Nosotros</a>
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
                                        <a class="nav-link dropdown-toggle <?= $isParentActive ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?= $tipoCategoria ?> <i class="fas fa-chevron-down"></i>
                                            </a>
                                        <?php if (!empty($categorias)): ?>
                                            <div class="dropdown-menu mega-menu">
                                                <div class="columna">
                                                    <h3><?= $tipoCategoria ?></h3>
                                                    <?php foreach ($categorias as $cat): ?>
                                                        <?php $isItemActive = ($current_controller === 'categoria' && $current_method === 'ver' && $current_category_id > 0 && (int) $cat['id'] === $current_category_id); ?>
                                                        <a href="<?= base_url('categoria/ver/' . $cat['id']); ?>" class="dropdown-item item <?= $isItemActive ? 'active' : '' ?>" <?= $isItemActive ? 'aria-current="true"' : '' ?> >
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
                                <a class="nav-link <?= ($current_controller == 'proyectos') ? 'active' : '' ?>" href="<?= base_url('proyectos'); ?>">Proyectos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($current_controller == 'servicios') ? 'active' : '' ?>" href="<?= base_url('servicios'); ?>">Servicios</a>
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

<script src="<?= base_url('assets/js/header.js'); ?>"></script>

