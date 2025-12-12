<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Asset Helper
 * 
 * Helper para gestionar archivos estáticos (JS, CSS, imágenes) con versionado automático
 * para evitar problemas de caché en el navegador.
 * 
 * IMPORTANTE: Solo se aplica versionado a archivos propios del sistema:
 * - JavaScript: assets/js/
 * - CSS: assets/css/
 * - Imágenes: images/
 * NO se aplica a librerías de terceros (vendor) que no cambian frecuentemente.
 */

if (!function_exists('js_url')) {
    /**
     * Genera una URL para un archivo JavaScript con versionado automático
     * Solo aplica versionado a archivos propios del sistema (assets/js/)
     * 
     * @param string $js_path Ruta relativa del JS desde la raíz del proyecto
     * @return string URL completa con parámetro de versión basado en la fecha de modificación del archivo
     */
    function js_url($js_path) {
        $CI =& get_instance();
        
        // Generar la URL base
        $url = base_url($js_path);
        
        // Solo agregar versionado si es un archivo propio del sistema (assets/js/)
        // NO agregar versionado a librerías vendor (jQuery, Bootstrap, DataTables, etc.)
        if (strpos($js_path, 'assets/js/') !== false) {
            // Obtener la ruta física del archivo
            $file_path = FCPATH . $js_path;
            
            // Si el archivo existe, usar su fecha de modificación como versión
            if (file_exists($file_path)) {
                $version = filemtime($file_path);
            } else {
                // Si el archivo no existe, usar timestamp actual
                $version = time();
            }
            
            // Agregar el parámetro de versión a la URL
            $separator = (strpos($url, '?') === false) ? '?' : '&';
            return $url . $separator . 'v=' . $version;
        }
        
        // Para archivos vendor, retornar la URL sin versionado
        return $url;
    }
}

if (!function_exists('css_url')) {
    /**
     * Genera una URL para un archivo CSS con versionado automático
     * Solo aplica versionado a archivos propios del sistema (assets/css/)
     * 
     * @param string $css_path Ruta relativa del CSS desde la raíz del proyecto
     * @return string URL completa con parámetro de versión basado en la fecha de modificación del archivo
     */
    function css_url($css_path) {
        $CI =& get_instance();
        
        // Generar la URL base
        $url = base_url($css_path);
        
        // Solo agregar versionado si es un archivo propio del sistema (assets/css/)
        // NO agregar versionado a librerías vendor (Bootstrap, DataTables, FontAwesome, etc.)
        if (strpos($css_path, 'assets/css/') !== false) {
            // Obtener la ruta física del archivo
            $file_path = FCPATH . $css_path;
            
            // Si el archivo existe, usar su fecha de modificación como versión
            if (file_exists($file_path)) {
                $version = filemtime($file_path);
            } else {
                // Si el archivo no existe, usar timestamp actual
                $version = time();
            }
            
            // Agregar el parámetro de versión a la URL
            $separator = (strpos($url, '?') === false) ? '?' : '&';
            return $url . $separator . 'v=' . $version;
        }
        
        // Para archivos vendor, retornar la URL sin versionado
        return $url;
    }
}

if (!function_exists('img_url')) {
    /**
     * Genera una URL para una imagen con versionado automático
     * Aplica versionado a imágenes propias del sistema (images/)
     * 
     * @param string $img_path Ruta relativa de la imagen desde la raíz del proyecto
     * @return string URL completa con parámetro de versión basado en la fecha de modificación del archivo
     */
    function img_url($img_path) {
        $CI =& get_instance();
        
        // Generar la URL base
        $url = base_url($img_path);
        
        // Agregar versionado a imágenes propias del sistema (images/)
        if (strpos($img_path, 'images/') !== false) {
            // Obtener la ruta física del archivo
            $file_path = FCPATH . $img_path;
            
            // Si el archivo existe, usar su fecha de modificación como versión
            if (file_exists($file_path)) {
                $version = filemtime($file_path);
            } else {
                // Si el archivo no existe, usar timestamp actual
                $version = time();
            }
            
            // Agregar el parámetro de versión a la URL
            $separator = (strpos($url, '?') === false) ? '?' : '&';
            return $url . $separator . 'v=' . $version;
        }
        
        // Para otras imágenes, retornar la URL sin versionado
        return $url;
    }
}
