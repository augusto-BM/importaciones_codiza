<!-- ==========================
     SECCIÓN – PRODUCTOS / CATEGORÍAS
=========================== -->
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
   SECCIÓN PRODUCTOS
========================== */
.section-productos {
    text-align: center;
    padding: 10px 20px;
    background: #f7f9fc;
}

/* Títulos */
.titulo-productos {
    font-size: 36px; /* más pequeño */
    font-weight: 800;
    margin-bottom: 5px;
    color: #212121;
}

.subtitulo-productos {
    font-size: 16px; /* más pequeño */
    color: #666;
    margin-bottom: 40px;
}

/* GRID */
.galeria-productos {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    max-width: 1000px; /* más compacto */
    margin: auto;
}

/* Tarjeta */
.galeria-item {
    background: #ffffff;
    border-radius: 12px; /* más compacto */
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: transform .25s ease, box-shadow .25s ease;
    cursor: pointer;
}

.galeria-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

/* Imagen */
.img-wrapper {
    width: 100%;
    height: 180px; /* más pequeño */
    overflow: hidden;
}

.img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .35s ease;
}

.galeria-item:hover img {
    transform: scale(1.1);
}

/* Texto */
.galeria-info {
    padding: 12px 16px;
}

.galeria-info h3 {
    font-size: 18px; /* más pequeño */
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 4px;
}

.galeria-info p {
    font-size: 12px; /* más pequeño */
    color: #666;
}

/* RESPONSIVO */
@media (max-width: 1000px) {
    .galeria-productos {
        grid-template-columns: repeat(2, 1fr);
    }

    .titulo-productos {
        font-size: 28px;
    }
}

@media (max-width: 600px) {
    .galeria-productos {
        grid-template-columns: 1fr;
    }

    .titulo-productos {
        font-size: 22px;
    }

    .img-wrapper {
        height: 150px;
    }
}



</style>

<div class="banner">
    <div class="banner-text"><span>PRODUCTOS</span></div>

</div>

<section class="section-productos">

    <h2 class="titulo-productos">Nuestros Productos</h2>
    <p class="subtitulo-productos">Ventas, importación y distribución de herramientas para la industria de metalmecánica.</p>

    <div class="galeria-productos">

        <?php 
        $imagenes = [
            "Ferreteria1.jpg",
            "Ferreteria2.jpg",
            "Ferreteria3.jpg",
            "Ferreteria4.jpg",
            "Ferreteria5.jpg"
        ];

        $titulos = [
            "TORNO",
            "CEPILLO",
            "TALADRO",
            "FRESADO",
            "BROCAS"
        ];

        // Slugs para URL
        $slugs = [
            "torno",
            "cepillos",
            "taladro",
            "fresa",
            "broca"
        ];

        foreach ($imagenes as $index => $img): ?>
            
            <a href="<?= base_url('productos/categoria/' . $slugs[$index]) ?>" class="galeria-item">
                
                <div class="img-wrapper">
                    <img src="<?= base_url('images/categorias/' . $img) ?>" alt="<?= $titulos[$index] ?>">
                </div>

                <div class="galeria-info">
                    <h3><?= $titulos[$index] ?></h3>
                </div>

            </a>

        <?php endforeach; ?>

    </div>

</section>

