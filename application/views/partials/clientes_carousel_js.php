<!-- ======================================= -->
<!-- JAVASCRIPT PARA CARRUSEL DE CLIENTES   -->
<!-- Requiere jQuery                         -->
<!-- ======================================= -->

<script>
// ======================================= 
// CARRUSEL RESPONSIVE DE CLIENTES
// =======================================
(function($) {
    'use strict';
    
    $(document).ready(function() {
        const $clienteItems = $('.cliente-item');
        const totalItems = $clienteItems.length;
        
        // Verificar si hay items para mostrar
        if (totalItems === 0) {
            console.warn('No hay clientes para mostrar en el carrusel');
            return;
        }
        
        let currentIndex = 0;
        let itemsPerView = 7;
        let autoplayInterval = null;

        // Función para obtener items por vista según el ancho de pantalla
        function getItemsPerView() {
            const width = $(window).width();
            if (width <= 575) return 1;        // Móvil: 1 item
            if (width <= 991) return 4;        // Tablet: 4 items
            return 7;                          // Desktop: 7 items
        }

        // Función para crear indicadores dinámicamente
        function createIndicators() {
            const totalPages = Math.ceil(totalItems / itemsPerView);
            const $indicatorsContainer = $('#clientesIndicators');
            $indicatorsContainer.empty();
            
            if (totalPages > 1) {
                for (let i = 0; i < totalPages; i++) {
                    const $dot = $('<span class="dot-clientes"></span>').attr('data-slide', i);
                    if (i === 0) $dot.addClass('active');
                    $indicatorsContainer.append($dot);
                }
            }
        }

        // Función para mostrar items según el índice actual
        function showItems(startIndex) {
            // Normalizar el índice
            if (startIndex >= totalItems) {
                currentIndex = 0;
            } else if (startIndex < 0) {
                currentIndex = Math.max(0, totalItems - itemsPerView);
            } else {
                currentIndex = startIndex;
            }

            // Ocultar todos los items
            $clienteItems.removeClass('active');

            // Mostrar items según el rango actual
            for (let i = 0; i < itemsPerView && (currentIndex + i) < totalItems; i++) {
                $clienteItems.eq(currentIndex + i).addClass('active');
            }

            // Actualizar indicadores
            const currentPage = Math.floor(currentIndex / itemsPerView);
            $('#clientesIndicators .dot-clientes').removeClass('active');
            $('#clientesIndicators .dot-clientes').eq(currentPage).addClass('active');
        }

        // Función para inicializar el carrusel
        function initCarousel() {
            itemsPerView = getItemsPerView();
            createIndicators();
            currentIndex = 0;
            showItems(0);
            startAutoplay();
        }

        // Función para avanzar
        function nextSlide() {
            const newIndex = currentIndex + itemsPerView;
            if (newIndex >= totalItems) {
                showItems(0);
            } else {
                showItems(newIndex);
            }
        }

        // Función para retroceder
        function prevSlide() {
            const newIndex = currentIndex - itemsPerView;
            showItems(newIndex);
        }

        // Autoplay
        function startAutoplay() {
            stopAutoplay();
            if (totalItems > itemsPerView) {
                autoplayInterval = setInterval(nextSlide, 3000);
            }
        }

        function stopAutoplay() {
            if (autoplayInterval !== null) {
                clearInterval(autoplayInterval);
                autoplayInterval = null;
            }
        }

        // Event listeners para botones de navegación
        $(document).on('click', '.carousel-next-clientes', function(e) {
            e.preventDefault();
            stopAutoplay();
            nextSlide();
            startAutoplay();
        });

        $(document).on('click', '.carousel-prev-clientes', function(e) {
            e.preventDefault();
            stopAutoplay();
            prevSlide();
            startAutoplay();
        });

        // Event listener para indicadores
        $(document).on('click', '#clientesIndicators .dot-clientes', function(e) {
            e.preventDefault();
            stopAutoplay();
            const page = parseInt($(this).data('slide'));
            showItems(page * itemsPerView);
            startAutoplay();
        });

        // Pausar autoplay al pasar el mouse
        $('#clientesCarousel').on('mouseenter', function() {
            stopAutoplay();
        });

        $('#clientesCarousel').on('mouseleave', function() {
            startAutoplay();
        });

        // Reinicializar al cambiar tamaño de ventana
        let resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                const newItemsPerView = getItemsPerView();
                if (newItemsPerView !== itemsPerView) {
                    initCarousel();
                }
            }, 250);
        });

        // Inicializar el carrusel
        initCarousel();
        
        //console.log('Carrusel de clientes inicializado correctamente');
    });
    
})(jQuery);
</script>
