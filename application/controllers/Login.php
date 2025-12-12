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
        $this->load->helper('security');
        
        // Configurar headers de seguridad
        $this->_set_security_headers();
    }

    /**
     * Configurar headers HTTP de seguridad
     */
    private function _set_security_headers() {
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: SAMEORIGIN");
        header("X-XSS-Protection: 1; mode=block");
        header("Referrer-Policy: strict-origin-when-cross-origin");
        header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
    }

    public function index() {
        // Si ya está logueado, redirigir al dashboard
        if ($this->session->userdata("logeado")) {
            redirect("login/dashboard");
        }
        // Vista del login
        $this->load->view('login');
    }

    /**
     * Validar credenciales de usuario con seguridad mejorada
     */
    public function validar() {
        // Validar CSRF token
        $csrf_token = $this->input->post('csrf_token');
        if (!$csrf_token || $csrf_token !== $this->session->userdata('csrf_token')) {
            $this->session->set_flashdata("error", "Sesión inválida. Por favor, intente nuevamente.");
            redirect("login");
            return;
        }

        // Verificar rate limiting
        if ($this->_is_rate_limited()) {
            $this->session->set_flashdata("error", "Demasiados intentos fallidos. Intente nuevamente en 15 minutos.");
            redirect("login");
            return;
        }

        // Sanitizar y validar inputs
        $usuario  = trim($this->input->post('usuario', TRUE));
        $password = $this->input->post('password', TRUE);

        // Validación básica
        if (empty($usuario) || empty($password)) {
            $this->_register_failed_attempt();
            $this->session->set_flashdata("error", "Usuario o contraseña incorrectos.");
            redirect("login");
            return;
        }

        // Validar longitud de inputs para prevenir ataques
        if (strlen($usuario) > 255 || strlen($password) > 255) {
            $this->_register_failed_attempt();
            $this->session->set_flashdata("error", "Usuario o contraseña incorrectos.");
            redirect("login");
            return;
        }

        // Validar en modelo con bcrypt y soporte para MD5 legacy
        $userData = $this->Login_model->verificarUsuario($usuario, $password);

        if ($userData) {
            // Resetear intentos fallidos
            $this->session->unset_userdata('login_attempts');
            $this->session->unset_userdata('last_attempt_time');
            
            // Regenerar ID de sesión para prevenir session fixation
            $this->session->sess_regenerate(TRUE);
            
            // Guardamos datos de sesión
            $this->session->set_userdata([
                "usuario_id" => $userData->id, 
                "usuario_nombre" => $userData->nombre, 
                "logeado" => TRUE, 
                "rol" => $userData->rol,
                "login_time" => time()
            ]);
            
            // Redirige al panel
            redirect("login/dashboard");

        } else {
            // Registrar intento fallido
            $this->_register_failed_attempt();
            
            // Error en login (mensaje genérico para no dar pistas)
            $this->session->set_flashdata("error", "Usuario o contraseña incorrectos.");
            redirect("login");
        }
    }

    /**
     * Rate limiting basado en sesión
     */
    private function _is_rate_limited() {
        $attempts = $this->session->userdata('login_attempts');
        $last_attempt = $this->session->userdata('last_attempt_time');
        
        if (!$attempts) {
            return FALSE;
        }
        
        // Si han pasado más de 15 minutos, resetear
        if ($last_attempt && (time() - $last_attempt) > 900) {
            $this->session->unset_userdata('login_attempts');
            $this->session->unset_userdata('last_attempt_time');
            return FALSE;
        }
        
        // Límite de 5 intentos
        return $attempts >= 5;
    }

    /**
     * Registrar intento fallido de login
     */
    private function _register_failed_attempt() {
        $attempts = $this->session->userdata('login_attempts');
        $attempts = $attempts ? $attempts + 1 : 1;
        
        $this->session->set_userdata('login_attempts', $attempts);
        $this->session->set_userdata('last_attempt_time', time());
    }

    /**
     * Cerrar sesión de forma segura
     */
    public function salir() {
        // Destruir toda la sesión de forma segura
        $this->session->sess_destroy();
        redirect("login");
    }

    /**
     * Verificar si la sesión es válida
     */
    private function _check_session() {
        if (!$this->session->userdata("logeado")) {
            redirect("login");
        }
        
        // Verificar timeout de sesión (opcional - 2 horas)
        $login_time = $this->session->userdata("login_time");
        if ($login_time && (time() - $login_time) > 7200) {
            $this->session->sess_destroy();
            redirect("login");
        }
    }

    public function dashboard() {
        $this->_check_session();
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("dashboard");
        $this->load->view("templates/footer");
    }

    public function productos() {
        $this->_check_session();
        $data['tiposCategorias'] = $this->Menu_model->getTiposCategorias();
        $data["categorias"] = $this->Categoria_model->getCategorias();
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("productos", $data);
        $this->load->view("templates/footer");
    }

    public function categorias() {
        $this->_check_session();
        $data['tiposCategorias'] = $this->Menu_model->getTiposCategorias();
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("categorias", $data);
        $this->load->view("templates/footer");
    }

    public function clientes() {
        if (!$this->session->userdata("logeado")) { redirect("login"); }
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        // Cargar vista del dashboard
        $this->load->view("templates/header", $data);
        $this->load->view("clientes");
        $this->load->view("templates/footer");
    }

    public function tiposcategorias() {
        $this->_check_session();
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
        $this->_check_session();
        
        // Sanitizar inputs
        $rol_usuario = $this->input->post('rol_usuario', TRUE);
        $id_usuario = $this->input->post('id_usuario', TRUE);
        
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
        $this->_check_session();

        $id = $this->input->post('id_oculto', TRUE);
        
        if (empty($id) || !is_numeric($id)) {
            echo json_encode(array("success" => false, "message" => "ID de usuario no válido"));
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
        $this->_check_session();

        $id = $this->input->post('id_oculto', TRUE);
        $nombre = trim($this->input->post('nombre', TRUE));
        $email = trim($this->input->post('email', TRUE));
        $password = $this->input->post('password', TRUE);
        
        // Validaciones
        if (empty($id) || !is_numeric($id) || empty($nombre) || empty($email)) {
            echo json_encode(array("success" => false, "message" => "Todos los campos obligatorios deben ser completados"));
            return;
        }
        
        // Validar formato de email
        /* if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array("success" => false, "message" => "El email no tiene un formato válido"));
            return;
        } */
        
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
