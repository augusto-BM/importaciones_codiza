<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ferreteria Mayta</title>
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/logo/favicon.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/logo/favicon.png') ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/logo/favicon.png') ?>">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    position: fixed; /* sticky también funciona si quieres */
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between; /* deja el contenido en los extremos */
    padding: 20px 50px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: all 0.3s ease; /* transición para todo */
}

/* Contenedor interno */
header .header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    transition: all 0.3s ease;
}

/* Logo normal */
header .logo img {
    height: 60px;
    transition: height 0.3s ease;
}

/* Header achicado al hacer scroll */
header.shrink {
    padding: 10px 50px; /* menos padding = fondo más pequeño */
}

header.shrink .header-inner {
    transform: scaleY(0.95); /* opcional, un pequeño escalado interno */
}

header.shrink .logo img {
    height: 50px; /* logo más pequeño */
}

/* Para que el contenido debajo del header no quede oculto */
body {
    padding-top: 80px; /* ajusta según la altura inicial del header */
}

/* ============================= */
/* NAV: menú centrado desktop   */
/* ============================= */

nav {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 10px; /* más cerca que antes */
}

nav ul li a {
    text-decoration: none;
    color: #333;
    font-weight: 600;           
    font-size: 16px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    letter-spacing: 0.5px;   /* un poco más compacto */
    padding: 8px 12px;       /* reduce espacio interno */
    border-radius: 5px;
    transition: all 0.3s ease;
    text-transform: uppercase;  
}

/* Hover elegante */
nav ul li a:hover {
    color: #fff;
    background-color: #007BFF;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3); 
    transform: translateY(-2px);
}



/* ============================= */
/* MEGA MENÚ                     */
/* ============================= */

.menu {
    list-style: none;
    display: flex;
    gap: 30px;
}

.mega {
    position: relative;
}

.mega-menu {
    position: absolute;
    top: calc(100% + 6px);
    left: 0;
    width: 900px;
    max-height: 85vh;
    overflow-y: auto;
    background: #ffffff;
    padding: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    border: 1px solid #eee;
    border-radius: 6px;
    
    display: grid;              /* siempre grid */
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;

    opacity: 0;                 /* invisible */
    transform: translateY(-10px); /* arriba un poco */
    pointer-events: none;       /* no clickeable */
    transition: opacity 0.35s ease, transform 0.35s ease; /* transición suave */
    z-index: 999;
}

/* Al pasar el mouse: difuminado y movimiento hacia abajo */
.mega:hover .mega-menu {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;       /* ahora clickeable */
}


.columna h3 {
    font-size: 16px;
    margin-bottom: 12px;
    font-weight: 700;
    color: #0056D6;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.item {
    display: block;
    padding: 6px 0;
    text-decoration: none;
    color: #555;
    font-size: 14px;
    transition: color 0.2s ease, padding-left 0.2s ease, background-color 0.2s ease;
}

.item:hover {
    color: #0056D6;
    font-weight: 600;
    background-color: #f9f9f9;
}

/* ======================================= */
/* RESPONSIVE                              */
/* ======================================= */

@media(max-width: 992px){
    nav ul {
        gap: 25px;
    }

    .mega-menu {
        width: 600px;
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 768px){

    header {
        flex-direction: column;
        align-items: flex-start;
        padding: 15px 20px;
    }

    /* Logo más pequeño automático */
    .logo img {
        height: 60px;
    }

    /* Menú pasa abajo del logo */

    nav ul {
        flex-direction: column;
        width: 100%;
        gap: 10px;
    }

    nav ul li a {
        width: 100%;
        text-align: center;
        font-size: 16px;
    }

    /* Mega menú desactivado en mobile */
    .mega-menu {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
}

@media(max-width: 480px){
    header {
        padding: 12px 15px;
    }
    .logo img {
        height: 50px;
    }
}

/* Botón hamburguesa */
.hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    z-index: 100000; /* SIEMPRE ENCIMA DEL MENU */
    position: relative;
}

.hamburger span {
    width: 28px;
    height: 3px;
    background: #333;
    border-radius: 4px;
    transition: .3s;
}

/* Animación en forma de X */
.hamburger.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 6px);
}
.hamburger.active span:nth-child(2) {
    opacity: 0;
}
.hamburger.active span:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -7px);
}

