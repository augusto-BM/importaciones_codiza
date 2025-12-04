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
        // Query base con fields específicos (nunca seleccionar password)
        $this->db->select('id, nombre, email, rol, estado');
        $this->db->from('usuarios');
        
        // Filtrado por rol con parámetros seguros
        if ($rol_usuario == '2') {
            // Si es dueño (rol=2), solo mostrar su propio usuario
            $this->db->where('id', (int)$id_usuario);
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
        // Nunca retornar el campo password
        $this->db->select('id, nombre, email, rol, estado');
        $this->db->from('usuarios');
        $this->db->where('id', (int)$id);
        $this->db->where_in('rol', array('1', '2'));
        $this->db->limit(1);
        
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Actualizar datos de un usuario
     * @param array $data Datos del usuario a actualizar
     * @return bool True si se actualizó correctamente
     */
    public function actualizar_usuario($data) {
        $id = (int)$data['id'];
        
        // Preparar datos con validación
        $update_data = array(
            'nombre' => $this->db->escape_str($data['nombre']), 
            'email' => $this->db->escape_str($data['email'])
        );
        
        // Solo actualizar contraseña si se proporcionó una nueva
        if (!empty($data['password'])) {
            // Validar longitud mínima de contraseña
            if (strlen($data['password']) < 6) {
                return FALSE;
            }
            // Usar bcrypt para hashear la contraseña
            $update_data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        
        // Actualizar con parámetros seguros
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
        $this->db->where('email', $this->db->escape_str($email));
        
        if ($id_usuario) {
            $this->db->where('id !=', (int)$id_usuario);
        }
        
        return $this->db->count_all_results() > 0;
    }
}
?>
