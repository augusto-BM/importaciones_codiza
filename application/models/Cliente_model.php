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
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('cji_flagestado', '1');
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Obtener cliente por ID
     * @param int $id_cliente
     * @return object|null
     */
    public function obtener_cliente_por_id($id_cliente) {
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('id_cliente', $id_cliente);
        $this->db->where('cji_flagestado', '1');
        $query = $this->db->get();
        return $query->row();
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
     * @param int $id_cliente
     * @param array $datos
     * @return bool
     */
    public function actualizar_cliente($id_cliente, $datos) {
        $this->db->where('id_cliente', $id_cliente);
        return $this->db->update('clientes', $datos);
    }

    /**
     * Eliminar cliente (eliminación lógica)
     * @param int $id_cliente
     * @return bool
     */
    public function eliminar_cliente($id_cliente) {
        $datos = array('cji_flagestado' => '2');
        $this->db->where('id_cliente', $id_cliente);
        return $this->db->update('clientes', $datos);
    }
}
