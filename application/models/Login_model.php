<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // <- ESTO ES OBLIGATORIO
    }

    /**
     * Verificar usuario con soporte para bcrypt y migración automática desde MD5
     * @param string $usuario Email del usuario
     * @param string $password Contraseña en texto plano
     * @return object|null Datos del usuario si es válido
     */
    public function verificarUsuario($usuario, $password) {
        // Usar query builder con parámetros posicionales para prevenir SQL injection
        $this->db->select('id, nombre, email, password, rol, estado');
        $this->db->from('usuarios');
        $this->db->where('email', $usuario);
        $this->db->where_in('rol', array('1', '2')); // Solo 1: soporte o 2: dueño
        $this->db->where('estado', '1'); // Solo usuarios activos
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if ($query->num_rows() === 0) {
            return NULL;
        }
        
        $user = $query->row();
        
        // Verificar si la contraseña es válida
        // Primero intentar con bcrypt (formato moderno)
        if (password_verify($password, $user->password)) {
            // Contraseña válida con bcrypt
            return $user;
        }
        
        // Si falla bcrypt, intentar con MD5 (formato legacy)
        $password_md5 = md5($password);
        if ($user->password === $password_md5) {
            // Contraseña válida con MD5 legacy - MIGRAR a bcrypt automáticamente
            $this->_migrate_password_to_bcrypt($user->id, $password);
            return $user;
        }
        
        // Contraseña inválida
        return NULL;
    }

    /**
     * Migrar contraseña de MD5 a bcrypt automáticamente
     * @param int $user_id ID del usuario
     * @param string $password Contraseña en texto plano
     */
    private function _migrate_password_to_bcrypt($user_id, $password) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $this->db->where('id', $user_id);
        $this->db->update('usuarios', array('password' => $password_hash));
    }
}
?>
