<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>El David - Detalles</title>
  <link rel="stylesheet" href="css/estilos.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    .navbar { display: flex; justify-content: center; }
    h1 { display: flex; justify-content: center; }
    .plato {
      display: flex; justify-content: center; width: 100%; background: transparent;
      gap: 10px; padding: 20px; box-sizing: border-box;
    }
    .conflei, .leche {
      width: 45%; height: 800px; background: white; box-sizing: border-box;
    }
    .conflei { border: 1px solid black; }
    .leche { border-left: 1px solid black; }
    @media (max-width: 768px) {
      .plato { flex-direction: column; }
      .conflei, .leche {
        width: 90%; margin: 10px auto; border: 1px solid black; height: auto;
      }
      .conflei { aspect-ratio: 1; }
    }
  </style>
</head>

<body>
  <h1>Dall-E</h1>

  <div class="contenedor-linea"><div class="linea-horizontal"></div></div>

  <?php include 'includes/navbar.php'; ?>

  <div class="contenedor-linea"><div class="linea-horizontal"></div></div>

  <!-- Contenido principal -->
  <div class="plato">
    <div class="conflei">
      <img src="img/busto.jpeg" alt="Busto El David" class="imagenes-seccion-prueba">
    </div>

    <div class="leche">
      <h2 class="nombre-articulo">El David (Estatua)</h2>
      <h2 class="Autor-articulo"><strong>Publicado por:</strong> Mati</h2>
      <h2 class="precio">$550</h2>
      <p class="descripcion-articulo">
        Réplica perfecta de la obra maestra renacentista, ideal para decoración o coleccionistas de arte clásico.
      </p>
      <ul class="caracteristicas-articulo">
        <li>Material: Resina de alta calidad</li>
        <li>Altura: 10m</li>
        <li>Peso: 300 kg</li>
        <li>Color: Blanco clásico</li>
      </ul>
      <button class="boton-comprar">Comprar</button>
    </div>
  </div>

  <div class="contenedor-linea"><div class="linea-horizontal"></div></div>
  <div id="contenedor-perder"><h2>¿Te gusta lo que ves? ¡Adquiérelo ahora!</h2></div>
  <div class="contenedor-linea"><div class="linea-horizontal"></div></div>

  <?php include 'includes/footer.php'; ?>

  <!-- Widget del carrito -->
  <?php include 'includes/carrito_widget.php'; ?>
</body>
</html>