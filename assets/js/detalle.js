(function(){
    var images = window.detalleImages || [];
    var currentIndex = 0;
    var zoomFactor = 2.5;

    function setMainImageByIndex(index) {
        if (!images || images.length === 0) return;
        index = (index + images.length) % images.length;
        var url = images[index];
        var main = document.getElementById('mainImage');
        if (main) main.src = url;

        var zoom = document.getElementById('zoomResult');
        if (zoom) {
            zoom.style.backgroundImage = 'url("' + url + '")';
        }

        var openBtn = document.getElementById('openImageBtn');
        if (openBtn) {
            if (url) {
                openBtn.style.display = 'inline-flex';
                openBtn.setAttribute('data-url', url);
            } else {
                openBtn.style.display = 'none';
            }
        }

        document.querySelectorAll('.thumbnail-wrapper').forEach(function(el){ el.classList.remove('active'); });
        var thumb = document.querySelector('.thumbnail-wrapper[data-index="' + index + '"]');
        if (thumb) thumb.classList.add('active');

        currentIndex = index;
    }

    function openImageInNewTab() {
        var url = (images && images.length) ? images[currentIndex] : null;
        var main = document.getElementById('mainImage');
        if (!url && main) url = main.src;
        if (!url) return;
        window.open(url, '_blank');
    }

    function changeMainImage(index) { setMainImageByIndex(index); }
    function prevImage() { if (!images || images.length === 0) return; setMainImageByIndex(currentIndex - 1); }
    function nextImage() { if (!images || images.length === 0) return; setMainImageByIndex(currentIndex + 1); }

    // Exponer funciones usadas por botones inline
    window.openImageInNewTab = openImageInNewTab;
    window.changeMainImage = changeMainImage;
    window.prevImage = prevImage;
    window.nextImage = nextImage;

    // Magnificador
    function attachMagnifier() {
        var img = document.getElementById('mainImage');
        var zoom = document.getElementById('zoomResult');
        var container = document.querySelector('.main-image-container');
        if (!img || !zoom || !container) return;

        function updateBackgroundSize() {
            var naturalW = img.naturalWidth || img.width;
            var naturalH = img.naturalHeight || img.height;
            var bgW = naturalW * zoomFactor;
            var bgH = naturalH * zoomFactor;
            zoom.style.backgroundSize = bgW + 'px ' + bgH + 'px';
        }

        function onMove(e) {
            var rect = img.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            x = Math.max(0, Math.min(rect.width, x));
            y = Math.max(0, Math.min(rect.height, y));
            var xPercent = (x / rect.width) * 100;
            var yPercent = (y / rect.height) * 100;
            zoom.style.backgroundPosition = xPercent + '% ' + yPercent + '%';
        }

        img.addEventListener('mouseenter', function() { container.classList.add('zoom-active'); updateBackgroundSize(); });
        img.addEventListener('mousemove', function(e) {
            var src = images[currentIndex] || img.src;
            if ((zoom.style.backgroundImage || '').indexOf(src) === -1) {
                zoom.style.backgroundImage = 'url("' + src + '")';
                updateBackgroundSize();
            }
            onMove(e);
        });
        img.addEventListener('mouseleave', function() { container.classList.remove('zoom-active'); });

        var observer = new MutationObserver(function(mutations){
            mutations.forEach(function(m){
                if (m.type === 'attributes' && m.attributeName === 'src') {
                    var src = img.getAttribute('src');
                    zoom.style.backgroundImage = 'url("' + src + '")';
                    updateBackgroundSize();
                }
            });
        });
        observer.observe(img, { attributes: true });
    }

    document.addEventListener('keydown', function(e){ if (e.key === 'ArrowLeft') prevImage(); if (e.key === 'ArrowRight') nextImage(); });

    function initGallery(){
        if (!images || images.length === 0) return;
        var active = document.querySelector('.thumbnail-wrapper.active');
        if (active && active.dataset && typeof active.dataset.index !== 'undefined') {
            currentIndex = parseInt(active.dataset.index, 10) || 0;
            setMainImageByIndex(currentIndex);
        } else {
            setMainImageByIndex(0);
        }
        var openBtn = document.getElementById('openImageBtn');
        if (openBtn) openBtn.style.display = (images && images.length) ? 'inline-flex' : 'none';
        attachMagnifier();
    }

    // Ejecutar cuando DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGallery);
    } else {
        initGallery();
    }
})();
