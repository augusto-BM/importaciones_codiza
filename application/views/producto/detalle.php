<style>
    .breadcrumb {
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "/";
        color: #6c757d;
        padding: 0 12px;
    }
    
    .breadcrumb-item {
        display: flex;
        align-items: center;
    }
    
    .breadcrumb-item.active {
        font-weight: 800;
        color: #2d3748 !important;
        font-size: 0.95rem;
    }
    
    .breadcrumb-item a:hover {
        color: #61CE70 !important;
    }
    
    .breadcrumb-container {
        margin-left: 3.5vw;
    }
    
    .product-detail-section {
        background: transparent;
        margin-bottom: 40px;
    }
    
    .image-gallery-container {
        padding: 30px;
        background: transparent;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
    
    .image-gallery-sticky-wrapper {
        position: sticky;
        top: 20px;
        align-self: flex-start;
    }
    
    .main-image-container {
        width: 100%;
        max-width: 500px;
        height: 500px;
        /* background: #f8f9fa; */
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .main-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 10px;
    }
    
    .thumbnails-container {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        max-width: 500px;
    }
    
    .thumbnail-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        background: #f8f9fa;
        padding: 8px;
    }
    
    .thumbnail-wrapper:hover {
        border-color: #61CE70;
        transform: scale(1.05);
    }
    
    .thumbnail-wrapper.active {
        border-color: #4CAF50;
        box-shadow: 0 2px 10px rgba(76, 175, 80, 0.3);
    }
    
    .thumbnail-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .product-info-container {
        padding: 40px;
    }
    
    .product-category {
        display: inline-block;
        background: linear-gradient(135deg, #61CE70 0%, #4CAF50 100%);
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .product-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        line-height: 1.3;
    }
    
    .product-description-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
        margin-top: 30px;
    }
    
    .product-description {
        font-size: 1rem;
        color: #4a5568;
        line-height: 1.8;
    }
    
    .product-description ul {
        margin: 15px 0;
        padding-left: 20px;
    }
    
    .product-description li {
        margin-bottom: 8px;
    }
    
    .product-description b, .product-description strong {
        color: #2d3748;
        font-weight: 600;
        display: block;
        margin-top: 15px;
        margin-bottom: 5px;
    }
    
    .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #f5f5f5;
        border-radius: 10px;
    }
    
    .no-image-placeholder i {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 15px;
    }
    
    .no-image-placeholder p {
        color: #a0aec0;
        font-size: 0.9rem;
        margin: 0;
    }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: #f8f9fa;
        color: #61CE70;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border: 2px solid #61CE70;
    }
    
    .back-btn:hover {
        background: #61CE70;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(97, 206, 112, 0.3);
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .main-image-container {
            height: 400px;
            max-width: 400px;
        }
        
        .product-info-container {
            padding: 30px;
        }
        
        .product-title {
            font-size: 1.7rem;
        }
        
        .product-description-title {
            font-size: 1.2rem;
        }
    }
    
    @media (max-width: 768px) {
        .breadcrumb-container {
            margin-left: 2vw;
        }
        
        .breadcrumb {
            font-size: 0.95rem;
        }
        
        .breadcrumb-item.active {
            font-size: 1rem;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            padding: 0 10px;
        }
        
        .image-gallery-sticky-wrapper {
            position: relative;
            top: 0;
        }
        
        .image-gallery-container {
            padding: 20px;
        }
        
        .main-image-container {
            height: 350px;
            max-width: 100%;
        }
        
        .product-info-container {
            padding: 25px;
        }
        
        .product-title {
            font-size: 1.5rem;
        }
        
        .product-description-title {
            font-size: 1.1rem;
            margin-top: 20px;
        }
        
        .product-description {
            font-size: 0.95rem;
        }
        
        .thumbnail-wrapper {
            width: 70px;
            height: 70px;
        }
    }
    
    @media (max-width: 576px) {
        .breadcrumb-container {
            margin-left: 1vw;
        }
        
        .breadcrumb {
            font-size: 0.85rem;
        }
        
        .breadcrumb-item.active {
            font-size: 0.9rem;
            font-weight: 700;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            padding: 0 6px;
            font-size: 0.85rem;
        }
        
        .image-gallery-sticky-wrapper {
            position: relative;
            top: 0;
        }
        
        .main-image-container {
            height: 300px;
            padding: 15px;
        }
        
        .product-info-container {
            padding: 20px;
        }
        
        .product-title {
            font-size: 1.3rem;
        }
        
        .product-category {
            font-size: 0.75rem;
            padding: 5px 12px;
        }
        
        .product-description-title {
            font-size: 1rem;
        }
        
        .product-description {
            font-size: 0.9rem;
            line-height: 1.6;
        }
        
        .thumbnail-wrapper {
            width: 60px;
            height: 60px;
            gap: 10px;
        }
        
        .back-btn {
            padding: 8px 18px;
            font-size: 0.9rem;
        }
    }
</style>

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

