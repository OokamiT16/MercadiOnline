<?php
// registrar-usuario.php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
    <title>Registrar Usuario</title>
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
                <h2 class="login-title">Registro de Usuario</h2>
                <?php
                if (isset($_SESSION['registro_error'])) {
                    echo "<div style='color: red;'>" . $_SESSION['registro_error'] . "</div>";
                    unset($_SESSION['registro_error']);
                }
                if (isset($_SESSION['registro_exito'])) {
                    echo "<div style='color: green;'>" . $_SESSION['registro_exito'] . "</div>";
                    unset($_SESSION['registro_exito']);
                }
                ?>
                <form class="login-form" action="procesar_registro.php" method="POST" style="display: flex; flex-direction: column; align-items: center;">
                <input type="text" name="usuario" placeholder="Usuario" required style="margin-bottom: 18px;">
                <input type="password" name="contrasena" placeholder="Contraseña" required style="margin-bottom: 18px;">
                <input type="text" name="nombre" placeholder="Nombre completo" required style="margin-bottom: 18px;">
                <input type="text" name="telefono" placeholder="Teléfono" required style="margin-bottom: 18px;">
                <input type="text" name="puesto" placeholder="Puesto" required style="margin-bottom: 18px;">
                <button type="submit" class="login-btn" style="margin-bottom: 15px;">Registrar</button>
                 </form>

                <a href="iniciarSesion.php" style="margin-top:20px; display:block; color:#4C3C8B;">¿Ya tienes cuenta? Iniciar sesión</a>
            </div>
        </div>
    </div>
</body>
</html>
