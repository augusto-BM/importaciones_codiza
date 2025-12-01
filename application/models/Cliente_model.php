<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Obtener todos los clientes activos
     * @return array
     */
    public function obtener_clientes() {
        $this->db->select('id_cliente, nombre, documento, imagen');
        $this->db->from('clientes');
        $this->db->where('cji_flagestado', '1');
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Obtener cliente por ID
     * @param int $id_oculto (se mapea a id_cliente en BD)
     * @return object|null
     */
    public function obtener_cliente_por_id($id_oculto) {
        $this->db->select('id_cliente as id_oculto, nombre, documento, imagen, cji_flagestado');
        $this->db->from('clientes');
        $this->db->where('id_cliente', $id_oculto);
        $query = $this->db->get();
        return $query->row();
    }
    
    /**
     * Verificar si existe documento duplicado
     * @param string $documento
     * @param int|null $id_oculto (excluir de la búsqueda - se mapea a id_cliente en BD)
     * @return bool
     */
    public function existe_documento($documento, $id_oculto = null) {
        $this->db->where('documento', $documento);
        $this->db->where('cji_flagestado !=', '2');
        if ($id_oculto) {
            $this->db->where('id_cliente !=', $id_oculto);
        }
        $query = $this->db->get('clientes');
        return $query->num_rows() > 0;
    }
    
    /**
     * Obtener la imagen actual de un cliente
     * @param int $id_oculto (se mapea a id_cliente en BD)
     * @return string|null
     */
    public function obtener_imagen_actual($id_oculto) {
        $this->db->select('imagen');
        $this->db->from('clientes');
        $this->db->where('id_cliente', $id_oculto);
        $query = $this->db->get();
        $resultado = $query->row();
        return $resultado ? $resultado->imagen : null;
    }

    /**
     * Insertar nuevo cliente
     * @param array $datos
     * @return bool
     */
    public function insertar_cliente($datos) {
        return $this->db->insert('clientes', $datos);
    }

    /**
     * Actualizar cliente
     * @param int $id_oculto (se mapea a id_cliente en BD)
     * @param array $datos
     * @return bool
     */
    public function actualizar_cliente($id_oculto, $datos) {
        $this->db->where('id_cliente', $id_oculto);
        return $this->db->update('clientes', $datos);
    }

    /**
     * Cambiar estado del cliente (activo/inactivo)
     * @param int $id_oculto (se mapea a id_cliente en BD)
     * @param int $nuevo_estado
     * @return bool
     */
    public function cambiar_estado_cliente($id_oculto, $nuevo_estado) {
        $datos = array('cji_flagestado' => $nuevo_estado);
        $this->db->where('id_cliente', $id_oculto);
        return $this->db->update('clientes', $datos);
    }

    /**
     * Obtener clientes con filtros para DataTables
     * @param object $filter - Filtros de búsqueda, paginación y ordenamiento
     * @return array
     */
    public function getClientes($filter) {
        // Construir condiciones WHERE
        $where = [];
        $params = [];
        
        // Filtro por estado
        if (isset($filter->estado) && $filter->estado != '2') {
            $where[] = "cji_flagestado = ?";
            $params[] = $filter->estado;
        } else {
            $where[] = "cji_flagestado IN ('0', '1')";
        }
        
        // Filtro por nombre
        if (!empty($filter->nombre)) {
            $where[] = "nombre LIKE ?";
            $params[] = '%' . $filter->nombre . '%';
        }
        
        // Filtro por documento
        if (!empty($filter->documento)) {
            $where[] = "documento LIKE ?";
            $params[] = '%' . $filter->documento . '%';
        }
        
        // Búsqueda general de DataTables
        if (!empty($filter->search)) {
            $where[] = "(nombre LIKE ? OR documento LIKE ?)";
            $params[] = '%' . $filter->search . '%';
            $params[] = '%' . $filter->search . '%';
        }
        
        $whereClause = implode(' AND ', $where);
        
        // Consulta para contar registros filtrados
        $sqlCount = "SELECT COUNT(*) as total FROM clientes WHERE " . $whereClause;
        $queryCount = $this->db->query($sqlCount, $params);
        $recordsFilter = $queryCount->row()->total;
        
        // Paginación
        $limit = '';
        if (isset($filter->start) && isset($filter->length) && $filter->length != -1) {
            $limit = " LIMIT " . intval($filter->length) . " OFFSET " . intval($filter->start);
        }
        
        // Consulta principal - ordenamiento fijo por nombre ASC
        $sql = "SELECT id_cliente, nombre, documento, cji_flagestado, imagen 
                FROM clientes 
                WHERE " . $whereClause . " 
                ORDER BY nombre ASC" . $limit;
        
        $query = $this->db->query($sql, $params);
        $records = $query->result();
        
        // Total de registros sin filtro
        $sqlTotal = "SELECT COUNT(*) as total FROM clientes WHERE cji_flagestado IN ('0', '1')";
        $queryTotal = $this->db->query($sqlTotal);
        $recordsTotal = $queryTotal->row()->total;
        
        return [
            "recordsTotal" => $recordsTotal,
            "recordsFilter" => $recordsFilter,
            "records" => $records
        ];
    }
}
