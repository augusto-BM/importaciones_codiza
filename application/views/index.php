<!-- Banner de borde a borde -->
<style>
 /* ======================================= */
/* BANNER CARRUSEL CON BOOTSTRAP Y JQUERY */
/* ======================================= */

.section-banner {
    position: relative;
    width: 100%;
    overflow: hidden;
    perspective: 1500px; /* Perspectiva 3D */
    height: 90vh; /* Reducir altura */
    min-height: 85vh;
    max-height: 650px;
    /* Fondo gris medio para evitar blanco durante el giro */
    background: #3a3a3a;
}

.banner-carousel-wrapper {
    position: relative;
    overflow: hidden;
    height: 100%;
    width: 100%;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    /* Evitar giro directo del contenido: el giro lo hace el contenedor "cubo" */
    opacity: 1;
    transform: translateZ(0);
    animation: none;
}

/* Contenedor tipo cubo para una entrada 3D más creíble */
.banner-cube {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    /* Animación de giro aplicada al cubo, no al contenido */
    opacity: 0;
    transform: rotateY(80deg) translateZ(0);
    animation: cubeEntrance 1.5s ease-in-out forwards;
    will-change: transform, opacity;
}

/* Cara lateral simulada para que no se vea blanco al girar */
.banner-cube::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    width: 60px; /* grosor visual de la cara lateral */
    background: linear-gradient(90deg, rgba(90,90,90,0.95), rgba(55,55,55,0.95));
    transform-origin: right center;
    transform: rotateY(90deg);
    pointer-events: none;
}

@keyframes cubeEntrance {
    from {
        opacity: 0;
        transform: rotateY(65deg) translateZ(0);
    }
    to {
        opacity: 1;
        transform: rotateY(0deg) translateZ(0);
    }
}

/* Animación de entrada 3D con rotación en el centro, sin movimiento lateral */
@keyframes bannerEntranceCenter {
    0% {
        opacity: 0;
        transform: rotateY(90deg) scale(0.8);
        transform-origin: center center;
    }
    40% {
        opacity: 0.7;
        transform: rotateY(45deg) scale(0.9);
    }
    70% {
        opacity: 1;
        transform: rotateY(-5deg) scale(1.02);
    }
    85% {
        transform: rotateY(2deg) scale(1.01);
    }
    100% {
        opacity: 1;
        transform: rotateY(0deg) scale(1);
        transform-origin: center center;
    }
}

.banner-carousel-track {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
}

.banner-slide {
    display: none;
    opacity: 0;
    transition: opacity 0.8s ease-in-out;
    position: relative;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transform-style: preserve-3d;

    &.active {
        display: flex;
        opacity: 1;
        justify-content: center;
        align-items: center;
    }

    /* Animación para el slide 2: giro 360° de abajo hacia arriba */
    &[data-slide="1"].active {
        animation: rotateBottomToTop 1.2s ease-in-out;
    }

    /* Animación para el slide 3: giro 360° de arriba hacia abajo */
    &[data-slide="2"].active {
        animation: rotateTopToBottom 1.2s ease-in-out;
    }
}

/* Keyframes para rotación de abajo hacia arriba (eje X negativo) */
@keyframes rotateBottomToTop {
    0% {
        transform: rotateX(-90deg);
        opacity: 0;
    }
    50% {
        transform: rotateX(-180deg);
        opacity: 0.5;
    }
    100% {
        transform: rotateX(0deg);
        opacity: 1;
    }
}

/* Keyframes para rotación de arriba hacia abajo (eje X positivo) */
@keyframes rotateTopToBottom {
    0% {
        transform: rotateX(90deg);
        opacity: 0;
    }
    50% {
        transform: rotateX(180deg);
        opacity: 0.5;
    }
    100% {
        transform: rotateX(0deg);
        opacity: 1;
    }
}

/* Overlay oscuro sobre la imagen */
.banner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

/* Contenido del banner */
.banner-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    padding: 0 20px;

    & h1 {
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 30px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    }
}

/* Ocultar elementos animados inicialmente */
.banner-title-animate,
.banner-btn-1,
.banner-btn-2 {
    opacity: 0;
    visibility: hidden;
}

.banner-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-top: 30px;

    & .btn-banner {
        padding: 15px 40px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;

        &.btn-primary-banner {
            background: #00963f;
            color: white;

            &:hover {
                background: #007a33;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(0, 150, 63, 0.4);
            }
        }

        &.btn-secondary-banner {
            background: transparent;
            color: white;
            border: 2px solid white;

            &:hover {
                background: white;
                color: #00963f;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
            }
        }
    }
}

