<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* 🌿 Estilo general */
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
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #444;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
            transition: 0.2s;
            box-sizing: border-box;
        }

        input:focus,
        select:focus,
        textarea:focus {
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

        img {
            display: block;
            max-width: 150px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
        }

        p {
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>

<a href="<?= base_url('productos/listar'); ?>" class="btn-back">&#8592; Volver</a>

<h2>Editar Producto</h2>

<form id="formEditar" method="post" enctype="multipart/form-data">

    <label>Nombre del producto:</label>
    <input type="text" name="nombre" value="<?= $producto->nombre ?>" required>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?= $producto->precio ?>" required>

    <label>Descripción:</label>
    <textarea name="descripcion" rows="4" required><?= $producto->descripcion ?></textarea>

    <label>Categoría:</label>
    <select name="categoria" required>
        <?php foreach ($categorias as $c) { ?>
            <option value="<?= $c->id ?>" <?= ($producto->categoria_id == $c->id) ? "selected" : "" ?>>
                <?= $c->nombre ?>
            </option>
        <?php } ?>
    </select>

    <label>Imagen actual:</label>
    <?php  
        $categoriaFolder = strtolower($producto->categoria);
        $imgPath = "images/productos/$categoriaFolder/{$producto->id}.jpg";
        $imgFullPath = FCPATH . $imgPath;
    ?>
    <img id="previewActual" 
        src="<?= file_exists($imgFullPath) ? base_url($imgPath) . '?v=' . time() : '' ?>" 
        alt="Imagen actual"
        style="width:150px; border:1px solid #ccc; border-radius:6px; margin-bottom:10px;"
        <?= !file_exists($imgFullPath) ? 'hidden' : '' ?>>
    <?php if (!file_exists($imgFullPath)) echo "<p>(Sin imagen)</p>"; ?>

    <label>Subir nueva imagen (Formato JPG):</label>
    <input type="file" name="imagen" accept=".jpg" id="inputImagen">
    <img id="previewNueva" src="" alt="Nueva imagen" 
        style="width:150px; border:1px solid #ccc; border-radius:6px; margin-top:10px; display:none;">

    <button type="submit">Actualizar</button>

</form>

<script>
// Validar imagen JPG y mostrar miniatura
const inputImagen = document.getElementById('inputImagen');
const previewNueva = document.getElementById('previewNueva');
const previewActual = document.getElementById('previewActual');

inputImagen.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) {
        previewNueva.style.display = 'none';
        if(previewActual) previewActual.style.display = 'inline-block';
        return;
    }

    const fileName = file.name.toLowerCase();
    if (!fileName.endsWith('.jpg')) {
        alert('Solo se permiten imágenes en formato JPG.');
        this.value = '';
        previewNueva.style.display = 'none';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        previewNueva.src = e.target.result;
        previewNueva.style.display = 'inline-block';
    }
    reader.readAsDataURL(file);
});

// Confirmación con SweetAlert2 antes de actualizar
document.getElementById('formEditar').addEventListener('submit', function(e){
    e.preventDefault();

    Swal.fire({
        title: '¿Actualizar producto?',
        text: "Confirma que deseas actualizar este producto",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#00a8ff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mensaje de éxito antes de enviar
            Swal.fire({
                title: 'Producto actualizado',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
                didClose: () => {
                    e.target.submit(); // enviar formulario al cerrar mensaje
                }
            });
        }
    });
});
</script>

</body>
</html>
