<!-- Estilos específicos de la vista de nosotros -->
<link rel="stylesheet" href="<?= css_url('assets/css/nosotros.css'); ?>">

<!-- Breadcrumbs -->
<?php $this->load->view('partials/breadcrumbs'); ?>

<!-- Schema.org Markup para Organización -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Importaciones Codiza S.A.",
  "alternateName": "CODIZA",
  "url": "<?= base_url() ?>",
  "logo": "<?= img_url('images/logo/logo-actual.png') ?>",
  "description": "Importadores de productos para la minería, agroindustria, pesquería e industrias en general. Especialistas en fajas transportadoras con más de 20 años de experiencia.",
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
    "email": "elsa.calero@codiza.com.pe",
    "availableLanguage": "Spanish",
    "areaServed": "PE"
  },
  "sameAs": [
    "<?= base_url() ?>"
  ],
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "150"
  }
}
</script>

<main id="main-content" role="main">

<!-- Banner Nosotros -->
<div class="banner-nosotros" style="background-image: url('<?= img_url("images/nosotros/banner-ph-about-1.jpg") ?>');">
    <div class="banner-nosotros-content">
        <h1>Sobre Nosotros</h1>
        <p>Conoce más sobre nuestra empresa y compromiso con la calidad</p>
    </div>
</div>

<!-- Sección Nosotros -->
<section class="section-nosotros">
    <div class="container">
        <div class="row nosotros-row">
            <!-- Columna de texto a la izquierda -->
            <div class="col-lg-6 nosotros-text-col">
                <h2>ALTA INGENIERÍA</h2>
                <p>
                    A lo largo del tiempo venimos importando de los cinco continentes y
                    exportando a toda Sudamérica. Representamos a las mejores marcas en:
                    <strong>bandas transportadoras, cangilones, grapas flexco, fajas sanitarias,
                    empaquetaduras y cortinas frigoríficas</strong>. La calidad de nuestros
                    productos y servicios industriales nos consolidan como líderes en el Perú.
                </p>

                <p>
                    Estamos preparados para ir a la vanguardia de los cambios constantes que las
                    industrias requieren. Contamos con una vasta experiencia adquirida a lo largo
                    de décadas, realizando trabajos de alta ingeniería con los mejores
                    profesionales y técnicos especializados, cumpliendo con máxima eficiencia
                    para que las industrias mantengan su producción en funcionamiento continuo.
                </p>

            </div>

            <!-- Columna de imagen a la derecha -->
            <div class="col-lg-6 nosotros-image-col">
                <div class="nosotros-image-wrapper">
                    <img src="<?= img_url('images/nosotros/nosotros-codiza.jpg') ?>" 
                         alt="Importaciones Codiza - Empresa líder en productos industriales en Perú" 
                         title="CODIZA S.A. - Más de 20 años de experiencia"
                         width="600" height="400" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Incluir CSS del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_css'); ?>

<!-- Incluir componente de clientes -->
<?php $this->load->view('partials/clientes_carousel', ['clientes' => $clientes]); ?>

<!-- Incluir JavaScript del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_js'); ?>

<script src="<?= js_url('assets/js/nosotros.js'); ?>"></script>

</main>
