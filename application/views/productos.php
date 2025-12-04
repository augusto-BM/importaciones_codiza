<!-- Estilos específicos de la vista de productos -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/tablas.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/productos.css'); ?>">
<!-- Definir base_url para JavaScript -->
<script>
    const base_url = '<?php echo base_url(); ?>productos/';
    const base_url_img = '<?php echo base_url(); ?>';
</script>
<div class="dashboard-wrapper">
    <div class="dashboard-container">
        <div class="page-header">
            <h1><i class="fas fa-box"></i>Productos</h1>
            <div class="filters-wrapper">
                <div class="filter-group">
                    <label for="filtroEstado">Estado</label>
                    <select name="filtroEstado" id="filtroEstado" class="form-control" style="cursor: pointer;" title="Cambiar Estado">
                        <option value="1">ACTIVO</option>
                        <option value="0">INACTIVO</option>
                        <option value="2">TODOS</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filtroCategorias">Categorías</label>
                    <select name="filtroCategorias" id="filtroCategorias" class="form-control" style="cursor: pointer;" title="Filtrar por Categoría">
                        <?php if (!empty($categorias)): ?>
                                <option value="">TODOS</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria->id_categoria ?>">
                                        <?= $categoria->nombre ?>
                                    </option>
                                <?php endforeach; ?>
                        <?php else: ?>
                                <option value="">No hay datos</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filtroTipos">Tipo</label>
                    <select name="filtroTipos" id="filtroTipos" class="form-control" style="cursor: pointer;" title="Cambiar Tipo de Categoría">
                        <?php if (!empty($tiposCategorias)): ?>
                                <option value="">TODOS</option>
                                <?php foreach ($tiposCategorias as $tipo): ?>
                                    <option value="<?= $tipo->id_tipocategoria ?>">
                                        <?= $tipo->nombre ?>
                                    </option>
                                <?php endforeach; ?>
                        <?php else: ?>
                                <option value="">No hay datos</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filtroNombre">Nombre</label>
                    <input type="text" id="filtroNombre" name="filtroNombre" class="form-control" placeholder="Ingrese nombre">
                </div>
                <button class="btn btn-info btn-sm btn-buscar">
                    <i class="fas fa-search"></i> Buscar
                </button>
                <button class="btn btn-dark btn-sm btn-limpiar">
                    <i class="fas fa-eraser"></i> Limpiar
                </button>
            </div>
        </div>

        <div class="table-container">
            <button class="btn-add btn-sm" style="position: absolute; right: 30px;">
                <i class="fas fa-plus"></i> Nuevo Producto
            </button>
            <table class="table table-striped table-bordered table-hover" id="tablaGeneral">
                <thead>
                    <tr>
                        <td class="text-center" style="width:0%; display: none;" data-orderable="false">ID</td>
                        <td class="text-center" style="width:30%" data-orderable="false">NOMBRE</td>
                        <td class="text-center" style="width:15%" data-orderable="false">CATEGORÍA</td>
                        <td class="text-center" style="width:15%" data-orderable="false">TIPO</td>
                        <td class="text-center" style="width:15%" data-orderable="false">DESCRIPCIÓN</td>
                        <td class="text-center" style="width:10%" data-orderable="false">IMAGEN</td>
                        <td class="text-center" style="width:10%" data-orderable="false">ESTADO</td>
                        <td class="text-center" style="width:5%" data-orderable="false"></td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal modal-global fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl modal-xxl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="formGeneral" enctype="multipart/form-data">
            <div class="modal-body">
                    <input type="hidden" id="id_oculto" name="id_oculto">
                    <!-- Información Básica -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre del Producto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control mb-2" id="nombre" name="nombre" maxlength="255" placeholder="Ingrese nombre del producto">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_categoria">Categoría <span class="text-danger">*</span></label>
                                <select class="form-control mb-2" id="id_categoria" name="id_categoria" style="cursor: pointer;" title="Seleccionar Categoría">
                                <?php if (!empty($categorias)): ?>
                                        <?php foreach ($categorias as $categoria): ?>
                                            <option value="<?= $categoria->id_categoria ?>">
                                                <?= $categoria->nombre ?>
                                            </option>
                                        <?php endforeach; ?>
                                <?php else: ?>
                                        <option value="">No hay categorías</option>
                                <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-md-2">
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="number" step="0.01" class="form-control mb-2" id="precio" name="precio" placeholder="0.00">
                            </div>
                        </div> -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="etiquetas">Etiquetas</label>
                                <input type="text" class="form-control mb-2" id="etiquetas" name="etiquetas" placeholder="Ej: nuevo, oferta, destacado">
                            </div>
                        </div>
                    </div>

                    <!-- Descripción y Etiquetas -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control mb-2" id="descripcion" name="descripcion" rows="3" placeholder="Descripción del producto"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Imágenes -->
                    <hr class="my-3">
                    <h5 class="mb-3"><i class="fas fa-images"></i> Imágenes del Producto</h5>
                    
                    <!-- Imagen -->
                    <div class="row d-flex align-items-center">
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group" style="display: flex; flex-direction: column;">
                                <label for="imagen1">Imagen Principal</label>
                                <input type="file" class="form-control-file mb-2" id="imagen1" name="imagen1" accept="image/*">
                                <div class="preview-wrapper" id="previewContainer1">
                                    <img id="imagenPreview1" class="img-thumbnail imagen-preview d-none">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group" style="display: flex; flex-direction: column;">
                                <label for="imagen2">Imagen 2</label>
                                <input type="file" class="form-control-file mb-2" id="imagen2" name="imagen2" accept="image/*">
                                <div class="preview-wrapper" id="previewContainer2">
                                    <img id="imagenPreview2" class="img-thumbnail imagen-preview d-none">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group" style="display: flex; flex-direction: column;">
                                <label for="imagen3">Imagen 3</label>
                                <input type="file" class="form-control-file mb-2" id="imagen3" name="imagen3" accept="image/*">
                                <div class="preview-wrapper" id="previewContainer3">
                                    <img id="imagenPreview3" class="img-thumbnail imagen-preview d-none">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group" style="display: flex; flex-direction: column;">
                                <label for="imagen4">Imagen 4</label>
                                <input type="file" class="form-control-file mb-2" id="imagen4" name="imagen4" accept="image/*">
                                <div class="preview-wrapper" id="previewContainer4">
                                    <img id="imagenPreview4" class="img-thumbnail imagen-preview d-none">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group" style="display: flex; flex-direction: column;">
                                <label for="imagen5">Imagen 5</label>
                                <input type="file" class="form-control-file mb-2" id="imagen5" name="imagen5" accept="image/*">
                                <div class="preview-wrapper" id="previewContainer5">
                                    <img id="imagenPreview5" class="img-thumbnail imagen-preview d-none">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12 col-md-4 col-lg-3">
                            <div class="form-group" style="display: flex; flex-direction: column;">
                                <label for="imagendetalle">Imagen de Detalle</label>
                                <input type="file" class="form-control-file mb-2" id="imagendetalle" name="imagendetalle" accept="image/*">
                                <div class="preview-wrapper" id="previewContainerDetalle">
                                    <img id="imagenPreviewDetalle" class="img-thumbnail imagen-preview d-none">
                                </div>
                            </div>
                        </div> -->
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-guardar btn-success">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <button type="button" class="btn btn-secondary btn-cancelar">
                    <i class="fas fa-times"></i> Cancelar
                </button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Cargar TinyMCE primero desde el CDN -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Inicializar TinyMCE después de cargar la librería -->
