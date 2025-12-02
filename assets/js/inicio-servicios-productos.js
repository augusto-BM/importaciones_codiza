    // ======================================= 
    // CARRUSEL RESPONSIVE DE SERVICIOS
    // =======================================
    $(document).ready(function() {
        const servicioItems = $('.servicio-item');
        const totalItems = servicioItems.length;
        let currentIndex = 0;
        let itemsPerView = 4; // Por defecto desktop
        let autoplayInterval;

        // Función para obtener items por vista según el ancho de pantalla
        function getItemsPerView() {
            const width = $(window).width();
            if (width <= 575) return 1;        // Móvil: 1 item
            if (width <= 991) return 2;        // Tablet: 2 items
            return 4;                          // Desktop: 4 items
        }

        // Función para crear indicadores dinámicamente
        function createIndicators() {
            const totalPages = Math.ceil(totalItems / itemsPerView);
            const indicatorsContainer = $('#serviciosIndicators');
            indicatorsContainer.empty();
            
            if (totalPages > 1) {
                for (let i = 0; i < totalPages; i++) {
                    const dot = $('<span class="dot"></span>').attr('data-slide', i);
                    if (i === 0) dot.addClass('active');
                    indicatorsContainer.append(dot);
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
            servicioItems.removeClass('active');

            // Mostrar items según el rango actual
            for (let i = 0; i < itemsPerView && (currentIndex + i) < totalItems; i++) {
                servicioItems.eq(currentIndex + i).addClass('active');
            }

            // Actualizar indicadores
            const currentPage = Math.floor(currentIndex / itemsPerView);
            $('#serviciosIndicators .dot').removeClass('active');
            $('#serviciosIndicators .dot').eq(currentPage).addClass('active');
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
            clearInterval(autoplayInterval);
        }

        // Event listeners
        $('.carousel-next').on('click', function() {
            stopAutoplay();
            nextSlide();
            startAutoplay();
        });

        $('.carousel-prev').on('click', function() {
            stopAutoplay();
            prevSlide();
            startAutoplay();
        });

        $(document).on('click', '#serviciosIndicators .dot', function() {
            stopAutoplay();
            const page = $(this).data('slide');
            showItems(page * itemsPerView);
            startAutoplay();
        });

        $('#serviciosCarousel').on('mouseenter', stopAutoplay);
        $('#serviciosCarousel').on('mouseleave', startAutoplay);

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

        // Inicializar
        initCarousel();
    });

    // ======================================= 
    // CARRUSEL RESPONSIVE DE CATEGORÍAS
    // =======================================
    $(document).ready(function() {
        const categoriaItems = $('.categoria-item');
        const totalItems = categoriaItems.length;
        let currentIndex = 0;
        let itemsPerView = 4;
        let autoplayInterval;

        function getItemsPerView() {
            const width = $(window).width();
            if (width <= 575) return 1;
            if (width <= 991) return 2;
            return 4;
        }

        function createIndicators() {
            const totalPages = Math.ceil(totalItems / itemsPerView);
            const indicatorsContainer = $('#categoriasIndicators');
            indicatorsContainer.empty();
            
            if (totalPages > 1) {
                for (let i = 0; i < totalPages; i++) {
                    const dot = $('<span class="dot-categorias"></span>').attr('data-slide', i);
                    if (i === 0) dot.addClass('active');
                    indicatorsContainer.append(dot);
                }
            }
        }

        function showItems(startIndex) {
            if (startIndex >= totalItems) {
                currentIndex = 0;
            } else if (startIndex < 0) {
                currentIndex = Math.max(0, totalItems - itemsPerView);
            } else {
                currentIndex = startIndex;
            }

            categoriaItems.removeClass('active');

            for (let i = 0; i < itemsPerView && (currentIndex + i) < totalItems; i++) {
                categoriaItems.eq(currentIndex + i).addClass('active');
            }

            const currentPage = Math.floor(currentIndex / itemsPerView);
            $('#categoriasIndicators .dot-categorias').removeClass('active');
            $('#categoriasIndicators .dot-categorias').eq(currentPage).addClass('active');
        }

        function initCarousel() {
            itemsPerView = getItemsPerView();
            createIndicators();
            currentIndex = 0;
            showItems(0);
            startAutoplay();
        }

        function nextSlide() {
            const newIndex = currentIndex + itemsPerView;
            if (newIndex >= totalItems) {
                showItems(0);
            } else {
                showItems(newIndex);
            }
        }

        function prevSlide() {
            const newIndex = currentIndex - itemsPerView;
            showItems(newIndex);
        }

        function startAutoplay() {
            stopAutoplay();
            if (totalItems > itemsPerView) {
                autoplayInterval = setInterval(nextSlide, 3000);
            }
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        $('.carousel-next-categorias').on('click', function() {
            stopAutoplay();
            nextSlide();
            startAutoplay();
        });

        $('.carousel-prev-categorias').on('click', function() {
            stopAutoplay();
            prevSlide();
            startAutoplay();
        });

        $(document).on('click', '#categoriasIndicators .dot-categorias', function() {
            stopAutoplay();
            const page = $(this).data('slide');
            showItems(page * itemsPerView);
            startAutoplay();
        });

        $('#categoriasCarousel').on('mouseenter', stopAutoplay);
        $('#categoriasCarousel').on('mouseleave', startAutoplay);

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

        initCarousel();
    });

    // ======================================= 
    // EFECTO PARALLAX EN SECCIÓN ASESORÍA
    // =======================================
    $(document).ready(function() {
        const parallaxBg = $('.asesoria-parallax-bg');
        const parallaxContainer = $('.asesoria-parallax-container');

        if (parallaxBg.length && parallaxContainer.length) {
            function updateParallax() {
                const scrollTop = $(window).scrollTop();
                const containerOffset = parallaxContainer.offset().top;
                const containerHeight = parallaxContainer.outerHeight();
                const windowHeight = $(window).height();

                // Calcular si el contenedor está visible en el viewport
                if (scrollTop + windowHeight > containerOffset && scrollTop < containerOffset + containerHeight) {
                    // Calcular la posición relativa del scroll dentro del contenedor
                    const elementTop = containerOffset - scrollTop;
                    const elementBottom = elementTop + containerHeight;
                    
                    // Calcular el porcentaje de visibilidad (0 cuando está arriba, 1 cuando está abajo)
                    const scrollPercent = (windowHeight - elementTop) / (windowHeight + containerHeight);
                    
                    // Aplicar transformación parallax más pronunciada
                    // El rango va de -25% a 25% de la altura del contenedor
                    const translateY = (scrollPercent - 0.5) * 50;
                    parallaxBg.css('transform', 'translateY(' + translateY + '%)');
                }
            }

            // Ejecutar al hacer scroll
            $(window).on('scroll', updateParallax);
            
            // Ejecutar al cargar la página
            updateParallax();
        }
    });
