<?php
class Menu_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // <- ESTO ES OBLIGATORIO
    }

    public function getCategoriasConProductos() {
        return $this->db
            ->select("c.id as categoria_id, c.nombre as categoria, p.id as producto_id, p.nombre as producto")
            ->from("categorias c")
            ->join("productos p", "p.categoria_id = c.id", "left")
            ->order_by("c.nombre", "ASC")
            ->get()
            ->result();
    }
}
?>
