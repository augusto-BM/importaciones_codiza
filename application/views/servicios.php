<style>
/* ======================================= */
/* BANNER SERVICIOS CON OVERLAY Y 100VH   */
/* ======================================= */

.banner-servicios {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    background-image: url('<?= base_url("images/nosotros/nosotros.png") ?>');
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

<!-- Sección Servicios -->
<section class="section-servicios">
    <!-- Servicio 1: Vulcanizado de Faja para la Industria -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-fire"></i>
                        <span>Vulcanizado</span>
                    </div>
                    <h3>Vulcanizado de Faja para la Industria</h3>
                    <p>
                        Ofrecemos servicios especializados de vulcanizado de fajas transportadoras para la industria, 
                        garantizando uniones resistentes y duraderas que maximizan la vida útil de sus equipos y 
                        optimizan los procesos productivos de su empresa.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Vulcanizado de Faja para la Industria">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 2: Vulcanizado de Faja Transportadora -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-tools"></i>
                        <span>Transporte</span>
                    </div>
                    <h3>Vulcanizado de Faja Transportadora</h3>
                    <p>
                        Servicio profesional de vulcanizado en frío y caliente para fajas transportadoras de todo tipo. 
                        Nuestro equipo técnico especializado realiza empalmes precisos y confiables, asegurando 
                        la continuidad operativa de sus sistemas de transporte de materiales.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Vulcanizado de Faja Transportadora">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 3: Montaje de Los Elevadores -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-arrows-alt-v"></i>
                        <span>Elevación</span>
                    </div>
                    <h3>Montaje de Los Elevadores</h3>
                    <p>
                        Instalación y montaje completo de elevadores de cangilones para la industria. Contamos con 
                        personal técnico calificado para realizar el ensamblaje, alineación y puesta en marcha de 
                        sistemas de elevación, cumpliendo con los más altos estándares de seguridad y calidad.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Montaje de Los Elevadores">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 4: Servicio de Faja con Perfil y Barreras -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-layer-group"></i>
                        <span>Perfil</span>
                    </div>
                    <h3>Servicio de Faja con Perfil y Barreras</h3>
                    <p>
                        Suministro e instalación de fajas transportadoras con perfiles transversales y barreras laterales. 
                        Ideales para transporte de materiales en inclinación, evitando el retroceso y derrame de productos. 
                        Soluciones personalizadas según las necesidades específicas de cada cliente.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Servicio de Faja con Perfil y Barreras">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 5: Servicio de Faja Curva Modular -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-bezier-curve"></i>
                        <span>Modular</span>
                    </div>
                    <h3>Servicio de Faja Curva Modular</h3>
                    <p>
                        Sistemas de transporte con fajas curvas modulares que permiten cambios de dirección sin 
                        necesidad de transferencias. Optimizan el espacio en planta y mejoran el flujo de producción. 
                        Disponibles en diferentes radios de curvatura y configuraciones.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Servicio de Faja Curva Modular">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 6: Servicio de Faja Seleccionadora -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-sort-amount-down"></i>
                        <span>Selección</span>
                    </div>
                    <h3>Servicio de Faja Seleccionadora</h3>
                    <p>
                        Fajas transportadoras especializadas para procesos de selección y clasificación de productos. 
                        Diseñadas para facilitar la inspección visual y separación manual o automatizada de materiales, 
                        con velocidad ajustable y ergonomía optimizada para los operadores.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Servicio de Faja Seleccionadora">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 7: Servicio de Faja Calibradora -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-ruler-combined"></i>
                        <span>Calibración</span>
                    </div>
                    <h3>Servicio de Faja Calibradora</h3>
                    <p>
                        Sistemas de calibración y clasificación por tamaño para productos agrícolas e industriales. 
                        Permiten la separación automática de productos según dimensiones específicas, mejorando 
                        la eficiencia en los procesos de selección y empaque.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Servicio de Faja Calibradora">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 8: Servicio de Faja Tipo Onda -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-wave-square"></i>
                        <span>Tipo Onda</span>
                    </div>
                    <h3>Servicio de Faja Tipo Onda</h3>
                    <p>
                        Fajas transportadoras de perfil ondulado diseñadas para transporte de productos delicados 
                        y materiales que requieren un manejo suave. La forma ondulada proporciona mayor agarre 
                        y previene el deslizamiento de los productos durante el transporte.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Servicio de Faja Tipo Onda">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 9: Servicio de Faja -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-conveyor-belt"></i>
                        <span>General</span>
                    </div>
                    <h3>Servicio de Faja</h3>
                    <p>
                        Servicio integral de mantenimiento, reparación e instalación de fajas transportadoras para 
                        todo tipo de industria. Ofrecemos asesoría técnica, suministro de repuestos originales y 
                        atención personalizada para garantizar el óptimo funcionamiento de sus sistemas.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Servicio de Faja">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 10: Servicio de Perfiles -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-grip-lines"></i>
                        <span>Perfiles</span>
                    </div>
                    <h3>Servicio de Perfiles</h3>
                    <p>
                        Fabricación e instalación de perfiles transversales para fajas transportadoras. Aumentan 
                        la capacidad de carga y mejoran el agarre en transportes inclinados. Disponibles en diversos 
                        materiales y configuraciones según la aplicación específica.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Servicio de Perfiles">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicio 11: Servicio de Faja con Inclinación -->
    <div class="servicio-item">
        <div class="container">
            <div class="servicio-container">
                <div class="servicio-texto">
                    <div class="servicio-icon-badge">
                        <i class="fas fa-angle-up"></i>
                        <span>Inclinación</span>
                    </div>
                    <h3>Servicio de Faja con Inclinación</h3>
                    <p>
                        Sistemas de transporte con fajas inclinadas para elevación de materiales entre diferentes 
                        niveles. Equipadas con perfiles y barreras para prevenir el retroceso de productos. 
                        Soluciones eficientes que optimizan el espacio y reducen costos operativos.
                    </p>
                </div>
                <div class="servicio-imagen-wrapper">
                    <div class="servicio-imagen-container">
                        <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Servicio de Faja con Inclinación">
                    </div>
                </div>
            </div>
        </div>
    </div>
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
