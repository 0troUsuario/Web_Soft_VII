<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'dalle');

if ($mysqli->connect_errno) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

$usuario = $mysqli->real_escape_string($_POST['usuario']);
$contrasena = $_POST['contrasena'];


$sql = "SELECT * FROM usuarios WHERE correo = '$usuario' OR cedula = '$usuario'";
$resultado = $mysqli->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $usuarioDB = $resultado->fetch_assoc();


    if (password_verify($contrasena, $usuarioDB['contraseña'])) {
        $_SESSION['usuario_id'] = $usuarioDB['id'];
        $_SESSION['usuario_nombre'] = $usuarioDB['nombre'];
        $_SESSION['usuario_correo'] = $usuarioDB['correo'];

        header("Location: inicio.php");
        exit();
    } else {
        $_SESSION['error'] = "Contraseña incorrecta.";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Usuario no encontrado.";
    header("Location: index.php");
    exit();
}
?>
