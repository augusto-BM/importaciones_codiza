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

    public function getTiposCategorias()
    {
        return $this->db
            ->select("id_tipocategoria, nombre, cji_flagestado")
            ->from("tipo_categoria")
            ->where("cji_flagestado", "1")
            ->get()
            ->result();
    }

    public function getTiposCategoriasConCategorias() {
        return $this->db
            ->select("tc.id_tipocategoria, tc.nombre as tipo_nombre, c.id_categoria, c.nombre as categoria_nombre")
            ->from("tipo_categoria tc")
            ->join("categorias c", "c.id_tipocategoria = tc.id_tipocategoria AND c.cji_flagestado = '1'", "left")
            ->where("tc.cji_flagestado", "1")
            ->order_by("tc.id_tipocategoria", "ASC")
            ->order_by("c.nombre", "ASC")
            ->get()
            ->result();
    }

}
?>
