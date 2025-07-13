<?php
/*Esto de abajo para evitar doble registrto al actualizar 
(Todavía no testeo esta parte de abajo, pero si mi lógica no me ffalla debería cumplir su función) AAAAAAA, por qué nadie crea la base de datos? :c  */
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: registro.php");
  exit();
}
/*Fin*/

$conexion = new mysqli("localhost", "root", "", "nombre_de_tu_base_de_datos"); // Aquí debo recordar reemplazar esto para la base de datos, todavía no está creada

if ($conexion->connect_error) {
  die("Conexión fallida: " . $conexion->connect_error);
}

$nombre     = $_POST['nombre'] ?? '';
$apellido   = $_POST['apellido'] ?? '';
$fecha      = $_POST['fecha'] ?? '';
$cedula     = $_POST['cedula'] ?? '';
$correo     = $_POST['correo'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Hasheo esta shingadera para cifrar contraseña
$contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, apellido, fecha, cedula, correo, contrasena)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssss", $nombre, $apellido, $fecha, $cedula, $correo, $contrasena_hashed);

if ($stmt->execute()) {
  echo "<script>alert('¡Registro exitoso!'); window.location.href='index.php';</script>";
} else {
  echo "<script>alert('Error al registrar: " . $conexion->error . "'); window.history.back();</script>";
}

$stmt->close();
$conexion->close();

?>
