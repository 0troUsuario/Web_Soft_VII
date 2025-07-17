<?php
session_start();

require 'carrito-funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = [
        'id' => isset($_POST['id']) ? intval($_POST['id']) : null,
        'nombre' => $_POST['nombre'] ?? '',
        'precio' => isset($_POST['precio']) ? floatval($_POST['precio']) : 0,
        'imagen' => $_POST['imagen'] ?? ''
    ];

    agregarAlCarrito($producto);
}



header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