/* Botones de navegación (flechas) */
.banner-carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: rgba(0, 0, 0, 0.6);
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    z-index: 100;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    opacity: 1;
    pointer-events: auto;

    &:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: translateY(-50%) scale(1.1);
    }

    &.banner-carousel-prev {
        left: 30px;
    }

    &.banner-carousel-next {
        right: 30px;
    }
}

/* Indicadores (puntos) del banner */
.banner-carousel-dots {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    justify-content: center;
    gap: 12px;
    z-index: 20;

    & .dot-banner {
        width: 15px;
        height: 15px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;

        &:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: scale(1.15);
        }

        &.active {
            background: white;
            transform: scale(1.3);
        }
    }
}

/* Ocultar en móviles */
@media (max-width: 992px) {
    .section-banner {
        display: none !important;
    }
}

@media (max-width: 768px) {
    .banner-carousel-wrapper {
        height: 100vh;
        min-height: 500px;
    }

    .banner-slide {
        height: 100vh;
        min-height: 500px;
    }

    .banner-content h1 {
        font-size: 32px;
    }

    .banner-buttons .btn-banner {
        padding: 12px 30px;
        font-size: 14px;
    }

    .banner-carousel-btn {
        width: 40px;
        height: 40px;
        font-size: 20px;

        &.banner-carousel-prev {
            left: 15px;
        }

        &.banner-carousel-next {
            right: 15px;
        }
    }
}

@media (max-width: 576px) {
    .banner-carousel-wrapper {
        height: 100vh;
        min-height: 400px;
    }

    .banner-slide {
        height: 100vh;
        min-height: 400px;
    }

    .banner-content h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .banner-buttons {
        flex-direction: column;
        gap: 15px;
    }

    .banner-buttons .btn-banner {
        padding: 10px 25px;
        font-size: 13px;
    }

    .banner-carousel-btn {
        width: 35px;
        height: 35px;
        font-size: 18px;

        &.banner-carousel-prev {
            left: 10px;
        }

        &.banner-carousel-next {
            right: 10px;
        }
    }

    .banner-carousel-dots .dot-banner {
        width: 12px;
        height: 12px;
    }
}


/* ======================================= */
/* CARRUSEL RESPONSIVO + TOUCH + DRAG     */
/* ======================================= */

.carousel {
    display: flex;
    overflow-x: auto;
    gap: 20px;
    margin-top: 40px;
    scroll-behavior: smooth;

    cursor: grab;
    user-select: none;
    padding: 10px;

    /* para celular: scroll suave */
    -webkit-overflow-scrolling: touch;
}

.carousel::-webkit-scrollbar {
    display: none; /* Oculta barra en móvil y PC */
}

.carousel-item {
    flex: 0 0 auto;
    width: 200px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel-item img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    pointer-events: none;
}

/* Celular: items más pequeños */
@media (max-width: 600px) {
    .carousel-item {
        width: 140px;
        height: 80px;
    }
}

.no-image-placeholder {
    display: flex;              /* Usar flexbox para centrar el contenido */
    justify-content: center;    /* Centrado horizontal */
    align-items: center;        /* Centrado vertical */
    height: 100%;               /* Asegura que ocupe toda la altura del contenedor */
    width: 100%;                /* Asegura que ocupe toda la anchura del contenedor */
    background-color: #f7f7f7; /* Opcional: color de fondo si no hay imagen */
}

.no-image-placeholder i {
    color: #6c757d;  /* Opcional: color para el icono */
}



</style>


