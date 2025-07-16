<?php
session_start();

include 'carrito-funciones.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
eliminarDelCarrito($id);

echo "ok";