/* MENU FULLSCREEN */
.mobile-menu {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;

    background: white;

    display: flex;
    flex-direction: column;
    justify-content: center; /* CENTRA VERTICAL */
    align-items: center;     /* CENTRA HORIZONTAL */

    text-align: center;
    gap: 25px;
    font-size: 22px;

    opacity: 0;
    pointer-events: none;

    transition: opacity 0.35s ease;
    z-index: 9999; /* MÁS BAJO QUE EL HAMBURGUESA */
}

/* Activo */
.mobile-menu.show {
    opacity: 1;
    pointer-events: auto;
}

.mobile-menu a {
    color: #222;
    text-decoration: none;
    font-weight: 600;
}

/* Responsivo */
@media(max-width: 768px) {
    nav {
        display: none;
    }

    .hamburger {
        display: flex;
    }

    .mega-menu {
        display: none !important;
    }
}


</style>

</head>
<body class="page-blur">

<header>
    <div class="logo">
        <a href="<?= base_url(); ?>">
            <img src="<?= base_url('images/logo/mayta.png') ?>" alt="Logo">
        </a>
    </div>

    <!-- Menú normal (desktop) -->
    <nav id="nav">
        <ul class="menu">
            <li><a href="<?= base_url('inicio'); ?>">Inicio</a></li>

            <li class="mega">
                <a href="<?= base_url('productos'); ?>">Productos</a>
                <div class="mega-menu">
                    <?php foreach ($menu as $categoria => $productos): ?>
                        <div class="columna">
                            <h3><?= $categoria ?></h3>
                            <?php foreach ($productos as $p): ?>
                                <a href="<?= base_url('productos/ver/' . $p['id']); ?>" class="item">
                                    <?= $p['nombre'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </li>

            <li><a href="<?= base_url('nosotros'); ?>">Nosotros</a></li>
            <li><a href="<?= base_url('contacto'); ?>">Contáctenos</a></li>

            <?php 
            $ci = get_instance();
            if ($ci->session->userdata('logeado') && $ci->session->userdata('usuario_id') == 1): ?>
                <li style="margin-left:auto;">
                    <a href="<?= base_url('login/dashboard'); ?>" style="font-weight:bold;">ADMINISTRAR</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Botón hamburguesa A LA DERECHA -->
    <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- MENÚ FULLSCREEN -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="<?= base_url('inicio'); ?>">Inicio</a>
        <a href="<?= base_url('productos'); ?>">Productos</a>
        <a href="<?= base_url('nosotros'); ?>">Nosotros</a>
        <a href="<?= base_url('contacto'); ?>">Contáctenos</a>

        <?php 
        if ($ci->session->userdata('logeado') && $ci->session->userdata('usuario_id') == 1): ?>
            <a href="<?= base_url('login/dashboard'); ?>" style="font-weight:bold;">ADMINISTRAR</a>
        <?php endif; ?>
    </div>
</header>


<script>
document.addEventListener("DOMContentLoaded", function() {
    document.body.classList.add("show");
});
</script>

<script>
    window.addEventListener('scroll', function () {
        const header = document.querySelector('header');

        if (window.scrollY > 20) { // umbral pequeño pero seguro
            header.classList.add('shrink');
        } else {
            header.classList.remove('shrink');
        }
    });
</script>

<script>
const hamburger = document.getElementById("hamburger");
const mobileMenu = document.getElementById("mobileMenu");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    mobileMenu.classList.toggle("show");
});
</script>

