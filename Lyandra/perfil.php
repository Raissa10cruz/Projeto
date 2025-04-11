<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

// Pega o e-mail da sessão
$email = $_SESSION["user"]["email"] ?? '';

// Buscar os dados atualizados do banco (incluindo name e profile_pic)
$stmt = $conn->prepare("SELECT name, email, profile_pic FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();


// Foto de perfil
$fotoPerfil = (!empty($user["profile_pic"]) && file_exists('uploads/' . $user["profile_pic"])) 
  ? $user["profile_pic"] 
  : 'perfil.png';

// Nome para exibir
$nomeExibido = $user["name"] ?? 'Usuário';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meu Perfil</title>
  <link rel="stylesheet" href="styles2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background-color: #2c3e50;
      font-family: Arial, sans-serif;
    }

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
      text-align: center;
      padding: 120px 20px;
      color: white;
    }

    .profile-pic-container {
      display: flex;
      justify-content: center;
      margin-top: 50px;
    }

    .profile-pic {
      width: 200px;
      height: 200px;
      border-radius: 50%; /* retrato redondo */
      overflow: hidden;
      border: 3px solid white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      margin: 0 auto;
    }

    .profile-pic img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* preenche mantendo proporção */
      object-position: center;
    }

    .profile-name {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .actions {
      margin-top: 20px;
    }

    .actions button {
      background-color: #8e44ad;
      border: none;
      color: white;
      padding: 10px 15px;
      border-radius: 20px;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .actions button:hover {
      background-color: #732d91;
    }

    /* Removido: .profile-pic-preview */
  </style>
</head>
<body>

  <div class="container">

    <a href="pag1.php" class="btn-voltar">← Voltar</a>

    <div class="profile-pic-container">
      <div class="profile-pic">
        <img src="<?= 'uploads/' . htmlspecialchars($fotoPerfil) ?>" alt="Foto de Perfil">
      </div>
    </div>

    <div class="profile-name"><?= htmlspecialchars($nomeExibido) ?></div>
    <p><?= htmlspecialchars($user["email"]) ?></p>

    <div class="actions">
  <a href="editar_perfil.php"><button><i class="fas fa-user-edit"></i> Editar Perfil</button></a>
  <?php if (!empty($user['descricao'])): ?>
    <p style="color: white; text-align: center; margin-top: 10px;"><?= htmlspecialchars($user['descricao']) ?></p>
  <?php else: ?>
    <p style="color: white; text-align: center; margin-top: 10px;">Adicione uma descrição no perfil</p>
  <?php endif; ?>
  
</div>

  </div>

</body>
</html>
