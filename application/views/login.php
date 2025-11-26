<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>

    <style>
        /* Fondo general */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #2e2e2e, #4a4a4a);
            font-family: "Poppins", sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Botón volver */
        .btn-back {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #ff7a00;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 4px 0 #c55f00;
        }

        .btn-back:hover {
            background: #e86f00;
            box-shadow: 0 4px 0 #a94e00;
            transform: translateY(-2px);
        }

        .btn-back:active {
            transform: translateY(1px);
            box-shadow: 0 2px 0 #a94e00;
        }

        /* Contenedor del login */
        .login-box {
            background: #ffffff;
            width: 380px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.30);
            animation: fadeIn 0.5s ease-in-out;
            text-align: center; /* CENTRAR TODO */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Título */
        .login-box h2 {
            margin: 0 0 25px 0;
            font-size: 28px;
            text-align: center;
            color: #333;
            font-weight: 600;
        }

        /* Inputs */
        .input-group {
            width: 100%;
            margin-bottom: 18px;
            display: flex;
            justify-content: center;
        }

        .input-group input {
            width: 90%; /* CENTRADO Y AJUSTADO */
            padding: 14px;
            border-radius: 10px;
            border: 1px solid #bbb;
            outline: none;
            font-size: 15px;
            transition: 0.2s;
        }

        .input-group input:focus {
            border-color: #ff7a00;
            box-shadow: 0 0 5px rgba(255,122,0,0.5);
        }

        /* Botón elegante estilo FERRETERÍA */
        .btn-login {
            width: 90%;
            background: #ff7a00;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 17px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: 0.3s;
            box-shadow: 0 6px 0 #c55f00;
        }

        .btn-login:hover {
            background: #e86f00;
            box-shadow: 0 6px 0 #a94e00;
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(1px);
            box-shadow: 0 3px 0 #a94e00;
        }

        /* Mensaje de error */
        .error {
            background: #ffe1e1;
            padding: 10px;
            color: #c40000;
            border-left: 4px solid #c40000;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }

        /* Móvil */
        @media (max-width: 420px) {
            .login-box {
                width: 90%;
                padding: 25px;
            }

            .btn-back {
                top: 10px;
                right: 10px;
                padding: 8px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <!-- Botón volver -->
    <a href="<?= base_url(); ?>" class="btn-back">&#8592; Volver</a>

    <div class="login-box">
        <h2>Iniciar Sesión</h2>

        <!-- ERROR -->
        <?php if($this->session->flashdata("error")): ?>
            <div class="error">
                <?= $this->session->flashdata("error"); ?>
            </div>
        <?php endif; ?>

        <!-- FORMULARIO -->
        <form action="<?= base_url('login/validar'); ?>" method="POST">

            <div class="input-group">
                <input type="text" name="usuario" placeholder="Usuario" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="btn-login">Ingresar</button>
        </form>
    </div>

</body>
</html>
