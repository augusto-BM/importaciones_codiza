<!-- Estilos específicos de la vista de categorías -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/tablas.css'); ?>">

<!-- Definir base_url para JavaScript -->
<script>
    const base_url = '<?php echo base_url(); ?>categoria/';
    const base_url_img = '<?php echo base_url(); ?>';
</script>
<div class="dashboard-wrapper">
    <div class="dashboard-container">
        <div class="page-header">
            <h1><i class="fas fa-list"></i> Gestión de Categorías</h1>
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
                <i class="fas fa-plus"></i> Nueva Categoría
            </button>
            <table class="table table-striped table-bordered table-hover" id="tablaGeneral">
                <thead>
                    <tr>
                        <td class="text-center" style="width:0%; display: none;" data-orderable="false">ID</td>
                        <td class="text-center" style="width:40%" data-orderable="false">NOMBRE</td>
                        <td class="text-center" style="width:25%" data-orderable="false">TIPO</td>
                        <td class="text-center" style="width:15%" data-orderable="false">IMAGEN</td>
                        <td class="text-center" style="width:15%" data-orderable="false">ESTADO</td>
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
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formGeneral" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="id_oculto" name="id_oculto">
                    
                    <div class="form-group">
                        <label for="nombre">Categoría <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" id="nombre" name="nombre" maxlength="100" placeholder="Ingrese nombre">
                    </div>
                    <div class="form-group">
                        <label for="id_tipocategoria">Tipo <span class="text-danger">*</span></label>
                        <select class="form-control mb-2" id="id_tipocategoria" name="id_tipocategoria" style="cursor: pointer;" title="Cambiar Tipo de Categoría">
                        <?php if (!empty($tiposCategorias)): ?>
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
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control-file mb-2" id="imagen" name="imagen" accept="image/*">
                        <small class="form-text text-muted">Formatos permitidos: JPG, PNG(Max: 2MB)</small>
                    </div>
                    <div class="form-group" id="previewContainer" style="display: none;">
                        <label>Vista previa</label>
                        <div class="text-center">
                            <img id="imagenPreview" src="" alt="Vista previa" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                        </div>
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
</div>

<!-- Scripts específicos de la vista de categorías -->
<script src="<?php echo base_url('assets/js/categorias.js'); ?>"></script>
