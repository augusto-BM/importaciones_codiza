<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Categoria_model');
        $this->load->model('Producto_model');
        $this->load->model('Menu_model');
        $this->load->model("Tipo_categoria_model");
        $this->load->helper(array('form', 'url', 'file', 'html_components'));
        $this->load->library(array('form_validation', 'upload', 'session'));
    }

    public function datatable_categorias() {
        if (!$this->session->userdata("logeado")) {
            echo json_encode(['data' => [], 'recordsTotal' => 0, 'recordsFiltered' => 0]);
            return;
        }

        $filter = new stdClass();
        $filter->start = $this->input->post("start");
        $filter->length = $this->input->post("length");
        $filter->search = $this->input->post("search")["value"];
        $filter->estado = $this->input->post("estado");
        $filter->nombre = $this->input->post("nombre");
        $filter->id_tipocategoria = $this->input->post("id_tipocategoria");

        $categorias = $this->Categoria_model->getCategoriasTabla($filter);

        $data = [];
        if (!empty($categorias["records"])) {
            foreach ($categorias["records"] as $categoria) {
                $img_html = generar_imagen('categorias', $categoria->imagen, $categoria->nombre);
                $btn_estado = generar_boton_estado($categoria->id_categoria, $categoria->cji_flagestado);
                $btn_editar = generar_boton_editar($categoria->id_categoria);
                $data[] = [
                    $categoria->id_categoria,
                    $categoria->nombre,
                    $categoria->tipo_nombre,
                    $img_html,
                    $btn_estado,
                    $btn_editar
                ];
            }
        }

        $json = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $categorias["recordsTotal"],
            "recordsFiltered" => $categorias["recordsFilter"],
            "data" => $data,
        );

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function obtener_categoria() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_oculto = $this->input->post('id_oculto');
        if (empty($id_oculto)) {
            echo json_encode(['success' => false, 'message' => 'ID de categoría no proporcionado']);
            return;
        }

        $categoria = $this->Categoria_model->obtener_categoria_por_id($id_oculto);

        if ($categoria) {
            echo json_encode(['success' => true, 'data' => $categoria]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Categoría no encontrada']);
        }
    }

    public function guardar_categoria() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_oculto = $this->input->post('id_oculto');
        $nombre = trim($this->input->post('nombre'));
        $id_tipocategoria = $this->input->post('id_tipocategoria');

        #log_message('debug', 'Guardar categoría - ID: ' . $id_oculto . ', Nombre: ' . $nombre . ', Tipo: ' . $id_tipocategoria);

        if (empty($nombre)) {
            echo json_encode(['success' => false, 'message' => 'El nombre de la categoría es obligatorio']);
            return;
        }
        if (empty($id_tipocategoria)) {
            echo json_encode(['success' => false, 'message' => 'El tipo de categoría es obligatorio']);
            return;
        }

        $existe_categoria = $this->Categoria_model->existe_categoria($nombre, $id_oculto);
            if ($existe_categoria) {
                echo json_encode(['success' => false, 'message' => 'El nombre de la categoría ya está registrado']);
                return;
        }

        $datos = array('nombre' => $nombre, 'id_tipocategoria' => $id_tipocategoria);

        $nombre_imagen = $this->procesar_imagen_subida($id_oculto);
        if ($nombre_imagen !== false) {
            $datos['imagen'] = $nombre_imagen;
        }

        if (empty($id_oculto)) {
            $datos['cji_flagestado'] = '1';
            $resultado = $this->Categoria_model->insertar_categoria($datos);
            $mensaje = $resultado ? 'Categoría registrada exitosamente' : 'Error al registrar la categoría';
        } else {
            $resultado = $this->Categoria_model->actualizar_categoria($id_oculto, $datos);
            $mensaje = $resultado ? 'Categoría actualizada exitosamente' : 'Error al actualizar la categoría';
        }
        echo json_encode(['success' => $resultado, 'message' => $mensaje]);
    }

    public function cambiar_estado_categoria() {
        if (!$this->session->userdata("logeado")) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            return;
        }

        $id_oculto = $this->input->post('id_oculto');
        $estado_actual = $this->input->post('estado_actual');

        if (!$id_oculto || !isset($estado_actual)) {
            echo json_encode(['success' => false, 'message' => 'Datos no válidos']);
            return;
        }

        $nuevo_estado = ($estado_actual == 1) ? 0 : 1;
        $resultado = $this->Categoria_model->cambiar_estado_categoria($id_oculto, $nuevo_estado);

        header('Content-Type: application/json');
        if ($resultado) {
            $estado_texto = ($nuevo_estado == 1) ? 'ACTIVO' : 'INACTIVO';
            echo json_encode([
                'success' => true,
                'message' => 'Estado cambiado a ' . $estado_texto . ' correctamente',
                'nuevo_estado' => $nuevo_estado
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al cambiar el estado']);
        }
    }

    private function procesar_imagen_subida($id_oculto = null) {
        if (empty($_FILES['imagen']['name'])) {
            return false;
        }
        $config['upload_path'] = './images/categorias/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = true;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        $this->upload->initialize($config);
        if ($this->upload->do_upload('imagen')) {
            $upload_data = $this->upload->data();
            $nombre_imagen = $upload_data['file_name'];
            if ($id_oculto) {
                $this->eliminar_imagen_anterior($id_oculto);
            }
            return $nombre_imagen;
        } else {
            log_message('error', 'Error al subir imagen: ' . $this->upload->display_errors('', ''));
            return false;
        }
    }

    private function eliminar_imagen_anterior($id_oculto) {
        $imagen_actual = $this->Categoria_model->obtener_imagen_actual($id_oculto);
        if ($imagen_actual && !empty($imagen_actual)) {
            $ruta_imagen = './images/categorias/' . $imagen_actual;
            if (file_exists($ruta_imagen)) {
                @unlink($ruta_imagen);
            }
        }
    }

    private function tiposCategoriasMenu() {
        $dataDB = $this->Menu_model->getTiposCategoriasConCategorias();

        $menu = [];

        foreach ($dataDB as $row) {
            $tipo = $row->tipo_nombre;

            if (!isset($menu[$tipo])) {
                $menu[$tipo] = [];
            }

            if ($row->categoria_nombre != null) {
                $menu[$tipo][] = [
                    "id" => $row->id_categoria,
                    "nombre" => $row->categoria_nombre
                ];
            }
        }

        return $menu;
    }

    // ===========================
    // LISTAR CATEGORÍAS
    // ===========================
    public function listar() {
        $data["categorias"] = $this->Categoria_model->getCategorias();
        $this->load->view("categorias/listar", $data);
    }

    // ===========================
    // AGREGAR CATEGORÍA
    // ===========================
    public function agregar() {

        if ($this->input->post()) {
            $nombre = $this->input->post("nombre");

            $this->Categoria_model->insertarCategoria($nombre);

            redirect(base_url("categoria/listar"));
        }

        $this->load->view("categorias/agregar");
    }

    // ===========================
    // EDITAR CATEGORÍA
    // ===========================
    public function editar($id) {

        $data["categoria"] = $this->Categoria_model->getCategoria($id);

        if ($this->input->post()) {
            $nombre = $this->input->post("nombre");

            $this->Categoria_model->actualizarCategoria($id, $nombre);

            redirect(base_url("categoria/listar"));
        }

        $this->load->view("categorias/editar", $data);
    }

    // ===========================
    // ELIMINAR CATEGORÍA
    // ===========================
    public function eliminar($id) {
        $this->Categoria_model->eliminarCategoria($id);
        redirect(base_url("categoria/listar"));
    }

    // ===========================
    // VER CATEGORÍA (FRONTEND)
    // ===========================
    public function ver($id = null) {
        // Validar que se envió un ID
        if ($id === null) {
            redirect(base_url('inicio'));
            return;
        }
        
        // Obtener información de la categoría
        $categoria = $this->Categoria_model->getCategoriaConTipo($id);
        
        // Si no existe la categoría, redirigir
        if (!$categoria) {
            redirect(base_url('inicio'));
            return;
        }
        
        // Obtener productos de la categoría
        $productos = $this->Producto_model->getProductosPorCategoria($id);
        
        // Cargar datos del menú para el header
        $data["menuTiposCategorias"] = $this->tiposCategoriasMenu();
        $data["categoria"] = $categoria;
        $data["productos"] = $productos;
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        
        $this->load->view("templates/header", $data);
        $this->load->view("categorias/ver", $data);
        $this->load->view("templates/footer");
    }

}

