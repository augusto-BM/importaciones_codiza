<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Security Firewall Hook
 * 
 * Sistema de protección multi-capa contra DDoS, scraping y ataques
 * Se ejecuta en el hook pre_system (antes de cargar CodeIgniter)
 * 
 * @author  Antigravity AI
 * @version 1.0.0
 */
class SecurityFirewall {
    
    // ========== CONFIGURACIÓN ==========
    
    // Rate Limiting
    const MAX_REQUESTS = 60;        // Peticiones permitidas por ventana de tiempo
    const TIME_WINDOW = 60;         // Ventana de tiempo en segundos
    
    // Bot Detection
    const ENABLE_BOT_BLOCKING = true;
    const STRICT_MODE = false;      // Si true, bloquea cualquier UA sospechoso
    
    // Browser Verification (Anti-DDoS)
    const ENABLE_BROWSER_CHECK = true;
    const COOKIE_NAME = 'sec_chk_token';
    const COOKIE_LIFETIME = 86400;  // 24 horas de validez
    
    // Logging
    const ENABLE_LOGGING = true;
    const LOG_FILE = 'security_threats.log';
    
    // Paths
    private $cache_dir;
    private $log_dir;
    private $config_dir;
    
    // Request data
    private $ip;
    private $user_agent;
    private $request_uri;
    private $request_method;
    
    /**
     * Constructor
     */
    public function __construct() {
        // Definir rutas
        $app_path = defined('APPPATH') ? APPPATH : dirname(__FILE__) . '/../../';
        $this->cache_dir = rtrim($app_path, '/') . '/cache/security/rate_limit/';
        $this->log_dir = rtrim($app_path, '/') . '/logs/';
        $this->config_dir = rtrim($app_path, '/') . '/config/';
        
        // Crear directorios si no existen
        $this->ensure_directories();
        
        // Obtener datos de la petición
        $this->ip = $this->get_client_ip();
        $this->user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';
        $this->request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $this->request_method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }
    
    /**
     * Método principal ejecutado por el hook
     */
    public function run() {
        // 1. Verificar IP Blacklist
        if ($this->is_ip_blacklisted()) {
            $this->block_request('IP_BLACKLIST', 'Your IP address has been blocked', 403);
        }
        
        // 2. Verificar Bot malicioso
        if (self::ENABLE_BOT_BLOCKING && $this->is_malicious_bot()) {
            $this->block_request('BOT_DETECTED', 'Automated access is not allowed', 403);
        }

        // 3. Validación de Navegador (Challenge JS)
        // Solo para GET requests y si no es un archivo estático
        if (self::ENABLE_BROWSER_CHECK && $this->request_method === 'GET' && !$this->is_static_file()) {
            $this->verify_browser();
        }
        
        // 4. Verificar Rate Limit
        if ($this->is_rate_limited()) {
            $this->block_request('RATE_LIMIT', 'Too many requests. Please try again later.', 429);
        }
        
        // 5. Aplicar Security Headers
        $this->set_security_headers();
        
        // 6. Registrar petición válida (incrementar contador)
        $this->register_request();
    }

    /**
     * Verificar si el navegador es legítimo mediante un reto JS
     * Muy rápido (milisegundos)
     */
    private function verify_browser() {
        // Generar token esperado basado en IP y UserAgent (para evitar compartir cookies)
        $expected_token = md5($this->ip . $this->user_agent . 's3cr3t_s4lt');
        
        // Verificar si ya tiene la cookie válida
        if (isset($_COOKIE[self::COOKIE_NAME]) && $_COOKIE[self::COOKIE_NAME] === $expected_token) {
            return; // Validado, continuar
        }

        // Si es un bot legítimo (Google, Bing), dejar pasar sin reto
        if ($this->is_legitimate_bot_verified()) {
            return;
        }

        // Si no tiene cookie, enviar reto JS
        $this->send_browser_challenge($expected_token);
    }

