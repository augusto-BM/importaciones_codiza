<link rel="stylesheet" href="<?= css_url('assets/css/servicios.css'); ?>">

<!-- Breadcrumbs -->
<?php $this->load->view('partials/breadcrumbs'); ?>

<!-- Schema.org: Service -->
<?php if (!empty($servicios)): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Servicios Industriales - Importaciones Codiza",
  "numberOfItems": <?= count($servicios) ?>,
  "itemListElement": [
    <?php foreach ($servicios as $index => $s): ?>
    {
      "@type": "ListItem",
      "position": <?= $index + 1 ?>,
      "item": {
        "@type": "Service",
        "serviceType": "<?= htmlspecialchars($s->nombre, ENT_QUOTES) ?>",
        "description": "<?= htmlspecialchars(strip_tags($s->descripcion), ENT_QUOTES) ?>",
        "provider": {
          "@type": "Organization",
          "name": "Importaciones Codiza S.A.",
          "url": "<?= base_url() ?>"
        },
        "areaServed": {
          "@type": "Country",
          "name": "Perú"
        }
      }
    }<?= $index < count($servicios) - 1 ? ',' : '' ?>
    <?php endforeach; ?>
  ]
}
</script>
<?php endif; ?>

<!-- Banner Servicios -->
<div class="banner-servicios" style="background-image: url('<?= img_url("images/banner/3-banners.jpg") ?>');">
    <div class="banner-servicios-content">
        <h1>Nuestros Servicios de Vulcanizado e Instalación</h1>
        <p>Soluciones integrales para la industria con la más alta calidad y profesionalismo</p>
    </div>
</div>

<section class="section-servicios">
    <?php foreach ($servicios as $s): ?>
        <article class="servicio-item" itemscope itemtype="https://schema.org/Service">
            <div class="container">
                <div class="servicio-container">

                    <!-- Texto -->
                    <div class="servicio-texto">

                        <div class="servicio-icon-badge">
                            <i class="<?= $s->icono ?>"></i>
                            <span><?= $s->badge ?></span>
                        </div>
                        <h2 itemprop="name"><?= htmlspecialchars($s->nombre) ?></h2>
                        <p itemprop="description"><?= $s->descripcion ?></p>
                        <meta itemprop="serviceType" content="<?= htmlspecialchars($s->nombre) ?>">
                        <div itemprop="provider" itemscope itemtype="https://schema.org/Organization">
                            <meta itemprop="name" content="Importaciones Codiza S.A.">
                        </div>
                    </div>

                    <!-- Imagen -->
                    <div class="servicio-imagen-wrapper">
                        <div class="servicio-imagen-container">
                            <img 
                                src="<?= base_url('images/servicios/' . $s->imagen) ?>" 
                                alt="<?= htmlspecialchars($s->nombre) ?> - Servicio Industrial Codiza Perú"
                                title="<?= htmlspecialchars($s->nombre) ?>"
                                loading="lazy"
                                itemprop="image">
                        </div>
                    </div>

                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<!-- Incluir CSS del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_css'); ?>

<!-- Incluir componente de clientes -->
<?php $this->load->view('partials/clientes_carousel', ['clientes' => $clientes]); ?>

<script src="<?= js_url('assets/js/servicios.js'); ?>"></script>

<!-- Incluir JavaScript del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_js'); ?>
