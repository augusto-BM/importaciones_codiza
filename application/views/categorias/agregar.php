<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar Categoría</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
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

        form {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
            color: #2f3640;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
            transition: border 0.3s;
        }

        input[type="text"]:focus {
            border-color: #40739e;
            outline: none;
        }

        button[type="submit"] {
            background-color: #00a8ff;
            color: #fff;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
            display: block;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0097e6;
        }
    </style>
</head>
<body>

<a href="<?= base_url('login/dashboard'); ?>" class="btn-back">&#8592; Volver</a>

<h2>Agregar Categoría</h2>

<form id="formCategoria" method="post">
    <label>Nombre de la categoría:</label>
    <input type="text" name="nombre" required>
    <button type="submit">Guardar</button>
</form>

<script>
// Confirmación antes de enviar con SweetAlert2
document.getElementById('formCategoria').addEventListener('submit', function(e){
    e.preventDefault(); // evitar envío inmediato

    Swal.fire({
        title: '¿Agregar esta categoría?',
        text: "Confirma que quieres guardar esta categoría",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#00a8ff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, agregar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Aquí se puede enviar el formulario
            e.target.submit();

            // Mensaje de éxito
            Swal.fire({
                title: 'Categoría agregada',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
});
</script>

</body>
</html>
