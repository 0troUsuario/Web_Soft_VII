<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'vendor/autoload.php';  // Autoload de Composer para PHPMailer y Dompdf

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'carrito-funciones.php';

// 1. Verificar usuario logueado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$carrito = obtenerCarrito();

if (empty($carrito)) {
    echo json_encode(['error' => 'Carrito vacío']);
    exit;
}

// 2. Conectar a BD
$conexion = new mysqli("localhost", "root", "", "dalle");
if ($conexion->connect_error) {
    echo json_encode(['error' => 'Error de conexión a BD']);
    exit;
}

// 3. Obtener datos usuario
$stmt = $conexion->prepare("SELECT nombre, apellido, correo FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo json_encode(['error' => 'Usuario no encontrado']);
    exit;
}
$usuario = $result->fetch_assoc();
$stmt->close();

// 4. Calcular total
$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// 5. Insertar compra en tabla compras
$stmt = $conexion->prepare("INSERT INTO compras (usuario_id, fecha, total) VALUES (?, NOW(), ?)");
$stmt->bind_param("id", $usuario_id, $total);
$stmt->execute();
$compra_id = $stmt->insert_id;
$stmt->close();

// 6. Insertar detalles en compra_detalles
$stmt = $conexion->prepare("INSERT INTO compra_detalles (compra_id, producto_id, nombre, precio, cantidad) VALUES (?, ?, ?, ?, ?)");
foreach ($carrito as $producto) {
    $stmt->bind_param("iisdi", $compra_id, $producto['id'], $producto['nombre'], $producto['precio'], $producto['cantidad']);
    $stmt->execute();
}
$stmt->close();



// 7. Crear HTML de la factura para PDF
$fecha = date('d-m-Y H:i:s');
$nombreCompleto = htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']);
$correo = htmlspecialchars($usuario['correo']);

$html = '
<h2>Factura de Compra</h2>
<p><strong>Cliente:</strong> ' . $nombreCompleto . '</p>
<p><strong>Correo:</strong> ' . $correo . '</p>
<p><strong>Fecha:</strong> ' . $fecha . '</p>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
<thead>
<tr>
<th>Producto</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Subtotal</th>
</tr>
</thead>
<tbody>';

foreach ($carrito as $producto) {
    $subtotal = $producto['precio'] * $producto['cantidad'];
    $html .= '
    <tr>
    <td>' . htmlspecialchars($producto['nombre']) . '</td>
    <td>$' . number_format($producto['precio'], 2) . '</td>
    <td>' . intval($producto['cantidad']) . '</td>
    <td>$' . number_format($subtotal, 2) . '</td>
    </tr>';
}

$html .= '
<tr>
<td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
<td><strong>$' . number_format($total, 2) . '</strong></td>
</tr>
</tbody>
</table>
';

// 8. Generar PDF con Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$pdfOutput = $dompdf->output();

// Guardar temporalmente el PDF
$nombreArchivo = 'Factura_' . $usuario['nombre'] . '_' . $usuario['apellido'] . '_' . $compra_id . '.pdf';
$rutaArchivo = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $nombreArchivo;
file_put_contents($rutaArchivo, $pdfOutput);

// 9. Enviar correo con PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración servidor SMTP 
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'dallesoporte@gmail.com';   
    $mail->Password = 'fipn uzlr nxcp kbwe';    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('dallesoporte@gmail.com', 'Dall-e');
    $mail->addAddress($correo, $nombreCompleto);

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Factura de tu compra';
    $mail->Body = "<p>Hola $nombreCompleto,</p><p>Adjuntamos la factura de tu compra realizada el $fecha.</p>";
    $mail->addStringAttachment($pdfOutput, $nombreArchivo, 'base64', 'application/pdf');

    $mail->send();

    // 10. Vaciar carrito y cerrar conexión
    vaciarCarrito();
    $conexion->close();

    echo json_encode(['success' => true, 'message' => 'Compra finalizada y factura enviada']);
} catch (Exception $e) {
    echo json_encode(['error' => "Error al enviar correo: {$mail->ErrorInfo}"]);
}
