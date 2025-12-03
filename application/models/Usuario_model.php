<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Obtener usuarios para DataTable con filtrado por rol
     * @param string $rol_usuario Rol del usuario actual (1=soporte, 2=dueño)
     * @param int $id_usuario ID del usuario actual
     * @return array Datos de usuarios
     */
    public function obtener_usuarios($rol_usuario, $id_usuario) {
        // Query base
        $this->db->select('id, nombre, email, rol, estado');
        $this->db->from('usuarios');
        
        // Filtrado por rol
        if ($rol_usuario == '2') {
            // Si es dueño (rol=2), solo mostrar su propio usuario
            $this->db->where('id', $id_usuario);
        } else {
            // Si es soporte (rol=1), mostrar todos los usuarios con rol 1 o 2
            $this->db->where_in('rol', array('1', '2'));
        }
        
        // Ordenar por ID descendente
        $this->db->order_by('id', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Obtener datos de un usuario por ID
     * @param int $id ID del usuario
     * @return object|null Datos del usuario
     */
    public function obtener_usuario($id) {
        $this->db->select('id, nombre, email, rol, estado');
        $this->db->from('usuarios');
        $this->db->where('id', $id);
        $this->db->where_in('rol', array('1', '2'));
        
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Actualizar datos de un usuario
     * @param array $data Datos del usuario a actualizar
     * @return bool True si se actualizó correctamente
     */
    public function actualizar_usuario($data) {
        $id = $data['id'];
        
        $update_data = array('nombre' => $data['nombre'], 'email' => $data['email']);
        
        // Solo actualizar contraseña si se proporcionó una nueva
        if (!empty($data['password'])) {
            $update_data['password'] = md5($data['password']);
        }
        
        $this->db->where('id', $id);
        $this->db->where_in('rol', array('1', '2'));
        
        return $this->db->update('usuarios', $update_data);
    }

    /**
     * Verificar si un email ya existe (excepto para el usuario actual)
     * @param string $email Email a verificar
     * @param int $id_usuario ID del usuario actual (para excluirlo de la búsqueda)
     * @return bool True si el email ya existe
     */
    public function email_existe($email, $id_usuario = null) {
        $this->db->from('usuarios');
        $this->db->where('email', $email);
        
        if ($id_usuario) {
            $this->db->where('id !=', $id_usuario);
        }
        
        return $this->db->count_all_results() > 0;
    }
}
?>
