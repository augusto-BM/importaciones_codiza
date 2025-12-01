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

    // =======================================
    // ADMIN PANEL - DATATABLE
    // =======================================
    public function getProductosTabla($filter) {
        $this->db->select("p.id_producto, p.nombre, p.precio, p.descripcion, p.imagen1, p.imagen2, p.imagen3, p.imagen4, p.imagen5, p.imagendetalle, p.etiquetas, p.cji_flagestado, c.nombre AS categoria_nombre");
        $this->db->from("productos p");
        $this->db->order_by("p.nombre", "ASC");
        $this->db->join("categorias c", "c.id_categoria = p.id_categoria", "left");

        // Filtros
        if (isset($filter->estado) && $filter->estado != 2) {
            $this->db->where("p.cji_flagestado", $filter->estado);
        }
        if (!empty($filter->nombre)) {
            $this->db->like("p.nombre", $filter->nombre);
        }
        if (!empty($filter->id_categoria)) {
            $this->db->where("p.id_categoria", $filter->id_categoria);
        }

        $recordsTotal = $this->db->count_all_results("", false);

        if (!empty($filter->search)) {
            $this->db->group_start();
            $this->db->like("p.nombre", $filter->search);
            $this->db->or_like("c.nombre", $filter->search);
            $this->db->or_like("p.descripcion", $filter->search);
            $this->db->group_end();
        }

        $recordsFilter = $this->db->count_all_results("", false);

        if (isset($filter->start) && isset($filter->length)) {
            $this->db->limit($filter->length, $filter->start);
        }

        $this->db->order_by("p.id_producto", "DESC");
        $records = $this->db->get()->result();

        return [
            "recordsTotal" => $recordsTotal,
            "recordsFilter" => $recordsFilter,
            "records" => $records
        ];
    }

    public function existe_nombreProducto($nombre, $id_oculto = null) {
        $this->db->select('id_producto');
        $this->db->from('productos');
        $this->db->where('nombre', $nombre);
        if ($id_oculto) {
            $this->db->where('id_producto !=', $id_oculto);
        }
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    // =======================================
    // OBTENER PRODUCTO POR ID (ADMIN)
    // =======================================
    public function obtener_producto_por_id($id) {
        $this->db->select("p.*, c.nombre AS categoria_nombre");
        $this->db->from("productos p");
        $this->db->join("categorias c", "c.id_categoria = p.id_categoria", "left");
        $this->db->where("p.id_producto", $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $producto = $query->row();
            return [
                'id_oculto' => $producto->id_producto,
                'nombre' => $producto->nombre,
                'id_categoria' => $producto->id_categoria,
                'precio' => $producto->precio,
                'descripcion' => $producto->descripcion,
                'etiquetas' => $producto->etiquetas,
                'imagen1' => isset($producto->imagen1) ? $producto->imagen1 : '',
                'imagen2' => isset($producto->imagen2) ? $producto->imagen2 : '',
                'imagen3' => isset($producto->imagen3) ? $producto->imagen3 : '',
                'imagen4' => isset($producto->imagen4) ? $producto->imagen4 : '',
                'imagen5' => isset($producto->imagen5) ? $producto->imagen5 : '',
                'imagendetalle' => isset($producto->imagendetalle) ? $producto->imagendetalle : ''
            ];
        }
        return false;
    }

    // =======================================
    // INSERTAR PRODUCTO (ADMIN)
    // =======================================
    public function insertar_producto($datos) {
        return $this->db->insert("productos", $datos);
    }

    // =======================================
    // ACTUALIZAR PRODUCTO (ADMIN)
    // =======================================
    public function actualizar_producto($id, $datos) {
        $this->db->where("id_producto", $id);
        return $this->db->update("productos", $datos);
    }

    // =======================================
    // CAMBIAR ESTADO
    // =======================================
    public function cambiar_estado_producto($id, $nuevo_estado) {
        $this->db->where("id_producto", $id);
        return $this->db->update("productos", ["cji_flagestado" => $nuevo_estado]);
    }

    // =======================================
    // OBTENER IMAGEN ACTUAL
    // =======================================
    public function obtener_imagen_actual($id) {
        $this->db->select("imagen1, imagen2, imagen3, imagen4, imagen5, imagendetalle");
        $this->db->from("productos");
        $this->db->where("id_producto", $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }
}
