<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    
    <style>
      .navbar{
        display: flex;
        justify-content: center;

      }
    </style>
   
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
      
   

<div class="contenedor-linea">
  <div class="linea-horizontal"></div>
 </div>

<?php include 'includes/footer.php'; ?>


</body>
</html>
