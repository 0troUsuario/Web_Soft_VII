<!-- Default adaptable para los artículos que se muestran en pantalla añadidos de la base de datos mediante "Publicar"-->

<?php
$conexion = new mysqli("localhost", "root", "", "dalle"); 
 
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conexion->query($sql);

if ($fila = $resultado->fetch_assoc()) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($fila['nombre']); ?></title>
  <link rel="stylesheet" href="css/estilos.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar {
      display: flex;
      justify-content: center;
    }

    h1 {
      display: flex;
      justify-content: center;
    }

    .plato {
      display: flex;
      justify-content: center;
      width: 100%;
      background-color: transparent;
      gap: 10px;
      padding: 20px;
      box-sizing: border-box;
    }

    .conflei {
      width: 45%;
      height: 800px;
      background-color: white;
      border: 1px solid black;
      box-sizing: border-box;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .conflei img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .leche {
      width: 45%;
      height: 800px;
      background-color: white;
      border-left: 1px solid black;
      box-sizing: border-box;
      padding: 20px;
    }

    @media (max-width: 768px) {
      .plato {
        flex-direction: column;
      }

      .conflei, .leche {
        width: 90%;
        height: auto;
        margin: 10px auto;
        border: 1px solid black;
      }
    }
  </style>
</head>

<body>
  <h1 class="centrar-titulo">Dall-E</h1>
  <div class="contenedor-linea"><div class="linea-horizontal"></div></div>
  <?php include 'includes/navbar.php'; ?>
  <div class="contenedor-linea"><div class="linea-horizontal"></div></div>

  <div class="contenedor-secundario">
    <div class="plato">
      <div class="conflei">
        <img src="<?php echo $fila['imagen']; ?>" alt="<?php echo htmlspecialchars($fila['nombre']); ?>">
      </div>

      <div class="leche">
        <h2 class="nombre-articulo"><?php echo htmlspecialchars($fila['nombre']); ?></h2>
        <h2 class="Autor-articulo"><strong>Publicado por:</strong> Dall-E</h2>
        <h2 class="precio">$<?php echo htmlspecialchars($fila['precio']); ?></h2>
        <p class="descripcion-articulo"><?php echo nl2br(htmlspecialchars($fila['descripcion'])); ?></p>
        <ul class="caracteristicas-articulo">
          <li><strong>Material:</strong> <?php echo htmlspecialchars($fila['material']); ?></li>
          <li><strong>Dimensiones:</strong> <?php echo htmlspecialchars($fila['dimension']) . ' ' . $fila['unidad_dimension']; ?></li>
          <li><strong>Peso:</strong> <?php echo htmlspecialchars($fila['peso']) . ' ' . $fila['unidad_peso']; ?></li>
        </ul>
        <button class="boton-comprar">Comprar</button>
      </div>
    </div>
  </div>

  <div class="contenedor-linea"><div class="linea-horizontal"></div></div>
  <div id="contenedor-perder">
    <h2>¿Te gusta lo que ves? ¡Adquiérelo ahora!</h2>
  </div>
  <div class="contenedor-linea"><div class="linea-horizontal"></div></div>
  <br><br>
  <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php
} else {
  echo "<p style='text-align:center;'>Producto no encontrado.</p>";
}
$conexion->close();
?>
