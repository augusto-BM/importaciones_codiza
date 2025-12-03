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