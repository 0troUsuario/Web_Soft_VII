<?php
session_start();
$conexion = new mysqli('localhost', 'root', '', 'dalle');
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

$usuarioId = $_SESSION['usuario_id'] ?? null;
$usuarioNombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
$usuarioCorreo = $_SESSION['usuario_correo'] ?? '';
$articulos = 0;

if ($usuarioId) {
  $stmt = $conexion->prepare("SELECT COUNT(*) AS total FROM productos WHERE autor = ?");
  $stmt->bind_param("s", $usuarioNombre);
  $stmt->execute();
  $stmt->bind_result($articulos);
  $stmt->fetch();
  $stmt->close();
}
?>

<nav class="navbar">
  <ul class="menunavbar">
    <li><a href="inicio.php">Inicio</a></li>

    <li><a href="publicar.php">Publicar</a></li>
    
    <li><a href="enlace.php">Nosotros</a></li>
    <?php if ($usuarioId): ?>
      <li><a href="#" id="abrirPerfil">Perfil</a></li>
    <?php else: ?>
      <li><a href="index.php">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>

<div id="overlay" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.7); z-index:999;"></div>


<div id="ventanaPerfil" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; color:black; padding:30px; border:2px solid black; border-radius:10px; z-index:1000; width:300px; text-align:center; font-family:Arial, sans-serif;">
  <h2 style="margin-bottom:10px; font-size:22px;"><?php echo htmlspecialchars($usuarioNombre); ?></h2>
  <p style="margin:5px 0 15px; font-size:14px; color:#5d6a77;"><?php echo htmlspecialchars($usuarioCorreo); ?></p>
  <p><strong>Artículos publicados:</strong> <?php echo $articulos; ?></p>
  <form method="POST" action="cerrar_sesion.php">
    <button type="submit" style="background:#e74c3c; border:none; padding:10px 20px; color:white; font-weight:bold; border-radius:5px; margin-top:15px; cursor:pointer;">Cerrar sesión</button>
  </form>
</div>

<script>
  const abrirPerfil = document.getElementById('abrirPerfil');
  const overlay = document.getElementById('overlay');
  const ventana = document.getElementById('ventanaPerfil');

  if (abrirPerfil && overlay && ventana) {
    abrirPerfil.addEventListener('click', (e) => {
      e.preventDefault();
      overlay.style.display = 'block';
      ventana.style.display = 'block';
      document.body.style.overflow = 'hidden';
    });

    overlay.addEventListener('click', () => {
      overlay.style.display = 'none';
      ventana.style.display = 'none';
      document.body.style.overflow = 'auto';
    });
  }
</script>
