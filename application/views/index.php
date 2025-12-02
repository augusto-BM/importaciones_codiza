<!-- Estilos específicos de la vista de productos -->
<link rel="stylesheet" href="<?= base_url('assets/css/inicio-banner.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/inicio-servicios-productos.css'); ?>">
<!-- Incluir CSS del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_css'); ?>


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
        <div class="asesoria-parallax-bg" style="background-image: url('<?= base_url("images/banner/3-banners4.jpg") ?>');"></div>
        <div class="asesoria-content">
            <h2>Asesoría Técnica, Ventas y Proyectos</h2>
            <p>En CODIZA S.A., ofrecemos soluciones confiables para la industria. Con nuestra experiencia, atendemos sus necesidades con soluciones industriales prácticas, diseñamos e instalamos fajas y accesorios industriales que mejoran el rendimiento y eficiencia de sus operaciones.</p>
        </div>
    </div>
</section>



<!-- Incluir componente de clientes -->
<?php $this->load->view('partials/clientes_carousel', ['clientes' => $clientes]); ?>

<script src="<?= base_url('assets/js/inicio-banner.js'); ?>"></script>
<script src="<?= base_url('assets/js/inicio-servicios-productos.js'); ?>"></script>

<!-- Incluir JavaScript del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_js'); ?>




