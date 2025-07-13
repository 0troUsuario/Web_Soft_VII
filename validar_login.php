<?php
session_start();

// Datos para conectar a tu base de datos
$servername = "localhost";
$username_db = "root";  // o tu usuario MySQL
$password_db = "";      // o tu contraseña MySQL
$dbname = "nombre_de_tu_base_de_datos"; //Nombre temporal, después lo debo cambiar al nombre de la base de datos (todavía no está creada la BD JAJAJAJA)

// Crear conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Consulta para validar usuario
$sql = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Usuario y contraseña correctos
    $_SESSION['usuario'] = $usuario;

    // Redirigir a la pantalla de carga, que luego lleva a inicio.php
    header("Location: loading.html?next=inicio.php");
    exit();
} else {
    // Usuario o contraseña incorrectos
    $_SESSION['error'] = "Usuario o contraseña incorrectos.";
    header("Location: index.php");
    exit();
}
?>
