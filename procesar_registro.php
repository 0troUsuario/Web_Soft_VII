<?php
$mysqli = new mysqli('localhost', 'root', '', 'dalle');

if ($mysqli->connect_errno) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

$nombre = $mysqli->real_escape_string($_POST['nombre']);
$apellido = $mysqli->real_escape_string($_POST['apellido']);
$fecha = $_POST['fecha'];
$cedula = $mysqli->real_escape_string($_POST['cedula']);
$correo = $mysqli->real_escape_string($_POST['correo']);
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); 

$query = "INSERT INTO usuarios (nombre, apellido, fecha, cedula, correo, contraseña)
          VALUES ('$nombre', '$apellido', '$fecha', '$cedula', '$correo', '$contrasena')";

if ($mysqli->query($query)) {
    header("Location: index.php");
    exit();
} else {
    echo "Error al registrar: " . $mysqli->error;
}



?>
