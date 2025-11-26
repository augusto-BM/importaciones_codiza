<style>
/* ------------------ BANNER ------------------ */
.banner {
    width: 100%;
    height: 700px;
    background-image: url('<?= base_url("images/nosotros/nosotros.png") ?>');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;

    color: white;
    font-size: 36px;
    font-weight: bold;
    padding: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);

    box-sizing: border-box;
}

/* Tablet y celular → esconder banner */
@media (max-width: 992px) {
    .banner {
        display: none !important;
    }
}

/* ------------------ SECCIÓN NOSOTROS ------------------ */

.section-nosotros {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 60px;
    padding: 90px 8%;
    font-family: "Poppins", sans-serif; 
    background: linear-gradient(135deg, #0a0f47, #1f3eff, #4b87ff);
    position: relative;
    overflow: hidden;
    color: #fff;
}

/* Ondas suaves premium */
.section-nosotros::before {
    content: "";
    position: absolute;
    top: -40%;
    left: -20%;
    width: 120%;
    height: 200%;
    background: radial-gradient(circle at top left, rgba(255,255,255,0.08), transparent 60%);
    transform: rotate(-15deg);
}

/* Imagen con borde brillante + sombra elegante */
.section-nosotros img {
    width: 37%;
    border-radius: 26px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.35);
    border: 3px solid rgba(255,255,255,0.25);
    backdrop-filter: blur(4px);
    animation: fadeUp 1s ease both;
}

/* Contenedor de texto */
.section-nosotros .texto {
    width: 55%;
    position: relative;
    z-index: 2;
    animation: fadeRight 1s ease both;
}

/* Título elegante */
.section-nosotros .texto h2 {
    font-size: 48px;
    font-weight: 900;
    margin-bottom: 30px;
    line-height: 1.1;
    letter-spacing: -0.5px;
}

/* Línea minimalista */
.section-nosotros .texto h2::after {
    content: "";
    display: block;
    width: 120px;
    height: 5px;
    background: rgba(255,255,255,0.85);
    margin-top: 20px;
    border-radius: 20px;
}

/* Párrafos */
.section-nosotros .texto p {
    font-size: 20px;
    line-height: 1.9;
    margin-bottom: 22px;
    color: rgba(255,255,255,0.92);
}

/* Animaciones suaves */
@keyframes fadeRight {
    from { opacity: 0; transform: translateX(40px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}


/* ------------- RESPONSIVE ------------- */

@media(max-width: 950px) {
    .section-nosotros {
        flex-direction: column;
        text-align: center;
        padding: 70px 10%;
        gap: 40px;
    }

    .section-nosotros img {
        width: 80%;
    }

    .section-nosotros .texto {
        width: 100%;
    }

    .section-nosotros .texto h2 {
        font-size: 36px;
    }

    .section-nosotros .texto h2::after {
        margin: auto;
    }
}

@media(max-width: 520px) {
    .banner {
        font-size: 32px;
    }

    .section-nosotros img {
        width: 90%;
    }

    .section-nosotros .texto p {
        font-size: 18px;
    }
}
</style>


<div class="banner">
</div>

<section class="section-nosotros">
    <img src="<?= base_url('images/nosotros/foto1.jpg') ?>" alt="Nosotros">

    <div class="texto">
        <h2>Ventas, Importación y Distribución de Herramientas – FERRETERÍA MAYTA</h2>

        <p>
            Somos una ferretería industrial dedicada a la venta al por mayor y menor, ofreciendo herramientas y equipos de alta resistencia para los sectores metalmecánico, construcción y mantenimiento.
        </p>

        <p>
            Importamos y distribuimos marcas reconocidas, garantizando productos de calidad superior, precios competitivos y un servicio confiable para empresas y profesionales.
        </p>

        <p>
            Contamos con homologaciones en diversas compañías líderes, lo que respalda nuestra trayectoria y compromiso con la seguridad, el buen servicio y la atención personalizada.
        </p>
    </div>
</section>

