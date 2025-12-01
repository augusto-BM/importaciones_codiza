<!-- ======================================= -->
<!-- ESTILOS CSS PARA CARRUSEL DE CLIENTES  -->
<!-- ======================================= -->

<style>
/* ======================================= */
/* SECCIÓN DE CLIENTES                    */
/* ======================================= */

.section-clientes {
    padding: 60px 100px;
    background: #f8f9fa;
    position: relative;
}

.section-clientes h3 {
    text-align: center;
    font-weight: bold;
    color: #00963f;
    margin-bottom: 40px;
    font-size: 36px;
}

/* Wrapper del carrusel - específico para clientes */
.section-clientes .servicios-carousel-wrapper {
    position: relative;
    width: 100%;
    overflow: visible;
}

.section-clientes .servicios-carousel-track {
    width: 100%;
    overflow: hidden;
}

/* Grid de clientes - 7 columnas en desktop */
.section-clientes .clientes-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 20px;
    transition: transform 0.5s ease-in-out;
}

/* Items individuales de clientes */
.section-clientes .cliente-item {
    display: none;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.section-clientes .cliente-item.active {
    display: block;
    opacity: 1;
}

/* Estilos de las tarjetas de servicio - específico para clientes */
.section-clientes .servicio-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    background: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: block;
    cursor: pointer;
}

.section-clientes .servicio-card:hover {
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.section-clientes .servicio-card:hover .servicio-imagen img {
    transform: scale(1.15);
    opacity: 0.7;
}

.section-clientes .servicio-card:hover .servicio-overlay {
    background: rgba(0, 0, 0, 0.3);
}

.section-clientes .servicio-imagen-wrapper {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
}

.section-clientes .servicio-imagen {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: #f0f0f0;
}

.section-clientes .servicio-imagen img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.5s ease, opacity 0.5s ease;
}

.section-clientes .servicio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0);
    transition: background 0.5s ease;
    pointer-events: none;
}

/* Placeholder para imágenes no disponibles */
.section-clientes .no-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
    transition: transform 0.4s ease;
}

.section-clientes .servicio-card:hover .no-image-placeholder {
    transform: scale(1.1);
}

.section-clientes .servicio-nombre {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 20px 15px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4), transparent);
    text-align: center;
    z-index: 2;
}

.section-clientes .servicio-nombre h4 {
    font-size: 15px;
    font-weight: 600;
    color: white;
    margin: 0;
    line-height: 1.4;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

/* Botones de navegación para clientes */
.section-clientes .carousel-btn.carousel-prev-clientes,
.section-clientes .carousel-btn.carousel-next-clientes {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: auto;
    height: auto;
    background: transparent;
    border: none;
    color: #333;
    font-size: 40px;
    cursor: pointer;
    z-index: 100;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    line-height: 1;
}

.section-clientes .servicios-carousel-wrapper:hover .carousel-prev-clientes,
.section-clientes .servicios-carousel-wrapper:hover .carousel-next-clientes {
    opacity: 1;
    pointer-events: auto;
}

.section-clientes .carousel-btn.carousel-prev-clientes:hover,
.section-clientes .carousel-btn.carousel-next-clientes:hover {
    color: #00963f;
    transform: translateY(-50%) scale(1.3);
}

.section-clientes .carousel-btn.carousel-prev-clientes {
    left: 0;
}

.section-clientes .carousel-btn.carousel-next-clientes {
    right: 0;
}

/* Contenedor de indicadores */
.section-clientes .carousel-dots,
.section-clientes #clientesIndicators {
    text-align: center;
    margin-top: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

/* Indicadores para clientes */
.section-clientes .carousel-dots .dot-clientes,
.section-clientes #clientesIndicators .dot-clientes {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid #333;
    border-radius: 50%;
    display: inline-block;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0;
}

.section-clientes .carousel-dots .dot-clientes:hover,
.section-clientes #clientesIndicators .dot-clientes:hover {
    background: #666;
    border-color: #000;
    transform: scale(1.15);
}

.section-clientes .carousel-dots .dot-clientes.active,
.section-clientes #clientesIndicators .dot-clientes.active {
    background: #000;
    border-color: #000;
    transform: scale(1.2);
}

/* ======================================= */
/* RESPONSIVE PARA CLIENTES               */
/* ======================================= */

@media (max-width: 991px) {
    .section-clientes {
        padding: 60px 40px;
    }

    /* Mostrar 4 columnas en tablet para clientes */
    .section-clientes .clientes-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .section-clientes .carousel-btn.carousel-prev-clientes,
    .section-clientes .carousel-btn.carousel-next-clientes {
        font-size: 32px;
        opacity: 1;
        pointer-events: auto;
    }

    .section-clientes .carousel-btn.carousel-prev-clientes {
        left: 5px;
    }

    .section-clientes .carousel-btn.carousel-next-clientes {
        right: 5px;
    }
}

@media (max-width: 575px) {
    .section-clientes {
        padding: 40px 15px;
    }

    /* Mostrar 1 columna en móvil */
    .section-clientes .clientes-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .section-clientes .carousel-btn.carousel-prev-clientes,
    .section-clientes .carousel-btn.carousel-next-clientes {
        width: 35px;
        height: 35px;
        font-size: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        opacity: 0.95;
        pointer-events: auto;
    }

    .section-clientes .carousel-btn.carousel-prev-clientes:hover,
    .section-clientes .carousel-btn.carousel-next-clientes:hover {
        background: rgba(0, 150, 63, 0.9);
        color: white;
    }

    .section-clientes .carousel-btn.carousel-prev-clientes {
        left: 5px;
    }

    .section-clientes .carousel-btn.carousel-next-clientes {
        right: 5px;
    }

    /* Ocultar indicadores en móvil */
    .section-clientes .carousel-dots,
    .section-clientes #clientesIndicators {
        display: none;
    }
}
</style>
