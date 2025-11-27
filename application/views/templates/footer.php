<style>
    /* ======================================= */
    /* FOOTER CON BOOTSTRAP Y CSS ANIDADO    */
    /* ======================================= */

    footer {
        background: linear-gradient(135deg, #1a4d2e 0%, #00963f 100%);
        color: white;
        padding: 60px 0 0 0;
        margin-top: 60px;

        & .footer-content {
            padding: 0 50px 40px 50px;
        }

        & .footer-logo {
            margin-bottom: 20px;

            & img {
                max-width: 250px;
                height: auto;
            }
        }

        & .footer-description {
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.9);
        }

        & .footer-contact {
            margin-bottom: 25px;

            & p {
                margin: 8px 0;
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 10px;

                & i {
                    color: #e2e1dcff;
                    font-size: 16px;
                    width: 20px;
                }
            }
        }

        & .social-icons {
            display: flex;
            gap: 12px;
            margin-top: 20px;

            & a {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                width: 45px;
                height: 45px;
                border-radius: 50%;
                color: #fff;
                font-size: 20px;
                text-decoration: none;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.1);
                border: 2px solid rgba(255, 255, 255, 0.3);

                &:hover {
                    transform: translateY(-5px) scale(1.1);
                    background: rgba(255, 255, 255, 0.2);
                    border-color: #e2e1dcff;
                    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
                }

                &.facebook:hover { border-color: #1877F2; box-shadow: 0 5px 15px rgba(24, 119, 242, 0.4); }
                &.twitter:hover { border-color: #1DA1F2; box-shadow: 0 5px 15px rgba(29, 161, 242, 0.4); }
                &.instagram:hover { border-color: #E4405F; box-shadow: 0 5px 15px rgba(228, 64, 95, 0.4); }
                &.youtube:hover { border-color: #FF0000; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.4); }
                &.whatsapp:hover { border-color: #25D366; box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4); }
                &.tiktok:hover { border-color: #FE2C55; box-shadow: 0 5px 15px rgba(254, 44, 85, 0.4); }
            }
        }

        & .footer-section {
            & h4 {
                font-size: 18px;
                font-weight: 700;
                margin-bottom: 20px;
                color: #e2e1dcff;
                position: relative;
                padding-bottom: 10px;

                &::after {
                    content: '';
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    width: 50px;
                    height: 3px;
                    background: #e2e1dcff;
                }
            }

            & ul {
                list-style: none;
                padding: 0;
                margin: 0;

                & li {
                    margin-bottom: 10px;

                    & a {
                        color: rgba(255, 255, 255, 0.85);
                        text-decoration: none;
                        font-size: 14px;
                        transition: all 0.3s ease;
                        display: inline-block;
                        position: relative;
                        padding-left: 15px;

                        &::before {
                            content: '▸';
                            position: absolute;
                            left: 0;
                            color: #e2e1dcff;
                            transition: all 0.3s ease;
                        }

                        &:hover {
                            color: #e2e1dcff;
                            padding-left: 20px;

                            &::before {
                                left: 5px;
                            }
                        }
                    }
                }
            }
        }

        & .footer-schedule {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;

            & p {
                margin: 8px 0;
                font-size: 14px;
                line-height: 1.6;

                & strong {
                    color: #d1d0ccff;
                    display: block;
                    margin-bottom: 5px;
                }
            }
        }

        & .footer-advisor {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;

            & h5 {
                font-size: 16px;
                color: #e2e1dcff;
                margin-bottom: 10px;
                font-weight: 600;
            }

            & p {
                margin: 6px 0;
                font-size: 13px;
                display: flex;
                align-items: center;
                gap: 8px;

                & i {
                    color: #e2e1dcff;
                    font-size: 14px;
                }

                & a {
                    color: white;
                    text-decoration: none;
                    transition: color 0.3s ease;

                    &:hover {
                        color: #e2e1dcff;
                    }
                }
            }
        }

        & .footer-bottom {
            background: rgba(0, 0, 0, 0.3);
            padding: 20px 50px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 40px;

            & p {
                margin: 0;
                font-size: 14px;
                color: rgba(255, 255, 255, 0.8);

                & strong {
                    color: #e2e1dcff;
                }
            }
        }
    }

    /* Botón flotante de WhatsApp */
    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        left: 30px;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: white;
        border-radius: 50%;
        width: 65px;
        height: 65px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 32px;
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4);
        z-index: 9999;
        text-decoration: none;
        transition: all 0.3s ease;
        animation: pulse 2s infinite;

        &:hover {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 12px 30px rgba(37, 211, 102, 0.6);
        }
    }

    /* Tooltip flotante para WhatsApp */
    .whatsapp-tooltip {
        position: absolute;
        left: 80px;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        color: #333;
        padding: 12px 20px;
        border-radius: 25px;
        font-size: 15px;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        opacity: 1;
        visibility: visible;
        transition: all 0.3s ease;
        pointer-events: none;
        z-index: 9998;

        &::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 8px solid white;
        }
    }

    /* Botón flotante Volver Arriba */
    .scroll-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: white;
        color: #333;
        border-radius: 50%;
        width: 65px;
        height: 65px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 28px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        z-index: 9999;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        transform: translateY(100px);
        border: 2px solid rgba(0, 0, 0, 0.1);

        &.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        &:hover {
            transform: scale(1.15) translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            background: #f5f5f5;
            color: #00963f;
        }
    }

    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4);
        }
        50% {
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.8), 0 0 0 10px rgba(37, 211, 102, 0.1), 0 0 0 20px rgba(37, 211, 102, 0.05);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        footer {
            & .footer-content {
                padding: 0 20px 30px 20px;
            }

            & .footer-logo img {
                max-width: 200px;
            }

            & .footer-section h4 {
                font-size: 16px;
                margin-top: 30px;
            }

            & .footer-bottom {
                padding: 15px 20px;

                & p {
                    font-size: 12px;
                }
            }
        }

        .whatsapp-float {
            width: 55px;
            height: 55px;
            font-size: 28px;
            bottom: 20px;
            left: 20px;

            & .whatsapp-tooltip {
                display: none;
            }
        }

        .scroll-top {
            width: 55px;
            height: 55px;
            font-size: 24px;
            bottom: 20px;
            right: 20px;
        }
    }

    @media (max-width: 576px) {
        footer {
            & .social-icons {
                justify-content: center;

                & a {
                    width: 40px;
                    height: 40px;
                    font-size: 18px;
                }
            }

            & .footer-section ul li a {
                font-size: 13px;
            }
        }
    }
