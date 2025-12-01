// Funcionalidad para la gestión de categorías con DataTables

const TABLA_SELECTOR = '#tablaGeneral';
const FILTROS = {estado: '#filtroEstado', nombre: '#filtroNombre', tipo: '#filtroTipos'};
const SELECTORES = {
    modal: '.modal-global',
    modalTitulo: '#staticBackdropLabel',
    formulario: '#formGeneral',
    campos: {idOculto: '#id_oculto', nombre: '#nombre', idTipo: '#id_tipocategoria', imagen: '#imagen'},
    preview: {container: '#previewContainer', imagen: '#imagenPreview'},
    botones: {guardar: '.btn-guardar', add: '.btn-add', buscar: '.btn-buscar', limpiar: '.btn-limpiar', cancelar: '.btn-cancelar', editar: '.btn-editar', cambiarEstado: '.btn-cambiar-estado'}
};

const ENDPOINTS = {
    datatable: base_url + 'datatable_categorias',
    cambiarEstado: base_url + 'cambiar_estado_categoria',
    obtenerCategoria: base_url + 'obtener_categoria',
    guardarCategoria: base_url + 'guardar_categoria'
};

const ESTADOS = {ACTIVO: 1, INACTIVO: 0};

const CONFIG = {
    imagen: {
        rutaBase: base_url_img + 'images/categorias/',
        tamanioMax: 2097152,
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
        cargarCategorias: 'No se pudieron cargar las categorías',
        cargarInfo: 'No se pudo cargar la información de la categoría',
        cambiarEstado: 'No se pudo cambiar el estado de la categoría',
        procesarSolicitud: 'No se pudo procesar la solicitud'
    },
    validacion: {
        imagenTamanio: 'La imagen no debe superar 2MB',
        imagenFormato: 'Solo se permiten imágenes JPG, PNG o GIF',
        camposIncompletos: 'Campos incompletos',
        nombreRequerido: 'Por favor ingrese el nombre de la categoría',
        tipoRequerido: 'Por favor seleccione el tipo de categoría'
    }
};

let tablaGeneral;

$(document).ready(function() {
    /* cargarTiposCategoria(); */
    initDataTable();
    initEventListeners();
    $(SELECTORES.modal).on('hidden.bs.modal', function () {
        $('body').removeClass('modal-open').css('padding-right', '');
        $('.modal-backdrop').remove();
    });
});

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
    $(FILTROS.tipo).val('');
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
                d.id_tipocategoria = $(FILTROS.tipo).val();
            },
            beforeSend: function () {
                mostrarCargando(MENSAJES.cargando);
            },
            complete: function () {
                Swal.close();
            },
            error: function(xhr, error, thrown) {
                console.error('Error al cargar categorías:', error);
                mostrarAlerta('error', 'Error', MENSAJES.error.cargarCategorias);
            }
        },
        language: {
            "decimal": "",
            "emptyTable": "No hay categorías registradas",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ categorías",
            "infoEmpty": "Mostrando 0 a 0 de 0 categorías",
            "infoFiltered": "(filtrado de _MAX_ categorías totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ categorías",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron categorías",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        pageLength: CONFIG.datatable.pageLength,
        lengthMenu: CONFIG.datatable.lengthMenu,
        columnDefs: [
            { targets: [0], visible: false },
            { targets: [0, 1, 2], searchable: false, orderable: false },
            { targets: [1, 2]},
            { targets: [3, 4, 5], className: "text-center", orderable: false, searchable: false }
        ]
    });

    $(SELECTORES.botones.buscar).on('click', function() {
        tablaGeneral.ajax.reload(null, false);
    });
    $(SELECTORES.botones.limpiar).on('click', function() {
        limpiarFiltros();
        tablaGeneral.ajax.reload(null, true);
    });
    $(FILTROS.estado + ', ' + FILTROS.tipo).on('change', function() {
        recargarTabla();
    });

}

function initEventListeners() {
    $(SELECTORES.botones.add).on('click', function() {
        abrirModalNuevaCategoria();
    });
    $(TABLA_SELECTOR).on('click', SELECTORES.botones.editar, function() {
        const id = $(this).data('id');
        editarCategoria(id);
    });
    $(SELECTORES.campos.imagen).on('change', function() {
        previsualizarImagen(this);
    });
    $(SELECTORES.formulario).on('blur', 'input[type="text"]', function() {
        $(this).val($(this).val().trim());
    });
    $(SELECTORES.botones.cancelar).on('click', function() {
        cerrarModal();
    });
    $(SELECTORES.formulario).on('submit', function(e) {
        e.preventDefault();
        guardarCategoria();
    });
    $(TABLA_SELECTOR).on('click', SELECTORES.botones.cambiarEstado, function() {
        const id = $(this).data('id');
        const estadoActual = $(this).data('estado');
        cambiarEstadoCategoria(id, estadoActual);
    });
}

