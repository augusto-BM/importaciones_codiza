// ===============================================
// ANIMACIONES AL HACER SCROLL - JQUERY
// ===============================================
$(document).ready(function() {
    // Intersection Observer para animaciones al hacer scroll
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                $(entry.target).addClass('animate-visible');
            }
        });
    }, observerOptions);

    // Observar items de servicios
    $('.servicio-item').each(function() {
        observer.observe(this);
    });

    // Parallax suave en el banner
    $(window).on('scroll', function() {
        const scrolled = $(window).scrollTop();
        $('.banner-servicios').css('background-position', 'center ' + (scrolled * 0.5) + 'px');
    });
});