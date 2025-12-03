// Funcionalidad para la gestión de usuarios con DataTables

const TABLA_USUARIOS_SELECTOR = '#tablaUsuarios';
const SELECTORES_USUARIOS = {
    modalLista: '#modalUsuarios',
    modalEditar: '#modalEditarUsuario',
    modalTituloEditar: '#modalEditarUsuarioLabel',
    formularioEditar: '#formEditarUsuario',
    campos: {
        idOculto: '#usuario_id_oculto',
        nombre: '#usuario_nombre',
        email: '#usuario_email',
        password: '#usuario_password',
        passwordRe: '#usuario_password_re'
    },
    botones: {
        gestionar: '#btnGestionarUsuarios',
        editar: '.btn-editar-usuario',
        cancelarEditar: '.btn-cancelar-editar',
        guardar: '.btn-guardar'
    }
};

const ENDPOINTS_USUARIOS = {
    datatable: base_url + 'login/datatable_usuarios',
    obtenerUsuario: base_url + 'login/obtener_usuario',
    guardarUsuario: base_url + 'login/guardar_usuario'
};

const ESTADOS = {ACTIVO: 1, INACTIVO: 0};
const ROLES = {SOPORTE: '1', DUENO: '2'};

const CONFIG_USUARIOS = {
    datatable: {
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
    },
    modal: {
        animacionDelay: 300
    }
};

const COLORES = {
    confirmacion: '#3085d6',
    cancelacion: '#6c757d',
    exito: '#28a745',
    peligro: '#dc3545'
};

const MENSAJES_USUARIOS = {
    cargando: 'Cargando...',
    guardando: 'Guardando...',
    actualizando: 'Actualizando...',
    procesando: 'Procesando...',
    cargandoDatos: 'Cargando datos...',
    error: {
        cargarUsuarios: 'No se pudieron cargar los usuarios',
        cargarInfo: 'No se pudo cargar la información del usuario',
        procesarSolicitud: 'No se pudo procesar la solicitud'
    },
    validacion: {
        camposIncompletos: 'Campos incompletos',
        nombreRequerido: 'Por favor ingrese el nombre del usuario',
        emailRequerido: 'Por favor ingrese el email del usuario',
        emailInvalido: 'Por favor ingrese un email válido',
        passwordInvalido: 'La contraseña debe tener al menos 4 caracteres',
        passwordNoCoincide: 'Las contraseñas no coinciden'
    }
};

let tablaUsuarios;

$(document).ready(function() {
    initEventListenersUsuarios();
});

