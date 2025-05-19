<?php
session_start();
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Buscar usuario
    $stmt = $conn->prepare("SELECT * FROM empleado WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($row = $resultado->fetch_assoc()) {
        // Validar contraseña
        if (password_verify($contrasena, $row['contrasena'])) {
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['puesto'] = $row['puesto'];

            // Redirección según tipo de usuario
            if (strtolower($row['usuario']) == "admin" || strtolower($row['puesto']) == "admin") {
                header("Location: dashboard.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            // Contraseña incorrecta
            echo '<script>alert("Credenciales incorrectas."); window.location.href="iniciarSesion.php";</script>';
            exit();
        }
    } else {
        // Usuario no encontrado
        echo '<script>alert("Credenciales incorrectas."); window.location.href="iniciarSesion.php";</script>';
        exit();
    }
}
?>
