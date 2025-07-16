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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
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
        <h2 class="Autor-articulo"><strong>Publicado por:</strong> <?php echo htmlspecialchars($fila['autor'] ?? 'Anónimo'); ?></h2>
        <h2 class="precio">$<?php echo htmlspecialchars($fila['precio']); ?></h2>
        <p class="descripcion-articulo"><?php echo nl2br(htmlspecialchars($fila['descripcion'])); ?></p>
        <ul class="caracteristicas-articulo">
          <li><strong>Material:</strong> <?php echo htmlspecialchars($fila['material']); ?></li>
          <li><strong>Dimensiones:</strong> <?php echo htmlspecialchars($fila['dimension']) . ' ' . $fila['unidad_dimension']; ?></li>
          <li><strong>Peso:</strong> <?php echo htmlspecialchars($fila['peso']) . ' ' . $fila['unidad_peso']; ?></li>
        </ul>
          <form method="post" action="procesar-carrito.php" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($fila['nombre']); ?>">
            <input type="hidden" name="precio" value="<?php echo $fila['precio']; ?>">
            <input type="hidden" name="imagen" value="<?php echo $fila['imagen']; ?>">
            <button type="submit" class="boton-comprar">Añadir al carrito</button>
          </form>

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

  <?php
$paginaActual = basename($_SERVER['PHP_SELF']);
if (!in_array($paginaActual, ['index.php', 'registro.php'])):
?>
<style>
  #boton-carrito {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: white;
    border: 2px solid black;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  }

  #boton-carrito i {
    font-size: 24px;
    color: black;
  }

  #menu-carrito {
    position: fixed;
    bottom: 90px;
    right: 20px;
    background: white;
    border: 1px solid black;
    padding: 20px;
    width: 300px;
    max-height: 400px;
    overflow-y: auto;
    display: none;
    z-index: 9999;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  }

  .carrito-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .carrito-item img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    margin-right: 10px;
  }

  .carrito-item p {
    margin: 0;
    font-size: 14px;
    flex: 1;
  }

.carrito-item button {
  background: none;
  border: none;
  color: #e74c3c;
  font-size: 18px;
  cursor: pointer;
  padding: 4px;
}


  #menu-carrito .total {
    font-weight: bold;
    margin-top: 10px;
    text-align: right;
  }

  #menu-carrito .boton-comprar {
    margin-top: 15px;
    background-color: #000000ff;
    color: white;
    border: none;
    padding: 8px 15px;
    cursor: pointer;
    border-radius: 4px;
    float: right;
  }
</style>

<div id="boton-carrito">
  <i class="fas fa-shopping-cart"></i>
  <div id="contador-carrito">0</div>
</div>


<div id="menu-carrito">
  <div id="contenido-carrito"></div>
  <div class="total" id="total-carrito"></div>
  <button class="boton-comprar" onclick="realizarCompra()">Comprar</button>
</div>

<script>
  const botonCarrito = document.getElementById('boton-carrito');
  const menuCarrito = document.getElementById('menu-carrito');

  botonCarrito.addEventListener('click', () => {
    menuCarrito.style.display = menuCarrito.style.display === 'block' ? 'none' : 'block';
    cargarCarrito();
  });

  function cargarCarrito() {
    fetch('mostrar-carrito.php')
      .then(response => response.text())
      .then(html => {
        document.getElementById('contenido-carrito').innerHTML = html;
        calcularTotal();
        actualizarContador(); 
      });
  }

  function actualizarContador() {
    fetch('contar-carrito.php')
      .then(response => response.json())
      .then(data => {
        const contador = document.getElementById('contador-carrito');
        const cantidad = data.total;

        if (cantidad > 0) {
          contador.style.display = 'flex';
          contador.innerText = cantidad > 9 ? '+9' : cantidad;
        } else {
          contador.style.display = 'none';
        }
      });
  }

  function calcularTotal() {
    fetch('calcular-total.php')
      .then(response => response.text())
      .then(total => {
        document.getElementById('total-carrito').innerText = 'Total: $' + total;
      });
  }

  function eliminarProducto(id) {
    fetch('eliminar-del-carrito.php?id=' + id)
      .then(() => cargarCarrito());
  }

function realizarCompra() {
  if (confirm('¿Deseas finalizar tu compra?')) {
    fetch('comprar-productos.php')
      .then(response => response.text())
      .then(data => {
        alert('Gracias por tu compra!');
        cargarCarrito();      // Recarga el contenido del carrito
        actualizarContador(); // Refresca el contador
        window.location.href = 'inicio.php'; 
      });
  }
}



  document.addEventListener('DOMContentLoaded', () => {
    actualizarContador();
  });
</script>
<?php endif; ?>

</body>
</html>
<?php
} else {
  echo "<p style='text-align:center;'>Producto no encontrado.</p>";
}
$conexion->close();
?>
