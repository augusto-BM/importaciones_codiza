# robots.txt para Importaciones Codiza
# Permite el rastreo de todas las páginas públicas

User-agent: *
Allow: /

# Bloquear áreas administrativas
Disallow: /login/
Disallow: /application/
Disallow: /system/
Disallow: /assets/vendor/

# Permitir recursos importantes para SEO
Allow: /assets/css/
Allow: /assets/js/
Allow: /images/

# Sitemap
Sitemap: <?= base_url('sitemap') ?>

# Rastreadores específicos
User-agent: Googlebot
Allow: /

User-agent: Googlebot-Image
Allow: /images/

User-agent: Bingbot
Allow: /
