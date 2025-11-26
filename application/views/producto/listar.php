<!DOCTYPE html>
<html>
<head>
    <!-- Agregar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <a href="<?= base_url('login/dashboard'); ?>" class="btn-back">&#8592; Volver</a>
    <a href="<?= base_url('productos/agregar'); ?>" class="btn-create">Crear</a>

    <title>Listado de Productos</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <style>
        /* 🌿 Estilo general de la página */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2f3640;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #273c75;
            padding: 8px 16px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .btn-back:hover {
            background-color: #192a56;
        }

        .btn-create {
                display: inline-block;
                margin-bottom: 20px;
                text-decoration: none;
                color: #fff;
                background-color: #273c75;
                padding: 8px 16px;
                border-radius: 8px;
                transition: background 0.3s;
                float: right; /* esto lo mueve a la derecha */
        }

        .btn-create:hover {
                background-color: #192a56;
        }

        /* 🌿 Tabla */
        table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
        }

        table.dataTable thead th {
            background-color: #40739e;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border: none;
            text-align: center;
        }

        table.dataTable tbody td {
            background-color: #fff;
            padding: 10px;
            vertical-align: middle;
            text-align: center;
        }

        table.dataTable tbody tr {
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-radius: 10px;
        }

        table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        td a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 6px;
            color: #fff;
            background-color: #00a8ff;
            transition: 0.3s;
        }

        td a:hover {
            background-color: #0097e6;
        }

        td a:last-child {
            background-color: #e84118;
        }

        td a:last-child:hover {
            background-color: #c23616;
        }

        /* Ajuste responsive */
        @media screen and (max-width: 768px) {
            table.dataTable thead {
                display: none;
            }

            table.dataTable tbody td {
                display: block;
                width: 100%;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table.dataTable tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 10px;
                font-weight: 600;
                text-align: left;
            }

            table img {
                margin: 0 auto 10px auto;
                display: block;
            }
        }
    </style>
</head>

<body>

<h2>Productos Registrados</h2>

<table id="tablaProductos" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($productos as $p): ?>
            <tr>
                <td><?= $p->id ?></td>

                <!-- Miniatura -->
                <td>
                    <?php
                        $categoriaFolder = strtolower($p->categoria_nombre);
                        $imgPath = "images/productos/$categoriaFolder/{$p->id}.jpg";
                        $imgFullPath = FCPATH . $imgPath;
                    ?>
                    <?php if (file_exists($imgFullPath)) { ?>
                        <img src="<?= base_url($imgPath) . '?v=' . time() ?>" alt="<?= $p->nombre ?>">
                    <?php } else { ?>
                        <span>(Sin imagen)</span>
                    <?php } ?>
                </td>

                <td><?= $p->nombre ?></td>
                <td><?= $p->categoria_nombre ? $p->categoria_nombre : "<i>Sin categoría</i>" ?></td>
                <td>S/ <?= number_format($p->precio, 2) ?></td>

                <td>
                    <a href="<?= base_url('productos/editar/'.$p->id) ?>">Editar</a>
                    <a href="<?= base_url('productos/eliminar/'.$p->id) ?>" class="btn-eliminar" data-id="<?= $p->id ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $("#tablaProductos").DataTable({
            "pageLength": 10,
            "lengthMenu": [5,10,20,50],
        });
    });
</script>

<script>
const enlacesEliminar = document.querySelectorAll('.btn-eliminar');

enlacesEliminar.forEach(enlace => {
    enlace.addEventListener('click', function(e) {
        e.preventDefault(); // evitar acción por defecto
        const url = this.href;

        Swal.fire({
            title: '¿Eliminar producto?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e84118',
            cancelButtonColor: '#718093',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar mensaje de eliminado antes de redirigir
                Swal.fire({
                    title: 'Producto eliminado',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                    didClose: () => {
                        window.location.href = url; // redirige después del mensaje
                    }
                });
            }
        });
    });
});
</script>

</body>
</html>