<section class="section-banner">
    <div class="banner-cube">
        <div class="banner-carousel-wrapper">
        <div class="banner-carousel-track">
            <!-- Slide 1 -->
            <div class="banner-slide active" data-slide="0" style="background-image: url('<?= base_url("images/banner/3-banners.jpg") ?>');">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <h1 class="banner-title-animate">Bienvenidos a Importaciones Codiza</h1>
                    <div class="banner-buttons">
                        <a href="<?= base_url('nosotros') ?>" class="btn-banner btn-primary-banner banner-btn-1">Conócenos</a>
                        <a href="<?= base_url('contacto') ?>" class="btn-banner btn-secondary-banner banner-btn-2">Contáctanos</a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="banner-slide" data-slide="1" style="background-image: url('<?= base_url("images/banner/3-banners2.jpg") ?>');">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <h1 class="banner-title-animate">Bienvenidos a Importaciones Codiza</h1>
                    <div class="banner-buttons">
                        <a href="<?= base_url('nosotros') ?>" class="btn-banner btn-primary-banner banner-btn-1">Conócenos</a>
                        <a href="<?= base_url('contacto') ?>" class="btn-banner btn-secondary-banner banner-btn-2">Contáctanos</a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="banner-slide" data-slide="2" style="background-image: url('<?= base_url("images/banner/3-banners3.jpg") ?>');">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <h1 class="banner-title-animate">Bienvenidos a Importaciones Codiza</h1>
                    <div class="banner-buttons">
                        <a href="<?= base_url('nosotros') ?>" class="btn-banner btn-primary-banner banner-btn-1">Conócenos</a>
                        <a href="<?= base_url('contacto') ?>" class="btn-banner btn-secondary-banner banner-btn-2">Contáctanos</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de navegación -->
        <button class="banner-carousel-btn banner-carousel-prev" type="button">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="banner-carousel-btn banner-carousel-next" type="button">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Indicadores (puntos) -->
        <div class="banner-carousel-dots">
            <span class="dot-banner active" data-slide="0"></span>
            <span class="dot-banner" data-slide="1"></span>
            <span class="dot-banner" data-slide="2"></span>
        </div>
        </div>
    </div>
</section>

<section class="section-categorias">
    <div class="container-fluid">
        <h4>NUESTROS PRODUCTOS</h4>
        <hr style="margin: 10px 0 20px 0; padding: 0;">
        
        <!-- Carrusel personalizado con jQuery -->
        <div id="categoriasCarousel" class="servicios-carousel-wrapper">
            <div class="servicios-carousel-track">
                <div class="categorias-grid">
                    <?php foreach ($categorias as $index => $categoria): ?>
                        <div class="categoria-item <?= $index < 4 ? 'active' : '' ?>" data-index="<?= $index ?>">
                            <div class="servicio-card">
                                <div class="servicio-imagen-wrapper">
                                    <div class="servicio-imagen">
                                        <?php if (!empty($categoria->imagen)): ?>
                                            <img src="<?= base_url("images/categorias/$categoria->imagen") ?>" 
                                                alt="<?= htmlspecialchars($categoria->nombre) ?>">
                                        <?php else: ?>
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-image fa-5x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="servicio-overlay"></div>
                                    </div>
                                    <div class="servicio-nombre">
                                        <h4><?= htmlspecialchars($categoria->nombre) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Controles anterior/siguiente -->
            <?php if (count($categorias) > 4): ?>
                <button class="carousel-btn carousel-prev-categorias" type="button">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-btn carousel-next-categorias" type="button">
                    <i class="fas fa-chevron-right"></i>
                </button>
            <?php endif; ?>
        </div>

        <!-- Indicadores -->
        <div id="categoriasIndicators" class="carousel-dots"></div>
    </div>
</section>

<section class="section-servicios">
    <div class="container-fluid">
        <h4>NUESTROS SERVICIOS</h4>
        <hr style="margin: 10px 0 20px 0; padding: 0;">
        
        <!-- Carrusel personalizado con jQuery -->
        <div id="serviciosCarousel" class="servicios-carousel-wrapper">
            <div class="servicios-carousel-track">
                <div class="servicios-grid">
                    <?php foreach ($servicios as $index => $servicio): ?>
                        <div class="servicio-item <?= $index < 4 ? 'active' : '' ?>" data-index="<?= $index ?>">
                            <div class="servicio-card">
                                <div class="servicio-imagen-wrapper">
                                    <div class="servicio-imagen">
                                        <?php if (!empty($servicio->imagen)): ?>
                                            <img src="<?= base_url($servicio->imagen) ?>" 
                                                alt="<?= htmlspecialchars($servicio->nombre) ?>">
                                        <?php else: ?>
                                            <!-- Mostrar un icono centrado si no hay imagen -->
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-image fa-5x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="servicio-overlay"></div>
                                    </div>

                                    <div class="servicio-nombre">
                                        <h4><?= htmlspecialchars($servicio->nombre) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Controles anterior/siguiente -->
            <?php if (count($servicios) > 4): ?>
                <button class="carousel-btn carousel-prev" type="button">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-btn carousel-next" type="button">
                    <i class="fas fa-chevron-right"></i>
                </button>
            <?php endif; ?>
        </div>

        <!-- Indicadores -->
        <div id="serviciosIndicators" class="carousel-dots"></div>
    </div>
</section>

