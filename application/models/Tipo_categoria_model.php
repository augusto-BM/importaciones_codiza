<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_categoria_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getTiposCategoriasTabla($filter) {
        $where = [];
        $params = [];

        // Filtro por estado
        if (isset($filter->estado) && $filter->estado != '2') {
            $where[] = "cji_flagestado = ?";
            $params[] = $filter->estado;
        } else {
            $where[] = "cji_flagestado IN ('0', '1')";
        }

        // Filtro por nombre exacto o parcial
        if (!empty($filter->nombre)) {
            $where[] = "nombre LIKE ?";
            $params[] = '%' . $filter->nombre . '%';
        }

        // Filtro de búsqueda general
        if (!empty($filter->search)) {
            $where[] = "nombre LIKE ?";
            $params[] = '%' . $filter->search . '%';
        }

        // Construcción de la cláusula WHERE
        $whereClause = implode(' AND ', $where);

        // Contar registros filtrados
        $sqlCount = "SELECT COUNT(*) as total FROM tipo_categoria WHERE " . $whereClause;
        $queryCount = $this->db->query($sqlCount, $params);
        $recordsFilter = $queryCount->row()->total;

        // Paginación
        $limit = '';
        if (isset($filter->start) && isset($filter->length) && $filter->length != -1) {
            $limit = " LIMIT " . intval($filter->length) . " OFFSET " . intval($filter->start);
        }

        // Consulta principal
        $sql = "SELECT id_tipocategoria, nombre, cji_flagestado 
                FROM tipo_categoria 
                WHERE " . $whereClause . " 
                ORDER BY nombre ASC" . $limit;
        $query = $this->db->query($sql, $params);
        $records = $query->result();

        // Total de registros sin filtrar
        $sqlTotal = "SELECT COUNT(*) as total FROM tipo_categoria WHERE cji_flagestado IN ('0', '1')";
        $queryTotal = $this->db->query($sqlTotal);
        $recordsTotal = $queryTotal->row()->total;

        return [
            "recordsTotal" => $recordsTotal,
            "recordsFilter" => $recordsFilter,
            "records" => $records
        ];
    }


    /**
     * Obtener todos los tipos de categoría activos
     * @return array
     */
    public function obtener_tipos_activos() {
        $this->db->select('id_tipocategoria, nombre');
        $this->db->from('tipo_categoria');
        $this->db->where('cji_flagestado', '1');
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    
    public function obtener_por_id($id) {
        $this->db->select('id_tipocategoria, nombre, cji_flagestado');
        $this->db->from('tipo_categoria');
        $this->db->where('id_tipocategoria', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function cambiar_estado_tipocategoria($id_oculto, $nuevo_estado) {
        $datos = array('cji_flagestado' => $nuevo_estado);
        $this->db->where('id_tipocategoria', $id_oculto);
        return $this->db->update('tipo_categoria', $datos);
    }

    public function existe_tipo_categoria($nombre, $id_oculto = null) {
        $this->db->where('nombre', $nombre);
        $this->db->where('cji_flagestado != 2', null, false); 

        if ($id_oculto) {
            $this->db->where('id_tipocategoria !=', $id_oculto);
        }

        $query = $this->db->get('tipo_categoria');
        return $query->num_rows() > 0;
    }


    public function insertar_categoria($datos) {
        return $this->db->insert('tipo_categoria', $datos);
    }

    public function actualizar_categoria($id_oculto, $datos) {
        $this->db->where('id_tipocategoria', $id_oculto);
        return $this->db->update('tipo_categoria', $datos);
    }

    
}
