<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Login_model");
        $this->load->model("Menu_model"); // <- NECESARIO
        $this->load->model("Tipo_categoria_model");
        $this->load->model("Categoria_model");
        $this->load->model("Cliente_model");
        $this->load->library('session');
    }

    public function index() {
        // Vista del login
        $this->load->view('login');
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
            $this->session->set_userdata(["usuario_id" => $userData->id, "usuario_nombre" => $userData->nombre, "logeado" => TRUE]);
            // Redirige al panel
            redirect("login/dashboard");

        } else {
            // Error en login
            $this->session->set_flashdata("error", "Usuario o contraseña incorrectos.");
            redirect("login");
        }
    }

    public function salir() {
        $this->session->sess_destroy();
        redirect("login");
    }

    public function dashboard() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        // Cargar vista del dashboard
        $this->load->view("templates/header");
        $this->load->view("dashboard");
        $this->load->view("templates/footer");
    }

    public function productos() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        $data["categorias"] = $this->Categoria_model->getCategorias();
        // Cargar vista de productos
        $this->load->view("templates/header");
        $this->load->view("productos", $data);
        $this->load->view("templates/footer");
    }

    public function categorias() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        $data['tiposCategorias'] = $this->Menu_model->getTiposCategorias();
        // Cargar vista de categorias
        $this->load->view("templates/header");
        $this->load->view("categorias", $data);
        $this->load->view("templates/footer");
    }

    public function clientes() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        // Cargar vista de clientes
        $this->load->view("templates/header");
        $this->load->view("clientes");
        $this->load->view("templates/footer");
    }

    public function tiposcategorias() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        // Cargar vista de tipos de categorias
        $this->load->view("templates/header");
        $this->load->view("tiposcategorias");
        $this->load->view("templates/footer");
    }
}
?>
