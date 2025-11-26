<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Login_model");
        $this->load->model("Menu_model"); // <- NECESARIO
        $this->load->library('session');
    }

    public function index() {
        // Vista del login
        $this->load->view('login');
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

    public function validar() {
        $usuario  = $this->input->post('usuario');
        $password = $this->input->post('password');

        // Hash correcto: MD5
        $password_md5 = md5($password);


        // Validar en modelo
        $userData = $this->Login_model->verificarUsuario($usuario, $password_md5);

        if ($userData) {

            // Guardamos datos de sesión
            $this->session->set_userdata([
                "usuario_id"     => $userData->id,
                "usuario_nombre" => $userData->nombre,
                "logeado"        => TRUE
            ]);

            // Redirige al panel
            redirect("login/dashboard");

        } else {

            // Error en login
            $this->session->set_flashdata("error", "Usuario o contraseña incorrectos.");
            redirect("login");
        }
    }

    public function dashboard() {
        $data["menu"] = $this->menuData();

        // Si no está logeado, lo mandamos al login
        if (!$this->session->userdata("logeado")) {
            redirect("login");
        }

        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("dashboard");
        $this->load->view("templates/footer");
    }

    public function salir() {
        $this->session->sess_destroy();
        redirect("login");
    }
}
?>
