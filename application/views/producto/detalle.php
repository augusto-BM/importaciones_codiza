<link rel="stylesheet" href="<?php echo base_url('assets/css/detalle.css'); ?>">

<!-- Schema.org Markup para Producto -->
<?php if ($producto): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "<?= htmlspecialchars($producto->nombre) ?>",
  "description": "<?= htmlspecialchars(strip_tags($producto->descripcion ?? 'Producto industrial de alta calidad disponible en CODIZA S.A.')) ?>",
  "image": [
    <?php 
    $imagenes_schema = [];
    for ($i = 1; $i <= 5; $i++) {
        $campo = "imagen$i";
        if (!empty($producto->$campo)) {
            $imagenes_schema[] = '"' . base_url('images/productos/' . $producto->$campo) . '"';
        }
    }
    echo implode(",\n    ", $imagenes_schema);
    ?>
  ],
  "brand": {
    "@type": "Brand",
    "name": "Importaciones Codiza"
  },
  "offers": {
    "@type": "Offer",
    "url": "<?= current_url() ?>",
    "priceCurrency": "PEN",
    "availability": "https://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "Importaciones Codiza S.A."
    }
  },
  "category": "<?= htmlspecialchars($producto->categoria_nombre ?? 'Productos Industriales') ?>"
}
</script>
<?php endif; ?>

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
                        <?php
                        // Preparar array de imágenes disponibles (hasta 5)
                        $imagenes = [];
                        for ($i = 1; $i <= 5; $i++) {
                            $campo = "imagen$i";
                            if (!empty($producto->$campo)) {
                                $imagenes[] = $producto->$campo;
                            }
                        }
                        ?>
                        <!-- Imagen principal -->
                        <div class="main-image-container">
                            <?php if (count($imagenes) > 0): ?>
                                <div class="main-image-wrapper">
                                    <img id="mainImage"
                                         src="<?= base_url('images/productos/' . $imagenes[0]) ?>"
                                         alt="<?= htmlspecialchars($producto->nombre) ?> - Producto industrial CODIZA"
                                         title="<?= htmlspecialchars($producto->nombre) ?>"
                                         class="main-image">
                                </div>

                                <!-- Elemento que muestra el área ampliada (magnificador) -->
                                <div class="zoom-result" id="zoomResult" aria-hidden="true"></div>

                                <!-- Botón para abrir la imagen actual en una pestaña nueva -->
                                <button type="button" id="openImageBtn" class="open-image-btn"
                                        title="Abrir imagen en pestaña nueva" aria-label="Abrir imagen en pestaña nueva"
                                        onclick="openImageInNewTab()"
                                        style="display:inline-flex;align-items:center;justify-content:center;margin-top:10px;">
                                    <i class="fa-solid fa-maximize"></i>
                                </button>

                                <!-- Flechas para navegar (aparecen al hover) -->
                                <button type="button" class="image-arrow prev" onclick="prevImage()" aria-label="Anterior"><i class="fas fa-chevron-left"></i></button>
                                <button type="button" class="image-arrow next" onclick="nextImage()" aria-label="Siguiente"><i class="fas fa-chevron-right"></i></button>

                            <?php else: ?>
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Sin imagen disponible</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Miniaturas -->
                        <div class="thumbnails-container" id="thumbnailsContainer">
                            <?php if (count($imagenes) > 0): ?>
                                <?php foreach ($imagenes as $index => $imagen): ?>
                                    <div class="thumbnail-wrapper <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>"
                                         onclick="changeMainImage(<?= $index ?>, this)">
                                        <img src="<?= base_url('images/productos/' . $imagen) ?>"
                                             alt="<?= htmlspecialchars($producto->nombre) ?> - Vista <?= $index + 1 ?>"
                                             title="<?= htmlspecialchars($producto->nombre) ?> - Miniatura <?= $index + 1 ?>"
                                             class="thumbnail-image">
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
                        <?php if (!empty($producto->etiquetas)): ?>
                            <p><b>Etiqueta:</b> <?= htmlspecialchars($producto->etiquetas) ?></p>
                        <?php endif; ?>
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
                                <img src="<?= base_url('images/productos/' . $rel->imagen1) ?>" 
                                     alt="<?= htmlspecialchars($rel->nombre) ?> - Producto relacionado CODIZA"
                                     title="<?= htmlspecialchars($rel->nombre) ?>">
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
    // Array de URLs completas de las imágenes (generado por PHP)
    var images = <?= json_encode(array_map(function($img){ return base_url('images/productos/' . $img); }, $imagenes)); ?> || [];
    var currentIndex = 0;
    var zoomFactor = 2.5; // nivel de ampliación: ajustar según necesidad

    function setMainImageByIndex(index) {
        if (!images || images.length === 0) return;
        index = (index + images.length) % images.length;
        var url = images[index];
        var main = document.getElementById('mainImage');
        if (main) main.src = url;

        // Actualizar background del zoom si existe
        var zoom = document.getElementById('zoomResult');
        if (zoom) {
            zoom.style.backgroundImage = 'url("' + url + '")';
            // background-size se actualizará en mousemove según dimensiones reales
        }

        // Mostrar u ocultar el botón de abrir imagen según exista URL
        var openBtn = document.getElementById('openImageBtn');
        if (openBtn) {
            if (url) {
                openBtn.style.display = 'inline-flex';
                openBtn.setAttribute('data-url', url);
            } else {
                openBtn.style.display = 'none';
            }
        }

        // Actualizar miniaturas activas
        document.querySelectorAll('.thumbnail-wrapper')
            .forEach(el => el.classList.remove('active'));

        var thumb = document.querySelector('.thumbnail-wrapper[data-index="' + index + '"]');
        if (thumb) thumb.classList.add('active');

        currentIndex = index;
    }

    function openImageInNewTab() {
        var url = (images && images.length) ? images[currentIndex] : null;
        var main = document.getElementById('mainImage');
        if (!url && main) url = main.src;
        if (!url) return;
        window.open(url, '_blank');
    }

    function changeMainImage(index, thumbnailElement) {
        setMainImageByIndex(index);
    }

    function prevImage() {
        if (!images || images.length === 0) return;
        setMainImageByIndex(currentIndex - 1);
    }

    function nextImage() {
        if (!images || images.length === 0) return;
        setMainImageByIndex(currentIndex + 1);
    }

    // Magnificador: manejo de eventos sobre la imagen principal
    (function attachMagnifier() {
        var img = document.getElementById('mainImage');
        var zoom = document.getElementById('zoomResult');
        var container = document.querySelector('.main-image-container');
        if (!img || !zoom || !container) return;

        function updateBackgroundSize() {
            // Usar las dimensiones naturales para preservar calidad cuando sea posible
            var naturalW = img.naturalWidth || img.width;
            var naturalH = img.naturalHeight || img.height;
            var bgW = naturalW * zoomFactor;
            var bgH = naturalH * zoomFactor;
            zoom.style.backgroundSize = bgW + 'px ' + bgH + 'px';
        }

        function onMove(e) {
            var rect = img.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            // limitar dentro de la imagen
            x = Math.max(0, Math.min(rect.width, x));
            y = Math.max(0, Math.min(rect.height, y));

            var xPercent = (x / rect.width) * 100;
            var yPercent = (y / rect.height) * 100;

            // Mover el background del zoom para centrar la zona bajo el cursor
            zoom.style.backgroundPosition = xPercent + '% ' + yPercent + '%';
        }

        img.addEventListener('mouseenter', function() {
            container.classList.add('zoom-active');
            updateBackgroundSize();
        });

        img.addEventListener('mousemove', function(e) {
            // Si la imagen cambió recientemente, asegurar backgroundImage
            var src = images[currentIndex] || img.src;
            if (zoom.style.backgroundImage.indexOf(src) === -1) {
                zoom.style.backgroundImage = 'url("' + src + '")';
                updateBackgroundSize();
            }
            onMove(e);
        });

        img.addEventListener('mouseleave', function() {
            container.classList.remove('zoom-active');
        });

        // Actualizar el background cuando cambie la imagen fuente por código
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(m) {
                if (m.type === 'attributes' && m.attributeName === 'src') {
                    var src = img.getAttribute('src');
                    zoom.style.backgroundImage = 'url("' + src + '")';
                    updateBackgroundSize();
                }
            });
        });
        observer.observe(img, { attributes: true });
    })();

    // Soportar navegación con flechas del teclado
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'ArrowRight') nextImage();
    });

    // Inicializar indice para que coincida con la miniatura activa (si existe)
    (function initGallery() {
        if (!images || images.length === 0) return;
        // Si existe una miniatura marcada como active, usar su índice
        var active = document.querySelector('.thumbnail-wrapper.active');
        if (active && active.dataset && typeof active.dataset.index !== 'undefined') {
            currentIndex = parseInt(active.dataset.index, 10) || 0;
            setMainImageByIndex(currentIndex);
        } else {
            // por defecto usar el 0
            setMainImageByIndex(0);
        }
        // Asegurar que el botón esté oculto si no hay imágenes
        var openBtn = document.getElementById('openImageBtn');
        if (openBtn) openBtn.style.display = (images && images.length) ? 'inline-flex' : 'none';
    })();
</script>

