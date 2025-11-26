<?php
class Nosotros extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Menu_model"); // <- NECESARIO
         $this->load->library('session'); // <- esto es clave
    }

    private function menuData() {
        $dataDB = $this->Menu_model->getCategoriasConProductos();

        $menu = [];

        foreach ($dataDB as $row) {
            $cat = $row->categoria;

            if (!isset($menu[$cat])) {
                $menu[$cat] = [];
            }

            if ($row->producto != null) {
                $menu[$cat][] = [
                    "id" => $row->producto_id,
                    "nombre" => $row->producto
                ];
            }
        }

        return $menu;
    }

        public function index() {
        $data["menu"] = $this->menuData();
        $this->load->view('templates/header', $data);
        $this->load->view('nosotros'); // <- Tu nueva vista contacto.php
        $this->load->view('templates/footer');
    }
}
?>
