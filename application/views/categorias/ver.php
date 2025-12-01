<style>
    .category-header {
        position: relative;
        color: white;
        padding: 80px 0;
        margin-bottom: 40px;
        overflow: hidden;
        min-height: 300px;
        display: flex;
        align-items: center;
    }
    
    .category-parallax-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: 1;
    }
    
    .category-parallax-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 2;
    }
    
    .category-content {
        position: relative;
        z-index: 3;
        width: 100%;
    }
    
    .category-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        display: inline-flex;
        align-items: center;
        gap: 15px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .content-section {
        background: white;
        padding: 30px 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 40px;
    }
    
    .category-subtitle {
        font-size: 1.2rem;
        margin: 0;
        opacity: 0.95;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        color: white;
        text-decoration: none;
        background-color: rgba(255,255,255,0.2);
        border-radius: 50%;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }
    
    .back-button:hover {
        background-color: rgba(255,255,255,0.3);
        color: white;
        transform: scale(1.1);
    }
    
    /* Cards de productos */
    .product-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .product-image-container {
        position: relative;
        width: 100%;
        height: 250px;
        background-color: white;
        padding: 20px;
    }
    
    .product-image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.8s ease, opacity 0.8s ease;
        position: absolute;
        top: 0;
        left: 0;
    }
    
    .product-image.image-1 {
        z-index: 2;
    }
    
    .product-image.image-2 {
        z-index: 1;
        opacity: 0;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.05);
    }
    
    .product-card:hover .product-image.image-1 {
        opacity: 0;
    }
    
    .product-card:hover .product-image.image-2 {
        opacity: 1;
    }
    
    .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f5f5f5;
        transition: transform 0.4s ease;
    }
    
    .product-card:hover .no-image-placeholder {
        transform: scale(1.1);
    }
    
    .product-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        min-height: 50px;
        line-height: 1.4;
    }
    
    .product-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #61CE70;
        margin-top: auto;
    }
    
    .no-products {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .no-products i {
        font-size: 5rem;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .no-products h3 {
        color: #666;
        margin-bottom: 10px;
    }
    
    .no-products p {
        color: #999;
    }
    
    .products-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 30px;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .category-header {
            padding: 60px 0;
            min-height: 250px;
        }
        
        .category-title {
            font-size: 2rem;
            gap: 12px;
        }
        
        .category-subtitle {
            font-size: 1.1rem;
        }
        
        .product-image-container {
            height: 220px;
        }
        
        .products-title {
            font-size: 1.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .category-header {
            padding: 50px 0;
            min-height: 220px;
        }
        
        .category-title {
            font-size: 1.6rem;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .category-subtitle {
            font-size: 1rem;
        }
        
        .back-button {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .product-image-container {
            height: 200px;
        }
        
        .product-title {
            font-size: 1rem;
            min-height: 45px;
        }
        
        .product-price {
            font-size: 1.2rem;
        }
        
        .products-title {
            font-size: 1.3rem;
            margin-bottom: 20px;
        }
        
        .no-products {
            padding: 40px 20px;
        }
        
        .no-products i {
            font-size: 4rem;
        }
        
        .content-section {
            padding: 20px 15px;
        }
    }
    
    @media (max-width: 576px) {
        .category-header {
            padding: 40px 0;
            min-height: 200px;
        }
        
        .category-title {
            font-size: 1.3rem;
            gap: 8px;
        }
        
        .category-subtitle {
            font-size: 0.9rem;
        }
        
        .back-button {
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
        }
        
        .product-image-container {
            height: 180px;
        }
        
        .product-body {
            padding: 15px;
        }
        
        .product-title {
            font-size: 0.95rem;
            min-height: 40px;
        }
        
        .product-price {
            font-size: 1.1rem;
        }
        
        .products-title {
            font-size: 1.1rem;
        }
        
        .no-products {
            padding: 30px 15px;
        }
        
        .no-products i {
            font-size: 3rem;
        }
        
        .no-products h3 {
            font-size: 1.2rem;
        }
        
        .no-products p {
            font-size: 0.9rem;
        }
    }
</style>

<!-- Header de la categoría -->
<section class="category-header">
    <div class="category-parallax-bg"
        <?php if (!empty($categoria->imagen)): ?>
            style="background-image: url('<?= base_url('images/categorias/' . $categoria->imagen); ?>');"
        <?php endif; ?>
    >
        <?php if (empty($categoria->imagen)): ?>
            <div class="no-image-placeholder">
                <i class="fas fa-image fa-5x text-muted"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="category-content">
        <div class="container">
            <div class="text-center">
                <h2 class="category-title mb-3">
                    <a href="<?= base_url('inicio'); ?>" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <?= htmlspecialchars($categoria->categoria_nombre) ?>
                </h2>
                <p class="category-subtitle mb-0"><?= htmlspecialchars($categoria->tipo_nombre) ?></p>
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
                                <div class="product-image-wrapper">
                                    <?php if (!empty($producto->imagen1)): ?>
                                        
                                        <img src="<?= base_url("images/productos/$producto->imagen1") ?>" 
                                             alt="<?= htmlspecialchars($producto->nombre) ?>" 
                                             class="product-image image-1">
                                        <?php if (!empty($producto->imagen2)): ?>
                                            <img src="<?= base_url("images/productos/$producto->imagen2") ?>" 
                                                 alt="<?= htmlspecialchars($producto->nombre) ?>" 
                                                 class="product-image image-2">
                                        <?php else: ?>
                                            <img src="<?= base_url("images/productos/$producto->imagen1") ?>" 
                                                 alt="<?= htmlspecialchars($producto->nombre) ?>" 
                                                 class="product-image image-2">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="no-image-placeholder">
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
