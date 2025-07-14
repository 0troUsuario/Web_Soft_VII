<?php
session_start();

class CarritoService {
    
    public function __construct() {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }
    
    public function agregarProducto($id, $nombre, $precio, $autor, $imagen) {
        $producto = [
            'id' => $id,
            'nombre' => $nombre,
            'precio' => (float)$precio,
            'autor' => $autor,
            'imagen' => $imagen,
            'cantidad' => 1
        ];
        
        // Verificar si el producto ya existe
        $encontrado = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id'] == $id) {
                $item['cantidad']++;
                $encontrado = true;
                break;
            }
        }
        
        // Si no existe, agregarlo
        if (!$encontrado) {
            $_SESSION['carrito'][] = $producto;
        }
        
        return $this->obtenerCarrito();
    }
    
    public function eliminarProducto($id) {
        $_SESSION['carrito'] = array_filter($_SESSION['carrito'], function($item) use ($id) {
            return $item['id'] != $id;
        });
        
        // Reindexar el array
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        
        return $this->obtenerCarrito();
    }
    
    public function actualizarCantidad($id, $cantidad) {
        $cantidad = (int)$cantidad;
        
        if ($cantidad <= 0) {
            return $this->eliminarProducto($id);
        }
        
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id'] == $id) {
                $item['cantidad'] = $cantidad;
                break;
            }
        }
        
        return $this->obtenerCarrito();
    }
    
    public function obtenerCarrito() {
        return $_SESSION['carrito'];
    }
    
    public function obtenerTotal() {
        $total = 0;
        foreach ($_SESSION['carrito'] as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return $total;
    }
    
    public function obtenerCantidadTotal() {
        $cantidad = 0;
        foreach ($_SESSION['carrito'] as $item) {
            $cantidad += $item['cantidad'];
        }
        return $cantidad;
    }
    
    public function vaciarCarrito() {
        $_SESSION['carrito'] = [];
        return true;
    }
    
    public function confirmarCompra() {
        // Aquí puedes agregar lógica para procesar la compra
        // Por ejemplo, guardar en base de datos, enviar emails, etc.
        
        $carrito = $this->obtenerCarrito();
        $total = $this->obtenerTotal();
        
        // Simular procesamiento de compra
        if (!empty($carrito)) {
            // Vaciar carrito después de confirmar
            $this->vaciarCarrito();
            return [
                'success' => true,
                'message' => 'Compra procesada exitosamente',
                'total' => $total
            ];
        }
        
        return [
            'success' => false,
            'message' => 'El carrito está vacío'
        ];
    }
}
?>