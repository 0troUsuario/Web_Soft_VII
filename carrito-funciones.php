<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

function agregarAlCarrito($producto) {
    $id = isset($producto['id']) ? $producto['id'] : null;

    if ($id === null) return;

    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = [
            'id' => $id,
            'nombre' => $producto['nombre'],
            'precio' => floatval($producto['precio']),
            'imagen' => $producto['imagen'],
            'cantidad' => 1
        ];
    }
}

function eliminarDelCarrito($id) {
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
}

function vaciarCarrito() {
    $_SESSION['carrito'] = [];
}

function obtenerCarrito() {
    return $_SESSION['carrito'] ?? [];
}

function calcularTotal() {
    $carrito = obtenerCarrito();
    $total = 0;

    foreach ($carrito as $item) {
        $cantidad = isset($item['cantidad']) ? $item['cantidad'] : 1;
        $total += floatval($item['precio']) * $cantidad;
    }

    return number_format($total, 2);
}

function contarItems() {
    return count(obtenerCarrito());
}
