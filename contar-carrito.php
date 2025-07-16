<?php
session_start();
$total = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
echo json_encode(['total' => $total]);
?>
