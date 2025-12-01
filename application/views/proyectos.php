<style>
/* ======================================= */
/* BANNER PROYECTOS CON OVERLAY Y 100VH   */
/* ======================================= */

.banner-proyectos {
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

/* Overlay oscuro sobre la imagen */
.banner-proyectos::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

/* Contenido del banner */
.banner-proyectos-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    padding: 0 20px;
    animation: fadeInUp 1s ease-out;
}

.banner-proyectos-content h1 {
    font-size: 56px;
    font-weight: 900;
    margin-bottom: 20px;
    text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8);
    letter-spacing: 1px;
}

.banner-proyectos-content p {
    font-size: 22px;
    font-weight: 400;
    text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ======================================= */
/* SECCIÓN PROYECTOS REALIZADOS           */
/* ======================================= */

.section-proyectos {
    padding: 100px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    overflow: hidden;
}

.section-proyectos::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(0, 150, 63, 0.05) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 0;
}

.section-proyectos .container {
    position: relative;
    z-index: 1;
}

.section-proyectos h2 {
    font-size: 42px;
    font-weight: 900;
    color: #1a4d2e;
    text-align: center;
    margin-bottom: 60px;
    position: relative;
    padding-bottom: 20px;
}

.section-proyectos h2::after {
    content: '';
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 0;
    width: 80px;
    height: 5px;
    background: linear-gradient(90deg, #00963f 0%, #1a4d2e 100%);
    border-radius: 10px;
}

/* Grid de proyectos */
.proyectos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

/* Tarjeta de proyecto */
.proyecto-card {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    background: white;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.4s ease;
    cursor: pointer;
    height: 400px;
}

.proyecto-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}

/* Imagen del proyecto */
.proyecto-imagen {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.proyecto-imagen img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.proyecto-card:hover .proyecto-imagen img {
    transform: scale(1.15);
}

/* Overlay oscuro */
.proyecto-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    transition: background 0.4s ease;
}

.proyecto-card:hover .proyecto-overlay {
    background: rgba(0, 0, 0, 0.6);
}

/* Contenido del proyecto */
.proyecto-content {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 30px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.7), transparent);
    color: white;
    z-index: 2;
    transform: translateY(0);
    transition: all 0.4s ease;
}

.proyecto-card:hover .proyecto-content {
    padding-bottom: 40px;
}

.proyecto-content h4 {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #61CE70;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.proyecto-content h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 12px;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    line-height: 1.3;
}

.proyecto-content p {
    font-size: 14px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    opacity: 0;
    max-height: 0;
    overflow: hidden;
    transform: translateY(10px);
    transition: all 0.4s ease;
}

.proyecto-card:hover .proyecto-content p {
    opacity: 1;
    max-height: 200px;
    transform: translateY(0);
    margin-top: 10px;
}

/* Icono decorativo */
.proyecto-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: rgba(0, 150, 63, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    z-index: 3;
    opacity: 0;
    transform: scale(0);
    transition: all 0.4s ease;
}