function mostrarCargandoUsuarios(mensaje = 'Cargando...') {
    Swal.fire({
        title: mensaje,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function mostrarAlertaUsuarios(icono, titulo, texto, timer = null) {
    const config = {icon: icono, title: titulo, text: texto};
    if (timer) {
        config.timer = timer;
        config.showConfirmButton = false;
    }
    Swal.fire(config);
}

function getTextoEstado(estado) {
    return (estado == ESTADOS.ACTIVO) ? 'ACTIVO' : 'INACTIVO';
}

function getTextoRol(rol) {
    return (rol == ROLES.SOPORTE) ? 'Soporte' : 'Dueño';
}

function initEventListenersUsuarios() {
    // Botón gestionar usuarios
    $(SELECTORES_USUARIOS.botones.gestionar).on('click', function() {
        abrirModalUsuarios();
    });

    // Botón editar usuario (delegado porque se carga dinámicamente)
    $(TABLA_USUARIOS_SELECTOR).on('click', SELECTORES_USUARIOS.botones.editar, function() {
        const id = $(this).data('id');
        editarUsuario(id);
    });

    // Botón cancelar editar
    $(SELECTORES_USUARIOS.botones.cancelarEditar).on('click', function() {
        cerrarModalEditar();
    });

    // Submit del formulario de edición
    $(SELECTORES_USUARIOS.formularioEditar).on('submit', function(e) {
        e.preventDefault();
        guardarUsuario();
    });

    // Limpiar estilos residuales del modal al cerrar
    $(SELECTORES_USUARIOS.modalLista).on('hidden.bs.modal', function () {
        $('body').removeClass('modal-open').css('padding-right', '');
        $('.modal-backdrop').remove();
    });

    $(SELECTORES_USUARIOS.modalEditar).on('hidden.bs.modal', function () {
        // Si el modal de lista está abierto, mantener el backdrop
        if ($(SELECTORES_USUARIOS.modalLista).hasClass('show')) {
            $('body').addClass('modal-open');
        } else {
            $('body').removeClass('modal-open').css('padding-right', '');
            $('.modal-backdrop').remove();
        }
    });

    // Control de visibilidad del campo repetir contraseña
    $(SELECTORES_USUARIOS.campos.password).on('input', function() {
        const password = $(this).val();
        const $divPasswordRe = $(SELECTORES_USUARIOS.campos.passwordRe).closest('.col-md-12');
        
        if (password.length > 0) {
            $divPasswordRe.removeClass('d-none');
        } else {
            $divPasswordRe.addClass('d-none');
            $(SELECTORES_USUARIOS.campos.passwordRe).val('');
        }
    });
}

function abrirModalUsuarios() {
    // Inicializar DataTable si no existe
    if (!tablaUsuarios) {
        initDataTableUsuarios();
    } else {
        tablaUsuarios.ajax.reload(null, false);
    }
    
    $(SELECTORES_USUARIOS.modalLista).modal('show');
}

function initDataTableUsuarios() {
    tablaUsuarios = $(TABLA_USUARIOS_SELECTOR).DataTable({
        responsive: true,
        destroy: true,
        processing: true,
        autoWidth: false,
        ajax: {
            url: ENDPOINTS_USUARIOS.datatable,
            type: "POST",
            data: {
                rol_usuario: usuario_rol,
                id_usuario: usuario_id
            },
            beforeSend: function () {
                mostrarCargandoUsuarios(MENSAJES_USUARIOS.cargando);
            },
            complete: function () {
                Swal.close();
            },
            error: function(xhr, error, thrown) {
                console.error('Error al cargar usuarios:', error);
                mostrarAlertaUsuarios('error', 'Error', MENSAJES_USUARIOS.error.cargarUsuarios);
            },
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'email' },
            { data: 'rol' },
            { data: 'estado' },
            { data: 'opciones' }
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay usuarios registrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
            "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
            "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ usuarios",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron usuarios",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        pageLength: CONFIG_USUARIOS.datatable.pageLength,
        lengthMenu: CONFIG_USUARIOS.datatable.lengthMenu,
        ordering: false,
        columnDefs: [
            { targets: [0], visible: false },
            { targets: [3, 4, 5], className: "text-center" }
        ]
    });
}

function editarUsuario(id) {
    $.ajax({
        url: ENDPOINTS_USUARIOS.obtenerUsuario,
        type: 'POST',
        data: { id_oculto: id },
        dataType: 'json',
        beforeSend: function() {
            mostrarCargandoUsuarios(MENSAJES_USUARIOS.cargandoDatos);
        },
        success: function(response) {
            Swal.close();
            if (response.success) {
                const usuario = response.data;
                $(SELECTORES_USUARIOS.campos.idOculto).val(usuario.id);
                $(SELECTORES_USUARIOS.campos.nombre).val(usuario.nombre);
                $(SELECTORES_USUARIOS.campos.email).val(usuario.email);
                $(SELECTORES_USUARIOS.campos.password).val('');
                $(SELECTORES_USUARIOS.campos.passwordRe).val('');
                $(SELECTORES_USUARIOS.campos.passwordRe).closest('.col-md-12').addClass('d-none');
                
                $(SELECTORES_USUARIOS.modalTituloEditar).text('Editar Usuario: ' + usuario.nombre);
                $(SELECTORES_USUARIOS.formularioEditar).find('.is-invalid').removeClass('is-invalid');
                
                // Abrir modal de edición encima del modal de lista
                $(SELECTORES_USUARIOS.modalEditar).modal('show');
            } else {
                mostrarAlertaUsuarios('error', 'Error', response.message);
            }
        },
        error: function() {
            mostrarAlertaUsuarios('error', 'Error', MENSAJES_USUARIOS.error.cargarInfo);
        }
    });
}

function guardarUsuario() {
    const nombre = $(SELECTORES_USUARIOS.campos.nombre).val().trim();
    const email = $(SELECTORES_USUARIOS.campos.email).val().trim();
    const password = $(SELECTORES_USUARIOS.campos.password).val();
    const passwordRe = $(SELECTORES_USUARIOS.campos.passwordRe).val();
    
    // Limpiar validaciones previas
    $(SELECTORES_USUARIOS.campos.nombre).removeClass('is-invalid');
    $(SELECTORES_USUARIOS.campos.email).removeClass('is-invalid');
    
    // Validar campos requeridos
    if (!nombre) {
        $(SELECTORES_USUARIOS.campos.nombre).addClass('is-invalid');
        mostrarAlertaUsuarios('warning', MENSAJES_USUARIOS.validacion.camposIncompletos, MENSAJES_USUARIOS.validacion.nombreRequerido);
        return;
    }
    
    if (!email) {
        $(SELECTORES_USUARIOS.campos.email).addClass('is-invalid');
        mostrarAlertaUsuarios('warning', MENSAJES_USUARIOS.validacion.camposIncompletos, MENSAJES_USUARIOS.validacion.emailRequerido);
        return;
    }

    if (password && password.length < 4) {
        $(SELECTORES_USUARIOS.campos.password).addClass('is-invalid');
        mostrarAlertaUsuarios('warning', MENSAJES_USUARIOS.validacion.camposIncompletos, MENSAJES_USUARIOS.validacion.passwordInvalido);
        return;
    }

    if (password && password !== passwordRe) {
        $(SELECTORES_USUARIOS.campos.passwordRe).addClass('is-invalid');
        mostrarAlertaUsuarios('warning', MENSAJES_USUARIOS.validacion.camposIncompletos, MENSAJES_USUARIOS.validacion.passwordNoCoincide);
        return;
    }
    
    
    // Validar formato de email
    /* const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        $(SELECTORES_USUARIOS.campos.email).addClass('is-invalid');
        mostrarAlertaUsuarios('warning', MENSAJES_USUARIOS.validacion.camposIncompletos, MENSAJES_USUARIOS.validacion.emailInvalido);
        return;
    } */
    
    // Mostrar confirmación
    const mensajePassword = password ? '<br><small>Se actualizará la contraseña</small>' : '';
    Swal.fire({
        title: '¿Actualizar usuario?',
        html: `Se actualizará el usuario: <strong>${nombre}</strong>${mensajePassword}`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: COLORES.confirmacion,
        cancelButtonColor: COLORES.cancelacion,
        confirmButtonText: '<i class="fas fa-save"></i> Sí, actualizar',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            enviarFormularioUsuario();
        }
    });
}

function enviarFormularioUsuario() {
    const formData = new FormData($(SELECTORES_USUARIOS.formularioEditar)[0]);
    
    $.ajax({
        url: ENDPOINTS_USUARIOS.guardarUsuario,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            mostrarCargandoUsuarios(MENSAJES_USUARIOS.actualizando);
        },
        success: function(response) {
            if (response.success) {
                cerrarModalEditar();
                
                if (response.force_logout) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Sesión cerrada',
                        text: 'Se han actualizado datos críticos de su cuenta. Por favor inicie sesión nuevamente.',
                        confirmButtonText: 'Entendido',
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = base_url + 'login';
                    });
                } else {
                    if (response.update_name) {
                        $('#header_user_name').text(response.update_name);
                    }
                    
                    setTimeout(() => {
                        mostrarAlertaUsuarios('success', '¡Éxito!', response.message, 1500);
                        recargarTablaUsuarios();
                    }, CONFIG_USUARIOS.modal.animacionDelay);
                }
            } else {
                mostrarAlertaUsuarios('error', 'Error', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en guardar_usuario:', status, error);
            mostrarAlertaUsuarios('error', 'Error', MENSAJES_USUARIOS.error.procesarSolicitud);
        }
    });
}

function cerrarModalEditar() {
    $(SELECTORES_USUARIOS.modalEditar).modal('hide');
    $(SELECTORES_USUARIOS.formularioEditar)[0].reset();
    $(SELECTORES_USUARIOS.formularioEditar).find('.is-invalid').removeClass('is-invalid');
    
    setTimeout(() => {
        // Mantener el modal de lista abierto
        if ($(SELECTORES_USUARIOS.modalLista).hasClass('show')) {
            $('body').addClass('modal-open');
        }
    }, CONFIG_USUARIOS.modal.animacionDelay);
}

function recargarTablaUsuarios() {
    if (tablaUsuarios) {
        tablaUsuarios.ajax.reload(null, false);
    }
}