function abrirModalNuevaCategoria() {
    $(SELECTORES.formulario)[0].reset();
    $(SELECTORES.campos.idOculto).val('');
    $(SELECTORES.preview.container).hide();
    $(SELECTORES.preview.imagen).attr('src', '');
    $(SELECTORES.modalTitulo).text('Nueva Categoría');
    $(SELECTORES.botones.guardar).html('<i class="fas fa-save"></i> Guardar');
    $(SELECTORES.formulario).find('.is-invalid').removeClass('is-invalid');
    $(SELECTORES.modal).modal('show');
}

function editarCategoria(id) {
    $.ajax({
        url: ENDPOINTS.obtenerCategoria,
        type: 'POST',
        data: { id_oculto: id },
        dataType: 'json',
        beforeSend: function() {
            mostrarCargando(MENSAJES.cargandoDatos);
        },
        success: function(response) {
            Swal.close();
            if (response.success) {
                const categoria = response.data;
                $(SELECTORES.campos.idOculto).val(categoria.id_oculto);
                $(SELECTORES.campos.nombre).val(categoria.nombre);
                $(SELECTORES.campos.idTipo).val(categoria.id_tipocategoria);
                if (categoria.imagen && categoria.imagen !== '') {
                    $(SELECTORES.preview.imagen).attr('src', CONFIG.imagen.rutaBase + categoria.imagen);
                    $(SELECTORES.preview.container).show();
                } else {
                    $(SELECTORES.preview.container).hide();
                }
                $(SELECTORES.modalTitulo).text('Editar Categoría');
                $(SELECTORES.botones.guardar).html('<i class="fas fa-save"></i> Actualizar');
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

function previsualizarImagen(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.size > CONFIG.imagen.tamanioMax) {
            mostrarAlerta('warning', 'Advertencia', MENSAJES.validacion.imagenTamanio);
            $(input).val('');
            $(SELECTORES.preview.container).hide();
            return;
        }
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

function guardarCategoria() {
    const idOculto = $(SELECTORES.campos.idOculto).val();
    const esEdicion = idOculto !== '' && idOculto !== undefined && idOculto !== null;
    const nombre = $(SELECTORES.campos.nombre).val().trim();
    const idTipo = $(SELECTORES.campos.idTipo).val();
    $(SELECTORES.campos.nombre).removeClass('is-invalid');
    $(SELECTORES.campos.idTipo).removeClass('is-invalid');
    if (!nombre) {
        $(SELECTORES.campos.nombre).addClass('is-invalid');
        mostrarAlerta('warning', MENSAJES.validacion.camposIncompletos, MENSAJES.validacion.nombreRequerido);
        return;
    }
    if (!idTipo) {
        $(SELECTORES.campos.idTipo).addClass('is-invalid');
        mostrarAlerta('warning', MENSAJES.validacion.camposIncompletos, MENSAJES.validacion.tipoRequerido);
        return;
    }
    Swal.fire({
        title: esEdicion ? '¿Actualizar categoría?' : '¿Guardar nueva categoría?',
        html: `Se ${esEdicion ? 'actualizará' : 'registrará'} la categoría: <strong>${nombre}</strong>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: COLORES.confirmacion,
        cancelButtonColor: COLORES.cancelacion,
        confirmButtonText: esEdicion ? '<i class="fas fa-save"></i> Sí, actualizar' : '<i class="fas fa-save"></i> Sí, guardar',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            enviarFormularioCategoria(esEdicion);
        }
    });
}

function enviarFormularioCategoria(esEdicion) {
    const formData = new FormData($(SELECTORES.formulario)[0]);
    $.ajax({
        url: ENDPOINTS.guardarCategoria,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            mostrarCargando(esEdicion ? MENSAJES.actualizando : MENSAJES.guardando);
        },
        success: function(response) {
            if (response.success) {
                cerrarModal();
                setTimeout(() => {
                    mostrarAlerta('success', '¡Éxito!', response.message, 1500);
                    recargarTabla();
                }, CONFIG.modal.animacionDelay);
            } else {
                mostrarAlerta('error', 'Error', response.message);
            }
        },
        error: function(xhr, status, error) {
            mostrarAlerta('error', 'Error', MENSAJES.error.procesarSolicitud);
        }
    });
}

function cerrarModal() {
    $(SELECTORES.modal).modal('hide');
    $(SELECTORES.formulario)[0].reset();
    $(SELECTORES.preview.container).hide();
    $(SELECTORES.formulario).find('.is-invalid').removeClass('is-invalid');
    setTimeout(() => {
        $('body').removeClass('modal-open').css('padding-right', '');
        $('.modal-backdrop').remove();
    }, CONFIG.modal.animacionDelay);
}

function cambiarEstadoCategoria(id, estadoActual) {
    const estadoNuevo = (estadoActual == ESTADOS.ACTIVO) ? ESTADOS.INACTIVO : ESTADOS.ACTIVO;
    const textoEstadoNuevo = getTextoEstado(estadoNuevo);
    const textoEstadoActual = getTextoEstado(estadoActual);
    Swal.fire({
        title: '¿Cambiar estado?',
        html: `La categoría está actualmente <strong>${textoEstadoActual}</strong>.<br>¿Desea cambiarla a <strong>${textoEstadoNuevo}</strong>?`,
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

function recargarTabla() {
    if (tablaGeneral) {
        tablaGeneral.ajax.reload(null, false);
    }
}