<script>
    tinymce.init({
        selector: '#descripcion',
        height: 300,
        menubar: false,
        language: 'es',
        plugins: 'lists wordcount',
        toolbar: 'undo redo | formatselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent',
        toolbar_mode: 'sliding',
        branding: false,
        promotion: false,
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        // Configuración específica para listas
        advlist_bullet_styles: 'default,circle,square',
        advlist_number_styles: 'default,lower-alpha,lower-roman,upper-alpha,upper-roman',
        // Permitir todos los elementos HTML necesarios
        valid_elements: '*[*]',
        extended_valid_elements: '*[*]',
        // Configuración de formato
        block_formats: 'Párrafo=p; Encabezado 1=h1; Encabezado 2=h2; Encabezado 3=h3; Encabezado 4=h4',
        // Configuración de idioma
        language_url: 'https://cdn.jsdelivr.net/npm/tinymce-lang/langs6/es.js',
        // Deshabilitar subida de imágenes (usar el campo de imagen separado)
        file_picker_types: '',
        images_upload_handler: function (blobInfo, success, failure) {
            failure('La subida de imágenes está deshabilitada. Use el campo "Imagen Principal" del formulario.');
        },
        // Sincronizar con el formulario antes de enviar
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });
</script>

<!-- Scripts específicos de la vista de productos -->
<script src="<?php echo base_url('assets/js/productos.js'); ?>"></script>