</style>

<footer>
    <div class="footer-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Columna 1: Logo e información -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="footer-logo">
                        <img src="<?= base_url('images/logo/footer-codiza-logo.png') ?>" alt="Importaciones Codiza">
                        
                    </div>
                    <p class="footer-description">
                        Ventas, importación y distribución de herramientas para la industria de metalmecánica
                    </p>
                    <div class="footer-contact">
                        <p><i class="fas fa-phone"></i> +51 972 156 330</p>
                        <p><i class="fas fa-map-marker-alt"></i> Av. Argentina 469 lima lima, Lima 15082</p>
                        <p><i class="fas fa-envelope"></i> ventas@importacionescodiza.com.pe</p>
                    </div>
                    <div class="social-icons">
                        <a href="#" class="facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="youtube" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Columna 2: Productos -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="footer-section">
                        <h4><i class="fas fa-tools"></i> Productos</h4>
                        <ul>
                            <?php if (isset($tipos_categoria) && !empty($tipos_categoria)): ?>
                                <?php foreach ($tipos_categoria as $tipo): ?>
                                    <li>
                                        <a href="<?= base_url('productos') ?>">
                                            <?= htmlspecialchars($tipo->nombre) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><a href="<?= base_url('productos') ?>">Ver todos los productos</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Columna 3: Horarios -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="footer-section">
                        <h4><i class="fas fa-clock"></i> Horarios de Atención</h4>
                        <div class="footer-schedule">
                            <p>
                                <strong>Lunes a Viernes:</strong>
                                8:00 am - 5:00 pm
                            </p>
                            <p>
                                <strong>Sábados:</strong>
                                8:00 am - 1:00 pm
                            </p>
                            <p>
                                <strong>Domingos:</strong>
                                Cerrado
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Columna 4: Contacto Ventas -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="footer-section">
                        <h4><i class="fas fa-headset"></i> Asesores de Ventas</h4>
                        
                        <div class="footer-advisor">
                            <h5><i class="fas fa-user-tie"></i> Asesor Principal</h5>
                            <p><i class="fas fa-phone"></i> <a href="tel:+51972156330">+51 972 156 330</a></p>
                            <p><i class="fas fa-envelope"></i> <a href="mailto:ventas@importacionescodiza.com.pe">ventas@importacionescodiza.com.pe</a></p>
                        </div>

                        <div class="footer-advisor">
                            <h5><i class="fas fa-user-tie"></i> Asesor Comercial</h5>
                            <p><i class="fas fa-phone"></i> <a href="tel:+51994357410">+51 994 357 410</a></p>
                            <p><i class="fas fa-envelope"></i> <a href="mailto:ventas1@importacionescodiza.com.pe">ventas1@importacionescodiza.com.pe</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 <strong>IMPORTACIONES CODIZA</strong> - Todos los derechos reservados.</p>
    </div>
</footer>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/51972156330" target="_blank" class="whatsapp-float" title="Chatea con nosotros">
    <i class="fab fa-whatsapp"></i>
    <span class="whatsapp-tooltip">Chatea con Codiza</span>
</a>

<!-- Botón flotante Volver Arriba -->
<button class="scroll-top" id="scrollTop" title="Volver arriba">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
// ===============================================
// BOTÓN VOLVER ARRIBA CON JQUERY
// ===============================================
$(document).ready(function() {
    const scrollTopBtn = $('#scrollTop');

    // Mostrar/ocultar botón al hacer scroll
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            scrollTopBtn.addClass('show');
        } else {
            scrollTopBtn.removeClass('show');
        }
    });

    // Scroll suave al inicio al hacer click
    scrollTopBtn.on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800, 'swing');
    });
});
</script>


