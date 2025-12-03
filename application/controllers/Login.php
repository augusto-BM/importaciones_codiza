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
        $this->load->model("Usuario_model");
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
            $this->session->set_userdata(["usuario_id" => $userData->id, "usuario_nombre" => $userData->nombre, "logeado" => TRUE, "rol" => $userData->rol]);
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
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("dashboard");
        $this->load->view("templates/footer");
    }

    public function productos() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        $data['tiposCategorias'] = $this->Menu_model->getTiposCategorias();
        $data["categorias"] = $this->Categoria_model->getCategorias();
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("productos", $data);
        $this->load->view("templates/footer");
    }

    public function categorias() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        $data['tiposCategorias'] = $this->Menu_model->getTiposCategorias();
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("categorias", $data);
        $this->load->view("templates/footer");
    }

    /* public function clientes() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("clientes");
        $this->load->view("templates/footer");
    } */

    public function tiposcategorias() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("tiposcategorias");
        $this->load->view("templates/footer");
    }

    // ==================== MÉTODOS PARA GESTIÓN DE USUARIOS ====================

    /**
     * DataTable para listar usuarios con filtrado por rol
     */
    public function datatable_usuarios() {
        if (!$this->session->userdata("logeado")) {
            echo json_encode(array("error" => "No autorizado"));
            return;
        }
        $rol_usuario = $this->input->post('rol_usuario');
        $id_usuario = $this->input->post('id_usuario');
        
        $usuarios = $this->Usuario_model->obtener_usuarios($rol_usuario, $id_usuario);
        
        // Formatear datos para DataTable
        foreach ($usuarios as &$usuario) {
            // Rol
            if ($usuario->rol == '1') {
                $usuario->rol = '<span class="badge bg-primary">Soporte</span>';
            } else {
                $usuario->rol = '<span class="badge bg-warning text-dark">Dueño</span>';
            }
            // Estado
            if ($usuario->estado == 1) {
                $usuario->estado = '<span class="badge bg-success">Activo</span>';
            } else {
                $usuario->estado = '<span class="badge bg-danger">Inactivo</span>';
            }   
            // Opciones
            $usuario->opciones = '<button class="btn btn-sm btn-warning btn-editar-usuario" data-id="' . $usuario->id . '" title="Editar usuario">' .
                                 '<i class="fas fa-edit" style="color: #272921c0;"></i></button>';
        }
        echo json_encode($usuarios);
    }

    /**
     * Obtener datos de un usuario para edición
     */
    public function obtener_usuario() {
        if (!$this->session->userdata("logeado")) {
            echo json_encode(array("success" => false, "message" => "No autorizado"));
            return;
        }

        $id = $this->input->post('id_oculto');
        
        if (empty($id)) {
            echo json_encode(array("success" => false, "message" => "ID de usuario no proporcionado"));
            return;
        }
        
        $usuario = $this->Usuario_model->obtener_usuario($id);
        
        if ($usuario) {
            echo json_encode(array("success" => true, "data" => $usuario));
        } else {
            echo json_encode(array("success" => false, "message" => "Usuario no encontrado"));
        }
    }

    /**
     * Guardar/actualizar usuario
     */
    public function guardar_usuario() {
        if (!$this->session->userdata("logeado")) {
            echo json_encode(array("success" => false, "message" => "No autorizado"));
            return;
        }

        $id = $this->input->post('id_oculto');
        $nombre = trim($this->input->post('nombre'));
        $email = trim($this->input->post('email'));
        $password = $this->input->post('password');
        
        // Validaciones
        if (empty($id) || empty($nombre) || empty($email)) {
            echo json_encode(array("success" => false, "message" => "Todos los campos obligatorios deben ser completados"));
            return;
        }
        
        // Verificar si el email ya existe para otro usuario
        if ($this->Usuario_model->email_existe($email, $id)) {
            echo json_encode(array("success" => false, "message" => "El email ya está registrado para otro usuario"));
            return;
        }

        // Obtener datos actuales del usuario antes de actualizar
        $usuario_actual_db = $this->Usuario_model->obtener_usuario($id);
        $es_usuario_actual = ($id == $this->session->userdata('usuario_id'));
        $force_logout = false;
        $update_name = false;

        if ($es_usuario_actual) {
            $rol_actual = $this->session->userdata('rol');

            // Si cambia email o password
            if ($usuario_actual_db->email !== $email || !empty($password)) {
                // Si NO es soporte (1), forzar logout
                if ($rol_actual != 1) {
                    $force_logout = true;
                }
            } 
            
            // Si no vamos a desloguear, verificamos si cambió el nombre para actualizar la sesión
            if (!$force_logout && $usuario_actual_db->nombre !== $nombre) {
                $update_name = true;
            }
        }
        
        $data = array('id' => $id, 'nombre' => $nombre, 'email' => $email, 'password' => $password);
        
        $resultado = $this->Usuario_model->actualizar_usuario($data);
        
        if ($resultado) {
            if ($force_logout) {
                $this->session->sess_destroy();
                echo json_encode(array("success" => true, "message" => "Datos críticos actualizados. Debe iniciar sesión nuevamente.", "force_logout" => true));
            } elseif ($update_name) {
                $this->session->set_userdata('usuario_nombre', $nombre);
                echo json_encode(array("success" => true, "message" => "Usuario actualizado correctamente", "update_name" => $nombre));
            } else {
                echo json_encode(array("success" => true, "message" => "Usuario actualizado correctamente"));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "No se pudo actualizar el usuario"));
        }
    }
}
?>
