<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

    public function get_productos_por_categoria($categoria_id) {
        return $this->db
            ->select('id_producto, nombre, precio')
            ->from('productos')
            ->where('id_categoria', $categoria_id)
            ->where('cji_flagestado', '1')
            ->get()
            ->result();
    }

    public function getProductosPorCategoria($id_categoria) {
        $this->db->select('id_producto, nombre, precio, imagen1');
        $this->db->from('productos');
        $this->db->where('id_categoria', $id_categoria);
        $this->db->where('cji_flagestado', '1');
        $this->db->order_by('nombre', 'ASC');
        return $this->db->get()->result();
    }

    public function get_categoria_por_nombre($nombre)
    {
        return $this->db
            ->where('nombre', $nombre)
            ->where('cji_flagestado', '1')
            ->get('categorias')
            ->row();
    }

        public function obtenerPorId($id)
    {
        $this->db->select('p.id_producto, p.nombre, p.precio, p.descripcion, p.etiquetas, p.imagen1, p.imagen2, p.imagen3, p.imagen4, p.imagen5, p.id_categoria, c.nombre AS categoria_nombre, tc.nombre AS tipo_nombre');
        $this->db->from('productos p');
        $this->db->join('categorias c', 'c.id_categoria = p.id_categoria', 'left');
        $this->db->join('tipo_categoria tc', 'tc.id_tipocategoria = c.id_tipocategoria', 'left');
        $this->db->where('p.id_producto', $id);
        $this->db->where('p.cji_flagestado', '1');

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
            ->join("categorias c", "c.id_categoria = p.id_categoria", "left")
            ->where("p.cji_flagestado", "1")
            ->get()
            ->result();
    }

    // =======================================
    // OBTENER UN SOLO PRODUCTO
    // =======================================
    public function getProducto($id) {
        $this->db->select("p.*, c.nombre AS categoria");
        $this->db->from("productos p");
        $this->db->join("categorias c", "c.id_categoria = p.id_categoria", "left");
        $this->db->where("p.id_producto", $id);
        $this->db->where("p.cji_flagestado", "1");
        return $this->db->get()->row();
    }


    // =======================================
    // INSERTAR PRODUCTO (devuelve el ID)
    // =======================================
    public function insertarProducto($nombre, $categoria_id, $precio, $descripcion) {

        $data = [
            "nombre"       => $nombre,
            "id_categoria" => $categoria_id,
            "precio"       => $precio,
            "descripcion"  => $descripcion,
            "cji_flagestado" => "1"
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
            "id_categoria" => $categoria_id,
            "precio"       => $precio,
            "descripcion"  => $descripcion
        ];

        $this->db->where("id_producto", $id)->update("productos", $data);
    }

    // =======================================
    // ELIMINAR PRODUCTO
    // =======================================
    public function eliminarProducto($id) {
        $this->db->where("id_producto", $id)->update("productos", ["cji_flagestado" => "2"]);
    }
}
