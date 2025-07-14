<?php
header('Content-Type: application/json');
require_once '../services/carrito_service.php';

$carritoService = new CarritoService();
$response = ['success' => false, 'message' => 'Acción no válida'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'agregar':
            $id = $_POST['id'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $autor = $_POST['autor'] ?? '';
            $imagen = $_POST['imagen'] ?? '';
            
            if ($id && $nombre && $precio > 0) {
                $carrito = $carritoService->agregarProducto($id, $nombre, $precio, $autor, $imagen);
                $response = [
                    'success' => true,
                    'message' => 'Producto agregado al carrito',
                    'carrito' => $carrito,
                    'total' => $carritoService->obtenerTotal(),
                    'cantidad_total' => $carritoService->obtenerCantidadTotal()
                ];
            } else {
                $response['message'] = 'Datos del producto incompletos';
            }
            break;
            
        case 'eliminar':
            $id = $_POST['id'] ?? '';
            if ($id) {
                $carrito = $carritoService->eliminarProducto($id);
                $response = [
                    'success' => true,
                    'message' => 'Producto eliminado del carrito',
                    'carrito' => $carrito,
                    'total' => $carritoService->obtenerTotal(),
                    'cantidad_total' => $carritoService->obtenerCantidadTotal()
                ];
            }
            break;
            
        case 'actualizar':
            $id = $_POST['id'] ?? '';
            $cantidad = $_POST['cantidad'] ?? 0;
            if ($id && $cantidad >= 0) {
                $carrito = $carritoService->actualizarCantidad($id, $cantidad);
                $response = [
                    'success' => true,
                    'message' => 'Cantidad actualizada',
                    'carrito' => $carrito,
                    'total' => $carritoService->obtenerTotal(),
                    'cantidad_total' => $carritoService->obtenerCantidadTotal()
                ];
            }
            break;
            
        case 'vaciar':
            $carritoService->vaciarCarrito();
            $response = [
                'success' => true,
                'message' => 'Carrito vaciado',
                'carrito' => [],
                'total' => 0,
                'cantidad_total' => 0
            ];
            break;
            
        case 'confirmar':
            $resultado = $carritoService->confirmarCompra();
            $response = $resultado;
            if ($resultado['success']) {
                $response['carrito'] = [];
                $response['total'] = 0;
                $response['cantidad_total'] = 0;
            }
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    
    if ($action === 'obtener') {
        $response = [
            'success' => true,
            'carrito' => $carritoService->obtenerCarrito(),
            'total' => $carritoService->obtenerTotal(),
            'cantidad_total' => $carritoService->obtenerCantidadTotal()
        ];
    }
}

echo json_encode($response);
?>