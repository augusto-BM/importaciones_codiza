<?php
class Productos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model("Menu_model");
        $this->load->model("Producto_model"); // corregido
        $this->load->model("Categoria_model");
        $this->load->model("Tipo_categoria_model");
        $this->load->helper(array('form', 'url', 'file', 'html_components'));
        $this->load->library(array('form_validation', 'upload', 'session'));
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

    public function categoria($slug) {
        $data["menuTiposCategorias"] = $this->tiposCategoriasMenu();
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();

        // 1. Convertir slug a nombre
        $categoria_nombre = strtoupper($slug);

        // 2. Buscar la categoría para obtener el ID
        $categoria = $this->Producto_model->get_categoria_por_nombre($categoria_nombre);

        if (!$categoria) {
            show_404();
        }

        // 3. Obtener productos por ID
        $data['categoria'] = $categoria_nombre;
        
        $data['productos'] = $this->Producto_model->get_productos_por_categoria($categoria->id);

        // 4. Cargar vista
        $this->load->view("templates/header", $data);
        $this->load->view("categorias/plantilla_categoria", $data);
        $this->load->view("templates/footer");
    }

    public function detalle($id)
    {
        $data["menuTiposCategorias"] = $this->tiposCategoriasMenu();
        $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
        $data['producto'] = $this->Producto_model->obtenerPorId($id);
        
        if (!$data['producto']) {
            show_404();
        }
        
        $this->load->view("templates/header", $data);
        $this->load->view('producto/detalle', $data);
        $this->load->view("templates/footer");
    }
  
    // ===========================
    // ADMIN PANEL - INDEX VIEW
    // ===========================
    public function index() {
        if (!$this->session->userdata("logeado")) {
            redirect(base_url("login"));
        }
        $data["categorias"] = $this->Categoria_model->getCategorias();
        $this->load->view("productos", $data);
    }

    // ===========================
    // DATATABLE AJAX
    // ===========================
    public function datatable_productos() {
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
        $filter->id_categoria = $this->input->post("id_categoria");

        $productos = $this->Producto_model->getProductosTabla($filter);

        $data = [];
        if (!empty($productos["records"])) {
            foreach ($productos["records"] as $producto) {
                // Renderizar imagen usando función del helper
                $img_html = generar_imagen('productos', $producto->imagen1, $producto->nombre);

                // Botón de estado usando función del helper
                $btn_estado = generar_boton_estado($producto->id_producto, $producto->cji_flagestado);

                // Botón editar usando función del helper
                $btn_editar = generar_boton_editar($producto->id_producto);
                
                $descripcion_corta = strlen($producto->descripcion) > 50 ? substr($producto->descripcion, 0, 50) . '...' : $producto->descripcion;
                
                $data[] = [
                    $producto->id_producto,
                    $producto->nombre,
                    $producto->categoria_nombre,
                    $descripcion_corta,
                    $img_html,
                    $btn_estado,
                    $btn_editar
                ];
            }
        }

        $json = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $productos["recordsTotal"],
            "recordsFiltered" => $productos["recordsFilter"],
            "data" => $data,
        );

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // ===========================
    // OBTENER PRODUCTO (AJAX)
    // ===========================
    public function obtener_producto() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_oculto = $this->input->post('id_oculto');
        if (empty($id_oculto)) {
            echo json_encode(['success' => false, 'message' => 'ID de producto no proporcionado']);
            return;
        }

        $producto = $this->Producto_model->obtener_producto_por_id($id_oculto);

        if ($producto) {
            echo json_encode(['success' => true, 'data' => $producto]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
    }

    // ===========================
    // GUARDAR PRODUCTO (AJAX)
    // ===========================
    public function guardar_producto() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_oculto = $this->input->post('id_oculto');
        $nombre = trim($this->input->post('nombre'));
        $id_categoria = $this->input->post('id_categoria');
        $precio = $this->input->post('precio');
        $descripcion = trim($this->input->post('descripcion'));
        $etiquetas = trim($this->input->post('etiquetas'));

        if (empty($nombre)) {
            echo json_encode(['success' => false, 'message' => 'El nombre del producto es obligatorio']);
            return;
        }
        if (empty($id_categoria)) {
            echo json_encode(['success' => false, 'message' => 'La categoría es obligatoria']);
            return;
        }
        
        if (!empty($nombre)) {
            $existe_nombre = $this->Producto_model->existe_nombreProducto($nombre, $id_oculto);
            if ($existe_nombre) {
                echo json_encode(['success' => false, 'message' => 'El nombre ya está registrado']);
                return;
            }
        }

        $datos = array(
            'nombre' => $nombre,
            'id_categoria' => $id_categoria,
            'precio' => $precio,
            'descripcion' => $descripcion,
            'etiquetas' => $etiquetas
        );

        // Procesar subida de múltiples imágenes (imagen1..imagen5 y imagendetalle)
        $nombres_imagenes = $this->procesar_imagen_subida($id_oculto);
        if ($nombres_imagenes !== false && is_array($nombres_imagenes)) {
            foreach ($nombres_imagenes as $campo => $nombre_archivo) {
                if (!empty($nombre_archivo)) {
                    $datos[$campo] = $nombre_archivo;
                }
            }
        }

        if (empty($id_oculto)) {
            $datos['cji_flagestado'] = '1';
            $resultado = $this->Producto_model->insertar_producto($datos);
            $mensaje = $resultado ? 'Producto registrado exitosamente' : 'Error al registrar el producto';
        } else {
            $resultado = $this->Producto_model->actualizar_producto($id_oculto, $datos);
            $mensaje = $resultado ? 'Producto actualizado exitosamente' : 'Error al actualizar el producto';
        }
        echo json_encode(['success' => $resultado, 'message' => $mensaje]);
    }

    // ===========================
    // CAMBIAR ESTADO (AJAX)
    // ===========================
    public function cambiar_estado_producto() {
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
        $resultado = $this->Producto_model->cambiar_estado_producto($id_oculto, $nuevo_estado);

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

    // ===========================
    // PROCESAR IMAGEN
    // ===========================
    private function procesar_imagen_subida($id_oculto = null) {
        $campos = ['imagen1','imagen2','imagen3','imagen4','imagen5','imagendetalle'];
        $config_base['upload_path'] = './images/productos/';
        $config_base['allowed_types'] = 'gif|jpg|jpeg|png';
        $config_base['max_size'] = 2048;
        $config_base['encrypt_name'] = true;
        if (!is_dir($config_base['upload_path'])) {
            mkdir($config_base['upload_path'], 0777, true);
        }

        $resultados = [];
        $algunaSubida = false;

        foreach ($campos as $campo) {
            if (!empty($_FILES[$campo]['name'])) {
                $this->upload->initialize($config_base);
                if ($this->upload->do_upload($campo)) {
                    $upload_data = $this->upload->data();
                    $nombre_imagen = $upload_data['file_name'];
                    // eliminar anterior solo para ese campo
                    if ($id_oculto) {
                        $this->eliminar_imagen_anterior($id_oculto, $campo);
                    }
                    $resultados[$campo] = $nombre_imagen;
                    $algunaSubida = true;
                } else {
                    log_message('error', 'Error al subir ' . $campo . ': ' . $this->upload->display_errors('', ''));
                    $resultados[$campo] = '';
                }
            }
        }

        return $algunaSubida ? $resultados : false;
    }

    // ===========================
    // ELIMINAR IMAGEN ANTERIOR
    // ===========================
    private function eliminar_imagen_anterior($id_oculto, $campo = 'imagen1') {
        $imagenes = $this->Producto_model->obtener_imagen_actual($id_oculto);
        if ($imagenes && isset($imagenes->{$campo}) && !empty($imagenes->{$campo})) {
            $ruta_imagen = './images/productos/' . $imagenes->{$campo};
            if (file_exists($ruta_imagen)) {
                @unlink($ruta_imagen);
            }
        }
    }

  // ===========================
    // LISTAR PRODUCTOS
    // ===========================
    public function listar() {
        $data["productos"] = $this->Producto_model->getProductos();
        $this->load->view("producto/listar", $data);
    }

    // ===========================
    // AGREGAR PRODUCTO
    // ===========================
    public function agregar() {

            // Cargar categorías para el select
            $data["categorias"] = $this->Categoria_model->getCategorias();

            if ($this->input->post()) {

                $nombre    = $this->input->post("nombre");
                $categoria = $this->input->post("categoria");
                $precio    = $this->input->post("precio");
                $descripcion = $this->input->post("descripcion");

                $categoriaData = $this->Categoria_model->getCategoria($categoria);

                $categoriaNombre = $categoriaData->nombre;

                // Insertar primero sin imagen (retorna ID)
                $idProducto = $this->Producto_model->insertarProducto($nombre, $categoria, $precio, $descripcion);

                // ===== SUBIR IMAGEN =====
                if (!empty($_FILES["imagen"]["name"])) {

                    $categoriaFolder = strtolower($categoriaNombre); // carpeta siempre en minúsculas

                    $rutaCarpeta = FCPATH . "images/productos/" . $categoriaFolder;

                    if (!is_dir($rutaCarpeta)) {
                        mkdir($rutaCarpeta, 0777, TRUE);
                    }

                    // Nombre final del archivo = ID del producto
                    $newFileName = $idProducto . ".jpg";

                    $config["upload_path"]   = $rutaCarpeta;
                    $config["allowed_types"] = "jpg|jpeg|png";
                    $config["file_name"]     = $newFileName;
                    $config["overwrite"]     = TRUE;

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload("imagen")) {
                    }
                }

                redirect(base_url("productos/listar"));
            }

            $this->load->view("producto/agregar", $data);
    }

    // ===========================
    // EDITAR PRODUCTO
    // ===========================
    public function editar($id) {

        $data["producto"]   = $this->Producto_model->getProducto($id);
        $data["categorias"] = $this->Categoria_model->getCategorias();

        if ($this->input->post()) {

            $nombre    = $this->input->post("nombre");
            $categoria = $this->input->post("categoria");
            $precio    = $this->input->post("precio");
            $descripcion = $this->input->post("descripcion");

            $categoriaData = $this->Categoria_model->getCategoria($categoria);

            $categoriaNombre = $categoriaData->nombre;

            $this->Producto_model->actualizarProducto($id, $nombre, $categoria, $precio, $descripcion);

            // ===== SUBIR NUEVA IMAGEN =====
            if (!empty($_FILES["imagen"]["name"])) {

                $categoriaFolder = strtolower($categoriaNombre);

                $rutaCarpeta = FCPATH . "images/productos/" . $categoriaFolder;

                if (!is_dir($rutaCarpeta)) {
                    mkdir($rutaCarpeta, 0777, TRUE);
                }

                $newFileName = $id . ".jpg";

                $config["upload_path"]   = $rutaCarpeta;
                $config["allowed_types"] = "jpg|jpeg|png";
                $config["file_name"]     = $newFileName;
                $config["overwrite"]     = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("imagen")) {
                }
            }

            redirect(base_url("productos/listar"));
        }

        $this->load->view("producto/editar", $data);
    }

    // ===========================
    // ELIMINAR PRODUCTO
    // ===========================
    public function eliminar($id) {

        // Opcional: eliminar imagen también
        $producto = $this->Producto_model->getProducto($id);

        if ($producto && !empty($producto->imagen) && file_exists(FCPATH . $producto->imagen)) {
            unlink(FCPATH . $producto->imagen);
        }

        $this->Producto_model->eliminarProducto($id);

        redirect(base_url("productos/listar"));
    }
}
?>
