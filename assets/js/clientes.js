// Funcionalidad para la gestión de clientes con DataTables

// Constantes
const TABLA_SELECTOR = '#tablaGeneral';
const FILTROS = {estado: '#filtroEstado', nombre: '#filtroNombre', documento: '#filtroDocumento'};
const SELECTORES = {
    modal: '.modal-global',
    modalTitulo: '#staticBackdropLabel',
    formulario: '#formGeneral',
    campos: {idOculto: '#id_oculto', nombre: '#nombre', documento: '#documento', imagen: '#imagen'},
    preview: {container: '#previewContainer', imagen: '#imagenPreview'},
    botones: {guardar: '.btn-guardar', add: '.btn-add', buscar: '.btn-buscar', limpiar: '.btn-limpiar', cancelar: '.btn-cancelar', editar: '.btn-editar', cambiarEstado: '.btn-cambiar-estado'}
};

const ENDPOINTS = {
    datatable: base_url + 'datatable_clientes',
    cambiarEstado: base_url + 'cambiar_estado_cliente',
    obtenerCliente: base_url + 'obtener_cliente',
    guardarCliente: base_url + 'guardar_cliente'
};

const ESTADOS = {ACTIVO: 1, INACTIVO: 0};

const CONFIG = {
    imagen: {
        rutaBase: base_url_img + 'images/clientes/',
        tamanioMax: 2097152, // 2MB en bytes
        tiposPermitidos: ['image/jpeg', 'image/jpg', 'image/png']
    },
    datatable: {
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
    },
    modal: {
        animacionDelay: 300
    }
};

const COLORES = {confirmacion: '#3085d6', cancelacion: '#6c757d', exito: '#28a745', peligro: '#dc3545'};

const MENSAJES = {
    cargando: 'Cargando...',
    guardando: 'Guardando...',
    actualizando: 'Actualizando...',
    procesando: 'Procesando...',
    cargandoDatos: 'Cargando datos...',
    error: {
        cargarClientes: 'No se pudieron cargar los clientes',
        cargarInfo: 'No se pudo cargar la información del cliente',
        cambiarEstado: 'No se pudo cambiar el estado del cliente',
        procesarSolicitud: 'No se pudo procesar la solicitud'
    },
    validacion: {
        imagenTamanio: 'La imagen no debe superar 2MB',
        imagenFormato: 'Solo se permiten imágenes JPG, PNG o GIF',
        camposIncompletos: 'Campos incompletos',
        nombreRequerido: 'Por favor ingrese el nombre del cliente'
    }
};

// Variable global para la tabla
let tablaGeneral;

$(document).ready(function() {
    // Inicializar DataTable
    initDataTable();
    
    // Event listeners
    initEventListeners();
    
    // Limpiar estilos residuales del modal al cerrar
    $(SELECTORES.modal).on('hidden.bs.modal', function () {
        $('body').removeClass('modal-open').css('padding-right', '');
        $('.modal-backdrop').remove();
    });
});

