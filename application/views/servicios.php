<style>
/* ======================================= */
/* BANNER SERVICIOS CON OVERLAY Y 100VH   */
/* ======================================= */

.banner-servicios {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    background-image: url('<?= base_url("images/banner/3-banners.jpg") ?>');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.banner-servicios::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.banner-servicios-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    padding: 0 20px;
    animation: fadeInUp 1s ease-out;
}

.banner-servicios-content h1 {
    font-size: 56px;
    font-weight: 900;
    margin-bottom: 20px;
    text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8);
    letter-spacing: 1px;
}

.banner-servicios-content p {
    font-size: 22px;
    font-weight: 400;
    text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ======================================= */
/* SECCIÓN SERVICIOS - DISEÑO INTERCALADO */
/* ======================================= */

.section-servicios {
    padding: 0;
    background: #fff;
}

.servicio-item {
    display: flex;
    align-items: center;
    min-height: 500px;
    position: relative;
    overflow: hidden;
}

.servicio-item:nth-child(odd) {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.servicio-item:nth-child(even) {
    background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
}

/* Contenedor principal */
.servicio-container {
    display: flex;
    align-items: center;
    gap: 60px;
    padding: 80px 0;
    position: relative;
    z-index: 1;
}

/* Texto del servicio */
.servicio-texto {
    flex: 1;
    animation: fadeInLeft 1s ease-out;
}

.servicio-item:nth-child(even) .servicio-container {
    flex-direction: row-reverse;
}

.servicio-item:nth-child(even) .servicio-texto {
    animation: fadeInRight 1s ease-out;
}

.servicio-texto h3 {
    font-size: 36px;
    font-weight: 900;
    color: #1a4d2e;
    margin-bottom: 25px;
    line-height: 1.2;
    position: relative;
    padding-bottom: 20px;
}

.servicio-texto h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 80px;
    height: 5px;
    background: linear-gradient(90deg, #00963f 0%, #1a4d2e 100%);
    border-radius: 10px;
}

.servicio-item:nth-child(even) .servicio-texto h3::after {
    left: auto;
    right: 0;
}

.servicio-texto p {
    font-size: 18px;
    line-height: 1.9;
    color: #495057;
    margin-bottom: 20px;
}

.servicio-icon-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(0, 150, 63, 0.1);
    padding: 10px 20px;
    border-radius: 50px;
    margin-bottom: 20px;
}

.servicio-icon-badge i {
    color: #00963f;
    font-size: 24px;
}

.servicio-icon-badge span {
    color: #00963f;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
}

/* Imagen del servicio */
.servicio-imagen-wrapper {
    flex: 1;
    position: relative;
}

.servicio-imagen-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    transition: all 0.4s ease;
}

.servicio-imagen-container:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
}

.servicio-imagen-container img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}

.servicio-imagen-container:hover img {
    transform: scale(1.05);
}

/* Decoración de fondo */
.servicio-item::before {
    content: '';
    position: absolute;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(0, 150, 63, 0.05) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 0;
}

.servicio-item:nth-child(odd)::before {
    top: -100px;
    right: -100px;
}

.servicio-item:nth-child(even)::before {
    bottom: -100px;
    left: -100px;
}

