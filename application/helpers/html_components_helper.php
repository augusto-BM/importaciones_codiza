<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generar_boton_estado')) {
    /**
     * Genera un botón para cambiar el estado (activo/inactivo)
     * 
     * @param int $id ID del registro
     * @param int $estado Estado actual (1 = activo, 0 = inactivo)
     * @return string HTML del botón
     */
    function generar_boton_estado($id, $estado) {
        $estado_class = ($estado == 1) ? 'btn-success' : 'btn-danger';
        $estado_texto = ($estado == 1) ? 'ACTIVO' : 'INACTIVO';
        
        return '<button class="btn btn-sm ' . $estado_class . ' btn-cambiar-estado" 
                    data-id="' . $id . '" 
                    data-estado="' . $estado . '" 
                    title="Cambiar estado">
                    ' . $estado_texto . '
                </button>';
    }
}

if (!function_exists('generar_boton_editar')) {
    /**
     * Genera un botón de editar con icono
     * 
     * @param int $id ID del registro a editar
     * @return string HTML del botón
     */
    function generar_boton_editar($id) {
        return '<button class="btn btn-warning btn-editar" 
                    data-id="' . $id . '" 
                    title="Editar">
                    <i class="fas fa-edit" style="color: #272921c0;"></i>
                </button>';
    }
}

if (!function_exists('generar_imagen')) {
    /**
     * Genera una imagen thumbnail con fallback
     * 
     * @param string $carpeta Carpeta dentro de images/ donde se encuentra la imagen
     * @param string $imagen Nombre del archivo de imagen
     * @param string $alt Texto alternativo para la imagen (opcional)
     * @return string HTML de la imagen o mensaje de sin imagen
     */
    function generar_imagen($carpeta, $imagen, $alt = '') {
        if (!empty($imagen)) {
            $ruta_imagen = base_url("images/" . $carpeta . "/" . $imagen);
            return '<a href="' . $ruta_imagen . '" target="_blank" rel="noopener noreferrer" title="Ver Imagen">
                        <img src="' . $ruta_imagen . '" alt="' . htmlspecialchars($alt) . '"
                        class="img-thumbnail" style="max-width: 25px; max-height: 25px; object-fit: cover; cursor: pointer;" 
                        onerror="this.src=\'' . base_url("images/logo/logo.png") . '\'">
                    </a>';
        } else {
            return '<span class="text-muted"><i class="fas fa-image-slash"></i> Sin imagen</span>';
        }
    }
}

if (!function_exists('generar_boton_eliminar')) {
    /**
     * Genera un botón de eliminar con icono
     * 
     * @param int $id ID del registro a eliminar
     * @return string HTML del botón
     */
    function generar_boton_eliminar($id) {
        return '<button class="btn btn-sm btn-danger btn-eliminar" 
                    data-id="' . $id . '" 
                    title="Eliminar">
                    <i class="fas fa-trash"></i>
                </button>';
    }
}

if (!function_exists('generar_boton_ver')) {
    /**
     * Genera un botón de ver/visualizar con icono
     * 
     * @param int $id ID del registro a visualizar
     * @return string HTML del botón
     */
    function generar_boton_ver($id) {
        return '<button class="btn btn-sm btn-info btn-ver" 
                    data-id="' . $id . '" 
                    title="Ver detalles">
                    <i class="fas fa-eye"></i>
                </button>';
    }
}

if (!function_exists('generar_badge_estado')) {
    /**
     * Genera un badge de estado (activo/inactivo)
     * 
     * @param int $estado Estado (1 = activo, 0 = inactivo)
     * @return string HTML del badge
     */
    function generar_badge_estado($estado) {
        $badge_class = ($estado == 1) ? 'badge-success' : 'badge-danger';
        $estado_texto = ($estado == 1) ? 'ACTIVO' : 'INACTIVO';
        
        return '<span class="badge ' . $badge_class . '">' . $estado_texto . '</span>';
    }
}
