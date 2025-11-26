<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

    public function get_productos_por_categoria($categoria_id) {
        return $this->db
            ->select('id, nombre, precio')
            ->from('productos')
            ->where('categoria_id', $categoria_id)
            ->get()
            ->result();
    }

    public function get_categoria_por_nombre($nombre)
    {
        return $this->db
            ->where('nombre', $nombre)
            ->get('categorias')
            ->row();
    }

        public function obtenerPorId($id)
    {
        $this->db->select('p.*, c.nombre AS categoria_nombre');
        $this->db->from('productos p');
        $this->db->join('categorias c', 'c.id = p.categoria_id', 'left');
        $this->db->where('p.id', $id);

        $query = $this->db->get();
        return $query->row(); // devuelve SOLO una fila
    }

 // =======================================
    // LISTAR TODOS LOS PRODUCTOS
    // =======================================
    public function getProductos() {
        return $this->db
            ->select("p.*, c.nombre AS categoria_nombre")
            ->from("productos p")
            ->join("categorias c", "c.id = p.categoria_id", "left")
            ->get()
            ->result();
    }

    // =======================================
    // OBTENER UN SOLO PRODUCTO
    // =======================================
    public function getProducto($id) {
        $this->db->select("p.*, c.nombre AS categoria");
        $this->db->from("productos p");
        $this->db->join("categorias c", "c.id = p.categoria_id");
        $this->db->where("p.id", $id);
        return $this->db->get()->row();
    }


    // =======================================
    // INSERTAR PRODUCTO (devuelve el ID)
    // =======================================
    public function insertarProducto($nombre, $categoria_id, $precio, $descripcion) {

        $data = [
            "nombre"       => $nombre,
            "categoria_id" => $categoria_id,
            "precio"       => $precio,
            "descripcion"  => $descripcion
        ];

        $this->db->insert("productos", $data);

        return $this->db->insert_id(); // MUY IMPORTANTE
    }

    // =======================================
    // ACTUALIZAR PRODUCTO
    // =======================================
    public function actualizarProducto($id, $nombre, $categoria_id, $precio, $descripcion) {

        $data = [
            "nombre"       => $nombre,
            "categoria_id" => $categoria_id,
            "precio"       => $precio,
            "descripcion"  => $descripcion
        ];

        $this->db->where("id", $id)->update("productos", $data);
    }

    // =======================================
    // ELIMINAR PRODUCTO
    // =======================================
    public function eliminarProducto($id) {
        $this->db->where("id", $id)->delete("productos");
    }
}
