<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
</head>

<body>
    <?php
    // Generar CSRF token si no existe
    if (!$this->session->userdata('csrf_token')) {
        $csrf_token = bin2hex(random_bytes(32));
        $this->session->set_userdata('csrf_token', $csrf_token);
    } else {
        $csrf_token = $this->session->userdata('csrf_token');
    }
    ?>
    
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <!-- ERROR -->
        <?php if($this->session->flashdata("error")): ?>
            <div class="error" role="alert">
                <?= htmlspecialchars($this->session->flashdata("error"), ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <!-- FORMULARIO -->
        <form action="<?= base_url('login/validar'); ?>" method="POST" autocomplete="on">
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">

            <div class="input-group">
                <input 
                    type="text" 
                    name="usuario" 
                    placeholder="Usuario" 
                    required 
                    autocomplete="username"
                    maxlength="255"
                    aria-label="Usuario">
            </div>

            <div class="input-group">
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Contraseña" 
                    required
                    autocomplete="current-password"
                    maxlength="255"
                    minlength="4"
                    aria-label="Contraseña">
            </div>

            <button type="submit" class="btn-login">Ingresar</button>

            <p><a href="<?= base_url(); ?>" class="btn-back">Regresar</a></p>
        </form>
    </div>
</body>
</html>
