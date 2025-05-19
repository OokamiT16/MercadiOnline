<?php
session_start();
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $puesto = $_POST['puesto'];

    // Verifica si el usuario ya existe
    $query = "SELECT * FROM empleado WHERE usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $_SESSION['registro_error'] = "El usuario ya existe. Por favor elige otro nombre de usuario.";
        header("Location: registrar-usuario.php");
        exit();
    }

    // Hashea la contraseña
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Inserta el nuevo usuario en la tabla empleado
    $query = "INSERT INTO empleado (usuario, contrasena, nombre, telefono, puesto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $usuario, $contrasena_hash, $nombre, $telefono, $puesto);

    if ($stmt->execute()) {
        $_SESSION['registro_exito'] = "¡Usuario registrado correctamente!";
        header("Location: registrar-usuario.php");
        exit();
    } else {
        $_SESSION['registro_error'] = "Error al registrar usuario. Intenta de nuevo.";
        header("Location: registrar-usuario.php");
        exit();
    }
} else {
    header("Location: registrar-usuario.php");
    exit();
}
?>
