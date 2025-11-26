<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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

        form {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #444;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
            box-sizing: border-box;
            transition: 0.2s;
        }

        input[type="text"]:focus {
            border-color: #40739e;
            outline: none;
        }

        button {
            background: #40739e;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            display: block;
            width: 100%;
        }

        button:hover {
            background: #2f3640;
        }
    </style>
</head>
<body>

<a href="<?= base_url('categoria/listar'); ?>" class="btn-back">&#8592; Volver</a>

<h2>Editar Categoría</h2>

<form id="formEditarCategoria" method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $categoria->nombre ?>" required>
    <button type="submit">Actualizar</button>
</form>

<script>
document.getElementById('formEditarCategoria').addEventListener('submit', function(e){
    e.preventDefault(); // Evitar envío inmediato

    Swal.fire({
        title: '¿Actualizar categoría?',
        text: "Confirma que deseas actualizar esta categoría",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#00a8ff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Categoría actualizada',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
                didClose: () => {
                    e.target.submit(); // enviar formulario después del mensaje
                }
            });
        }
    });
});
</script>

</body>
</html>
