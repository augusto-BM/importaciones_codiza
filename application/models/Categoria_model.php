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

    public function getCategoriaConTipo($id) {
        $this->db->select('c.id_categoria, c.nombre as categoria_nombre, t.id_tipocategoria, t.nombre as tipo_nombre');
        $this->db->from('categorias c');
        $this->db->join('tipo_categoria t', 'c.id_tipocategoria = t.id_tipocategoria', 'left');
        $this->db->where('c.id_categoria', $id);
        $this->db->where('c.cji_flagestado', '1');
        return $this->db->get()->row();
    }

    public function actualizarCategoria($id, $nombre) {
        $this->db->where("id", $id)->update("categorias", ["nombre" => $nombre]);
    }

    public function eliminarCategoria($id) {
        $this->db->where("id", $id)->delete("categorias");
    }
}
?>
