// ============================= 
// FORZAR SCROLL AL INICIO
// ============================= 
// Prevenir restauración automática del scroll
if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}
// Forzar scroll a 0 inmediatamente
window.scrollTo(0, 0);

// ============================= 
// FADE IN PÁGINA
// ============================= 
$(document).ready(function() {
    $('body').addClass('show');
});

// ============================= 
// HEADER SHRINK AL HACER SCROLL
// ============================= 
$(window).on('scroll', function() {
    const header = $('#mainHeader');
    
    if ($(window).scrollTop() > 20) {
        header.addClass('shrink');
    } else {
        header.removeClass('shrink');
    }
});

// ============================= 
// INICIALIZAR TOOLTIPS DE BOOTSTRAP
// ============================= 
$(document).ready(function() {
    // Inicializar todos los tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// ============================= 
// MENÚ HAMBURGUESA MÓVIL
// ============================= 
$(document).ready(function() {
    const $hamburger = $('#hamburger');
    const $mobileMenu = $('#mobileMenu');
    const $overlay = $('#mobileMenuOverlay');
    
    // Función para cerrar el menú
    function closeMenu() {
        $hamburger.removeClass('active');
        $mobileMenu.removeClass('show');
        $overlay.removeClass('show');
        $('body').css('overflow', '');
    }
    
    // Toggle del menú hamburguesa
    $hamburger.on('click', function() {
        $(this).toggleClass('active');
        $mobileMenu.toggleClass('show');
        $overlay.toggleClass('show');
        
        // Prevenir scroll del body cuando el menú está abierto
        if ($mobileMenu.hasClass('show')) {
            $('body').css('overflow', 'hidden');
        } else {
            $('body').css('overflow', '');
        }
    });
    
    // Cerrar menú al hacer clic en un enlace
    $('.mobile-menu-link, .mobile-submenu-item').on('click', function() {
        closeMenu();
    });
    
    // Cerrar menú al hacer clic en el overlay
    $overlay.on('click', function() {
        closeMenu();
    });
    
    // Cerrar menú al cambiar tamaño de ventana a desktop
    $(window).on('resize', function() {
        if ($(window).width() >= 992) {
            closeMenu();
        }
    });
    
    // Manejar acordeón de categorías en móvil
    $('.mobile-accordion-header').on('click', function() {
        const targetId = $(this).data('target');
        const $content = $('#' + targetId);
        const $icon = $(this).find('.mobile-accordion-icon');
        
        // Toggle del acordeón actual
        $(this).toggleClass('active');
        $content.toggleClass('active');
        
        // Cerrar otros acordeones
        $('.mobile-accordion-header').not(this).removeClass('active');
        $('.mobile-accordion-content').not($content).removeClass('active');
    });
});

// =============================
// MEGA-MENU: abrir/cerrar por CLICK y cerrar al hacer click fuera
// =============================
$(document).ready(function() {
    // Toggle por click en el botón del dropdown
    $('.mega-dropdown .dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        var $toggle = $(this);
        var $li = $toggle.closest('.mega-dropdown');
        var $menu = $li.find('.mega-menu').first();

        // icono dentro del toggle
        var $icon = $toggle.find('i.fas').first();

        // Cerrar otros abiertos y restaurar sus iconos
        $('.mega-dropdown').not($li).each(function() {
            var $other = $(this);
            $other.removeClass('show').find('.mega-menu').removeClass('show').css('display', 'none');
            $other.find('.dropdown-toggle').attr('aria-expanded', 'false');
            var $otherIcon = $other.find('.dropdown-toggle i.fas').first();
            if ($otherIcon.length) {
                $otherIcon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            }
        });

        // Toggle actual
        if ($li.hasClass('show')) {
            $li.removeClass('show');
            $menu.removeClass('show').css('display', 'none');
            $toggle.attr('aria-expanded', 'false');
            if ($icon.length) {
                $icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            }
        } else {
            $li.addClass('show');
            $menu.addClass('show').css('display', 'block');
            $toggle.attr('aria-expanded', 'true');
            if ($icon.length) {
                $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }
        }
    });

    // Click fuera cierra los mega-menus
    $(document).on('click', function(e) {
        if ($(e.target).closest('.mega-dropdown').length === 0) {
            $('.mega-dropdown').each(function() {
                var $other = $(this);
                $other.removeClass('show').find('.mega-menu').removeClass('show').css('display', 'none');
                $other.find('.dropdown-toggle').attr('aria-expanded', 'false');
                var $otherIcon = $other.find('.dropdown-toggle i.fas').first();
                if ($otherIcon.length) {
                    $otherIcon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                }
            });
        }
    });

    // Al cambiar tamaño a móvil, cerrar menús
    $(window).on('resize', function() {
        if ($(window).width() < 992) {
            $('.mega-dropdown').removeClass('show').find('.mega-menu').removeClass('show').css('display', 'none');
            $('.mega-dropdown .dropdown-toggle').attr('aria-expanded', 'false');
        }
    });
});