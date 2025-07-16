<?php
include 'conexion.php';

$sql = "SELECT * FROM productos ORDER BY fecha_publicacion DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="css/estilos.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />

 
  <style>
    .navbar {
      display: flex;
      justify-content: center;
    }
  </style>

  <style>
    .centrar-titulo {
      display: flex;
      justify-content: center;
    }
    .centrar-subtitulo {
      display: flex;
      justify-content: center;
    }
  </style>

  <style>
    .contenedor-prueba {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>

  <style>
    .prueba-contenedor-uno {
      background-color: aqua;
      width: 250px;
      padding: 200px;
    }
    .prueba-contenedor-dos {
      background-color: blueviolet;
      width: 200px;
      padding: 200px;
    }
  </style>

  <style>
    .texto-contenedor {
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>

  <style>
    .Texto-articulo-destacado {
      align-items: center;
      justify-content: center;
    }
  </style>

  <style>
    .destacada {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
    }

    .imagen-destacada {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }

    @media (max-width: 768px) {
      .cuadro-grande {
        width: 90vw;
        height: auto;
      }
    }
  </style>
</head>
<body>


  <img src="img/Dall-e_PNG.png" alt="Logo flotante" id="floating-logo" class="d-none d-md-block" />
  <style>
    #floating-logo {
      position: fixed;
      top: 10px;
      left: 10px;
      height: 150px;      
      width: auto;          
      opacity: 0;          
      transition: opacity 0.3s ease-in-out;
      pointer-events: none; 
      z-index: 1000;       
    }
  </style>


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

  <div class="seccion-cuadro-grande">
    <div class="cuadro-grande">
      <figure class="destacada">
        <img src="img/busto.jpeg" alt="Noche" class="imagen-destacada" />
      </figure>
      <div class="rectangulo-superpuesto">
        <span>Artículo destacado</span>
      </div>
    </div>
  </div>

  <div class="contenedor-linea">
    <div class="linea-horizontal"></div>
  </div>



  <div class="contenedor-principal">
    

  
    <?php
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo '<div class="cuadro">';
            echo '<figure><img src="' . htmlspecialchars($fila['imagen']) . '" alt="' . htmlspecialchars($fila['nombre']) . '" class="imagen-el-david" /></figure>';
            echo '<div class="info-producto">';
            echo '<h2>' . htmlspecialchars($fila['nombre']) . '</h2>';
            echo '<p class="price">$' . htmlspecialchars($fila['precio']) . '</p>';
            echo '<button class="btn-ver-mas" onclick="location.href=\'seccion-prueba-default.php?id=' . (int)$fila['id'] . '\'">Ver más</button>';
            echo '</div></div>';
        }
    } else {
        echo '<p>No hay productos disponibles.</p>';
    }
    ?>
  </div>

  <br /><br />
  <div class="contenedor-linea">
    <div class="linea-horizontal"></div>
  </div>

  <div id="contenedor-perder">
    <h2>No te pierdas nuestros nuevos articulos</h2>
  </div>

  <div class="contenedor-linea">
    <div class="linea-horizontal"></div>
  </div>

 

  <?php include 'includes/footer.php'; ?>

 
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const soloLetras = (input) => {
        input.addEventListener("input", function () {
          this.value = this.value.normalize("NFD").replace(/[\u0300-\u036f]/g, ""); 
          this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, "");
        });
      };

      soloLetras(document.getElementById("nombre"));
      soloLetras(document.getElementById("apellido"));
    });
  </script>
  

  
  <script>
    const floatingLogo = document.getElementById('floating-logo');

    window.addEventListener('scroll', () => {
      if (window.scrollY > 0) {
        floatingLogo.style.opacity = '1'; 
      } else {
        floatingLogo.style.opacity = '0';
      }
    });
  </script>

  <?php $conexion->close(); ?>

</body>
</html>
