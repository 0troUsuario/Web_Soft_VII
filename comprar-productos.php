<?php
session_start();

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    exit("Carrito vacío");
}

$conexion = new mysqli("localhost", "root", "", "dalle");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

foreach ($_SESSION['carrito'] as $id => $producto) {
    
    $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}


$_SESSION['carrito'] = [];

$conexion->close();
echo "Compra realizada correctamente";