    /**
     * Enviar página ligera con reto JavaScript
     */
    private function send_browser_challenge($token) {
        $uri = $this->request_uri;
        
        // HTML minificado y optimizado para velocidad
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta http-equiv="refresh" content="3;url=' . htmlspecialchars($uri) . '" /><title>Security Check</title><style>body{font-family:Arial,sans-serif;background:#fff;display:flex;justify-content:center;align-items:center;height:100vh;margin:0} .box{text-align:center;padding:20px;border:1px solid #eee;border-radius:5px;box-shadow:0 2px 10px rgba(0,0,0,0.05)} h1{font-size:18px;margin-bottom:10px;color:#333} p{font-size:14px;color:#666}</style></head><body><div class="box"><h1>Verificando navegador...</h1><p>Esto tomará solo un momento.</p></div><script>document.cookie="' . self::COOKIE_NAME . '=' . $token . '; max-age=' . self::COOKIE_LIFETIME . '; path=/"; window.location.reload();</script></body></html>';
        
        echo $html;
        exit;
    }

    /**
     * Verificar si es un archivo estático (imágenes, css, js)
     * No queremos bloquear o retar la carga de assets
     */
    private function is_static_file() {
        $extensions = array('.jpg', '.jpeg', '.png', '.gif', '.css', '.js', '.ico', '.svg', '.woff', '.ttf');
        $uri_lower = strtolower($this->request_uri);
        
        foreach ($extensions as $ext) {
            if (substr($uri_lower, -strlen($ext)) === $ext) {
                return true;
            }
        }
        return false;
    }

    // ... (Mantener resto de métodos auxiliares: get_client_ip, is_ip_blacklisted, etc.) ...
    
    /**
     * Obtener la IP real del cliente (considerando proxies)
     */
    private function get_client_ip() {
        $ip_keys = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }
    
    /**
     * Verificar si la IP está en la lista negra
     */
    private function is_ip_blacklisted() {
        $blacklist_file = $this->config_dir . 'ip_blacklist.php';
        
        if (!file_exists($blacklist_file)) {
            return false;
        }
        
        include($blacklist_file);
        
        if (isset($config['ip_blacklist']) && is_array($config['ip_blacklist'])) {
            return in_array($this->ip, $config['ip_blacklist']);
        }
        
        return false;
    }
    
    /**
     * Verificar si el User-Agent es un bot malicioso
     */
    private function is_malicious_bot() {
        $ua_lower = strtolower($this->user_agent);
        
        // Lista negra de User-Agents maliciosos
        $malicious_patterns = array(
            'sqlmap', 'nikto', 'nmap', 'masscan', 'nessus', 'openvas', 'acunetix', 'metasploit', 'havij', // Herramientas
            'scrapy', 'webcopier', 'httrack', 'teleport', 'webzip', 'webripper', 'wget', 'curl', // Scrapers
            'python-requests', 'python-urllib', 'java/', 'apache-httpclient', 'go-http-client', // Libs
            'zmeu', 'scanner', 'bot@', 'spider', 'crawl' // Otros
        );
        
        // Whitelist de bots legítimos (NO bloquear)
        if ($this->is_legitimate_bot_verified()) {
            return false;
        }
        
        // Verificar patrones maliciosos
        foreach ($malicious_patterns as $pattern) {
            if (strpos($ua_lower, $pattern) !== false) {
                return true;
            }
        }
        
        // En modo estricto, bloquear UAs vacíos o muy cortos
        if (self::STRICT_MODE) {
            if (empty($this->user_agent) || strlen($this->user_agent) < 10) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Verificar bots legítimos (separado para reuso)
     */
    private function is_legitimate_bot_verified() {
        $ua_lower = strtolower($this->user_agent);
        $legitimate_bots = array(
            'googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baiduspider', 
            'yandexbot', 'facebookexternalhit', 'twitterbot', 'linkedinbot', 
            'whatsapp', 'telegrambot'
        );

        foreach ($legitimate_bots as $bot) {
            if (strpos($ua_lower, $bot) !== false) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Verificar si se excedió el rate limit
     */
    private function is_rate_limited() {
        $rate_file = $this->get_rate_file();
        
        if (!file_exists($rate_file)) {
            return false;
        }
        
        $data = json_decode(file_get_contents($rate_file), true);
        
        if (!$data || !isset($data['requests']) || !isset($data['window_start'])) {
            return false;
        }
        
        $current_time = time();
        $window_start = $data['window_start'];
        $requests = $data['requests'];
        
        // Si la ventana de tiempo expiró, resetear
        if (($current_time - $window_start) > self::TIME_WINDOW) {
            return false;
        }
        
        // Verificar si excede el límite
        return $requests >= self::MAX_REQUESTS;
    }
    
    /**
     * Registrar una petición válida
     */
    private function register_request() {
        $rate_file = $this->get_rate_file();
        $current_time = time();
        
        if (file_exists($rate_file)) {
            $data = json_decode(file_get_contents($rate_file), true);
            
            // Si la ventana expiró, resetear
            if (($current_time - $data['window_start']) > self::TIME_WINDOW) {
                $data = array(
                    'window_start' => $current_time,
                    'requests' => 1
                );
            } else {
                $data['requests']++;
            }
        } else {
            $data = array(
                'window_start' => $current_time,
                'requests' => 1
            );
        }
        
        file_put_contents($rate_file, json_encode($data));
        
        // Limpiar archivos antiguos (más de 2 minutos)
        $this->cleanup_old_files();
    }
    
    /**
     * Obtener ruta del archivo de rate limiting para esta IP
     */
    private function get_rate_file() {
        $ip_hash = md5($this->ip);
        return $this->cache_dir . $ip_hash . '.json';
    }
    
    /**
     * Limpiar archivos de rate limiting antiguos
     */
    private function cleanup_old_files() {
        // Solo ejecutar limpieza 5% de las veces
        if (rand(1, 20) !== 1) {
            return;
        }
        
        $files = glob($this->cache_dir . '*.json');
        $current_time = time();
        $max_age = self::TIME_WINDOW * 2; // 2 ventanas de tiempo
        
        foreach ($files as $file) {
            if (($current_time - filemtime($file)) > $max_age) {
                @unlink($file);
            }
        }
    }
    
    /**
     * Aplicar headers de seguridad HTTP
     */
    private function set_security_headers() {
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("Referrer-Policy: strict-origin-when-cross-origin");
        header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
        
        // CSP ajustado para permitir scripts inline del propio sitio (necesario para CodeIgniter a veces)
        // Puedes endurecerlo quitando 'unsafe-inline' si tu JS está todo en archivos externos
        header("Content-Security-Policy: default-src 'self' 'unsafe-inline' 'unsafe-eval' data:; img-src 'self' data:;");
    }
    
    /**
     * Bloquear petición y registrar amenaza
     */
    private function block_request($threat_type, $message, $http_code = 403) {
        // Registrar amenaza
        if (self::ENABLE_LOGGING) {
            $this->log_threat($threat_type);
        }
        
        // Enviar respuesta HTTP
        http_response_code($http_code);
        header('Content-Type: application/json');
        
        $response = array(
            'error' => $message,
            'code' => $http_code,
            'timestamp' => date('Y-m-d H:i:s')
        );
        
        // Si es rate limit, agregar tiempo de espera
        if ($threat_type === 'RATE_LIMIT') {
            $rate_file = $this->get_rate_file();
            if (file_exists($rate_file)) {
                $data = json_decode(file_get_contents($rate_file), true);
                $elapsed = time() - $data['window_start'];
                $retry_after = max(1, self::TIME_WINDOW - $elapsed);
                $response['retry_after'] = $retry_after;
                header("Retry-After: $retry_after");
            }
        }
        
        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }
    
    /**
     * Registrar amenaza en el log
     */
    private function log_threat($threat_type) {
        $log_file = $this->log_dir . self::LOG_FILE;
        
        $log_entry = sprintf(
            "[%s] %s | IP: %s | UA: %s | Method: %s | URI: %s\n",
            date('Y-m-d H:i:s'),
            $threat_type,
            $this->ip,
            $this->user_agent,
            $this->request_method,
            $this->request_uri
        );
        
        @file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
    }
    
    /**
     * Asegurar que los directorios necesarios existan
     */
    private function ensure_directories() {
        $dirs = array(
            $this->cache_dir,
            $this->log_dir
        );
        
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
        }
        
        // Crear archivo .htaccess en cache para proteger
        $htaccess = $this->cache_dir . '.htaccess';
        if (!file_exists($htaccess)) {
            @file_put_contents($htaccess, "Deny from all\n");
        }
    }
}
