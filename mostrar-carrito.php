<?php
include 'carrito-funciones.php';
$carrito = obtenerCarrito();

if (empty($carrito)) {
    echo "<p>Tu carrito está vacío.</p>";
} else {
    foreach ($carrito as $id => $item) {
        echo '<div class="carrito-item">';
        echo '<img src="' . htmlspecialchars($item['imagen']) . '" alt="img">';
        echo '<p>' . htmlspecialchars($item['nombre']) . ' - $' . number_format($item['precio'], 2) . '</p>';
        echo '<button onclick="eliminarProducto(' . intval($id) . ')">&times;</button>';
        echo '</div>';
    }
}