/* ======================================= */
/* ANIMACIONES                             */
/* ======================================= */

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

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-40px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(40px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* ======================================= */
/* RESPONSIVE                              */
/* ======================================= */

@media (max-width: 992px) {
    .banner-servicios {
        height: 70vh;
        min-height: 500px;
        background-attachment: scroll;
    }

    .banner-servicios-content h1 {
        font-size: 42px;
    }

    .banner-servicios-content p {
        font-size: 18px;
    }

    .servicio-item {
        min-height: auto;
    }

    .servicio-container {
        flex-direction: column !important;
        gap: 40px;
        padding: 60px 0;
    }

    .servicio-item:nth-child(even) .servicio-container {
        flex-direction: column !important;
    }

    .servicio-texto h3 {
        font-size: 32px;
        text-align: center;
    }

    .servicio-texto h3::after {
        left: 50% !important;
        right: auto !important;
        transform: translateX(-50%);
    }

    .servicio-texto p {
        text-align: center;
    }

    .servicio-icon-badge {
        margin: 0 auto 20px;
    }

    .servicio-imagen-container img {
        height: 350px;
    }
}

@media (max-width: 768px) {
    .banner-servicios {
        height: 60vh;
        min-height: 450px;
    }

    .banner-servicios-content h1 {
        font-size: 36px;
    }

    .banner-servicios-content p {
        font-size: 16px;
    }

    .servicio-container {
        padding: 50px 0;
    }

    .servicio-texto h3 {
        font-size: 28px;
    }

    .servicio-texto p {
        font-size: 16px;
    }

    .servicio-imagen-container img {
        height: 300px;
    }
}

@media (max-width: 576px) {
    .banner-servicios {
        height: 50vh;
        min-height: 400px;
    }

    .banner-servicios-content h1 {
        font-size: 28px;
    }

    .banner-servicios-content p {
        font-size: 15px;
    }

    .servicio-container {
        padding: 40px 0;
    }

    .servicio-texto h3 {
        font-size: 24px;
    }

    .servicio-texto p {
        font-size: 15px;
    }

    .servicio-imagen-container img {
        height: 250px;
    }
}
</style>

<!-- Banner Servicios -->
<div class="banner-servicios">
    <div class="banner-servicios-content">
        <h1>Nuestros Servicios</h1>
        <p>Soluciones integrales para la industria con la más alta calidad y profesionalismo</p>
    </div>
</div>

<?php
    $servicios = 
    [
        [
            "icono" => "fas fa-fire",
            "badge" => "Vulcanizado",
            "titulo" => "Vulcanizado de Faja para la Industria",
            "descripcion" => "Ofrecemos servicios especializados de vulcanizado de fajas transportadoras para la industria...",
            "imagen" => "Servicio-en-fajas-transportadoras.jpg"
        ],
        [
            "icono" => "fas fa-tools",
            "badge" => "Transporte",
            "titulo" => "Vulcanizado de Faja Transportadora",
            "descripcion" => "Servicio profesional de vulcanizado en frío y caliente para fajas transportadoras de todo tipo...",
            "imagen" => "Servicio-en-fajas-transportadoras2.jpg"
        ],
        [
            "icono" => "fas fa-arrows-alt-v",
            "badge" => "Elevación",
            "titulo" => "Montaje de Los Elevadores",
            "descripcion" => "Instalación y montaje completo de elevadores de cangilones para la industria...",
            "imagen" => "servicios-en-fajas-transportadoras7.jpg"
        ],
        [
            "icono" => "fas fa-layer-group",
            "badge" => "Perfil",
            "titulo" => "Servicio de Faja con Perfil y Barreras",
            "descripcion" => "Suministro e instalación de fajas transportadoras con perfiles transversales y barreras laterales...",
            "imagen" => "servicios-en-fajas-transportadoras5-768x432.jpg"
        ],
        [
            "icono" => "fas fa-bezier-curve",
            "badge" => "Modular",
            "titulo" => "Servicio de Faja Curva Modular",
            "descripcion" => "Sistemas de transporte con fajas curvas modulares que permiten cambios de dirección...",
            "imagen" => "servicios-en-fajas-transportadoras6.jpg"
        ],
        [
            "icono" => "fas fa-sort-amount-down",
            "badge" => "Selección",
            "titulo" => "Servicio de Faja Seleccionadora",
            "descripcion" => "Fajas transportadoras especializadas para procesos de selección y clasificación de productos...",
            "imagen" => "SERVICIO-DE-FAJA-TIPO-CURVA.jpg"
        ],
        [
            "icono" => "fas fa-ruler-combined",
            "badge" => "Calibración",
            "titulo" => "Servicio de Faja Calibradora",
            "descripcion" => "Sistemas de calibración y clasificación por tamaño para productos agrícolas e industriales...",
            "imagen" => "SERVICIO-DE-FAJA-CON-AGUJEROS.jpg"
        ],
        [
            "icono" => "fas fa-wave-square",
            "badge" => "Tipo Onda",
            "titulo" => "Servicio de Faja Tipo Onda",
            "descripcion" => "Fajas transportadoras de perfil ondulado diseñadas para transporte de productos delicados...",
            "imagen" => "servicios-en-fajas-transportadoras4.jpg"
        ],
        [
            "icono" => "fas fa-conveyor-belt",
            "badge" => "General",
            "titulo" => "Servicio de Faja",
            "descripcion" => "Servicio integral de mantenimiento, reparación e instalación de fajas transportadoras...",
            "imagen" => "servicios-en-fajas-transportadoras3.jpg"
        ],
        [
            "icono" => "fas fa-grip-lines",
            "badge" => "Perfiles",
            "titulo" => "Servicio de Perfiles",
            "descripcion" => "Fabricación e instalación de perfiles transversales para fajas transportadoras...",
            "imagen" => "servicios-en-fajas-transportadoras2.jpg"
        ],
        [
            "icono" => "fas fa-angle-up",
            "badge" => "Inclinación",
            "titulo" => "Servicio de Faja con Inclinación",
            "descripcion" => "Sistemas de transporte con fajas inclinadas para elevación de materiales...",
            "imagen" => "servicios-en-fajas-transportadoras-768x576.jpg"
        ]
    ];
?>

<!-- Sección Servicios -->
<section class="section-servicios">
    <?php foreach ($servicios as $s): ?>
        <div class="servicio-item">
            <div class="container">
                <div class="servicio-container">

                    <!-- Texto -->
                    <div class="servicio-texto">
                        <div class="servicio-icon-badge">
                            <i class="<?= $s['icono'] ?>"></i>
                            <span><?= $s['badge'] ?></span>
                        </div>

                        <h3><?= $s['titulo'] ?></h3>

                        <p><?= $s['descripcion'] ?></p>
                    </div>

                    <!-- Imagen -->
                    <div class="servicio-imagen-wrapper">
                        <div class="servicio-imagen-container">
                            <img src="<?= base_url('images/servicios/' . $s['imagen']) ?>" 
                                alt="<?= $s['titulo'] ?>">
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

<script>
// ===============================================
// ANIMACIONES AL HACER SCROLL - JQUERY
// ===============================================
$(document).ready(function() {
    // Intersection Observer para animaciones al hacer scroll
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                $(entry.target).addClass('animate-visible');
            }
        });
    }, observerOptions);

    // Observar items de servicios
    $('.servicio-item').each(function() {
        observer.observe(this);
    });

    // Parallax suave en el banner
    $(window).on('scroll', function() {
        const scrolled = $(window).scrollTop();
        $('.banner-servicios').css('background-position', 'center ' + (scrolled * 0.5) + 'px');
    });
});
</script>

<!-- Incluir JavaScript del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_js'); ?>
