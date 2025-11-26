<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_categoria_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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

    /**
     * Obtener todos los tipos de categoría (activos e inactivos)
     * @return array
     */
    public function obtener_todos() {
        $this->db->select('id_tipocategoria, nombre, cji_flagestado');
        $this->db->from('tipo_categoria');
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Obtener un tipo de categoría por ID
     * @param int $id
     * @return object|null
     */
    public function obtener_por_id($id) {
        $this->db->select('id_tipocategoria, nombre, cji_flagestado');
        $this->db->from('tipo_categoria');
        $this->db->where('id_tipocategoria', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Insertar un nuevo tipo de categoría
     * @param array $data
     * @return int ID insertado
     */
    public function insertar($data) {
        $datos = array(
            'nombre' => $data['nombre'],
            'cji_flagestado' => isset($data['cji_flagestado']) ? $data['cji_flagestado'] : '1'
        );
        $this->db->insert('tipo_categoria', $datos);
        return $this->db->insert_id();
    }

    /**
     * Actualizar un tipo de categoría
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function actualizar($id, $data) {
        $datos = array(
            'nombre' => $data['nombre'],
            'cji_flagestado' => isset($data['cji_flagestado']) ? $data['cji_flagestado'] : '1'
        );
        $this->db->where('id_tipocategoria', $id);
        return $this->db->update('tipo_categoria', $datos);
    }

    /**
     * Cambiar estado de un tipo de categoría
     * @param int $id
     * @param string $estado '1' = ACTIVO, '2' = INACTIVO
     * @return bool
     */
    public function cambiar_estado($id, $estado) {
        $this->db->where('id_tipocategoria', $id);
        return $this->db->update('tipo_categoria', array('cji_flagestado' => $estado));
    }

    /**
     * Eliminar un tipo de categoría (eliminación lógica)
     * @param int $id
     * @return bool
     */
    public function eliminar($id) {
        return $this->cambiar_estado($id, '2');
    }

    /**
     * Contar tipos de categoría activos
     * @return int
     */
    public function contar_activos() {
        $this->db->from('tipo_categoria');
        $this->db->where('cji_flagestado', '1');
        return $this->db->count_all_results();
    }
}
