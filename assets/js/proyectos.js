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
                $(entry.target).css({
                    'opacity': '1',
                    'transform': 'translateY(0)'
                });
            }
        });
    }, observerOptions);

    // Observar tarjetas de proyectos
    $('.proyecto-card').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateY(30px)',
            'transition': 'all 0.6s ease ' + (index * 0.1) + 's'
        });
        observer.observe(this);
    });

    // Parallax suave en el banner
    $(window).on('scroll', function() {
        const scrolled = $(window).scrollTop();
        $('.banner-proyectos').css('background-position', 'center ' + (scrolled * 0.5) + 'px');
    });
});