// Funciones auxiliares reutilizables
function mostrarCargando(mensaje = 'Cargando...') {
    Swal.fire({
        title: mensaje,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function mostrarAlerta(icono, titulo, texto, timer = null) {
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

function limpiarFiltros() {
    $(FILTROS.estado).val(ESTADOS.ACTIVO);
    $(FILTROS.nombre).val('');
    $(FILTROS.documento).val('');
}

function initDataTable() {
    tablaGeneral = $(TABLA_SELECTOR).DataTable({
        responsive: true,
        filter: false,
        destroy: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: ENDPOINTS.datatable,
            type: "POST",
            data: function (d) {
                d.estado = $(FILTROS.estado).val();
                d.nombre = $(FILTROS.nombre).val();
                d.documento = $(FILTROS.documento).val();
            },
            beforeSend: function () {
                mostrarCargando(MENSAJES.cargando);
            },
            complete: function () {
                Swal.close();
            },
            error: function(xhr, error, thrown) {
                console.error('Error al cargar clientes:', error);
                mostrarAlerta('error', 'Error', MENSAJES.error.cargarClientes);
            }
        },
        language: {
            "decimal": "",
            "emptyTable": "No hay clientes registrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
            "infoEmpty": "Mostrando 0 a 0 de 0 clientes",
            "infoFiltered": "(filtrado de _MAX_ clientes totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ clientes",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron clientes",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        pageLength: CONFIG.datatable.pageLength,
        lengthMenu: CONFIG.datatable.lengthMenu,
        //order: [[1, 'asc']],
        columnDefs: [
            { targets: [0], visible: false },
            { targets: [0, 1, 2], searchable: false, orderable: false },
            { targets: [1, 2]},
            { targets: [3, 4, 5], className: "text-center", orderable: false, searchable: false }
        ]
    });

    // Botón buscar
    $(SELECTORES.botones.buscar).on('click', function() {
        tablaGeneral.ajax.reload(null, false);
    });

    // Botón limpiar
    $(SELECTORES.botones.limpiar).on('click', function() {
        limpiarFiltros();
        tablaGeneral.ajax.reload(null, true);
    });

    // Evento change del select de estado
    $(FILTROS.estado).on('change', function() {
        recargarTabla();
    });
}

function initEventListeners() {
    // Botón agregar cliente
    $(SELECTORES.botones.add).on('click', function() {
        abrirModalNuevoCliente();
    });

    // Botón editar (delegado porque se carga dinámicamente)
    $(TABLA_SELECTOR).on('click', SELECTORES.botones.editar, function() {
        const id = $(this).data('id');
        editarCliente(id);
    });
    
    // Preview de imagen cuando se selecciona
    $(SELECTORES.campos.imagen).on('change', function() {
        previsualizarImagen(this);
    });
    
    // Validación del campo documento - solo permitir números
    $(SELECTORES.campos.documento).on('keypress', function(e) {
        const char = String.fromCharCode(e.which);
        // Permitir solo números
        if (!/[0-9]/.test(char)) {
            e.preventDefault();
        }
    });
    
    // Limpiar espacios al inicio y final de todos los campos de texto cuando pierden el foco
    $(SELECTORES.formulario).on('blur', 'input[type="text"]', function() {
        $(this).val($(this).val().trim());
    });
    
    // Botón cancelar modal
    $(SELECTORES.botones.cancelar).on('click', function() {
        cerrarModal();
    });
    
    // Submit del formulario
    $(SELECTORES.formulario).on('submit', function(e) {
        e.preventDefault();
        guardarCliente();
    });
    
    // Botón cambiar estado (delegado porque se carga dinámicamente)
    $(TABLA_SELECTOR).on('click', SELECTORES.botones.cambiarEstado, function() {
        const id = $(this).data('id');
        const estadoActual = $(this).data('estado');
        cambiarEstadoCliente(id, estadoActual);
    });
}

// Función para abrir modal limpio
function abrirModalNuevoCliente() {
    $(SELECTORES.formulario)[0].reset();
    $(SELECTORES.campos.idOculto).val('');
    $(SELECTORES.preview.container).hide();
    $(SELECTORES.preview.imagen).attr('src', '');
    $(SELECTORES.modalTitulo).text('Nuevo Cliente');
    $(SELECTORES.botones.guardar).html('<i class="fas fa-save"></i> Guardar');
    // Limpiar clases de validación
    $(SELECTORES.formulario).find('.is-invalid').removeClass('is-invalid');
    $(SELECTORES.modal).modal('show');
}

// Función para editar cliente
function editarCliente(id) {
    $.ajax({
        url: ENDPOINTS.obtenerCliente,
        type: 'POST',
        data: { id_oculto: id },
        dataType: 'json',
        beforeSend: function() {
            mostrarCargando(MENSAJES.cargandoDatos);
        },
        success: function(response) {
            Swal.close();
            console.log('Respuesta obtener_cliente:', response); // Debug
            if (response.success) {
                const cliente = response.data;
                console.log('Datos del cliente:', cliente); // Debug
                $(SELECTORES.campos.idOculto).val(cliente.id_oculto);
                $(SELECTORES.campos.nombre).val(cliente.nombre);
                $(SELECTORES.campos.documento).val(cliente.documento);
                
                console.log('ID asignado al campo oculto:', $(SELECTORES.campos.idOculto).val()); // Debug
                
                // Mostrar imagen si existe
                if (cliente.imagen && cliente.imagen !== '') {
                    $(SELECTORES.preview.imagen).attr('src', CONFIG.imagen.rutaBase + cliente.imagen);
                    $(SELECTORES.preview.container).show();
                } else {
                    $(SELECTORES.preview.container).hide();
                }
                
                $(SELECTORES.modalTitulo).text('Editar Cliente');
                $(SELECTORES.botones.guardar).html('<i class="fas fa-save"></i> Actualizar');
                // Limpiar clases de validación
                $(SELECTORES.formulario).find('.is-invalid').removeClass('is-invalid');
                $(SELECTORES.modal).modal('show');
            } else {
                mostrarAlerta('error', 'Error', response.message);
            }
        },
        error: function() {
            mostrarAlerta('error', 'Error', MENSAJES.error.cargarInfo);
        }
    });
}

// Función para previsualizar imagen
function previsualizarImagen(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validar tamaño (2MB)
        if (file.size > CONFIG.imagen.tamanioMax) {
            mostrarAlerta('warning', 'Advertencia', MENSAJES.validacion.imagenTamanio);
            $(input).val('');
            $(SELECTORES.preview.container).hide();
            return;
        }
        
        // Validar formato
        if (!CONFIG.imagen.tiposPermitidos.includes(file.type)) {
            mostrarAlerta('warning', 'Advertencia', MENSAJES.validacion.imagenFormato);
            $(input).val('');
            $(SELECTORES.preview.container).hide();
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            $(SELECTORES.preview.imagen).attr('src', e.target.result);
            $(SELECTORES.preview.container).show();
        };
        reader.readAsDataURL(file);
    } else {
        $(SELECTORES.preview.container).hide();
    }
}

// Función para guardar cliente
function guardarCliente() {
    const idOculto = $(SELECTORES.campos.idOculto).val();
    const esEdicion = idOculto !== '' && idOculto !== undefined && idOculto !== null;
    const nombre = $(SELECTORES.campos.nombre).val().trim();
    const documento = $(SELECTORES.campos.documento).val().trim();
    
    // Debug: verificar valores
    console.log('Guardar cliente - ID:', idOculto, 'Es edición:', esEdicion, 'Nombre:', nombre);
    
    // Limpiar validaciones previas
    $(SELECTORES.campos.nombre).removeClass('is-invalid');
    $(SELECTORES.campos.documento).removeClass('is-invalid');
    
    // Validar campos requeridos
    if (!nombre) {
        $(SELECTORES.campos.nombre).addClass('is-invalid');
        mostrarAlerta('warning', MENSAJES.validacion.camposIncompletos, MENSAJES.validacion.nombreRequerido);
        return;
    }
    
    // Mostrar confirmación
    Swal.fire({
        title: esEdicion ? '¿Actualizar cliente?' : '¿Guardar nuevo cliente?',
        html: `Se ${esEdicion ? 'actualizará' : 'registrará'} el cliente: <strong>${nombre}</strong>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: COLORES.confirmacion,
        cancelButtonColor: COLORES.cancelacion,
        confirmButtonText: esEdicion ? '<i class="fas fa-save"></i> Sí, actualizar' : '<i class="fas fa-save"></i> Sí, guardar',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            enviarFormularioCliente(esEdicion);
        }
    });
}

// Función auxiliar para enviar el formulario
function enviarFormularioCliente(esEdicion) {
    const formData = new FormData($(SELECTORES.formulario)[0]);
    
    // Debug: verificar datos del FormData
    console.log('FormData a enviar:');
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }
    
    $.ajax({
        url: ENDPOINTS.guardarCliente,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            mostrarCargando(esEdicion ? MENSAJES.actualizando : MENSAJES.guardando);
        },
        success: function(response) {
            console.log('Respuesta guardar_cliente:', response); // Debug
            if (response.success) {
                cerrarModal();
                // Esperar a que termine la animación del modal antes de mostrar alerta
                setTimeout(() => {
                    mostrarAlerta('success', '¡Éxito!', response.message, 1500);
                    recargarTabla();
                }, CONFIG.modal.animacionDelay);
            } else {
                mostrarAlerta('error', 'Error', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en guardar_cliente:', status, error); // Debug
            console.error('Respuesta del servidor:', xhr.responseText); // Debug
            mostrarAlerta('error', 'Error', MENSAJES.error.procesarSolicitud);
        }
    });
}

// Función para cerrar modal
function cerrarModal() {
    $(SELECTORES.modal).modal('hide');
    $(SELECTORES.formulario)[0].reset();
    $(SELECTORES.preview.container).hide();
    // Limpiar clases de validación
    $(SELECTORES.formulario).find('.is-invalid').removeClass('is-invalid');
    
    // Limpiar estilos residuales del modal
    setTimeout(() => {
        $('body').removeClass('modal-open').css('padding-right', '');
        $('.modal-backdrop').remove();
    }, CONFIG.modal.animacionDelay);
}


// Función para cambiar estado del cliente
function cambiarEstadoCliente(id, estadoActual) {
    const estadoNuevo = (estadoActual == ESTADOS.ACTIVO) ? ESTADOS.INACTIVO : ESTADOS.ACTIVO;
    const textoEstadoNuevo = getTextoEstado(estadoNuevo);
    const textoEstadoActual = getTextoEstado(estadoActual);
    
    Swal.fire({
        title: '¿Cambiar estado?',
        html: `El cliente está actualmente <strong>${textoEstadoActual}</strong>.<br>¿Desea cambiarlo a <strong>${textoEstadoNuevo}</strong>?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: (estadoNuevo == ESTADOS.ACTIVO) ? COLORES.exito : COLORES.peligro,
        cancelButtonColor: COLORES.cancelacion,
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            realizarCambioEstado(id, estadoActual);
        }
    });
}

// Función auxiliar para realizar el cambio de estado
function realizarCambioEstado(id, estadoActual) {
    $.ajax({
        url: ENDPOINTS.cambiarEstado,
        type: 'POST',
        data: { 
            id_oculto: id,
            estado_actual: estadoActual
        },
        dataType: 'json',
        beforeSend: function() {
            mostrarCargando(MENSAJES.procesando);
        },
        success: function(response) {
            if (response.success) {
                Swal.close();
                mostrarAlerta('success', '¡Estado cambiado!', response.message, 1500);
                setTimeout(() => {
                    recargarTabla();
                }, 1600);
            } else {
                mostrarAlerta('error', 'Error', response.message);
            }
        },
        error: function() {
            mostrarAlerta('error', 'Error', MENSAJES.error.cambiarEstado);
        }
    });
}

// Función para recargar la tabla (solo para limpiar filtros)
function recargarTabla() {
    if (tablaGeneral) {
        tablaGeneral.ajax.reload(null, false);
    }
}
