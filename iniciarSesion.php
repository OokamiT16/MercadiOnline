<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-main">
        <div class="login-left">
            <!--Aqui dbemos poner una imagen para que se vea bonito, pero no e hecho el dibujo -->
        </div>

        <div class="login-right">
            <img src="img/Logo-1.png" class="login-logo" alt="Logo">
            <div class="login-form-box">
                <h2 class="login-title">¡Bienvenido!</h2>
                <form class="login-form" action="login.php" method="POST" style="display: flex; flex-direction: column; align-items: center;">
                  <input type="text" name="usuario" placeholder="Usuario" required style="margin-bottom: 18px;">
                  <input type="password" name="contrasena" placeholder="Contraseña" required style="margin-bottom: 18px;">
                  <button type="submit" class="login-btn" style="margin-bottom: 15px;">Ingresar</button>
                  <a href="registrar-usuario.php">¿No tienes cuenta? Registrate</a>
                </form>
                <?php if (isset($_SESSION['error'])): ?>
                    <p style="color: red;"><?= $_SESSION['error'] ?></p>
                    <?php unset($_SESSION['error']); ?>
                    
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>
