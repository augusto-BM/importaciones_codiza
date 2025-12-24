<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador de Sitemap
 * Genera dinámicamente el sitemap.xml para SEO
 */
class Sitemap extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Categoria_model');
        $this->load->model('Producto_model');
    }
    
    /**
     * Genera el sitemap.xml dinámicamente
     * Acceso: https://tudominio.com/sitemap o https://tudominio.com/sitemap/index
     */
    public function index() {
        // Configurar header XML
        header("Content-Type: application/xml; charset=utf-8");
        
        // Obtener datos
        $categorias = $this->Categoria_model->get_all_active();
        $productos = $this->Producto_model->get_all_active();
        
        // Generar XML
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Página principal
        $this->add_url(base_url(), date('Y-m-d'), 'daily', '1.0');
        
        // Páginas estáticas
        $paginas = [
            'nosotros' => ['freq' => 'monthly', 'priority' => '0.8'],
            'servicios' => ['freq' => 'weekly', 'priority' => '0.9'],
            'proyectos' => ['freq' => 'weekly', 'priority' => '0.8'],
            'contacto' => ['freq' => 'monthly', 'priority' => '0.7']
        ];
        
        foreach ($paginas as $pagina => $config) {
            $this->add_url(
                base_url($pagina), 
                date('Y-m-d'), 
                $config['freq'], 
                $config['priority']
            );
        }
        
        // Categorías
        if (!empty($categorias)) {
            foreach ($categorias as $cat) {
                $this->add_url(
                    base_url('categoria/ver/' . $cat->id_categoria),
                    date('Y-m-d'),
                    'weekly',
                    '0.9'
                );
            }
        }
        
        // Productos
        if (!empty($productos)) {
            foreach ($productos as $prod) {
                $this->add_url(
                    base_url('producto/ver/' . $prod->id_producto),
                    date('Y-m-d'),
                    'weekly',
                    '0.7'
                );
            }
        }
        
        echo '</urlset>';
    }
    
    /**
     * Helper para añadir una URL al sitemap
     */
    private function add_url($loc, $lastmod, $changefreq, $priority) {
        echo '<url>';
        echo '<loc>' . htmlspecialchars($loc) . '</loc>';
        echo '<lastmod>' . $lastmod . '</lastmod>';
        echo '<changefreq>' . $changefreq . '</changefreq>';
        echo '<priority>' . $priority . '</priority>';
        echo '</url>';
    }
}
