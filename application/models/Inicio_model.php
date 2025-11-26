<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio_model extends CI_Model {

    public function getServiciosActivos() {
        $this->db->select('id_servicio, nombre, imagen');
        $this->db->from('servicios');
        $this->db->where('cji_flagestado', '1');
        $this->db->order_by('id_servicio', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getCategoriasActivas() {            
        $this->db->select('id_categoria, nombre, imagen');
        $this->db->from('categorias');
        $this->db->where('cji_flagestado', '1');
        $this->db->order_by('nombre', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }
}

?>