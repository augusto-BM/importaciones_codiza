<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f1f1f1;
            font-family: "Poppins", sans-serif;
        }

        .container {
            padding: 40px 20px;
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 32px;
            color: #333;
            letter-spacing: 1px;
        }

        /* GRID DE BOTONES */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        }

        /* TARJETAS */
        .card {
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
            text-align: center;
            transition: 0.3s;
            border-left: 6px solid #ff7a00; /* toque ferretería */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.18);
        }

        .card i {
            font-size: 45px;
            margin-bottom: 15px;
            color: #ff7a00;
        }

        .card h3 {
            margin-top: 0;
            color: #333;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .card p {
            color: #666;
            font-size: 15px;
            margin-bottom: 20px;
        }

        /* BOTÓN */
        .btn {
            display: inline-block;
            padding: 12px 15px;
            background: #ff7a00;
            color: white;
            text-decoration: none;
            font-size: 15px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 4px 0 #c55f00;
        }

        .btn:hover {
            background: #e36d00;
            box-shadow: 0 4px 0 #a65000;
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #a65000;
        }
    </style>

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
<br><br>
<br>

<div class="container">
<br>
    <!-- Botón de cerrar sesión -->
    <div style="text-align: right; margin-bottom: 15px;">
        <a class="btn" href="<?= base_url('login/salir'); ?>">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </div>

    <h1>Panel de Administración</h1>

    <div class="dashboard-grid">
        <!-- AGREGAR CATEGORÍA -->
        <div class="card">
            <i class="fas fa-folder-plus"></i>
            <h3>Agregar Categoría</h3>
            <p>Registra nuevas categorías para organizar tus productos.</p>
            <a class="btn" href="<?= base_url('categoria/agregar'); ?>">Ir</a>
        </div>

        <!-- EDITAR CATEGORÍAS -->
        <div class="card">
            <i class="fas fa-edit"></i>
            <h3>Editar Categorías</h3>
            <p>Modifica, elimina o actualiza categorías existentes.</p>
            <a class="btn" href="<?= base_url('categoria/listar'); ?>">Ir</a>
        </div>

        <!-- AGREGAR PRODUCTO -->
        <div class="card">
            <i class="fas fa-box-open"></i>
            <h3>Agregar Producto</h3>
            <p>Ingresa nuevos productos con precios y stock.</p>
            <a class="btn" href="<?= base_url('productos/agregar'); ?>">Ir</a>
        </div>

        <!-- EDITAR PRODUCTOS -->
        <div class="card">
            <i class="fas fa-boxes-stacked"></i>
            <h3>Editar Productos</h3>
            <p>Actualiza información de productos ya registrados.</p>
            <a class="btn" href="<?= base_url('productos/listar'); ?>">Ir</a>
        </div>
    </div>
</div>


</body>
</html>
