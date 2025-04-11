<?php
session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['email'];

  // Simulação de envio de link de redefinição
  // Em um sistema real, você enviaria um email com token
  $_SESSION['recuperar_email'] = $email;
  header("Location: recuperar_senha.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Esqueci a Senha</title>
  <style>
    body {
      font-family: Georgia, serif;
      background: url('imgRaissa/Flower hd 4k wallpaper 1920x1080 laptop desktop wpp_ 🌹.jfif') no-repeat center center;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .form-container {
      background-color: rgba(255, 255, 255, 0.3);
      padding: 30px;
      border-radius: 25px;
      width: 320px;
      text-align: center;
      backdrop-filter: blur(8px);
    }

    h2 {
      color: white;
      font-weight: normal;
    }

    label {
      display: block;
      color: white;
      font-weight: bold;
      margin-top: 15px;
    }

    input[type=email] {
      width: 100%;
      padding: 10px;
      border-radius: 20px;
      border: none;
      margin-top: 10px;
    }

    .btn {
      background-color: #b39ddb;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 20px;
      margin-top: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Recuperar Senha</h2>
    <form method="POST">
      <label>Digite seu email:</label>
      <input type="email" name="email" required>
      <button class="btn" type="submit">Enviar link</button>
    </form>
  </div>
</body>
</html>
