<?php
class Inicio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Menu_model"); // <- NECESARIO
        $this->load->model("Inicio_model"); // <- NECESARIO
        $this->load->model("Tipo_categoria_model"); // <- NUEVO
        $this->load->model("Cliente_model"); // <- NUEVO
        $this->load->library('session'); // <- esto es clave
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

    public function index() {
        $data["menuTiposCategorias"] = $this->tiposCategoriasMenu();
        $data["servicios"] = $this->Inicio_model->getServiciosActivos();
        $data["categorias"] = $this->Inicio_model->getCategoriasActivas();
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        $data["clientes"] = $this->Cliente_model->obtener_clientes();

        $this->load->view("templates/header", $data);
        $this->load->view("index");
        $this->load->view("templates/footer");
    }


}
?>
