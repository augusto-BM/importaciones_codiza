<?php
class Categoria_model extends CI_Model {

        public function __construct() {
        parent::__construct();
        $this->load->database(); // <- ESTO ES OBLIGATORIO
    }

    public function getCategorias() {
        return $this->db->get("categorias")->result();
    }

    public function insertarCategoria($nombre) {
        $this->db->insert("categorias", ["nombre" => $nombre]);
    }

    public function getCategoria($id) {
        return $this->db->where("id", $id)->get("categorias")->row();
    }

    public function actualizarCategoria($id, $nombre) {
        $this->db->where("id", $id)->update("categorias", ["nombre" => $nombre]);
    }

    public function eliminarCategoria($id) {
        $this->db->where("id", $id)->delete("categorias");
    }
}
?>
