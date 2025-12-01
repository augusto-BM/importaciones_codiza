<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function obtener_categorias() {
        $this->db->select('c.id_categoria, c.nombre, c.imagen, c.id_tipocategoria, t.nombre as tipo_nombre');
        $this->db->from('categorias c');
        $this->db->join('tipo_categoria t', 'c.id_tipocategoria = t.id_tipocategoria', 'left');
        $this->db->where('c.cji_flagestado', '1');
        $this->db->order_by('c.nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_categoria_por_id($id_oculto) {
        $this->db->select('c.id_categoria as id_oculto, c.nombre, c.imagen, c.id_tipocategoria, t.nombre as tipo_nombre, c.cji_flagestado');
        $this->db->from('categorias c');
        $this->db->join('tipo_categoria t', 'c.id_tipocategoria = t.id_tipocategoria', 'left');
        $this->db->where('c.id_categoria', $id_oculto);
        $query = $this->db->get();
        return $query->row();
    }

    public function obtener_imagen_actual($id_oculto) {
        $this->db->select('imagen');
        $this->db->from('categorias');
        $this->db->where('id_categoria', $id_oculto);
        $query = $this->db->get();
        $resultado = $query->row();
        return $resultado ? $resultado->imagen : null;
    }

    public function insertar_categoria($datos) {
        return $this->db->insert('categorias', $datos);
    }

    public function actualizar_categoria($id_oculto, $datos) {
        $this->db->where('id_categoria', $id_oculto);
        return $this->db->update('categorias', $datos);
    }

    public function cambiar_estado_categoria($id_oculto, $nuevo_estado) {
        $datos = array('cji_flagestado' => $nuevo_estado);
        $this->db->where('id_categoria', $id_oculto);
        return $this->db->update('categorias', $datos);
    }

    public function getCategoriasTabla($filter) {
        $where = [];
        $params = [];
        if (isset($filter->estado) && $filter->estado != '2') {
            $where[] = "c.cji_flagestado = ?";
            $params[] = $filter->estado;
        } else {
            $where[] = "c.cji_flagestado IN ('0', '1')";
        }
        if (!empty($filter->nombre)) {
            $where[] = "c.nombre LIKE ?";
            $params[] = '%' . $filter->nombre . '%';
        }
        if (!empty($filter->id_tipocategoria)) {
            $where[] = "c.id_tipocategoria = ?";
            $params[] = $filter->id_tipocategoria;
        }
        if (!empty($filter->search)) {
            $where[] = "(c.nombre LIKE ? OR t.nombre LIKE ?)";
            $params[] = '%' . $filter->search . '%';
            $params[] = '%' . $filter->search . '%';
        }
        $whereClause = implode(' AND ', $where);
        $sqlCount = "SELECT COUNT(*) as total FROM categorias c LEFT JOIN tipo_categoria t ON c.id_tipocategoria = t.id_tipocategoria WHERE " . $whereClause;
        $queryCount = $this->db->query($sqlCount, $params);
        $recordsFilter = $queryCount->row()->total;
        $limit = '';
        if (isset($filter->start) && isset($filter->length) && $filter->length != -1) {
            $limit = " LIMIT " . intval($filter->length) . " OFFSET " . intval($filter->start);
        }
        $sql = "SELECT c.id_categoria, c.nombre, t.nombre as tipo_nombre, c.cji_flagestado, c.imagen FROM categorias c LEFT JOIN tipo_categoria t ON c.id_tipocategoria = t.id_tipocategoria WHERE " . $whereClause . " ORDER BY c.nombre ASC" . $limit;
        $query = $this->db->query($sql, $params);
        $records = $query->result();
        $sqlTotal = "SELECT COUNT(*) as total FROM categorias WHERE cji_flagestado IN ('0', '1')";
        $queryTotal = $this->db->query($sqlTotal);
        $recordsTotal = $queryTotal->row()->total;
        return [
            "recordsTotal" => $recordsTotal,
            "recordsFilter" => $recordsFilter,
            "records" => $records
        ];
    }
    public function getCategorias() {
        $this->db->where("cji_flagestado", "1");
        $this->db->order_by("nombre", "ASC");
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
        $this->db->select('c.id_categoria, c.nombre as categoria_nombre, c.imagen, t.id_tipocategoria, t.nombre as tipo_nombre');
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

    public function existe_categoria($nombre, $id_oculto = null) {
        $this->db->where('nombre', $nombre);
        $this->db->where('cji_flagestado !=', '2');
        if ($id_oculto) {
            $this->db->where('id_categoria !=', $id_oculto);
        }
        $query = $this->db->get('categorias');
        return $query->num_rows() > 0;
    }
}

?>
