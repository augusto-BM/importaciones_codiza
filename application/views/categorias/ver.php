<link rel="stylesheet" href="<?= css_url('assets/css/ver.css'); ?>">

<?php
// Variables para breadcrumbs
$categoria_nombre = htmlspecialchars($categoria->categoria_nombre);
$categoria_id = $categoria->id_categoria;
?>

<!-- Breadcrumbs -->
<?php $this->load->view('partials/breadcrumbs'); ?>

<!-- Schema.org: ItemList de Productos -->
<?php if (!empty($productos)): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "<?= $categoria_nombre ?> - Productos Disponibles",
  "numberOfItems": <?= count($productos) ?>,
  "itemListElement": [
    <?php foreach ($productos as $index => $producto): ?>
    {
      "@type": "ListItem",
      "position": <?= $index + 1 ?>,
      "item": {
        "@type": "Product",
        "name": "<?= htmlspecialchars($producto->nombre, ENT_QUOTES) ?>",
        "image": "<?= !empty($producto->imagen1) ? img_url('images/productos/' . $producto->imagen1) : '' ?>",
        "description": "<?= htmlspecialchars(strip_tags(substr($producto->descripcion ?? '', 0, 200)), ENT_QUOTES) ?>",
        "brand": {
          "@type": "Brand",
          "name": "Importaciones Codiza"
        },
        "offers": {
          "@type": "Offer",
          "availability": "https://schema.org/InStock",
          "priceCurrency": "PEN",
          "url": "<?= base_url('productos/detalle/' . $producto->id_producto) ?>"
        }
      }
    }<?= $index < count($productos) - 1 ? ',' : '' ?>
    <?php endforeach; ?>
  ]
}
</script>
<?php endif; ?>

<!-- Header de la categoría -->
<section class="category-header">
    <div class="category-parallax-bg"
        <?php if (!empty($categoria->imagen)): ?>
            style="background-image: url('<?= img_url("images/categorias/{$categoria->imagen}"); ?>');"
        <?php endif; ?>
    >
        <?php if (empty($categoria->imagen)): ?>
            <div class="no-image-placeholder" style="background: rgba(0, 0, 0, 0.5);">
                <i class="fas fa-image fa-5x text-muted"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="category-content">
        <div class="container">
            <div class="text-center title-wrapper">
                <a href="<?= base_url('inicio'); ?>" class="back-button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Regresar">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="title-text">
                    <h1 class="category-title mb-3"><?= $categoria_nombre ?></h1>
                    <p class="category-subtitle mb-0"><?= htmlspecialchars($categoria->tipo_nombre) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Contenido principal -->
<div class="container mb-5">
    <!-- Sección de productos -->
    <div class="mt-4">
        <?php if (!empty($productos)): ?>
            <div class="row g-4">
                <?php foreach ($productos as $producto): ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <article class="product-card" id="contenedor-producto-<?= $producto->id_producto ?>" 
                             onclick="window.location.href='<?= base_url('productos/detalle/' . $producto->id_producto) ?>'"
                             itemscope itemtype="https://schema.org/Product">
                            <div class="product-image-container">
                                <div class="product-image-wrapper" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver Producto">
                                    <?php if (!empty($producto->imagen1)): ?>
                                        
                                        <img src="<?= img_url("images/productos/$producto->imagen1") ?>" 
                                             alt="<?= htmlspecialchars($producto->nombre) ?> - <?= $categoria_nombre ?> | Codiza Perú" 
                                             title="<?= htmlspecialchars($producto->nombre) ?>"
                                             class="product-image image-1"
                                             loading="lazy"
                                             itemprop="image">
                                        <?php if (!empty($producto->imagen2)): ?>
                                            <img src="<?= img_url("images/productos/$producto->imagen2") ?>" 
                                                 alt="<?= htmlspecialchars($producto->nombre) ?> - Vista alternativa" 
                                                 title="<?= htmlspecialchars($producto->nombre) ?>"
                                                 class="product-image image-2"
                                                 loading="lazy">
                                        <?php else: ?>
                                            <img src="<?= img_url("images/productos/$producto->imagen1") ?>" 
                                                 alt="<?= htmlspecialchars($producto->nombre) ?>" 
                                                 class="product-image image-2"
                                                 loading="lazy">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="no-image-placeholder" style="background: rgba(0, 0, 0, 0.5);">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="product-body">
                                <h2 class="product-title text-center" itemprop="name"><?= htmlspecialchars($producto->nombre) ?></h2>
                                <meta itemprop="description" content="<?= htmlspecialchars(strip_tags(substr($producto->descripcion ?? '', 0, 100))) ?>">
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-products">
                <i class="fas fa-box-open"></i>
                <h3>No hay productos disponibles</h3>
                <p>Esta categoría aún no tiene productos registrados.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
