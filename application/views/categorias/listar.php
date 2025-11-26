<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de Categorías</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
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

        td a {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            color: #fff;
            transition: 0.3s;
        }

        td a:first-child {
            background-color: #00a8ff;
        }

        td a:first-child:hover {
            background-color: #0097e6;
        }

        td a.btn-eliminar {
            background-color: #e84118;
        }

        td a.btn-eliminar:hover {
            background-color: #c23616;
        }

        /* Responsive */
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
        }
    </style>
</head>

<body>

<a href="<?= base_url('login/dashboard'); ?>" class="btn-back">&#8592; Volver</a>
<a href="<?= base_url('categoria/agregar'); ?>" class="btn-create">Crear</a>

<h2>Categorías Registradas</h2>

<table id="tablaCategorias" class="display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($categorias as $c): ?>
            <tr>
                <td data-label="ID"><?= $c->id ?></td>
                <td data-label="Nombre"><?= $c->nombre ?></td>
                <td data-label="Opciones">
                    <a href="<?= base_url('categoria/editar/'.$c->id) ?>">Editar</a>
                    <a href="<?= base_url('categoria/eliminar/'.$c->id) ?>" class="btn-eliminar">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $("#tablaCategorias").DataTable();
});

// Confirmación y mensaje con SweetAlert2 al eliminar
const enlacesEliminar = document.querySelectorAll('.btn-eliminar');

enlacesEliminar.forEach(enlace => {
    enlace.addEventListener('click', function(e) {
        e.preventDefault(); // evitar acción por defecto
        const url = this.href;

        Swal.fire({
            title: '¿Eliminar categoría?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e84118',
            cancelButtonColor: '#718093',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Categoría eliminada',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                    didClose: () => {
                        window.location.href = url;
                    }
                });
            }
        });
    });
});
</script>

</body>
</html>
