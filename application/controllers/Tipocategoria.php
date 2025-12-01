<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipocategoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Categoria_model");
        $this->load->model("Menu_model");
        $this->load->model("Producto_model");
        $this->load->model("Tipo_categoria_model");
        $this->load->helper('html_components');
        $this->load->library('session');
    }

    public function datatable_tiposcategorias() {
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

        $categorias = $this->Tipo_categoria_model->getTiposCategoriasTabla($filter);

        $data = [];
        if (!empty($categorias["records"])) {
            foreach ($categorias["records"] as $categoria) {
                $btn_estado = generar_boton_estado($categoria->id_tipocategoria, $categoria->cji_flagestado);
                $btn_editar = generar_boton_editar($categoria->id_tipocategoria);
                $data[] = [
                    $categoria->id_tipocategoria,
                    $categoria->nombre,
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

    public function cambiar_estado_tipocategoria() {
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
        $resultado = $this->Tipo_categoria_model->cambiar_estado_tipocategoria($id_oculto, $nuevo_estado);

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

    public function obtener_tipocategoria() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_oculto = $this->input->post('id_oculto');
        if (empty($id_oculto)) {
            echo json_encode(['success' => false, 'message' => 'ID de categoría no proporcionado']);
            return;
        }

        $tipo_categoria = $this->Tipo_categoria_model->obtener_por_id($id_oculto);

        if ($tipo_categoria) {
            echo json_encode(['success' => true, 'data' => $tipo_categoria]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tipo de categoría no encontrada']);
        }
    }

    public function guardar_tipocategoria() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_oculto = $this->input->post('id_oculto');
        $nombre = trim($this->input->post('nombre'));

        #log_message('debug', 'Guardar categoría - ID: ' . $id_oculto . ', Nombre: ' . $nombre . ', Tipo: ' . $id_tipocategoria);

        if (empty($nombre)) {
            echo json_encode(['success' => false, 'message' => 'El nombre de la categoría es obligatorio']);
            return;
        }

        $existe_tipo_categoria = $this->Tipo_categoria_model->existe_tipo_categoria($nombre, $id_oculto);
            if ($existe_tipo_categoria) {
                echo json_encode(['success' => false, 'message' => 'El nombre del tipo de categoría ya está registrado']);
                return;
        }

        $datos = array('nombre' => $nombre);

        // Eliminado manejo de imagen, no se usa en esta vista

        if (empty($id_oculto)) {
            $datos['cji_flagestado'] = '1';
            $resultado = $this->Tipo_categoria_model->insertar_categoria($datos);
            $mensaje = $resultado ? 'Tipo de categoría registrada exitosamente' : 'Error al registrar el tipo de categoría';
        } else {
            $resultado = $this->Tipo_categoria_model->actualizar_categoria($id_oculto, $datos);
            $mensaje = $resultado ? 'Tipo de categoría actualizada exitosamente' : 'Error al actualizar el tipo de categoría';
        }
        echo json_encode(['success' => $resultado, 'message' => $mensaje]);
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
                    "id" => $row->id_tipocategoria,
                    "nombre" => $row->categoria_nombre
                ];
            }
        }

        return $menu;
    }


}
?>
