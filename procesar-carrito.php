<?php
session_start();

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}


if (!isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id] = [
        'nombre' => $nombre,
        'precio' => $precio,
        'imagen' => $imagen,
        'cantidad' => 1
    ];
}



header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
