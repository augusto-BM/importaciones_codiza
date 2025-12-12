<link rel="stylesheet" href="<?= css_url('assets/css/servicios.css'); ?>">
<!-- Banner Servicios -->
<div class="banner-servicios" style="background-image: url('<?= img_url("images/banner/3-banners.jpg") ?>');">
    <div class="banner-servicios-content">
        <h1>Nuestros Servicios</h1>
        <p>Soluciones integrales para la industria con la más alta calidad y profesionalismo</p>
    </div>
</div>

<section class="section-servicios">
    <?php foreach ($servicios as $s): ?>
        <div class="servicio-item">
            <div class="container">
                <div class="servicio-container">

                    <!-- Texto -->
                    <div class="servicio-texto">

                        <div class="servicio-icon-badge">
                            <i class="<?= $s->icono ?>"></i>
                            <span><?= $s->badge ?></span>
                        </div>
                        <h3><?= $s->nombre ?></h3>
                        <p><?= $s->descripcion ?></p>
                    </div>

                    <!-- Imagen -->
                    <div class="servicio-imagen-wrapper">
                        <div class="servicio-imagen-container">
                            <img 
                                src="<?= base_url('images/servicios/' . $s->imagen) ?>" 
                                alt="<?= $s->nombre ?>">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<!-- Incluir CSS del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_css'); ?>

<!-- Incluir componente de clientes -->
<?php $this->load->view('partials/clientes_carousel', ['clientes' => $clientes]); ?>

<script src="<?= js_url('assets/js/servicios.js'); ?>"></script>

<!-- Incluir JavaScript del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_js'); ?>
