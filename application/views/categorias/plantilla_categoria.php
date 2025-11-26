<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $categoria ?></title>

    <style>

.banner {
    position: relative;
    width: 100%;
    height: 530px;
    background-image: url('<?= base_url("images/banner/productos.jpg") ?>');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    overflow: hidden;
}

.banner-text {
    position: absolute;
    top: 0;
    left: 0;
    width: 60%;
    height: 100%;
    background: rgba(0,0,0,0.5); /* diagonal semitransparente */
    transform: skewX(-20deg); /* diagonal */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2;
    padding: 0 20px;
    box-sizing: border-box;
}

.banner-text span {
    display: inline-block;
    transform: skewX(20deg); /* texto recto */
    font-family: 'Georgia', serif;
    font-size: 64px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 4px;
    color: #fff;
    background: linear-gradient(90deg, #ffffff, #faf5dbff); /* degradado elegante */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
}

/* Tablet */
@media (max-width: 992px) {
    .banner {
        height: 700px;
    }
    .banner-text span {
        font-size: 50px;
    }
}

/* Celular */
@media (max-width: 600px) {
    .banner {
        height: 500px;
        padding: 50px;
    }
    .banner-text span {
        font-size: 36px;
    }
}



/* ==========================
   CATEGORÍA HEADER
========================== */
.categoria-header {
    text-align: center;
    margin: 25px 0 12px; /* más compacto */
}

.categoria-header h2 {
    font-size: 28px; /* más pequeño */
    font-weight: 800;
    text-transform: uppercase;
    color: #222;
}


/* GRID FIJO DE 3 COLUMNAS */
.categoria-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px; /* más compacto */
    padding: 10px 30px;
}

/* TARJETA PRODUCTO */
.producto-card {
    background: #fff;
    border-radius: 10px; /* más compacto */
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    transition: 0.25s ease;
    text-align: center;
}


.producto-card {
    text-decoration: none;
    color: inherit;
    display: block;
}

.producto-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
}

/* IMAGEN PRODUCTO */
.producto-card img {
    width: 50%;
    aspect-ratio: 1 / 1; /* mantiene la imagen cuadrada */
    object-fit: cover;    /* recorta lo que sobresalga */
}

/* NOMBRE */
.producto-nombre {
    font-size: 16px; /* más pequeño */
    font-weight: 600;
    margin: 12px 0 6px;
    color: #222;
}

/* PRECIO */
.producto-precio {
    font-size: 14px; /* más pequeño */
    color: #e63946;
    font-weight: 700;
    margin-bottom: 12px;
}

/* RESPONSIVE PARA TABLET */
@media(max-width: 900px) {
    .categoria-grid {
        grid-template-columns: repeat(2, 1fr);
        padding: 10px;
    }

    .breadcrumb {
        padding: 0 10px;
        font-size: 11px;
        margin: 10px;
    }
}

/* RESPONSIVE PARA CELULAR */
@media(max-width: 600px) {
    .categoria-grid {
        grid-template-columns: 1fr;
    }

    .producto-card img {
        height: 150px;
    }



}

/* ================================ */
/* BREADCRUMB ELEGANTE TIPO AMAZON  */
/* ================================ */
.breadcrumb {
    max-width: 1100px;
     margin: 40px 0 10px 30px; /* izquierda con 30px */
    font-family: "Poppins", sans-serif;
    font-size: 16px;
    color: #555;
}

.breadcrumb a {
    color: #0f275e;
    text-decoration: none;
    font-weight: 600;
    transition: 0.2s;
}

.breadcrumb a:hover {
    color: #3a60ff;
}

.breadcrumb span {
    margin: 0 8px;
    color: #999;
}

    </style>
</head>
<body>
<div class="banner">
    <div class="banner-text"><span>PRODUCTOS</span></div>

</div>

    <div class="categoria-header">
        <h2><?= $categoria ?></h2>
    </div>

<div class="breadcrumb">
    <a href="<?= base_url() ?>">Inicio</a>
    <span>></span>

    <a href="<?= base_url('productos') ?>">Productos</a>
    <span>></span>

    <strong><?= $categoria ?></strong>
</div>


<div class="categoria-grid">

    <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $p): ?>

            <a href="<?= base_url('productos/ver/' . $p->id) ?>" class="producto-card">

                <img src="<?= base_url('images/productos/' . strtolower($categoria) . '/' . $p->id . '.jpg') ?>" 
                     alt="<?= $p->nombre ?>">

                <div class="producto-nombre"><?= $p->nombre ?></div>
                <div class="producto-precio">S/ <?= number_format($p->precio, 2) ?></div>

            </a>

        <?php endforeach; ?>
    <?php else: ?>
        <p style="grid-column: 1/-1; text-align:center; font-size:20px;">
            No hay productos en esta categoría.
        </p>
    <?php endif; ?>

</div>


</body>
</html>
