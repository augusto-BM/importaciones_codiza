<?php
class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // <- ESTO ES OBLIGATORIO
    }

    public function verificarUsuario($usuario, $password_md5) {
        $this->db->where("email", $usuario);
        $this->db->where("password", $password_md5);
        $this->db->where_in("rol", array("1", "2")); // Solo 1: soporte o 2: dueño
        $this->db->where("estado", "1"); // Solo usuarios activos

        $query = $this->db->get("usuarios");

        return $query->row(); // Si encuentra, retorna datos
    }
}
?>
