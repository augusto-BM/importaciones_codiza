<?php
class Nosotros extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Menu_model"); // <- NECESARIO
        $this->load->model("Tipo_categoria_model");
        $this->load->model("Cliente_model"); // <- NUEVO PARA COMPONENTE
        $this->load->library('session'); // <- esto es clave
    }    private function tiposCategoriasMenu() {
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

        public function index() {
        $data["menuTiposCategorias"] = $this->tiposCategoriasMenu();
        $data["clientes"] = $this->Cliente_model->obtener_clientes(); // <- NUEVO
        $this->load->view('templates/header', $data);
        $this->load->view('nosotros', $data); // <- Pasar datos a la vista
        $this->load->view('templates/footer');
    }
}
?>
