<?php
session_start();

// Datos para conectar a tu base de datos
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "dalle";

// Crear conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Validar campos vacíos
if (empty($usuario) || empty($contrasena)) {
    $_SESSION['error'] = "Por favor, completa todos los campos.";
    header("Location: index.php");
    exit();
}

// Consulta para obtener el hash de la contraseña
$sql = "SELECT id, username, contrasena FROM usuario WHERE username = ? LIMIT 1";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error al preparar consulta: " . $conn->error);
}
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    // Verificar la contraseña con password_verify
    if (password_verify($contrasena, $row['contrasena'])) {
        $_SESSION['username'] = $row['username'];
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
