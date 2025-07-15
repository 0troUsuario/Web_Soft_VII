<?php
error_reporting(E_ALL); // Muestra todos los errores
ini_set('display_errors', 1); // Muestra los errores en el navegador
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: registro.php");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "dalle");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$username    = $_POST['username'] ?? '';
$nombre      = $_POST['nombre'] ?? '';
$fecha       = $_POST['fecha'] ?? '';
$cedula      = $_POST['cedula'] ?? '';
$correo      = $_POST['correo'] ?? '';
$contrasena  = $_POST['contrasena'] ?? '';

// --- INICIO DE LAS VALIDACIONES ---

// 1. Validar campos vacíos
if (empty($username) || empty($nombre) || empty($fecha) || empty($cedula) || empty($correo) || empty($contrasena)) {
    echo "<script>alert('Por favor, completa todos los campos.'); window.history.back();</script>";
    $conexion->close(); // Cerrar conexión antes de salir
    exit();
}

// 2. Validar formato de correo electrónico
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Correo electrónico inválido.'); window.history.back();</script>";
    $conexion->close(); // Cerrar conexión antes de salir
    exit();
}

// 3. Verificar si el nombre de usuario o correo ya existe (Aquí es donde estaba el problema de '$verificar->num_rows')
// Asegúrate de que tu tabla 'usuario' y las columnas 'username' y 'correo' existen.

$verificar = $conexion->prepare("SELECT id FROM usuario WHERE username = ? OR correo = ?");
if ($verificar === false) {
    // Si prepare falla, es un error en la sintaxis SQL o nombre de tabla/columna.
    die("Error al preparar la consulta de verificación (SELECT): " . $conexion->error);
}

$verificar->bind_param("ss", $username, $correo);

if (!$verificar->execute()) {
    // Si execute falla, es un problema de ejecución de la consulta.
    die("Error al ejecutar la consulta de verificación (SELECT): " . $verificar->error);
}

$verificar->store_result(); // Necesario para que num_rows funcione

if ($verificar->num_rows > 0) {
    echo "<script>alert('El nombre de usuario o correo ya está registrado.'); window.history.back();</script>";
    $verificar->close();
    $conexion->close(); // Cerrar conexión antes de salir
    exit();
}
$verificar->close();

// --- FIN DE LAS VALIDACIONES ---

// Si llegamos hasta aquí, todas las validaciones pasaron, ahora podemos hashear la contraseña e insertar.

$contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario (username, nombre, fecha, cedula, correo, contrasena) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    // Si prepare falla aquí, es un error en la sintaxis SQL del INSERT o columnas/tabla.
    die("Error al preparar la consulta de inserción (INSERT): " . $conexion->error);
}

$stmt->bind_param("ssssss", $username, $nombre, $fecha, $cedula, $correo, $contrasena_hashed);

if ($stmt->execute()) {
    echo "<script>alert('¡Registro exitoso!'); window.location.href='index.php';</script>";
} else {
    // Si execute falla aquí, es un problema de la base de datos durante la inserción.
    // Usamos $stmt->error para el error específico de la sentencia.
    echo "<script>alert('Error al registrar: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conexion->close();
?>