<section class="section-asesoria">
    <div class="asesoria-parallax-container">
        <div class="asesoria-parallax-bg" style="background-image: url('<?= base_url("images/banner/banner.jpg") ?>');"></div>
        <div class="asesoria-content">
            <h2>Asesoría Técnica, Ventas y Proyectos</h2>
            <p>En IMPORTACIONES COTIZA, convertimos sus necesidades en soluciones eficientes y oportunas. Diseñamos, fabricamos e instalamos fajas de alto rendimiento para diversas industrias, optimizando procesos, reduciendo costos operativos y mejorando la productividad.</p>
        </div>
    </div>
</section>

<!-- Incluir CSS del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_css'); ?>

<!-- Incluir componente de clientes -->
<?php $this->load->view('partials/clientes_carousel', ['clientes' => $clientes]); ?>

<style>
/* ======================================= */
/* SECCIÓN DE SERVICIOS                   */
/* ======================================= */

.section-servicios {
    padding: 60px 100px;
    background: #f8f9fa;

    & h4 {
        text-align: left;
        font-weight: bold;
        color: #00963f;
        margin-bottom: 0;
    }

    & hr {
        width: 30px;
        height: 4px;
        background-color: #00963f;
        border: none;
        margin-bottom: 40px;
        margin-left: 0;
    }
}

/* ======================================= */
/* SECCIÓN DE CATEGORÍAS                  */
/* ======================================= */

.section-categorias {
    padding: 60px 100px;
    background: #ffffff;

    & h4 {
        text-align: left;
        font-weight: bold;
        color: #00963f;
        margin-bottom: 0;
    }

    & hr {
        width: 30px;
        height: 4px;
        background-color: #00963f;
        border: none;
        margin-bottom: 40px;
        margin-left: 0;
    }
}

/* Wrapper del carrusel */
.servicios-carousel-wrapper {
    position: relative;
    overflow: visible;
    padding: 0 50px;
    max-width: 100%;

    &:hover .carousel-btn {
        opacity: 1;
        pointer-events: auto;
    }
}

/* Track del carrusel */
.servicios-carousel-track {
    position: relative;
    width: 100%;
    overflow: hidden;
}

/* Grid de servicios y categorías */
.servicios-grid,
.categorias-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    transition: transform 0.5s ease-in-out;
}

/* Items individuales */
.servicio-item,
.categoria-item {
    display: none;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;

    &.active {
        display: block;
        opacity: 1;
    }
}

/* Tarjeta de servicio */
.servicio-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    cursor: pointer;

    &:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);

        & .servicio-imagen img {
            transform: scale(1.15);
            opacity: 0.7;
        }

        & .servicio-overlay {
            background: rgba(0, 0, 0, 0.3);
        }
    }
}

/* Wrapper de imagen */
.servicio-imagen-wrapper {
    position: relative;
    width: 100%;
    height: 280px;
}

/* Contenedor de imagen */
.servicio-imagen {
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: #f0f0f0;
    position: relative;

    & img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.5s ease, opacity 0.5s ease;
    }
}

/* Overlay oscuro sobre la imagen */
.servicio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0);
    transition: background 0.5s ease;
    pointer-events: none;
}

/* Nombre del servicio */
.servicio-nombre {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 20px 15px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4), transparent);
    text-align: center;
    z-index: 2;

    & h4 {
        font-size: 15px;
        font-weight: 600;
        color: white;
        margin: 0;
        line-height: 1.4;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
}

/* Controles del carrusel (flechas) */
.carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: auto;
    height: auto;
    background: transparent;
    border: none;
    color: #333;
    font-size: 40px;
    cursor: pointer;
    z-index: 100;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    line-height: 1;

    &:hover {
        color: #00963f;
        transform: translateY(-50%) scale(1.3);
    }

    &.carousel-prev,
    &.carousel-prev-categorias {
        left: 0;
    }

    &.carousel-next,
    &.carousel-next-categorias {
        right: 0;
    }
}

/* Indicadores (puntos) */
.carousel-dots {
    text-align: center;
    margin-top: 30px;
    display: flex;
    justify-content: center;
    gap: 10px;

    & .dot,
    & .dot-categorias {
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #333;
        border-radius: 50%;
        display: inline-block;
        cursor: pointer;
        transition: all 0.3s ease;

        &:hover {
            background: #666;
            border-color: #000;
            transform: scale(1.15);
        }

        &.active {
            background: #000;
            border-color: #000;
            transform: scale(1.2);
        }
    }
}

/* ======================================= */
/* RESPONSIVE                              */
/* ======================================= */

