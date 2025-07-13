<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- centrea la navbar-->
    <style>
      .navbar{
        display: flex;
        justify-content: center;

      }
    </style>
    <!--FinCentrea-->
    <style>
      .centrar-titulo{
        display: flex;
        justify-content: center;

      }

      .centrar-subtitulo{
        display: flex;
        justify-content: center;

      }
    </style>

    <!-- test-->

    <style>
      .contenedor-prueba{
        display: flex;
        justify-content: center;
        align-items: center;
      }
    </style>

    <style>
      .prueba-contenedor-uno{
        background-color: aqua;
        width: 250px;
        padding: 200px;

      }

      .prueba-contenedor-dos{
        background-color: blueviolet;
        width: 200px;
        padding: 200px;
      }
    </style>
      <!--fin test-->
    


    <style>
      .texto-contenedor{
        display: flex;
        align-items: center;
        justify-content: center;
      }
    </style>

    <style>
      .Texto-articulo-destacado{
        align-items: center;
        justify-content: center;
      }
    </style>
    
    <style>
      /* Aseguramos que el contenedor tenga un tamaño específico */


.destacada {
  margin: 0;            /* Eliminamos márgenes predeterminados */
  padding: 0;           /* Eliminamos padding para controlar el tamaño */
  width: 100%;          /* Asegura que figure ocupe el 100% del contenedor */
  height: 100%;         /* Asegura que figure ocupe el 100% del contenedor */
}

.imagen-destacada {
  width: 100%;          /* Imagen ocupará todo el ancho */
  height: 100%;         /* Imagen ocupará todo el alto */
  object-fit: cover;    /* La imagen cubre el área sin distorsionarse */
  object-position: center;  /* Centra la imagen dentro del contenedor */
}
@media (max-width: 768px) {
  .cuadro-grande {
    width: 90vw; /* Ocupa el 90% del ancho de la pantalla */
    height: auto; /* Mantiene la altura proporcional al ancho */
  }
}
      

      
    </style>


</head>
<body>
    <h1 class="centrar-titulo">
        Dall-E
       </h1>
        <h2 class="centrar-subtitulo">
           Todo lo que puedas encontrar, en un solo lugar
        </h2>
        <br>

      <div class="contenedor-linea">
        <div class="linea-horizontal"></div>
      </div>
      
<?php include 'includes/navbar.php'; ?>

        
    </div>
      <div class="contenedor-linea">
        <div class="linea-horizontal"></div>
      </div>
      
      <!-- cuadro grande, sección-->

      <div class="seccion-cuadro-grande">
        <div class="cuadro-grande">
          <figure class="destacada">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/iszldsN137M" title="YouTube video player" frameborder="0" allowfullscreen class="imagen-destacada"></iframe>
          </figure>
          <div class="rectangulo-superpuesto">
            <span>Mira nuestro video</span>
          </div>
        </div>
      </div>
      
       
    

      <div class="contenedor-linea">
        <div class="linea-horizontal"></div>
      </div>
      
      <!--contenedor dos-->
<!-- contenido-->






<!-- otra línea de división-->
<div class="contenedor-linea">
  <div class="linea-horizontal"></div>
 </div>





<!-- contenido-->
<?php include 'includes/footer.php'; ?>


</body>
</html>
