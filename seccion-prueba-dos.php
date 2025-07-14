<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
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
      h1{
        display: flex;
        justify-content: center;

      }
    </style>


    <!--====estilo contenedor==-->
    <style>
      /* Estilos generales para el div padre */
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
      }
    
      
      .leche {
        width: 45%;               
        height: 800px;             
        background-color: white;  
        border-top: 1px solid transparent;    
        border-right: 1px solid transparent;  
        border-bottom: 1px solid transparent; 
        border-left: 1px solid black;  
        box-sizing: border-box;   
      }
    
     
      @media (max-width: 768px) {
        .plato {
          flex-direction: column; 
        }
    
     
        .conflei {
          width: 80%;   
          margin: 10px auto; 
          height: auto;       
          aspect-ratio: 1;   
        }
    
        .leche {
          width: 90%;   
          margin: 10px auto; 
        }
    
     
        .conflei, .leche {
          border: 1px solid black; 
        }
      }
    </style>



</head>
<body>
    <h1 class="centrar-titulo">
        Dall-E
    </h1>

    <div class="contenedor-linea">
        <div class="linea-horizontal"></div>
      </div>
      
   <!--====ref nav======-->
<?php include 'includes/navbar.php'; ?> 

        
    </div>



      <div class="contenedor-linea">
        <div class="linea-horizontal"></div>
      </div>
      



<div class="contenedor-secundario">
  

    <div class="plato">
      <div class="conflei"> 
        <img src="img/noche-estrellada.jpg" alt="Noche Estrellada" class="imagenes-seccion-prueba">
      </div>

      <div class="leche">
        <h2 class="nombre-articulo">La Noche Estrellada (Lienzo)</h2>
        <h2 class="Autor-articulo"> <strong>Publicado por:</strong> Joseph</h2>
        <h2 class="precio">$80</h2>
        <p class="descripcion-articulo">
            Vendo réplica de "La Noche Estrellada", la célebre obra maestra de Vincent van Gogh, una pieza que captura con maestría la esencia del movimiento postimpresionista. Esta icónica pintura, creada en 1889, es famosa por su vibrante paleta de colores azul profundo, amarillo radiante y toques de blanco que evocan la 
            noche estrellada en un cielo lleno de energía y emoción. En el cuadro, las ondulaciones del viento se entrelazan con una aldea tranquila bajo un cielo tumultuoso, donde las estrellas parecen danzar y brillar con una intensidad que casi se puede sentir. La textura rica y los trazos enérgicos que caracterizan la técnica de Van Gogh no solo aportan dinamismo a la composición, sino que también transmiten 
            un profundo sentido de melancolía y esperanza. 
        </p>
    
        <ul class="caracteristicas-articulo">
          <li>Material: Lienzo hecho de lino</li>
          <li>Dimensión: 40cm x 50cm</li>
          <li>Peso: 1 kg</li>
          <li>Color: Blanco y negro</li>
        </ul>
    
        <button class="boton-comprar">Comprar</button>
      </div>
    </div>

    


<div class="contenedor-linea">
  <div class="linea-horizontal"></div>
</div>

<div id="contenedor-perder">
  <h2>
   ¿Te gusta lo que ves? ¡Adquierelo ahora!
  </h2>
</div>


<div class="contenedor-linea">
  <div class="linea-horizontal"></div>
</div>



<br>
<?php include 'includes/footer.php'; ?>

</body>
</html>

