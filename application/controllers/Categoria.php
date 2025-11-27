<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Categoria_model");
        $this->load->model("Menu_model");
        $this->load->model("Producto_model");
        $this->load->library('session');
    }

    private function tiposCategoriasMenu() {
        $dataDB = $this->Menu_model->getTiposCategoriasConCategorias();

        $menu = [];

        foreach ($dataDB as $row) {
            $tipo = $row->tipo_nombre;

            if (!isset($menu[$tipo])) {
                $menu[$tipo] = [];
            }

            if ($row->categoria_nombre != null) {
                $menu[$tipo][] = [
                    "id" => $row->id_categoria,
                    "nombre" => $row->categoria_nombre
                ];
            }
        }

        return $menu;
    }

    // ===========================
    // LISTAR CATEGORÍAS
    // ===========================
    public function listar() {
        $data["categorias"] = $this->Categoria_model->getCategorias();
        $this->load->view("categorias/listar", $data);
    }

    // ===========================
    // AGREGAR CATEGORÍA
    // ===========================
    public function agregar() {

        if ($this->input->post()) {
            $nombre = $this->input->post("nombre");

            $this->Categoria_model->insertarCategoria($nombre);

            redirect(base_url("categoria/listar"));
        }

        $this->load->view("categorias/agregar");
    }

    // ===========================
    // EDITAR CATEGORÍA
    // ===========================
    public function editar($id) {

        $data["categoria"] = $this->Categoria_model->getCategoria($id);

        if ($this->input->post()) {
            $nombre = $this->input->post("nombre");

            $this->Categoria_model->actualizarCategoria($id, $nombre);

            redirect(base_url("categoria/listar"));
        }

        $this->load->view("categorias/editar", $data);
    }

    // ===========================
    // ELIMINAR CATEGORÍA
    // ===========================
    public function eliminar($id) {
        $this->Categoria_model->eliminarCategoria($id);
        redirect(base_url("categoria/listar"));
    }

    // ===========================
    // VER CATEGORÍA (FRONTEND)
    // ===========================
    public function ver($id = null) {
        // Validar que se envió un ID
        if ($id === null) {
            redirect(base_url('inicio'));
            return;
        }
        
        // Obtener información de la categoría
        $categoria = $this->Categoria_model->getCategoriaConTipo($id);
        
        // Si no existe la categoría, redirigir
        if (!$categoria) {
            redirect(base_url('inicio'));
            return;
        }
        
        // Obtener productos de la categoría
        $productos = $this->Producto_model->getProductosPorCategoria($id);
        
        // Cargar datos del menú para el header
        $data["menuTiposCategorias"] = $this->tiposCategoriasMenu();
        $data["categoria"] = $categoria;
        $data["productos"] = $productos;
        
        $this->load->view("templates/header", $data);
        $this->load->view("categorias/ver", $data);
        $this->load->view("templates/footer");
    }
}
?>
