<!-- Estilos específicos de la vista de productos -->
<link rel="preload" as="image" href="<?= base_url('images/banner/3-banners.jpg'); ?>" fetchpriority="high">
<link rel="stylesheet" href="<?= base_url('assets/css/inicio-banner.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/inicio-servicios-productos.css'); ?>">
<!-- Incluir CSS del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_css'); ?>

<!-- Schema.org: Organization -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Importaciones Codiza S.A.",
  "alternateName": "CODIZA",
  "url": "<?= base_url() ?>",
  "logo": "<?= base_url('images/logo/logo-actual.png') ?>",
  "description": "Importadores de productos para la minería, agroindustria, pesquería e industrias en general. Especialistas en fajas transportadoras con más de 20 años de experiencia en Perú.",
  "foundingDate": "2009",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Av. Ramón Cárcamo 565 Int. 131",
    "addressLocality": "Lima",
    "addressRegion": "Lima",
    "postalCode": "15001",
    "addressCountry": "PE"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+51-985-410-410",
    "contactType": "Ventas",
    "email": "codiza@importacionescodiza.com",
    "availableLanguage": "Spanish",
    "areaServed": "PE"
  },
  "sameAs": [
    "<?= base_url() ?>"
  ]
}
</script>

<!-- Schema.org: ItemList para Categorías -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Categorías de Productos Industriales CODIZA",
  "itemListElement": [
    <?php if (isset($categorias) && !empty($categorias)): ?>
      <?php foreach ($categorias as $index => $categoria): ?>
        {
          "@type": "ListItem",
          "position": <?= $index + 1 ?>,
          "name": "<?= htmlspecialchars($categoria->nombre) ?>",
          "url": "<?= base_url('categoria/ver/' . $categoria->id_categoria) ?>"
        }<?= $index < count($categorias) - 1 ? ',' : '' ?>
      <?php endforeach; ?>
    <?php endif; ?>
  ]
}
</script>

<main id="main-content" role="main">

<section class="section-banner">
    <div class="banner-cube">
        <div class="banner-carousel-wrapper">
        <?php
            $banner_buttons = [
                [
                    "text" => "Conócenos",
                    "url" => base_url("nosotros"),
                    "class" => "btn-banner btn-primary-banner banner-btn-1"
                ],
                [
                    "text" => "Contáctanos",
                    "url" => "https://wa.me/51985410410",
                    "class" => "btn-banner btn-secondary-banner banner-btn-2",
                    "title" => "Por Whatsapp"
                ]
            ];

            $slides = [
                [
                    "id" => 0,
                    "image" => base_url("images/banner/3-banners.jpg"),
                    "title" => "Bienvenidos a Importaciones Codiza",
                ],
                [
                    "id" => 1,
                    "image" => base_url("images/banner/3-banners2.jpg"),
                    "title" => "Bienvenidos a Importaciones Codiza",
                ],
                [
                    "id" => 2,
                    "image" => base_url("images/banner/3-banners3.jpg"),
                    "title" => "Bienvenidos a Importaciones Codiza",
                ],
            ];
        ?>
        <div class="banner-carousel-track">
            <?php foreach ($slides as $index => $s): ?>
                <div class="banner-slide <?= $index === 0 ? 'active' : '' ?>" data-slide="<?= htmlspecialchars($s['id'], ENT_QUOTES) ?>" style="background-image: url('<?= htmlspecialchars($s['image'], ENT_QUOTES) ?>');">
                    <div class="banner-overlay"></div>
                    <!-- Imagen accesible (oculta visualmente pero visible para SEO/lectores) -->
                    <img src="<?= htmlspecialchars($s['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($s['title']) ?>" class="visually-hidden" loading="lazy">
                    <div class="banner-content">
                        <h1 class="banner-title-animate"><?= htmlspecialchars($s['title']) ?></h1>
                        <div class="banner-buttons">
                            <?php foreach ($banner_buttons as $btn): ?>
                                <a href="<?= htmlspecialchars($btn['url'], ENT_QUOTES) ?>" class="<?= htmlspecialchars($btn['class']) ?>" <?= isset($btn['title']) ? 'title="'.htmlspecialchars($btn['title'], ENT_QUOTES).'"' : '' ?> target="_blank"><?= htmlspecialchars($btn['text']) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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
            <?php for ($i = 0; $i < count($slides); $i++): ?>
                <span class="dot-banner <?= $i === 0 ? 'active' : '' ?>" data-slide="<?= htmlspecialchars($i, ENT_QUOTES) ?>"></span>
            <?php endfor; ?>
        </div>
        </div>
    </div>
</section>

<section class="section-categorias">
    <div class="container-fluid">
        <h2>Nuestras Categorías</h2>
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
                                                alt="<?= htmlspecialchars($categoria->nombre) ?> - Productos industriales CODIZA" 
                                                title="<?= htmlspecialchars($categoria->nombre) ?>"
                                                width="300" height="300" loading="lazy">
                                        <?php else: ?>
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-image fa-5x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="servicio-overlay"></div>
                                    </div>
                                    <div class="servicio-nombre">
                                        <h3><?= htmlspecialchars($categoria->nombre) ?></h3>
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
        <h2>Nuestros Servicios</h2>
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
                                            <img src="<?= base_url("images/servicios/$servicio->imagen") ?>" 
                                                alt="<?= htmlspecialchars($servicio->nombre) ?> - Servicios CODIZA" 
                                                title="<?= htmlspecialchars($servicio->nombre) ?>"
                                                width="300" height="300" loading="lazy">
                                        <?php else: ?>
                                            <!-- Mostrar un icono centrado si no hay imagen -->
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-image fa-5x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="servicio-overlay"></div>
                                    </div>

                                    <div class="servicio-nombre">
                                        <h3><?= htmlspecialchars($servicio->nombre) ?></h3>
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

</main>
