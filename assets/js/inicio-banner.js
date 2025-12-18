// ======================================= 
    // CARRUSEL DE BANNER CON JQUERY
    // =======================================
    $(document).ready(function() {
        let currentSlideBanner = 0;
        const slidesBanner = $('.banner-slide');
        const dotsBanner = $('.banner-carousel-dots .dot-banner');
        const totalSlidesBanner = slidesBanner.length;
        let autoplayIntervalBanner = null;
        let isTransitioning = false;

        // Función para mostrar slide
        function showSlideBanner(index) {
            if (isTransitioning) return; // Evitar transiciones múltiples
            
            isTransitioning = true;
            
            // Asegurar que el índice esté en rango
            if (index >= totalSlidesBanner) {
                currentSlideBanner = 0;
            } else if (index < 0) {
                currentSlideBanner = totalSlidesBanner - 1;
            } else {
                currentSlideBanner = index;
            }

            // Ocultar todos los slides
            slidesBanner.removeClass('active');
            dotsBanner.removeClass('active');

            // Mostrar slide actual
            slidesBanner.eq(currentSlideBanner).addClass('active');
            dotsBanner.eq(currentSlideBanner).addClass('active');
            
            // Ejecutar la animación de contenido del slide actual (si existe)
            // Se usa un pequeño retardo para permitir que se aplique la clase "active"
            setTimeout(function() {
                if (typeof window.animateBannerContent === 'function') {
                    window.animateBannerContent();
                }
            }, 250);

            // Permitir nueva transición después de 800ms (duración de la animación)
            setTimeout(function() {
                isTransitioning = false;
            }, 800);
        }

        // Función para iniciar autoplay
        function startAutoplayBanner() {
            // Limpiar intervalo existente antes de crear uno nuevo
            if (autoplayIntervalBanner !== null) {
                clearInterval(autoplayIntervalBanner);
            }
            
            autoplayIntervalBanner = setInterval(function() {
                showSlideBanner(currentSlideBanner + 1);
            }, 8000); // Cambia cada 8 segundos (más tiempo para evitar cambios rápidos)
        }

        // Función para detener autoplay
        function stopAutoplayBanner() {
            if (autoplayIntervalBanner !== null) {
                clearInterval(autoplayIntervalBanner);
                autoplayIntervalBanner = null;
            }
        }

        // Botón siguiente
        $('.banner-carousel-next').on('click', function() {
            stopAutoplayBanner();
            showSlideBanner(currentSlideBanner + 1);
            startAutoplayBanner();
        });

        // Botón anterior
        $('.banner-carousel-prev').on('click', function() {
            stopAutoplayBanner();
            showSlideBanner(currentSlideBanner - 1);
            startAutoplayBanner();
        });

        // Click en indicadores
        dotsBanner.on('click', function() {
            stopAutoplayBanner();
            const slideIndex = $(this).data('slide');
            showSlideBanner(slideIndex);
            startAutoplayBanner();
        });

        // Pausar autoplay al pasar el mouse/puntero o al tocar el carrusel
        $('.banner-carousel-wrapper').on('pointerenter touchstart', function() {
            stopAutoplayBanner();
        });

        // Reanudar autoplay al quitar el mouse/puntero o al terminar el toque
        $('.banner-carousel-wrapper').on('pointerleave touchend', function() {
            // pequeño retraso para evitar reinicios inmediatos tras interacciones táctiles
            setTimeout(function() {
                startAutoplayBanner();
            }, 250);
        });

        // Reiniciar/autoreactivar autoplay cuando la pestaña vuelve a estar visible
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                stopAutoplayBanner();
            } else {
                startAutoplayBanner();
            }
        });

        // Reiniciar autoplay al recuperar foco de la ventana
        window.addEventListener('focus', function() {
            startAutoplayBanner();
        });

        // Detener autoplay al perder foco (opcional)
        window.addEventListener('blur', function() {
            stopAutoplayBanner();
        });

        // Iniciar autoplay al cargar la página
        if (totalSlidesBanner > 1) {
            startAutoplayBanner();
        }

        // Reintento seguro: si por alguna razón el intervalo no se inició,
        // arrancarlo pasados unos milisegundos (útil en navegadores que throttlean)
        setTimeout(function() {
            if (totalSlidesBanner > 1 && autoplayIntervalBanner === null && !document.hidden) {
                startAutoplayBanner();
            }
        }, 1000);
        
        // Forzar scroll al inicio al cargar la página
        $(window).scrollTop(0);
        $('html, body').scrollTop(0);
    });
 
 // ======================================= 
    // ANIMACIONES DEL BANNER
    // =======================================
    $(document).ready(function() {
        // Convertir la función en global para que pueda llamarse desde
        // showSlideBanner (autoplay, dots y botones)
        window.animateBannerContent = function() {
            // Resetear y ocultar inmediatamente los elementos antes de animar
            $('.banner-slide.active .banner-title-animate').css({
                'opacity': '0',
                'transform': 'scale(0.5)',
                'visibility': 'visible',
                'transition': 'none'
            });
            
            $('.banner-slide.active .banner-btn-1, .banner-slide.active .banner-btn-2').css({
                'opacity': '0',
                'transform': 'translateY(50px)',
                'visibility': 'visible',
                'transition': 'none'
            });
            
            // Forzar reflow para asegurar que los estilos se apliquen
            const titleEl = $('.banner-slide.active .banner-title-animate')[0];
            if (titleEl) titleEl.offsetHeight;
            
            // Animar el título: entrada desde el centro con escala
            setTimeout(function() {
                $('.banner-slide.active .banner-title-animate').css({
                    'transition': 'all 1s cubic-bezier(0.5, 0, 0, 1)',
                    'opacity': '1',
                    'transform': 'scale(1)'
                });
            }, 100);
            
            // Animar el primer botón: entrada desde abajo
            setTimeout(function() {
                $('.banner-slide.active .banner-btn-1').css({
                    'transition': 'all 0.8s ease-out',
                    'opacity': '1',
                    'transform': 'translateY(0)'
                });
            }, 1100);
            
            // Animar el segundo botón: entrada desde abajo (después del primero)
            setTimeout(function() {
                $('.banner-slide.active .banner-btn-2').css({
                    'transition': 'all 0.8s ease-out',
                    'opacity': '1',
                    'transform': 'translateY(0)'
                });
            }, 1900);
        }
        
        // Ejecutar animación al cargar la página
        setTimeout(function() {
            if (typeof window.animateBannerContent === 'function') window.animateBannerContent();
        }, 800);
        
        // Re-ejecutar animación cuando cambia el slide
        $('.banner-carousel-next, .banner-carousel-prev, .dot-banner').on('click', function() {
            // Ocultar elementos del slide anterior
            $('.banner-slide .banner-title-animate, .banner-slide .banner-btn-1, .banner-slide .banner-btn-2').css({
                'opacity': '0',
                'visibility': 'hidden',
                'transition': 'none'
            });
            
            setTimeout(function() {
                if (typeof window.animateBannerContent === 'function') window.animateBannerContent();
            }, 200);
        });
    });