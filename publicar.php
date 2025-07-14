<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $mysqli = new mysqli('localhost', 'root', '', 'dalle');
    if ($mysqli->connect_errno) {
        die("Fallo la conexión a MySQL: " . $mysqli->connect_error);
    }


    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $descripcion = $mysqli->real_escape_string($_POST['descripcion']);
    $material = $mysqli->real_escape_string($_POST['material']);
    $dimension = $mysqli->real_escape_string($_POST['dimension']);
    $unidad_dimension = $mysqli->real_escape_string($_POST['unidad-dimension']);
    $peso = floatval($_POST['peso']);
    $unidad_peso = $mysqli->real_escape_string($_POST['unidad-peso']);
    $color = $mysqli->real_escape_string($_POST['color'] ?? ''); // Por si no viene, lo deja vacío

    // Subida de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        $carpetaDestino = 'uploads/';
        $rutaDestino = $carpetaDestino . uniqid() . "_" . $nombreArchivo;

        // Mueve el archivo a la carpeta uploads 
        if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
            die("Error al subir la imagen.");
        }
    } else {
        die("No se ha subido ninguna imagen o hay un error en la subida.");
    }

    // Inserta el producto en la base de datos, claro que sí  
    $sql = "INSERT INTO productos (nombre, precio, descripcion, imagen, material, dimension, unidad_dimension, peso, unidad_peso, color)
            VALUES ('$nombre', $precio, '$descripcion', '$rutaDestino', '$material', '$dimension', '$unidad_dimension', $peso, '$unidad_peso', '$color')";

    if ($mysqli->query($sql)) {
        // Redirige a inicio.php al terminar
        header('Location: inicio.php');
        exit;
    } else {
        die("Error al insertar en la base de datos: " . $mysqli->error);
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Publicar</title>
  <link rel="stylesheet" href="css/estilos.css" />


  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />


  <style>
    .navbar {
      display: flex;
      justify-content: center;
    }

    h1,
    h2 {
      display: flex;
      justify-content: center;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 100;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
    }

    .modal-contenido {
      background: #fff;
      padding: 20px;
      margin: 10% auto;
      width: 300px;
      border-radius: 10px;
      text-align: center;
    }

    .modal-contenido input {
      width: 80%;
      margin: 5px 0;
      padding: 5px;
    }
  </style>
</head>

<body>
  <h1 class="centrar-titulo">Dall-E</h1>
  <h2 class="centrar-subtitulo">Todo lo que puedas encontrar, en un solo lugar</h2>

  <br />

  <div class="contenedor-linea">
    <div class="linea-horizontal"></div>
  </div>

<?php include 'includes/navbar.php'; ?>

  <div class="contenedor-linea">
    <div class="linea-horizontal"></div>
  </div>

  <div class="contenedor-animado">
    <div class="contenedor-publicar">
      <div class="contenedor-borrar">
        <div class="contenedor-formulario">
          <form id="formulario-producto" method="POST" enctype="multipart/form-data" action="publicar.php">
            <h1 class="publicar-producto">Publicar Producto</h1>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ingresa el nombre" required />
            <br /><br />

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Ingresa el precio" min="1" max="999999" required />

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" placeholder="Ingresa una descripción extensa" required></textarea>

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required />

            <label for="material">Material</label>
            <input type="text" id="material" name="material" placeholder="Ingresa el material" required />

            <label for="dimension">Dimensión</label>
            <div class="entrada-dimension">
              <input type="text" id="dimension" name="dimension" placeholder="Ej: 20 x 30" readonly required onclick="abrirSelectorDimension()" />
              <select id="unidad-dimension" name="unidad-dimension">
                <option value="m">Metros</option>
                <option value="cm">Centímetros</option>
              </select>
            </div>

            <label for="peso">Peso</label>
            <div class="entrada-peso">
              <input type="number" id="peso" name="peso" placeholder="Peso" required />
              <select id="unidad-peso" name="unidad-peso">
                <option value="kg">Kg</option>
                <option value="lb">Lb</option>
                <option value="ton">Tonelada</option>
              </select>
            </div>

<label for="color">Color</label>
<input type="text" id="color" name="color" placeholder="Ingresa el color" />


            <button type="submit" name="submit">Publicar</button>

          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="contenedor-linea">
    <div class="linea-horizontal"></div>
  </div>

  <!-- Modal para dimensiones -->
  <div id="modal-dimension" class="modal">
    <div class="modal-contenido">
      <h3>Selecciona las dimensiones</h3>
      <label for="ancho">Ancho:</label>
      <input type="number" id="ancho" min="1" required />
      <label for="alto">Alto:</label>
      <input type="number" id="alto" min="1" required />
      <div style="margin-top: 10px;">
        <button type="button" onclick="guardarDimension()">Guardar</button>
        <button type="button" onclick="cerrarSelectorDimension()">Cancelar</button>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const campos = document.querySelectorAll('#formulario-producto input, #formulario-producto select, #formulario-producto textarea');

      campos.forEach(campo => {
        campo.addEventListener('blur', function () {
          if (campo.value === '') {
            campo.style.borderBottom = '2px solid #e74c3c';
          } else {
            campo.style.borderBottom = '2px solid #566975';
          }
        });

        campo.addEventListener('focus', function () {
          campo.style.borderBottom = '2px solid #566975';
        });
      });

    
      const nombreInput = document.getElementById('nombre');
      nombreInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
      });
    });

    function abrirSelectorDimension() {
      document.getElementById('modal-dimension').style.display = 'block';
    }

    function cerrarSelectorDimension() {
      document.getElementById('modal-dimension').style.display = 'none';
    }

    function guardarDimension() {
      const ancho = document.getElementById('ancho').value;
      const alto = document.getElementById('alto').value;
      const campoDimension = document.getElementById('dimension');

      if (ancho > 0 && alto > 0) {
        campoDimension.value = `${ancho} x ${alto}`;
        cerrarSelectorDimension();
      } else {
        alert('Por favor ingresa valores válidos para ancho y alto.');
      }
    }
  </script>
</body>

</html>
