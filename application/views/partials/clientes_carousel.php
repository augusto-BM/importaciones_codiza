<!-- ======================================= -->
<!-- COMPONENTE: CARRUSEL DE CLIENTES       -->
<!-- Parámetros necesarios: $clientes        -->
<!-- ======================================= -->

<section class="section-clientes">
    <div class="container-fluid">
        <h3 class="text-center mb-4" style="color: black;">Nuestros Clientes</h3>        
        <!-- Carrusel personalizado con jQuery -->
        <div id="clientesCarousel" class="servicios-carousel-wrapper">
            <div class="servicios-carousel-track">
                <div class="clientes-grid">
                    <?php if (!empty($clientes)): ?>
                        <?php foreach ($clientes as $index => $cliente): ?>
                            <div class="cliente-item <?= $index < 7 ? 'active' : '' ?>" data-index="<?= $index ?>">
                                <div class="servicio-card"  data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?= $cliente->nombre?>">
                                    <div class="servicio-imagen-wrapper">
                                        <div class="servicio-imagen">
                                            <?php if (!empty($cliente->imagen)): ?>
                                                <img src="<?= base_url('images/clientes/' . $cliente->imagen) ?>" 
                                                     alt="<?= htmlspecialchars($cliente->nombre) ?>">
                                            <?php else: ?>
                                                <div class="no-image-placeholder" style="background: rgba(0, 0, 0, 0.5);">
                                                    <i class="fas fa-image fa-3x text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="servicio-overlay"></div>
                                        </div>
                                        <div class="servicio-nombre d-none">
                                            <h4><?= htmlspecialchars($cliente->nombre) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">No hay clientes disponibles.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Controles anterior/siguiente -->
            <?php if (!empty($clientes) && count($clientes) > 7): ?>
                <button class="carousel-btn carousel-prev-clientes" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Anterior">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-btn carousel-next-clientes" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Siguiente">
                    <i class="fas fa-chevron-right"></i>
                </button>
            <?php endif; ?>
        </div>

        <!-- Indicadores -->
        <div id="clientesIndicators" class="carousel-dots"></div>
    </div>
</section>
