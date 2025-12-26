<?php
header('Content-Type: text/plain; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Detectar base URL sin CodeIgniter
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$base = ($base === '/') ? '' : $base;

$sitemap = $protocol . '://' . $host . $base . '/sitemap.xml';
?>

# robots.txt para Importaciones Codiza
User-agent: *
Allow: /

# Bloquear áreas administrativas
Disallow: /login/
Disallow: /application/
Disallow: /system/
# Permitir que los motores accedan a librerías/recursos de terceros necesarios
Allow: /assets/vendor/

# Permitir recursos importantes para SEO
Allow: /assets/css/
Allow: /assets/js/
Allow: /images/

# Sitemap
Sitemap: <?= $sitemap ?>

# Rastreadores específicos
User-agent: Googlebot
Allow: /

User-agent: Googlebot-Image
Allow: /images/

User-agent: Bingbot
Allow: /
