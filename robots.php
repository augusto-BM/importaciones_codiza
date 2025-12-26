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
Sitemap: <?php
			header('Content-Type: text/plain');
			if (function_exists('base_url')) {
				echo base_url('sitemap');
			} else {
				$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
				$host = $_SERVER['HTTP_HOST'];
				$script = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
				$base = ($script === '/' || $script === '\\') ? '' : $script;
				echo $protocol . '://' . $host . $base . '/sitemap.xml';
			}
		 ?>

# Rastreadores específicos
User-agent: Googlebot
Allow: /

User-agent: Googlebot-Image
Allow: /images/

User-agent: Bingbot
Allow: /