.proyecto-card:hover .proyecto-icon {
    opacity: 1;
    transform: scale(1);
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

/* ======================================= */
/* RESPONSIVE                              */
/* ======================================= */

@media (max-width: 992px) {
    .banner-proyectos {
        height: 70vh;
        min-height: 500px;
        background-attachment: scroll;
    }

    .banner-proyectos-content h1 {
        font-size: 42px;
    }

    .banner-proyectos-content p {
        font-size: 18px;
    }

    .section-proyectos h2 {
        font-size: 36px;
    }

    .proyectos-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    .proyecto-card {
        height: 350px;
    }

    .section-proyectos {
        padding: 70px 0;
    }
}

@media (max-width: 768px) {
    .banner-proyectos {
        height: 60vh;
        min-height: 450px;
    }

    .banner-proyectos-content h1 {
        font-size: 36px;
    }

    .banner-proyectos-content p {
        font-size: 16px;
    }

    .section-proyectos h2 {
        font-size: 32px;
    }

    .proyectos-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .proyecto-card {
        height: 320px;
    }

    .section-proyectos {
        padding: 50px 0;
    }

    .proyecto-content h3 {
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    .banner-proyectos {
        height: 50vh;
        min-height: 400px;
    }

    .banner-proyectos-content h1 {
        font-size: 28px;
    }

    .banner-proyectos-content p {
        font-size: 15px;
    }

    .section-proyectos h2 {
        font-size: 28px;
        margin-bottom: 40px;
    }

    .section-proyectos {
        padding: 40px 0;
    }

    .proyecto-content {
        padding: 20px;
    }

    .proyecto-content h4 {
        font-size: 12px;
    }

    .proyecto-content h3 {
        font-size: 18px;
    }

    .proyecto-content p {
        font-size: 13px;
    }
}
</style>

<!-- Banner Proyectos -->
<div class="banner-proyectos">
    <div class="banner-proyectos-content">
        <h1>Nuestros Proyectos</h1>
        <p>Conoce los proyectos exitosos que hemos realizado para nuestros clientes</p>
    </div>
</div>

<!-- Sección Proyectos Realizados -->
<section class="section-proyectos">
    <div class="container">
        <h2>Proyectos Realizados</h2>
        
        <?php
            $proyectos = [
                [
                    "imagen" => "foto1.jpg",
                    "icono" => "fas fa-industry",
                    "titulo_small" => "Faja modular Intralox",
                    "titulo" => "Industria en General",
                    "descripcion" => "En la Industria En General brindamos soluciones a la Industria Envasadora, Plásticos, Cartoneras, Maderera, Textil, Lavanderías y muchas otras aplicaciones industriales."
                ],
                [
                    "imagen" => "foto1.jpg",
                    "icono" => "fas fa-gem",
                    "titulo_small" => "Faja modular Intralox",
                    "titulo" => "Minería, Agregados y Cerámicos",
                    "descripcion" => "Nuestras fajas transportadoras se usan principalmente para transportar materiales granulados, como en la industria minera, cerámicos, agregados, agrícola y muchas otras."
                ],
                [
                    "imagen" => "foto1.jpg",
                    "icono" => "fas fa-fish",
                    "titulo_small" => "Faja modular Intralox",
                    "titulo" => "Agroindustria y Pesquería",
                    "descripcion" => "En Viru S.A. estamos comprometidos con brindar el mejor producto y servicio de garantía y buena calidad..."
                ],
                [
                    "imagen" => "foto1.jpg",
                    "icono" => "fas fa-cog",
                    "titulo_small" => "Faja modular Intralox",
                    "titulo" => "Molinos, Agropecuario y Avícola",
                    "descripcion" => "En el Terminal Internacional del Sur (TISUR) – Arequipa. Solucionamos el desmontaje y montaje..."
                ]
            ];
            ?>

            <div class="proyectos-grid">
                <?php foreach ($proyectos as $p): ?>
                    <div class="proyecto-card">
                        <div class="proyecto-imagen">
                            <img src="<?= base_url("images/nosotros/".$p['imagen']) ?>" alt="<?= $p['titulo'] ?>">
                            <div class="proyecto-overlay"></div>
                            <div class="proyecto-icon">
                                <i class="<?= $p['icono'] ?>"></i>
                            </div>
                        </div>

                        <div class="proyecto-content">
                            <h4><?= $p['titulo_small'] ?></h4>
                            <h3><?= $p['titulo'] ?></h3>
                            <p><?= $p['descripcion'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
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
                $(entry.target).css({
                    'opacity': '1',
                    'transform': 'translateY(0)'
                });
            }
        });
    }, observerOptions);

    // Observar tarjetas de proyectos
    $('.proyecto-card').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateY(30px)',
            'transition': 'all 0.6s ease ' + (index * 0.1) + 's'
        });
        observer.observe(this);
    });

    // Parallax suave en el banner
    $(window).on('scroll', function() {
        const scrolled = $(window).scrollTop();
        $('.banner-proyectos').css('background-position', 'center ' + (scrolled * 0.5) + 'px');
    });
});
</script>

<!-- Incluir JavaScript del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_js'); ?>
