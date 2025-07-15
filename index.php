<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Cutive+Mono&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Cutive Mono', monospace;
    }
    body, html {
      height: 100%;
      overflow: hidden;
    }
    body {
      background: radial-gradient(ellipse at bottom, #2a2a2a 0%, #0e0e0e 100%);
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-container {
      background-color: rgba(255, 255, 255, 0.04);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      width: 350px;
      position: relative;
      z-index: 2;
    }
    .login-container h2 {
      margin-bottom: 20px;
      text-align: center;
      font-size: 26px;
      color: #e0e0e0;
    }
    form input[type="text"],
    form input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      background: rgba(255, 255, 255, 0.07);
      border: 1px solid #555;
      border-radius: 8px;
      color: #f1f1f1;
      font-size: 16px;
    }
    form input:focus {
      outline: none;
      box-shadow: 0 0 8px #aaa;
    }
    form button {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      background: linear-gradient(135deg, #666, #444);
      border: none;
      border-radius: 8px;
      font-size: 18px;
      color: white;
      cursor: pointer;
      transition: background 0.8s ease, transform 0.3s ease;
    }
    form button:hover {
      transform: scale(1.03);
      background: linear-gradient(135deg, #888, #333);
    }
    .toggle-password {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }
    .toggle-password input[type="checkbox"] {
      appearance: none;
      width: 18px;
      height: 18px;
      border: 2px solid #999;
      border-radius: 4px;
      background-color: transparent;
      position: relative;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .toggle-password input[type="checkbox"]:checked {
      background-color: #ccc;
    }
    .toggle-password input[type="checkbox"]::after {
      content: "";
      position: absolute;
      width: 6px;
      height: 10px;
      border: solid black;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
      top: 1px;
      left: 5px;
      opacity: 0;
      transition: opacity 0.2s ease;
    }
    .toggle-password input[type="checkbox"]:checked::after {
      opacity: 1;
    }
    .spark-container {
      position: absolute;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }
    .spark {
      position: absolute;
      width: 4px;
      height: 4px;
      background: #ffffff;
      border-radius: 50%;
      animation: fall 1.5s linear forwards;
      pointer-events: none;
    }
    @keyframes fall {
      0% {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
      100% {
        opacity: 0;
        transform: translateY(80px) scale(0.5);
      }
    }
    .create-account {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
      color: #ccc;
    }
    .create-account a {
      color: #fff;
      text-decoration: underline;
    }
    .create-account a:hover {
      color: #bbb;
    }
    .back-button {
      position: absolute;
      top: 15px;
      left: 15px;
      background-color: rgba(255, 255, 255, 0.1);
      color: #ffffff;
      text-decoration: none;
      font-size: 20px;
      padding: 8px 12px;
      border-radius: 50%;
      backdrop-filter: blur(4px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: transform 0.3s ease, background-color 0.3s ease;
      z-index: 10;
    }
    .back-button:hover {
      background-color: rgba(255, 255, 255, 0.2);
      transform: scale(1.1);
    }
    .animated-bg {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      overflow: hidden;
      z-index: 0;
    }
    .circles li {
      position: absolute;
      display: block;
      list-style: none;
      width: 20px;
      height: 20px;
      background: rgba(255, 255, 255, 0.06);
      animation: animate 25s linear infinite;
      bottom: -150px;
      border-radius: 50%;
    }
    .circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
    .circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
    .circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
    .circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
    .circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
    .circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
    .circles li:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
    .circles li:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }
    @keyframes animate {
      0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 0; }
      100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
    }
    /* Mensaje error */
    .error-message {
      color: #f44336;
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="login-container">
    
    <a href="loading.html?next=inicio.php" class="back-button" title="Regresar">
      <i class="fas fa-chevron-left"></i>
    </a>

    <h2>Iniciar Sesión</h2>

    <form method="POST" action="validar-login.php" id="loginForm">
      <input type="text" name="usuario" placeholder="Correo electrónico" required />
      <input type="password" name="contrasena" placeholder="Contraseña" required />

      <div class="toggle-password">
        <input type="checkbox" id="ver-contrasena" />
        <label for="ver-contrasena">Ver contraseña</label>
        <div class="spark-container" id="spark-zone"></div>
      </div>

      <button type="submit">Ingresar</button>
    </form>

    <?php
    if (isset($_SESSION['error'])) {
      echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']);
    }
    ?>

    <div class="create-account">
      ¿No tienes cuenta? <a href="registro.php">Crear cuenta</a>
    </div>

  </div>

  <div class="animated-bg">
    <ul class="circles">
      <li></li><li></li><li></li><li></li>
      <li></li><li></li><li></li><li></li>
    </ul>
  </div>

  <script>
    
    const checkbox = document.getElementById("ver-contrasena");
    const passwordInput = document.querySelector('input[name="contrasena"]');
    const sparkZone = document.getElementById("spark-zone");

    checkbox.addEventListener("change", () => {
      passwordInput.type = checkbox.checked ? "text" : "password";
      passwordInput.style.transition = "all 0.3s ease";
      passwordInput.style.boxShadow = checkbox.checked ? "0 0 10px #888" : "none";

      for (let i = 0; i < 12; i++) {
        const spark = document.createElement("div");
        spark.classList.add("spark");
        spark.style.left = `${checkbox.offsetLeft + 8 + Math.random() * 4}px`;
        spark.style.top = `${checkbox.offsetTop + 4}px`;
        spark.style.background = `#ccc`;
        spark.style.transform = `translate(${Math.random() * 30 - 15}px, 0)`;

        sparkZone.appendChild(spark);
        setTimeout(() => spark.remove(), 1500);
      }
    });
  </script>
</body>
</html>
