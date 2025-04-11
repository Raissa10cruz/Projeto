<?php
session_start();

// Verifica se o usuário está logado e pega os dados da sessão
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

$user = $_SESSION["user"];
$fotoPerfil = isset($user["profile_pic"]) && file_exists($user["profile_pic"]) ? $user["profile_pic"] : 'padrao.png';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meu Perfil</title>
  <link rel="stylesheet" href="styles2.css">
  <style>
    .btn-voltar {
      position: absolute;
      top: 20px;
      left: 20px;
      background-color: #D4ACB2;
      color: rgba(0, 0, 0, 0.9);
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .btn-voltar:hover {
      background-color: #8e44ad;
      color: white;
    }

    .container {
      position: relative; /* necessário para posicionar o botão dentro */
    }
  </style>
</head>
<body>
  <div class="container">

    <!-- Botão de Voltar -->
    <a href="pag1.php" class="btn-voltar">← Voltar</a>

    <div class="profile-pic-container">
      <div class="profile-pic">
        <img src="<?= htmlspecialchars($fotoPerfil) ?>" alt="Foto de Perfil">
        <div class="profile-pic-preview">
          <i class="fas fa-camera"></i>
        </div>
      </div>
    </div>

    <h1 style="text-align:center; color:white;">Bem-vindo, <?= htmlspecialchars($user["email"]) ?></h1>
    <p style="text-align:center; color:white;">Aqui você poderá atualizar suas informações em breve.</p>

  </div>
</body>
</html>