@media (max-width: 991px) {
    .section-servicios,
    .section-categorias {
        padding: 60px 40px;
    }

    .servicios-carousel-wrapper {
        padding: 0 45px;
    }

    /* Mostrar 2 columnas en tablet */
    .servicios-grid,
    .categorias-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .servicio-imagen-wrapper,
    .servicio-imagen {
        height: 220px;
    }

    .servicio-nombre h4 {
        font-size: 14px;
    }

    .carousel-btn {
        font-size: 32px;
        opacity: 1;
        pointer-events: auto;

        &.carousel-prev,
        &.carousel-prev-categorias {
            left: 5px;
        }

        &.carousel-next,
        &.carousel-next-categorias {
            right: 5px;
        }
    }
}

@media (max-width: 575px) {
    .section-servicios,
    .section-categorias {
        padding: 40px 15px;
    }

    .servicios-carousel-wrapper {
        padding: 0 40px;
    }

    /* Mostrar 1 columna en móvil */
    .servicios-grid,
    .categorias-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .servicio-imagen-wrapper,
    .servicio-imagen {
        height: 250px;
    }

    .servicio-nombre {
        padding: 15px 10px;

        & h4 {
            font-size: 14px;
        }
    }

    .carousel-btn {
        width: 35px;
        height: 35px;
        font-size: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        opacity: 0.95;
        pointer-events: auto;

        &:hover {
            background: rgba(0, 150, 63, 0.9);
            color: white;
        }

        &.carousel-prev,
        &.carousel-prev-categorias {
            left: 5px;
        }

        &.carousel-next,
        &.carousel-next-categorias {
            right: 5px;
        }
    }

    /* Ocultar indicadores en móvil ya que solo muestra 1 imagen */
    .carousel-dots {
        display: none;
    }
}

/* ======================================= */
/* SECCIÓN DE ASESORÍA CON PARALLAX       */
/* ======================================= */

.section-asesoria {
    margin: 0;
    padding: 0;
    width: 100%;
}

.asesoria-parallax-container {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
}

.asesoria-parallax-bg {
    position: absolute;
    top: -50%;
    left: 0;
    width: 100%;
    height: 200%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    transform: translateY(0);
    will-change: transform;
}

.asesoria-content {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 0 20px;
    text-align: center;
    background: rgba(0, 0, 0, 0.5);

    & h2 {
        font-size: 42px;
        font-weight: bold;
        color: white;
        margin-bottom: 20px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        max-width: 900px;
    }

    & p {
        font-size: 18px;
        color: white;
        line-height: 1.8;
        max-width: 800px;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
        margin: 0;
    }
}

/* Responsive */
@media (max-width: 992px) {
    .asesoria-parallax-container {
        height: 350px;
    }

    .asesoria-content h2 {
        font-size: 32px;
    }

    .asesoria-content p {
        font-size: 16px;
    }
}

@media (max-width: 576px) {
    .asesoria-parallax-container {
        height: 300px;
    }

    .asesoria-content h2 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .asesoria-content p {
        font-size: 14px;
        line-height: 1.6;
    }
}
</style>

<script>
// ======================================= 
// CARRUSEL RESPONSIVE DE SERVICIOS
// =======================================
$(document).ready(function() {
    const servicioItems = $('.servicio-item');
    const totalItems = servicioItems.length;
    let currentIndex = 0;
    let itemsPerView = 4; // Por defecto desktop
    let autoplayInterval;

    // Función para obtener items por vista según el ancho de pantalla
    function getItemsPerView() {
        const width = $(window).width();
        if (width <= 575) return 1;        // Móvil: 1 item
        if (width <= 991) return 2;        // Tablet: 2 items
        return 4;                          // Desktop: 4 items
    }

    // Función para crear indicadores dinámicamente
    function createIndicators() {
        const totalPages = Math.ceil(totalItems / itemsPerView);
        const indicatorsContainer = $('#serviciosIndicators');
        indicatorsContainer.empty();
        
        if (totalPages > 1) {
            for (let i = 0; i < totalPages; i++) {
                const dot = $('<span class="dot"></span>').attr('data-slide', i);
                if (i === 0) dot.addClass('active');
                indicatorsContainer.append(dot);
            }
        }
    }

    // Función para mostrar items según el índice actual
    function showItems(startIndex) {
        // Normalizar el índice
        if (startIndex >= totalItems) {
            currentIndex = 0;
        } else if (startIndex < 0) {
            currentIndex = Math.max(0, totalItems - itemsPerView);
        } else {
            currentIndex = startIndex;
        }

        // Ocultar todos los items
        servicioItems.removeClass('active');

        // Mostrar items según el rango actual
        for (let i = 0; i < itemsPerView && (currentIndex + i) < totalItems; i++) {
            servicioItems.eq(currentIndex + i).addClass('active');
        }

        // Actualizar indicadores
        const currentPage = Math.floor(currentIndex / itemsPerView);
        $('#serviciosIndicators .dot').removeClass('active');
        $('#serviciosIndicators .dot').eq(currentPage).addClass('active');
    }

    // Función para inicializar el carrusel
    function initCarousel() {
        itemsPerView = getItemsPerView();
        createIndicators();
        currentIndex = 0;
        showItems(0);
        startAutoplay();
    }

    // Función para avanzar
    function nextSlide() {
        const newIndex = currentIndex + itemsPerView;
        if (newIndex >= totalItems) {
            showItems(0);
        } else {
            showItems(newIndex);
        }
    }

    // Función para retroceder
    function prevSlide() {
        const newIndex = currentIndex - itemsPerView;
        showItems(newIndex);
    }

    // Autoplay
    function startAutoplay() {
        stopAutoplay();
        if (totalItems > itemsPerView) {
            autoplayInterval = setInterval(nextSlide, 3000);
        }
    }

    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }

    // Event listeners
    $('.carousel-next').on('click', function() {
        stopAutoplay();
        nextSlide();
        startAutoplay();
    });

    $('.carousel-prev').on('click', function() {
        stopAutoplay();
        prevSlide();
        startAutoplay();
    });

    $(document).on('click', '#serviciosIndicators .dot', function() {
        stopAutoplay();
        const page = $(this).data('slide');
        showItems(page * itemsPerView);
        startAutoplay();
    });

    $('#serviciosCarousel').on('mouseenter', stopAutoplay);
    $('#serviciosCarousel').on('mouseleave', startAutoplay);

    // Reinicializar al cambiar tamaño de ventana
    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const newItemsPerView = getItemsPerView();
            if (newItemsPerView !== itemsPerView) {
                initCarousel();
            }
        }, 250);
    });

    // Inicializar
    initCarousel();
});

