<?php

$host = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "dalle";  // Cambiado a "dalle" que es tu base actual

$conexion = new mysqli($host, $usuario, $contrasena, $basededatos);

// Verificar conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}


$conexion->set_charset("utf8");
?>
