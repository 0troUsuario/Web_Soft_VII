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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
    color: red;
    cursor: pointer;
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
    fetch('generar-factura.php')
      .then(async (response) => {
        console.log('Status HTTP:', response.status);
        const text = await response.text(); // primero lee como texto

        try {
          const data = JSON.parse(text); // intenta parsear como JSON
          console.log('Respuesta JSON:', data);

          if (response.ok) {
            if (data.success) {
              alert(data.message);
              cargarCarrito();
              actualizarContador();
              window.location.href = 'inicio.php';
            } else if (data.error) {
              alert('Error: ' + data.error);
            } else {
              alert('Respuesta inesperada');
            }
          } else {
            alert('Error HTTP: ' + response.status + ' - ' + (data.error || ''));
          }
        } catch (e) {
          console.error('No es JSON válido:', text);
          alert('Respuesta inválida del servidor');
        }
      })
      .catch(error => {
        console.error('Error en fetch:', error);
        alert('Error en la comunicación con el servidor: ' + error.message);
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
