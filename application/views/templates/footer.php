<link rel="stylesheet" href="<?= css_url('assets/css/footer.css'); ?>">
<footer role="contentinfo">
    <div class="footer-content">
        <div class="container">
            <div class="row align-items-stretch">
                <!-- Columna 1: Logo e información -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="footer-logo">
                        <img src="<?= img_url('images/logo/logo-footer.png') ?>" alt="Importaciones Codiza - Productos Industriales" width="180" height="auto" loading="lazy">
                    </div>
                    <p class="footer-description">
                        <img src="<?= img_url('images/footer/delivery.png') ?>" alt="Importaciones Codiza - Productos Industriales" width="50" height="auto" loading="lazy">
                        Envíos a todo el Peru
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
                

                <!-- Columnas 2-4 agrupadas: se anidan para que la columna 1 ocupe toda la altura -->
                <div class="col-12 col-md-6 col-lg-9">
                    <div class="row footer-sections-row">
                        <!-- Columna 2: Productos -->
                        <div class="col-12 col-md-12 col-lg-3 mb-4">
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
                        <div class="col-12 col-md-12 col-lg-4 mb-4">
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
                        <div class="col-12 col-md-12 col-lg-4 mb-4">
                            <div class="footer-section">
                                <h4><i class="fas fa-headset"></i> Asesores de Ventas</h4>
                                <div class="footer-advisor">
                                    <h5><i class="fas fa-user-tie"></i> Asesor Principal</h5>
                                    <p><i class="fas fa-phone"></i> <a href="tel:+51985410410" title="Llamar al asesor">+51 946 385 307</a></p>
                                    <p><i class="fas fa-envelope"></i> <a href="mailto:elsa.calero@codiza.com.pe" title="Enviar email">elsa.calero@codiza.com.pe</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fila de marcas: imagen debajo sólo de las columnas 2-4 -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <img src="<?= img_url('images/footer/footer_marcas.png') ?>" alt="Marcas - Importaciones Codiza" class="img-fluid footer-marcas" loading="lazy">
                        </div>
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
<a href="https://wa.me/51985410410" target="_blank" class="whatsapp-float"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Escribenos" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
    <span class="whatsapp-tooltip">Cotizaciones Whatsapp</span>
</a>

<!-- Botón flotante Volver Arriba -->
<button class="scroll-top" id="scrollTop" title="Volver arriba" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Volver arriba">
    <i class="fas fa-chevron-up"></i>
</button>

<script src="<?= base_url('assets/vendor/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

<script src="<?= base_url('assets/vendor/popperjs/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>

<!-- DataTables JS -->
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/dataTables.bootstrap5.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/responsive.bootstrap5.min.js'); ?>"></script>
<script src="<?= js_url('assets/js/footer.js'); ?>"></script>


