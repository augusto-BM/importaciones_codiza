<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Categoria_model");
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
}
?>
