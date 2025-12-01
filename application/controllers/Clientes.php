<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cliente_model');
        $this->load->helper(array('form', 'url', 'file', 'html_components'));
        $this->load->library(array('form_validation', 'upload', 'session'));

    }

    public function datatable_clientes() {
        if (!$this->session->userdata("logeado")) {
            echo json_encode(['data' => [], 'recordsTotal' => 0, 'recordsFiltered' => 0]);
            return;
        }

        // Crear objeto de filtros
        $filter = new stdClass();
        $filter->start = $this->input->post("start");
        $filter->length = $this->input->post("length");
        $filter->search = $this->input->post("search")["value"];

        // Filtros personalizados
        $filter->estado = $this->input->post("estado");
        $filter->nombre = $this->input->post("nombre");
        $filter->documento = $this->input->post("documento");

        // Obtener resultados del modelo
        $clientes = $this->Cliente_model->getClientes($filter);

        $data = [];
        if (!empty($clientes["records"])) {
            foreach ($clientes["records"] as $cliente) {
                // Renderizar imagen usando función del helper
                $img_html = generar_imagen('clientes', $cliente->imagen, $cliente->nombre);

                // Botón de estado usando función del helper
                $btn_estado = generar_boton_estado($cliente->id_cliente, $cliente->cji_flagestado);

                // Botón editar usando función del helper
                $btn_editar = generar_boton_editar($cliente->id_cliente);

                $data[] = [
                    $cliente->id_cliente,
                    $cliente->nombre,
                    $cliente->documento,
                    $img_html,
                    $btn_estado,
                    $btn_editar
                ];
            }
        }

        $json = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $clientes["recordsTotal"],
            "recordsFiltered" => $clientes["recordsFilter"],
            "data" => $data,
        );

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function obtener_cliente() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_oculto = $this->input->post('id_oculto');
        
        if (empty($id_oculto)) {
            echo json_encode(['success' => false, 'message' => 'ID de cliente no proporcionado']);
            return;
        }

        $cliente = $this->Cliente_model->obtener_cliente_por_id($id_oculto);

        if ($cliente) {
            echo json_encode(['success' => true, 'data' => $cliente]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cliente no encontrado']);
        }
    }

    /**
     * Guardar o actualizar cliente
     */
    public function guardar_cliente() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_oculto = $this->input->post('id_oculto');
        $nombre = trim($this->input->post('nombre'));
        $documento = trim($this->input->post('documento'));
        
        // Debug: log para verificar datos recibidos
        log_message('debug', 'Guardar cliente - ID: ' . $id_oculto . ', Nombre: ' . $nombre . ', Documento: ' . $documento);
        
        // Validaciones
        if (empty($nombre)) {
            echo json_encode(['success' => false, 'message' => 'El nombre del cliente es obligatorio']);
            return;
        }

        // Verificar documento duplicado solo si NO está vacío
        if (!empty($documento)) {
            $existe_documento = $this->Cliente_model->existe_documento($documento, $id_oculto);
            if ($existe_documento) {
                echo json_encode(['success' => false, 'message' => 'El documento ya está registrado']);
                return;
            }
        }

        // Preparar datos
        $datos = array(
            'nombre' => $nombre, 
            'documento' => !empty($documento) ? $documento : null
        );

        // Manejo de imagen
        $nombre_imagen = $this->procesar_imagen_subida($id_oculto);
        if ($nombre_imagen !== false) {
            $datos['imagen'] = $nombre_imagen;
        }

        // Guardar o actualizar
        if (empty($id_oculto)) {
            // Nuevo cliente
            $datos['cji_flagestado'] = '1';
            $resultado = $this->Cliente_model->insertar_cliente($datos);
            $mensaje = $resultado ? 'Cliente registrado exitosamente' : 'Error al registrar el cliente';
        } else {
            // Actualizar cliente
            $resultado = $this->Cliente_model->actualizar_cliente($id_oculto, $datos);
            $mensaje = $resultado ? 'Cliente actualizado exitosamente' : 'Error al actualizar el cliente';
        }
        echo json_encode(['success' => $resultado, 'message' => $mensaje]);
    }

    public function cambiar_estado_cliente() {
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

        // Cambiar el estado: si es 1 pasa a 0, si es 0 pasa a 1
        $nuevo_estado = ($estado_actual == 1) ? 0 : 1;

        $resultado = $this->Cliente_model->cambiar_estado_cliente($id_oculto, $nuevo_estado);
        
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
        // Verificar si se subió un archivo
        if (empty($_FILES['imagen']['name'])) {
            return false;
        }

        // Configuración de subida
        $config['upload_path'] = './images/clientes/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = true;

        // Crear directorio si no existe
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagen')) {
            $upload_data = $this->upload->data();
            $nombre_imagen = $upload_data['file_name'];

            // Si es actualización, eliminar imagen anterior
            if ($id_oculto) {
                $this->eliminar_imagen_anterior($id_oculto);
            }

            return $nombre_imagen;
        } else {
            // Si hay error en la subida, registrar pero no detener el proceso
            log_message('error', 'Error al subir imagen: ' . $this->upload->display_errors('', ''));
            return false;
        }
    }

    private function eliminar_imagen_anterior($id_oculto) {
        $imagen_actual = $this->Cliente_model->obtener_imagen_actual($id_oculto);
        
        if ($imagen_actual && !empty($imagen_actual)) {
            $ruta_imagen = './images/clientes/' . $imagen_actual;
            if (file_exists($ruta_imagen)) {
                @unlink($ruta_imagen);
            }
        }
    }


}
