<?php
class Categoria_model extends CI_Model {

        public function __construct() {
        parent::__construct();
        $this->load->database(); // <- ESTO ES OBLIGATORIO
    }

    public function getCategorias() {
        $this->db->where("cji_flagestado", "1");
        return $this->db->get("categorias")->result();
    }

    public function insertarCategoria($nombre, $id_tipocategoria = null) {
        $data = [
            "nombre" => $nombre,
            "id_tipocategoria" => $id_tipocategoria,
            "cji_flagestado" => "1"
        ];
        $this->db->insert("categorias", $data);
    }

    public function getCategoria($id) {
        return $this->db->where("id_categoria", $id)->get("categorias")->row();
    }

    public function getCategoriaConTipo($id) {
        $this->db->select('c.id_categoria, c.nombre as categoria_nombre, t.id_tipocategoria, t.nombre as tipo_nombre');
        $this->db->from('categorias c');
        $this->db->join('tipo_categoria t', 'c.id_tipocategoria = t.id_tipocategoria', 'left');
        $this->db->where('c.id_categoria', $id);
        $this->db->where('c.cji_flagestado', '1');
        return $this->db->get()->row();
    }

    public function actualizarCategoria($id, $nombre, $id_tipocategoria = null) {
        $data = ["nombre" => $nombre];
        if ($id_tipocategoria !== null) {
            $data["id_tipocategoria"] = $id_tipocategoria;
        }
        $this->db->where("id_categoria", $id)->update("categorias", $data);
    }

    public function eliminarCategoria($id) {
        $this->db->where("id_categoria", $id)->update("categorias", ["cji_flagestado" => "2"]);
    }
}
?>