// ======================================= 
// CARRUSEL RESPONSIVE DE CATEGORÍAS
// =======================================
$(document).ready(function() {
    const categoriaItems = $('.categoria-item');
    const totalItems = categoriaItems.length;
    let currentIndex = 0;
    let itemsPerView = 4;
    let autoplayInterval;

    function getItemsPerView() {
        const width = $(window).width();
        if (width <= 575) return 1;
        if (width <= 991) return 2;
        return 4;
    }

    function createIndicators() {
        const totalPages = Math.ceil(totalItems / itemsPerView);
        const indicatorsContainer = $('#categoriasIndicators');
        indicatorsContainer.empty();
        
        if (totalPages > 1) {
            for (let i = 0; i < totalPages; i++) {
                const dot = $('<span class="dot-categorias"></span>').attr('data-slide', i);
                if (i === 0) dot.addClass('active');
                indicatorsContainer.append(dot);
            }
        }
    }

    function showItems(startIndex) {
        if (startIndex >= totalItems) {
            currentIndex = 0;
        } else if (startIndex < 0) {
            currentIndex = Math.max(0, totalItems - itemsPerView);
        } else {
            currentIndex = startIndex;
        }

        categoriaItems.removeClass('active');

        for (let i = 0; i < itemsPerView && (currentIndex + i) < totalItems; i++) {
            categoriaItems.eq(currentIndex + i).addClass('active');
        }

        const currentPage = Math.floor(currentIndex / itemsPerView);
        $('#categoriasIndicators .dot-categorias').removeClass('active');
        $('#categoriasIndicators .dot-categorias').eq(currentPage).addClass('active');
    }

    function initCarousel() {
        itemsPerView = getItemsPerView();
        createIndicators();
        currentIndex = 0;
        showItems(0);
        startAutoplay();
    }

    function nextSlide() {
        const newIndex = currentIndex + itemsPerView;
        if (newIndex >= totalItems) {
            showItems(0);
        } else {
            showItems(newIndex);
        }
    }

    function prevSlide() {
        const newIndex = currentIndex - itemsPerView;
        showItems(newIndex);
    }

    function startAutoplay() {
        stopAutoplay();
        if (totalItems > itemsPerView) {
            autoplayInterval = setInterval(nextSlide, 3000);
        }
    }

    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }

    $('.carousel-next-categorias').on('click', function() {
        stopAutoplay();
        nextSlide();
        startAutoplay();
    });

    $('.carousel-prev-categorias').on('click', function() {
        stopAutoplay();
        prevSlide();
        startAutoplay();
    });

    $(document).on('click', '#categoriasIndicators .dot-categorias', function() {
        stopAutoplay();
        const page = $(this).data('slide');
        showItems(page * itemsPerView);
        startAutoplay();
    });

    $('#categoriasCarousel').on('mouseenter', stopAutoplay);
    $('#categoriasCarousel').on('mouseleave', startAutoplay);

    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const newItemsPerView = getItemsPerView();
            if (newItemsPerView !== itemsPerView) {
                initCarousel();
            }
        }, 250);
    });

    initCarousel();
});

