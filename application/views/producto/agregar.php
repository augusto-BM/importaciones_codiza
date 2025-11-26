<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
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
            max-width: 600px;
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

        input[type="text"],
        input[type="number"],
        select,
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus,
        input[type="file"]:focus {
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

        #preview {
            display: block;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 1px solid #ccc;
            margin-top: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<a href="<?= base_url('login/dashboard'); ?>" class="btn-back">&#8592; Volver</a>

<h2>Agregar Producto</h2>

<form id="formAgregar" method="post" enctype="multipart/form-data">

    <label>Nombre del producto:</label>
    <input type="text" name="nombre" required>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" required>

    <label>Descripción:</label>
    <textarea name="descripcion" rows="4" required></textarea>

    <label>Categoría:</label>
    <select name="categoria" required>
        <?php foreach ($categorias as $c) { ?>
            <option value="<?= $c->id ?>"><?= $c->nombre ?></option>
        <?php } ?>
    </select>

    <label>Imagen del producto (Formato JPG):</label>
    <input type="file" name="imagen" accept=".jpg" id="inputImagen" required>

    <img id="preview" src="#" alt="Miniatura" style="display:none;">

    <button type="submit">Guardar</button>
</form>

<script>
// Mostrar miniatura y validar JPG
document.getElementById('inputImagen').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        const fileName = file.name.toLowerCase();
        if (!fileName.endsWith('.jpg')) {
            alert('Solo se permiten imágenes en formato JPG.');
            e.target.value = '';
            preview.style.display = 'none';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});

// SweetAlert2 al enviar
document.getElementById('formAgregar').addEventListener('submit', function(e){
    e.preventDefault(); // evitar envío inmediato

    Swal.fire({
        title: '¿Agregar este producto?',
        text: "Confirma que quieres guardar este producto",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#00a8ff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, agregar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            // Mostrar mensaje de éxito antes de enviar
            Swal.fire({
                title: '¡Producto agregado!',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
                willClose: () => {
                    // enviar formulario al cerrar el mensaje
                    e.target.submit();
                }
            });
        }
    });
});
</script>

</body>
</html>
