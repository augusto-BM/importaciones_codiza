<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css'); ?>">

<div class="dashboard-wrapper">
    <div class="dashboard-container">
        <div class="welcome-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h1>¡Bienvenido, <span id="header_user_name"><?= $this->session->userdata('usuario_nombre'); ?></span>!</h1>
        <p class="subtitle">Panel de Administración</p>
        <p class="info-text">
            Utiliza el menú de navegación superior para gestionar todos los aspectos del sistema.
        </p>
        <button class="btn btn-danger btn-add btn-sm" id="btnGestionarUsuarios"><i class="fas fa-key"></i> Cambiar Contraseña</button>
    </div>

    <!-- Modal Lista de Usuarios -->
    <div class="modal modal-global fade" id="modalUsuarios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUsuariosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUsuariosLabel">Gestión de Usuarios</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tablaUsuarios" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Usuario (Nested) -->
    <div class="modal modal-global fade" id="modalEditarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarUsuarioLabel">Editar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditarUsuario" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="usuario_id_oculto" name="id_oculto">
                        
                        <!-- Información del Usuario -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="usuario_nombre">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="usuario_nombre" name="nombre" maxlength="255" placeholder="Ingrese nombre del usuario" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="usuario_email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="usuario_email" name="email" maxlength="255" placeholder="Ingrese email del usuario" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="usuario_password">Nueva Contraseña</label>
                                    <input type="password" class="form-control" id="usuario_password" name="password" placeholder="Dejar en blanco para mantener la actual">
                                    <small class="form-text text-muted">Solo ingrese una contraseña si desea cambiarla</small>
                                </div>
                            </div>
                            
                            <div class="col-md-12 d-none">
                                <div class="form-group mb-3">
                                    <label for="usuario_password_re">Repetir Contraseña</label>
                                    <input type="password" class="form-control" id="usuario_password_re" name="password_re" placeholder="Dejar en blanco para mantener la actual">
                                    <small class="form-text text-muted">Solo ingrese una contraseña si desea cambiarla</small>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-guardar btn-success">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                        <button type="button" class="btn btn-secondary btn-cancelar-editar">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para usuarios -->
    <script>
        const base_url = '<?= base_url() ?>';
        const usuario_rol = '<?= $this->session->userdata('rol') ?>';
        const usuario_id = '<?= $this->session->userdata('usuario_id') ?>';
    </script>
    <script src="<?= js_url('assets/js/usuarios.js'); ?>"></script>
</div>
