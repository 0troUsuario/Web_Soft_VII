<?php
$host       = "127.0.0.1";   // o "localhost", ambos funcionan
$usuario    = "root";
$contrasena = "";
$basededatos= "dalle";

$conexion = new mysqli($host, $usuario, $contrasena, $basededatos);

if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");
?>
