<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   
    <style>
      .navbar{
        display: flex;
        justify-content: center;

      }
    </style>
  
    <style>
      h1{
        display: flex;
        justify-content: center;

      }
    </style>


    
    <style>
     
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
    <!--====Aquí va la división del contenido======-->

    <div class="plato">
      <div class="conflei"> <!-- Sección 1-->
        <img src="img/valle-de-los-lamentos.jpg" alt="valle-de-los-lamentos" class="imagenes-seccion-prueba">
      </div>

      <div class="leche">
        <h2 class="nombre-articulo">Valle de los Lamentos</h2>
        <h2 class="Autor-articulo"> <strong>Publicado por:</strong> José</h2>
        <h2 class="precio">15$</h2>
        <p class="descripcion-articulo">
            Vendo un este lienzo del "Valle de los Lamentos" del autor "Kentaro Miura", hecho con pintura acrílica. 
            Detalles en el lienzo con relieves y perfecta para decorar cualquier espacio
        </p>
        <!-- Lista de características -->
        <ul class="caracteristicas-articulo">
          <li>Material: Lienzo</li>
          <li>Dimensión: 30cm x 50cm</li>
          <li>Peso: 1lb</li>
          <li>Color: Blanco, Negro, Gris</li>
        </ul>
        <!-- Botón para comprar -->
        <button class="boton-comprar">Comprar</button>
      </div>
    </div>

     <!--====Fin división del contenido======-->

<!-- mas líneas de división-->

<div class="contenedor-linea">
  <div class="linea-horizontal"></div>
</div>

<div id="contenedor-perder">
  <h2>
   ¿Te gusta lo que ves? ¡Adquierelo ahora!
  </h2>
</div>

<!-- otra línea de división-->
<div class="contenedor-linea">
  <div class="linea-horizontal"></div>
</div>



<br>
<?php include 'includes/footer.php'; ?>



</body>
</html>