</script>

<!-- Incluir JavaScript del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_js'); ?>

<script>
document.getElementById("form-contacto").addEventListener("submit", function(e) {
    e.preventDefault();

    // ALERTA EXITOSA
    Swal.fire({
        icon: 'success',
        title: '¡Mensaje enviado!',
        text: 'Nos pondremos en contacto contigo pronto.',
        confirmButtonColor: '#e63946'
    });

    this.reset();
});
</script>





<script>
const slider = document.querySelector('.carousel');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});

slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
});

slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
});

slider.addEventListener('mousemove', (e) => {
    if(!isDown) return;
    e.preventDefault(); // Esto evita la selección por defecto
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 2; // velocidad del scroll
    slider.scrollLeft = scrollLeft - walk;
});

// LOOP INFINITO AUTOMÁTICO PARA EL ARRASTRE
slider.addEventListener('scroll', () => {
    const maxScroll = slider.scrollWidth / 2; // mitad (porque duplicamos)
    
    if (slider.scrollLeft >= maxScroll) {
        slider.scrollLeft = 1; // reinicia apenas pasa la mitad
    } 
    else if (slider.scrollLeft <= 0) {
        slider.scrollLeft = maxScroll - 1; // si va muy atrás
    }
});

</script>

<script>
// ======================================= 
// CARRUSEL DE BANNER CON JQUERY
// =======================================
$(document).ready(function() {
    let currentSlideBanner = 0;
    const slidesBanner = $('.banner-slide');
    const dotsBanner = $('.banner-carousel-dots .dot-banner');
    const totalSlidesBanner = slidesBanner.length;
    let autoplayIntervalBanner = null;
    let isTransitioning = false;

    // Función para mostrar slide
    function showSlideBanner(index) {
        if (isTransitioning) return; // Evitar transiciones múltiples
        
        isTransitioning = true;
        
        // Asegurar que el índice esté en rango
        if (index >= totalSlidesBanner) {
            currentSlideBanner = 0;
        } else if (index < 0) {
            currentSlideBanner = totalSlidesBanner - 1;
        } else {
            currentSlideBanner = index;
        }

        // Ocultar todos los slides
        slidesBanner.removeClass('active');
        dotsBanner.removeClass('active');

        // Mostrar slide actual
        slidesBanner.eq(currentSlideBanner).addClass('active');
        dotsBanner.eq(currentSlideBanner).addClass('active');
        
        // Ejecutar la animación de contenido del slide actual (si existe)
        // Se usa un pequeño retardo para permitir que se aplique la clase "active"
        setTimeout(function() {
            if (typeof window.animateBannerContent === 'function') {
                window.animateBannerContent();
            }
        }, 250);

        // Permitir nueva transición después de 800ms (duración de la animación)
        setTimeout(function() {
            isTransitioning = false;
        }, 800);
    }

    // Función para iniciar autoplay
    function startAutoplayBanner() {
        // Limpiar intervalo existente antes de crear uno nuevo
        if (autoplayIntervalBanner !== null) {
            clearInterval(autoplayIntervalBanner);
        }
        
        autoplayIntervalBanner = setInterval(function() {
            showSlideBanner(currentSlideBanner + 1);
        }, 5000); // Cambia cada 6 segundos (más tiempo para evitar cambios rápidos)
    }

    // Función para detener autoplay
    function stopAutoplayBanner() {
        if (autoplayIntervalBanner !== null) {
            clearInterval(autoplayIntervalBanner);
            autoplayIntervalBanner = null;
        }
    }

    // Botón siguiente
    $('.banner-carousel-next').on('click', function() {
        stopAutoplayBanner();
        showSlideBanner(currentSlideBanner + 1);
        startAutoplayBanner();
    });

    // Botón anterior
    $('.banner-carousel-prev').on('click', function() {
        stopAutoplayBanner();
        showSlideBanner(currentSlideBanner - 1);
        startAutoplayBanner();
    });

    // Click en indicadores
    dotsBanner.on('click', function() {
        stopAutoplayBanner();
        const slideIndex = $(this).data('slide');
        showSlideBanner(slideIndex);
        startAutoplayBanner();
    });

    // Pausar autoplay al pasar el mouse sobre el carrusel
    $('.banner-carousel-wrapper').on('mouseenter', function() {
        stopAutoplayBanner();
    });

    // Reanudar autoplay al quitar el mouse
    $('.banner-carousel-wrapper').on('mouseleave', function() {
        startAutoplayBanner();
    });

    // Iniciar autoplay al cargar la página
    if (totalSlidesBanner > 1) {
        startAutoplayBanner();
    }
    
    // Forzar scroll al inicio al cargar la página
    $(window).scrollTop(0);
    $('html, body').scrollTop(0);
});
</script>

