<link rel="stylesheet" href="<?= base_url('assets/css/footer.css'); ?>">
<footer role="contentinfo">
    <div class="footer-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Columna 1: Logo e información -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="footer-logo">
                        <img src="<?= base_url('images/logo/logo-footer.png') ?>" alt="Importaciones Codiza - Productos Industriales" width="180" height="auto" loading="lazy">
                    </div>
                    <p class="footer-description">
                        CODIZA | Soluciones en Fajas Transportadoras.
                    </p>
                    <div class="footer-contact">
                        <p><i class="fas fa-phone"></i> <a href="tel:+51985410410" title="Llamar a CODIZA">+51 946 385 307</a></p>
                        <p><i class="fas fa-map-marker-alt"></i> Av. Ramón Cárcamo 565 Int. 131, Lima, Perú</p>
                        <p><i class="fa-solid fa-globe"></i> <a href="https://importacionescodiza.com/" target="_blank" title="Sitio web Importaciones Codiza">https://importacionescodiza.com/</a></p>
                    </div>
                    <div class="social-icons">
                        <a href="#" class="facebook" title="Facebook Importaciones Codiza" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="instagram" title="Instagram Importaciones Codiza" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="youtube" title="YouTube Importaciones Codiza" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Columna 2: Productos -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="footer-section">
                        <h4><i class="fas fa-tools"></i> Tipos de Categorias</h4>
                        <ul>
                            <?php if (isset($tipos_categoria) && !empty($tipos_categoria)): ?>
                                <?php foreach ($tipos_categoria as $tipo): ?>
                                    <li>
                                        <span style="color: #ffffff; cursor: default;">
                                            <?= htmlspecialchars($tipo->nombre) ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><span style="color: #ffffff;">Consulta nuestro catálogo</span></li>
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
                                8:00 am - 6:00 pm
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
                            <p><i class="fas fa-phone"></i> <a href="tel:+51985410410" title="Llamar al asesor">+51 946 385 307</a></p>
                            <p><i class="fas fa-envelope"></i> <a href="mailto:codiza@importacionescodiza.com" title="Enviar email">codiza@importacionescodiza.com</a></p>
                        </div>
                        <!-- <div class="footer-advisor">
                            <h5><i class="fas fa-user-tie"></i> Asesor Comercial</h5>
                            <p><i class="fas fa-phone"></i> <a href="tel:+51994357410">+51 994 357 410</a></p>
                            <p><i class="fas fa-envelope"></i> <a href="mailto:ventasindustriales@codiza.com.pe">ventasindustriales@codiza.com.pe</a></p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> <strong>IMPORTACIONES CODIZA</strong> - Todos los derechos reservados.</p>
    </div>
</footer>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/51985410410" target="_blank" class="whatsapp-float" title="Chatea con nosotros por WhatsApp" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
    <span class="whatsapp-tooltip">Cotizaciones Whatsapp</span>
</a>

<!-- Botón flotante Volver Arriba -->
<button class="scroll-top" id="scrollTop" title="Volver arriba" aria-label="Volver arriba">
    <i class="fas fa-chevron-up"></i>
</button>

<script src="<?= base_url('assets/js/footer.js'); ?>"></script>


