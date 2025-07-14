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
      

<?php include 'includes/navbar.php'; ?> 

        
    </div>



      <div class="contenedor-linea">
        <div class="linea-horizontal"></div>
      </div>
      



<div class="contenedor-secundario">
   

    <div class="plato">
      <div class="conflei"> 
        <img src="img/Pensador.jpeg" alt="Pensador" class="imagenes-seccion-prueba">
      </div>

      <div class="leche">
        <h2 class="nombre-articulo">El Pensador</h2>
        <h2 class="Autor-articulo"> <strong>Publicado por:</strong> Sara</h2>
        <h2 class="precio">100$</h2>
        <p class="descripcion-articulo">
            Vendo una hermosa réplica de la famosa estatua "El Pensador" de Auguste Rodin. Esta obra icónica representa la reflexión profunda y la contemplación, 
            ideal para quienes aprecian el arte y la filosofía. La réplica está elaborada con materiales de alta calidad, lo que le confiere durabilidad y 
            un acabado estético impecable. La ofrezco a la venta por motivos de espacio personal, ya que he decidido reubicar mi colección de arte. 
            Esta es una oportunidad única para llevar a tu hogar un símbolo de inspiración y pensamiento profundo.
        </p>
  
        <ul class="caracteristicas-articulo">
          <li>Material: Hormigón</li>
          <li>Altura: 8 metros</li>
          <li>Peso: 1 tonelada</li>
          <li>Color: Bronce oscuro</li>
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