<script>
// ======================================= 
// EFECTO PARALLAX EN SECCIÓN ASESORÍA
// =======================================
$(document).ready(function() {
    const parallaxBg = $('.asesoria-parallax-bg');
    const parallaxContainer = $('.asesoria-parallax-container');

    if (parallaxBg.length && parallaxContainer.length) {
        function updateParallax() {
            const scrollTop = $(window).scrollTop();
            const containerOffset = parallaxContainer.offset().top;
            const containerHeight = parallaxContainer.outerHeight();
            const windowHeight = $(window).height();

            // Calcular si el contenedor está visible en el viewport
            if (scrollTop + windowHeight > containerOffset && scrollTop < containerOffset + containerHeight) {
                // Calcular la posición relativa del scroll dentro del contenedor
                const elementTop = containerOffset - scrollTop;
                const elementBottom = elementTop + containerHeight;
                
                // Calcular el porcentaje de visibilidad (0 cuando está arriba, 1 cuando está abajo)
                const scrollPercent = (windowHeight - elementTop) / (windowHeight + containerHeight);
                
                // Aplicar transformación parallax más pronunciada
                // El rango va de -25% a 25% de la altura del contenedor
                const translateY = (scrollPercent - 0.5) * 50;
                parallaxBg.css('transform', 'translateY(' + translateY + '%)');
            }
        }

        // Ejecutar al hacer scroll
        $(window).on('scroll', updateParallax);
        
        // Ejecutar al cargar la página
        updateParallax();
    }
});
</script>

<script>
// ======================================= 
// ANIMACIONES DEL BANNER
// =======================================
$(document).ready(function() {
    // Convertir la función en global para que pueda llamarse desde
    // showSlideBanner (autoplay, dots y botones)
    window.animateBannerContent = function() {
        // Resetear y ocultar inmediatamente los elementos antes de animar
        $('.banner-slide.active .banner-title-animate').css({
            'opacity': '0',
            'transform': 'scale(0.5)',
            'visibility': 'visible',
            'transition': 'none'
        });
        
        $('.banner-slide.active .banner-btn-1, .banner-slide.active .banner-btn-2').css({
            'opacity': '0',
            'transform': 'translateY(50px)',
            'visibility': 'visible',
            'transition': 'none'
        });
        
        // Forzar reflow para asegurar que los estilos se apliquen
        const titleEl = $('.banner-slide.active .banner-title-animate')[0];
        if (titleEl) titleEl.offsetHeight;
        
        // Animar el título: entrada desde el centro con escala
        setTimeout(function() {
            $('.banner-slide.active .banner-title-animate').css({
                'transition': 'all 1s cubic-bezier(0.5, 0, 0, 1)',
                'opacity': '1',
                'transform': 'scale(1)'
            });
        }, 100);
        
        // Animar el primer botón: entrada desde abajo
        setTimeout(function() {
            $('.banner-slide.active .banner-btn-1').css({
                'transition': 'all 0.8s ease-out',
                'opacity': '1',
                'transform': 'translateY(0)'
            });
        }, 1100);
        
        // Animar el segundo botón: entrada desde abajo (después del primero)
        setTimeout(function() {
            $('.banner-slide.active .banner-btn-2').css({
                'transition': 'all 0.8s ease-out',
                'opacity': '1',
                'transform': 'translateY(0)'
            });
        }, 1900);
    }
    
    // Ejecutar animación al cargar la página
    setTimeout(function() {
        if (typeof window.animateBannerContent === 'function') window.animateBannerContent();
    }, 800);
    
    // Re-ejecutar animación cuando cambia el slide
    $('.banner-carousel-next, .banner-carousel-prev, .dot-banner').on('click', function() {
        // Ocultar elementos del slide anterior
        $('.banner-slide .banner-title-animate, .banner-slide .banner-btn-1, .banner-slide .banner-btn-2').css({
            'opacity': '0',
            'visibility': 'hidden',
            'transition': 'none'
        });
        
        setTimeout(function() {
            if (typeof window.animateBannerContent === 'function') window.animateBannerContent();
        }, 200);
    });
});
</script>


