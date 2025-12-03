// Funcionalidad para la gestión de productos con DataTables

const TABLA_SELECTOR = '#tablaGeneral';
const FILTROS = {estado: '#filtroEstado', nombre: '#filtroNombre', categoria: '#filtroCategorias', tipoCategoria: '#filtroTipos'};
const SELECTORES = {
    modal: '.modal-global',
    modalTitulo: '#staticBackdropLabel',
    formulario: '#formGeneral',
    campos: {
        idOculto: '#id_oculto', 
        nombre: '#nombre', 
        idCategoria: '#id_categoria', 
        precio: '#precio',
        descripcion: '#descripcion',
        etiquetas: '#etiquetas',
        imagen: '#imagen1'
    },
    preview: {containerPrefix: '#previewContainer', imagenPrefix: '#imagenPreview'},
    botones: {guardar: '.btn-guardar', add: '.btn-add', buscar: '.btn-buscar', limpiar: '.btn-limpiar', cancelar: '.btn-cancelar', editar: '.btn-editar', cambiarEstado: '.btn-cambiar-estado'}
};

const ENDPOINTS = {
    datatable: base_url + 'datatable_productos',
    cambiarEstado: base_url + 'cambiar_estado_producto',
    obtenerProducto: base_url + 'obtener_producto',
    guardarProducto: base_url + 'guardar_producto'
};

const ESTADOS = {ACTIVO: 1, INACTIVO: 0};

const CONFIG = {
    imagen: {
        rutaBase: base_url_img + 'images/productos/',
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
        cargarProductos: 'No se pudieron cargar los productos',
        cargarInfo: 'No se pudo cargar la información del producto',
        cambiarEstado: 'No se pudo cambiar el estado del producto',
        procesarSolicitud: 'No se pudo procesar la solicitud'
    },
    validacion: {
        imagenTamanio: 'La imagen no debe superar 2MB',
        imagenFormato: 'Solo se permiten imágenes JPG, PNG o GIF',
        camposIncompletos: 'Campos incompletos',
        nombreRequerido: 'Por favor ingrese el nombre del producto',
        categoriaRequerida: 'Por favor seleccione la categoría',
        precioRequerido: 'Por favor ingrese el precio',
        precioInvalido: 'El precio debe ser mayor a 0'
    }
};

let tablaGeneral;

$(document).ready(function() {
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
    $(FILTROS.categoria).val('');
    $(FILTROS.tipoCategoria).val('');
}

function initDataTable() {
    ['1','2','3','4','5','Detalle'].forEach(num => {
    $('#imagen' + num).on('change', function(e) {
        const file = e.target.files[0];
        const previewImg = $('#imagenPreview' + num);
        const container = $('#previewContainer' + num);

        if (file) {
            previewImg.removeClass('d-none');
            container.show();

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        } else {
            previewImg.attr('src', '').addClass('d-none');
            container.hide();
        }
    });
});

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
                d.id_categoria = $(FILTROS.categoria).val();
                d.id_tipocategoria = $(FILTROS.tipoCategoria).val();
            },
            beforeSend: function () {
                mostrarCargando(MENSAJES.cargando);
            },
            complete: function () {
                Swal.close();
            },
            error: function(xhr, error, thrown) {
                console.error('Error al cargar productos:', error);
                mostrarAlerta('error', 'Error', MENSAJES.error.cargarProductos);
            }
        },
        language: {
            "decimal": "",
            "emptyTable": "No hay productos registrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ productos",
            "infoEmpty": "Mostrando 0 a 0 de 0 productos",
            "infoFiltered": "(filtrado de _MAX_ productos totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ productos",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron productos",
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
            { targets: [2, 3, 5, 6, 7], className: "text-center", orderable: false, searchable: false }
        ]
    });

    $(SELECTORES.botones.buscar).on('click', function() {
        tablaGeneral.ajax.reload(null, true);
    });
    $(SELECTORES.botones.limpiar).on('click', function() {
        limpiarFiltros();
        tablaGeneral.ajax.reload(null, true);
    });
    $(FILTROS.estado + ', ' + FILTROS.categoria + ', ' + FILTROS.tipoCategoria).on('change', function() {
        tablaGeneral.ajax.reload(null, true);
    });

}

function initEventListeners() {
    $(SELECTORES.botones.add).on('click', function() {
        abrirModalNuevoProducto();
    });
    $(TABLA_SELECTOR).on('click', SELECTORES.botones.editar, function() {
        const id = $(this).data('id');
        editarProducto(id);
    });
    
    $(SELECTORES.formulario).on('blur', 'input[type="text"]', function() {
        $(this).val($(this).val().trim());
    });
    $(SELECTORES.botones.cancelar).on('click', function() {
        cerrarModal();
    });
    $(SELECTORES.formulario).on('submit', function(e) {
        e.preventDefault();
        guardarProducto();
    });
    $(TABLA_SELECTOR).on('click', SELECTORES.botones.cambiarEstado, function() {
        const id = $(this).data('id');
        const estadoActual = $(this).data('estado');
        cambiarEstadoProducto(id, estadoActual);
    });

    ['imagen1','imagen2','imagen3','imagen4','imagen5','imagendetalle'].forEach(function(id) {
        $('#' + id).on('change', function() {
            previsualizarImagen(this);
        });
    });
}

