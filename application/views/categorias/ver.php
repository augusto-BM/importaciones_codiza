<link rel="stylesheet" href="<?= css_url('assets/css/ver.css'); ?>">

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
                    <h2 class="category-title mb-3"><?= htmlspecialchars($categoria->categoria_nombre) ?></h2>
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
                        <div class="product-card" id="contenedor-producto-<?= $producto->id_producto ?>" 
                             onclick="window.location.href='<?= base_url('productos/detalle/' . $producto->id_producto) ?>'">
                            <div class="product-image-container">
                                <div class="product-image-wrapper" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver Producto">
                                    <?php if (!empty($producto->imagen1)): ?>
                                        
                                        <img src="<?= img_url("images/productos/$producto->imagen1") ?>" 
                                             alt="<?= htmlspecialchars($producto->nombre) ?>" 
                                             class="product-image image-1">
                                        <?php if (!empty($producto->imagen2)): ?>
                                            <img src="<?= img_url("images/productos/$producto->imagen2") ?>" 
                                                 alt="<?= htmlspecialchars($producto->nombre) ?>" 
                                                 class="product-image image-2">
                                        <?php else: ?>
                                            <img src="<?= img_url("images/productos/$producto->imagen1") ?>" 
                                                 alt="<?= htmlspecialchars($producto->nombre) ?>" 
                                                 class="product-image image-2">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="no-image-placeholder" style="background: rgba(0, 0, 0, 0.5);">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="product-body">
                                <h5 class="product-title text-center"><?= htmlspecialchars($producto->nombre) ?></h5>
                            </div>
                        </div>
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
