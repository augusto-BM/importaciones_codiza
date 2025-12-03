<link rel="stylesheet" href="<?= base_url('assets/css/nosotros.css'); ?>">

<!-- Schema.org Markup para Organización -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Importaciones Codiza S.A.",
  "alternateName": "CODIZA",
  "url": "<?= base_url() ?>",
  "logo": "<?= base_url('images/logo/logo-actual.png') ?>",
  "description": "Importadores de productos para la minería, agroindustria, pesquería e industrias en general. Especialistas en fajas transportadoras con más de 20 años de experiencia.",
  "foundingDate": "2009",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Av. Ramón Cárcamo 565 Int. 131",
    "addressLocality": "Lima",
    "addressCountry": "PE"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+51-985-410-410",
    "contactType": "Ventas",
    "email": "codiza@importacionescodiza.com",
    "availableLanguage": "Spanish"
  },
  "sameAs": [
    "<?= base_url() ?>"
  ]
}
</script>

<!-- Banner Nosotros -->
<div class="banner-nosotros" style="background-image: url('<?= base_url("images/nosotros/banner-ph-about-1.jpg") ?>');">
    <div class="banner-nosotros-content">
        <h1>Sobre Nosotros - Importaciones Codiza</h1>
        <p>Conoce más sobre nuestra empresa y compromiso con la calidad</p>
    </div>
</div>

<!-- Sección Nosotros -->
<section class="section-nosotros">
    <div class="container">
        <div class="row nosotros-row">
            <!-- Columna de texto a la izquierda -->
            <div class="col-lg-6 nosotros-text-col">
                <h2><?= date("Y") - 2009; ?> años de soluciones en todo el Perú</h2>
                <h3>Nuestra historia</h3>
                <p>
                    CODIZA S.A. Importadores de Productos para la Minería, Agroindustria, Pesquería e Industrias en general. Contamos con mas de 20 años de experiencia con la mejor asesoría para el manejo de nuestros productos en la línea de Fajas Transportadoras, Cangilones para Elevadores de Molinos, Cortinas de PVC, Empaquetaduras y Anexos dirigido a la industria en general.
                </p>
                <p style="margin-bottom: 0; font-weight: bold;">Cirilo Matos García</p>
                <p style="font-style: italic;">Gerente General</p>
            </div>

            <!-- Columna de imagen a la derecha -->
            <div class="col-lg-6 nosotros-image-col">
                <div class="nosotros-image-wrapper">
                    <img src="<?= base_url('images/nosotros/nosotros-codiza.jpg') ?>" 
                         alt="Importaciones Codiza - Empresa líder en productos industriales en Perú" 
                         title="CODIZA S.A. - Más de 20 años de experiencia">
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

<script src="<?= base_url('assets/js/nosotros.js'); ?>"></script>

