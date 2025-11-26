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
}

.section-clientes h3 {
    text-align: center;
    font-weight: bold;
    color: #00963f;
    margin-bottom: 40px;
}

/* Grid de clientes - 7 columnas en desktop */
.clientes-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 20px;
    transition: transform 0.5s ease-in-out;
}

/* Items individuales de clientes */
.cliente-item {
    display: none;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.cliente-item.active {
    display: block;
    opacity: 1;
}

/* Botones de navegación para clientes */
.carousel-btn.carousel-prev-clientes,
.carousel-btn.carousel-next-clientes {
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

.servicios-carousel-wrapper:hover .carousel-prev-clientes,
.servicios-carousel-wrapper:hover .carousel-next-clientes {
    opacity: 1;
    pointer-events: auto;
}

.carousel-btn.carousel-prev-clientes:hover,
.carousel-btn.carousel-next-clientes:hover {
    color: #00963f;
    transform: translateY(-50%) scale(1.3);
}

.carousel-btn.carousel-prev-clientes {
    left: 0;
}

.carousel-btn.carousel-next-clientes {
    right: 0;
}

/* Indicadores para clientes */
.carousel-dots .dot-clientes {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid #333;
    border-radius: 50%;
    display: inline-block;
    cursor: pointer;
    transition: all 0.3s ease;
}

.carousel-dots .dot-clientes:hover {
    background: #666;
    border-color: #000;
    transform: scale(1.15);
}

.carousel-dots .dot-clientes.active {
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
    .clientes-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .carousel-btn.carousel-prev-clientes,
    .carousel-btn.carousel-next-clientes {
        font-size: 32px;
        opacity: 1;
        pointer-events: auto;
    }

    .carousel-btn.carousel-prev-clientes {
        left: 5px;
    }

    .carousel-btn.carousel-next-clientes {
        right: 5px;
    }
}

@media (max-width: 575px) {
    .section-clientes {
        padding: 40px 15px;
    }

    /* Mostrar 1 columna en móvil */
    .clientes-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .carousel-btn.carousel-prev-clientes,
    .carousel-btn.carousel-next-clientes {
        width: 35px;
        height: 35px;
        font-size: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        opacity: 0.95;
        pointer-events: auto;
    }

    .carousel-btn.carousel-prev-clientes:hover,
    .carousel-btn.carousel-next-clientes:hover {
        background: rgba(0, 150, 63, 0.9);
        color: white;
    }

    .carousel-btn.carousel-prev-clientes {
        left: 5px;
    }

    .carousel-btn.carousel-next-clientes {
        right: 5px;
    }

    /* Ocultar indicadores en móvil */
    .carousel-dots {
        display: none;
    }
}
</style>
