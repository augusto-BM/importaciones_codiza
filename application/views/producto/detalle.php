<link rel="stylesheet" href="<?php echo base_url('assets/css/detalle.css'); ?>">

<!-- Detalle del Producto -->
<div class="container mb-5 mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4 breadcrumb-container">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('inicio'); ?>" class="text-decoration-none text-secondary">INICIO</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('categoria/ver/' . $producto->id_categoria); ?>" class="text-decoration-none text-secondary">
                    <?= htmlspecialchars($producto->categoria_nombre) ?>
                </a>
            </li>
            <li class="breadcrumb-item active text-dark" aria-current="page">
                <?= htmlspecialchars($producto->nombre) ?>
            </li>
        </ol>
    </nav>

    <?php if ($producto): ?>
    <div class="product-detail-section">
        <div class="row g-0">

            <!-- Galería de imágenes -->
            <div class="col-lg-6">
                <div class="image-gallery-sticky-wrapper">
                    <div class="image-gallery-container">

                        <!-- Imagen principal -->
                        <div class="main-image-container">
                            <?php if (!empty($producto->imagen1)): ?>
                                <img id="mainImage"
                                     src="<?= base_url("images/productos/$producto->imagen1") ?>"
                                     alt="<?= htmlspecialchars($producto->nombre) ?>"
                                     class="main-image">
                            <?php else: ?>
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Sin imagen disponible</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Miniaturas -->
                        <div class="thumbnails-container" id="thumbnailsContainer">
                            <?php 
                            $imagenes = [];

                            // Recorrer las 5 imágenes de la tabla
                            for ($i = 1; $i <= 5; $i++) {
                                $campo = "imagen$i";
                                if (!empty($producto->$campo)) {
                                    $imagenes[] = $producto->$campo;
                                }
                            }

                            if (count($imagenes) > 0):
                                foreach ($imagenes as $index => $imagen):
                            ?>
                                <div class="thumbnail-wrapper <?= $index === 0 ? 'active' : '' ?>"
                                     onclick="changeMainImage('<?= base_url("images/productos/$imagen") ?>', this)">
                                    
                                    <img src="<?= base_url("images/productos/$imagen") ?>"
                                         alt="Miniatura <?= $index + 1 ?>"
                                         class="thumbnail-image">
                                </div>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Información del producto -->
            <div class="col-lg-6">
                <div class="product-info-container">

                    <span class="product-category">
                        <i class="fas fa-tag"></i> <?= htmlspecialchars($producto->categoria_nombre) ?>
                    </span>

                    <h1 class="product-title"><?= htmlspecialchars($producto->nombre) ?></h1>

                    <!-- Descripción -->
                    <?php if (!empty($producto->descripcion)): ?>
                        <h2 class="product-description-title">Descripción del producto</h2>
                        <div class="product-description">
                            <?= preg_replace('/\s+/', ' ', trim($producto->descripcion)) ?>
                        </div>
                    <?php else: ?>
                        <div class="product-description">
                            <em style="color:#a0aec0;">No hay descripción disponible.</em>
                        </div>
                    <?php endif; ?>

                    <!-- Volver -->
                    <div class="mt-4">
                        <a href="javascript:history.back()" class="back-btn">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <?php else: ?>

    <div class="alert alert-warning text-center">
        <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
        <h4>Producto no encontrado</h4>
        <p>El producto que buscas no existe o ha sido eliminado.</p>
        <a href="<?= base_url('inicio'); ?>" class="btn btn-primary mt-3">
            <i class="fas fa-home"></i> Volver al inicio
        </a>
    </div>

    <?php endif; ?>

</div>
<div class="container mt-5">
    <?php if (!empty($productos_relacionados)): ?>
        <h3 class="related-title">Productos relacionados</h3>
        <div class="related-products-grid">
            <?php foreach ($productos_relacionados as $rel): ?>
                <div class="related-card">
                    <a href="<?= base_url('productos/detalle/' . $rel->id_producto) ?>" class="related-link">
                        <?php if (!empty($rel->imagen1)): ?>
                            <div class="related-img-wrap" style="cursor: pointer;" title="Ver Producto">
                                <img src="<?= base_url('images/productos/' . $rel->imagen1) ?>" alt="<?= htmlspecialchars($rel->nombre) ?>">
                            </div>
                        <?php else: ?>
                            <div class="related-img-wrap placeholder" style="cursor: pointer;" title="Ver Producto">
                                <i class="fas fa-image"></i>
                            </div>
                        <?php endif; ?>
                        <div class="related-info">
                            <h4 class="related-name"><?= htmlspecialchars($rel->nombre) ?></h4>
                            <!-- < ?php if (isset($rel->precio) && $rel->precio !== null && $rel->precio !== ''): ?>
                                <div class="related-price">$< ?= number_format($rel->precio, 2, ',', '.') ?></div>
                            < ?php endif; ?> -->
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    function changeMainImage(imageSrc, thumbnailElement) {
        // Cambiar la imagen principal
        document.getElementById('mainImage').src = imageSrc;

        // Actualizar miniaturas activas
        document.querySelectorAll('.thumbnail-wrapper')
            .forEach(el => el.classList.remove('active'));

        thumbnailElement.classList.add('active');
    }
</script>