function abrirModalNuevoProducto() {
    $(SELECTORES.formulario)[0].reset();
    $(SELECTORES.campos.idOculto).val('');
    // Ocultar todos los contenedores de preview y limpiar src
    $('[id^="previewContainer"]').hide();
    $('[id^="imagenPreview"]').attr('src', '');
    
    // Limpiar TinyMCE
    if (tinymce.get('descripcion')) {
        tinymce.get('descripcion').setContent('');
    }
    
    $(SELECTORES.modalTitulo).text('Nuevo Producto');
    $(SELECTORES.botones.guardar).html('<i class="fas fa-save"></i> Guardar');
    $(SELECTORES.formulario).find('.is-invalid').removeClass('is-invalid');
    $(SELECTORES.modal).modal('show');
}

function editarProducto(id) {
    $.ajax({
        url: ENDPOINTS.obtenerProducto,
        type: 'POST',
        data: { id_oculto: id },
        dataType: 'json',
        beforeSend: function() {
            mostrarCargando(MENSAJES.cargandoDatos);
        },
        success: function(response) {
            Swal.close();

            if (!response.success) {
                return mostrarAlerta('error', 'Error', response.message);
            }

            const producto = response.data;

            // Campos
            $(SELECTORES.campos.idOculto).val(producto.id_oculto);
            $(SELECTORES.campos.nombre).val(producto.nombre);
            $(SELECTORES.campos.idCategoria).val(producto.id_categoria);
            $(SELECTORES.campos.precio).val(producto.precio);
            $(SELECTORES.campos.etiquetas).val(producto.etiquetas);

            // Descripción
            if (tinymce.get('descripcion')) {
                tinymce.get('descripcion').setContent(producto.descripcion || '');
            } else {
                $(SELECTORES.campos.descripcion).val(producto.descripcion);
            }

            // IMÁGENES
            const campos = ['imagen1','imagen2','imagen3','imagen4','imagen5','imagendetalle'];

            campos.forEach(campo => {
                const filename = producto[campo] || '';

                const sufijo = campo === 'imagendetalle' ? 'Detalle' : campo.replace('imagen','');
                const previewImg = $('#imagenPreview' + sufijo);
                const previewContainer = $('#previewContainer' + sufijo);

                if (filename) {
                    previewImg.attr('src', CONFIG.imagen.rutaBase + filename);
                    previewImg.removeClass('d-none');
                    previewContainer.show();
                } else {
                    previewImg.attr('src', '').addClass('d-none');
                    previewContainer.hide();
                }
            });

            $(SELECTORES.modalTitulo).text('Editar Producto');
            $(SELECTORES.botones.guardar).html('<i class="fas fa-save"></i> Actualizar');
            $(SELECTORES.formulario).find('.is-invalid').removeClass('is-invalid');
            $(SELECTORES.modal).modal('show');
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

function guardarProducto() {
    const idOculto = $(SELECTORES.campos.idOculto).val();
    const esEdicion = idOculto !== '' && idOculto !== undefined && idOculto !== null;
    const nombre = $(SELECTORES.campos.nombre).val().trim();
    const idCategoria = $(SELECTORES.campos.idCategoria).val();
    const precio = $(SELECTORES.campos.precio).val();
    
    $(SELECTORES.campos.nombre).removeClass('is-invalid');
    $(SELECTORES.campos.idCategoria).removeClass('is-invalid');
    $(SELECTORES.campos.precio).removeClass('is-invalid');
    
    if (!nombre) {
        $(SELECTORES.campos.nombre).addClass('is-invalid');
        mostrarAlerta('warning', MENSAJES.validacion.camposIncompletos, MENSAJES.validacion.nombreRequerido);
        return;
    }
    if (!idCategoria) {
        $(SELECTORES.campos.idCategoria).addClass('is-invalid');
        mostrarAlerta('warning', MENSAJES.validacion.camposIncompletos, MENSAJES.validacion.categoriaRequerida);
        return;
    }
    
    
    Swal.fire({
        title: esEdicion ? '¿Actualizar producto?' : '¿Guardar nuevo producto?',
        html: `Se ${esEdicion ? 'actualizará' : 'registrará'} el producto: <strong>${nombre}</strong>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: COLORES.confirmacion,
        cancelButtonColor: COLORES.cancelacion,
        confirmButtonText: esEdicion ? '<i class="fas fa-save"></i> Sí, actualizar' : '<i class="fas fa-save"></i> Sí, guardar',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            enviarFormularioProducto(esEdicion);
        }
    });
}

function enviarFormularioProducto(esEdicion) {
    const formData = new FormData($(SELECTORES.formulario)[0]);
    $.ajax({
        url: ENDPOINTS.guardarProducto,
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

function cambiarEstadoProducto(id, estadoActual) {
    const estadoNuevo = (estadoActual == ESTADOS.ACTIVO) ? ESTADOS.INACTIVO : ESTADOS.ACTIVO;
    const textoEstadoNuevo = getTextoEstado(estadoNuevo);
    const textoEstadoActual = getTextoEstado(estadoActual);
    Swal.fire({
        title: '¿Cambiar estado?',
        html: `El producto está actualmente <strong>${textoEstadoActual}</strong>.<br>¿Desea cambiarlo a <strong>${textoEstadoNuevo}</strong>?`,
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
