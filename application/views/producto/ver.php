<style>
/* ===================================================== */
/* ESTILO GENERAL DE LA PÁGINA DE PRODUCTO – TIPO AMAZON */
/* ===================================================== */

.producto-container {
    max-width: 1100px;
    margin: 80px auto;
    display: flex;
    gap: 50px;
    font-family: "Poppins", sans-serif;
    padding: 20px;
}

/* IMAGEN */
.producto-imagen {
    flex: 1;
}

.producto-imagen img {
    width: 100%;
    max-height: 500px;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0px 8px 25px rgba(0,0,0,0.15);
}

/* LADO DERECHO */
.producto-info {
    flex: 1.2;
}

.producto-info h1 {
    font-size: 40px;
    font-weight: 900;
    margin-bottom: 15px;
    color: #222;
}

.producto-precio {
    font-size: 32px;
    font-weight: 800;
    color: #e63946;
    margin-bottom: 15px;
}

.producto-categoria {
    font-size: 18px;
    margin-bottom: 25px;
    color: #3a3a3a;
    font-weight: 600;
}

.producto-descripcion {
    font-size: 18px;
    line-height: 1.7;
    color: #444;
    margin-bottom: 30px;
    white-space: pre-line;
    text-align: justify;
}

/* BOTÓN */
.boton-comprar {
    background: #0f275e;
    padding: 16px 35px;
    color: white;
    font-size: 20px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
    display: inline-block;
}

.boton-comprar:hover {
    background: #1d3fa6;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .producto-container {
        flex-direction: column;
        text-align: center;
    }

    .producto-info h1 {
        font-size: 32px;
    }

    .producto-precio {
        font-size: 28px;
    }

    .producto-descripcion {
        text-align: center;
    }
}

/* ================================ */
/* BREADCRUMB ELEGANTE TIPO AMAZON  */
/* ================================ */
/* BREADCRUMB ELEGANTE TIPO AMAZON */
.breadcrumb {
    max-width: 1100px;         /* igual que el contenedor principal */
    margin: 100px auto 20px;   /* espacio arriba y abajo */
    padding: 0 20px;           /* margen interno para móviles */
    font-family: "Poppins", sans-serif;
    font-size: 16px;
    color: #555;
    position: relative;        /* para que no quede detrás del header */
    z-index: 10;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
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

.breadcrumb strong {
    color: #222;
}

</style>

<br>
<div class="breadcrumb">
    <a href="<?= base_url() ?>">Inicio</a>
    <span>></span>
    <a href="<?= base_url('productos') ?>">Productos</a>
    <span>></span>
    <a href="<?= base_url('productos/categoria/' . $producto->categoria_nombre) ?>">
        <?= $producto->categoria_nombre ?>
    </a>
    <span>></span>
    <strong><?= $producto->nombre ?></strong>
</div>


<div class="producto-container">

    <!-- IMAGEN -->
    <div class="producto-imagen">
        <img src="<?= base_url('images/productos/' . strtolower($producto->categoria_nombre) . '/' . $producto->id . '.jpg') ?>"
             alt="<?= $producto->nombre ?>">
    </div>

    <!-- INFORMACIÓN -->
    <div class="producto-info">

        <h1><?= $producto->nombre ?></h1>

        <div class="producto-precio">
            S/ <?= number_format($producto->precio, 2) ?>
        </div>

        <div class="producto-categoria">
            Categoría: <?= $producto->categoria_nombre ?>
        </div>

        <div class="producto-descripcion">
            <?= nl2br($producto->descripcion) ?>
        </div>

        <a href="https://wa.me/51972156330?text=Hola, deseo información sobre el producto: <?= urlencode($producto->nombre) ?>"
           target="_blank"
           class="boton-comprar">
            Consultar por WhatsApp
        </a>

    </div>

</div>
