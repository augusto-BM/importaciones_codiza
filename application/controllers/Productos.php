<?php
class Productos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model("Menu_model");
        $this->load->model("Producto_model"); // corregido
        $this->load->model("Categoria_model");
        $this->load->model("Tipo_categoria_model");
         $this->load->library('session'); // <- esto es clave
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

    // MÉTODO COMENTADO - Vista productos.php eliminada (código antiguo no usado)
    // public function index() {
    //     $data["menuTiposCategorias"] = $this->tiposCategoriasMenu();
    //     $data["tipos_categoria"] = $this->Tipo_categoria_model->obtener_tipos_activos();
    //     $this->load->view("templates/header", $data);
    //     $this->load->view("productos");
    //     $this->load->view("templates/footer");
    // }

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
