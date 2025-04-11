<?php
session_start();

$mensagem = "";
$mostrarFormulario = true;

if (!isset($_SESSION['recuperar_email'])) {
  $mensagem = "Acesso inválido.";
  $mostrarFormulario = false;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $novaSenha = $_POST['senha'];
  $email = $_SESSION['recuperar_email'];

  // Conexão
  $conn = new mysqli("localhost", "root", "", "site_autoconhecimento");
  if ($conn->connect_error) die("Erro: " . $conn->connect_error);

  $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");

  $stmt->bind_param("ss", $senhaHash, $email);

  if ($stmt->execute()) {
    $mensagem = "Senha atualizada com sucesso! <a href='login.php'>Faça login</a>";
    $mostrarFormulario = false;
    unset($_SESSION['recuperar_email']);
  } else {
    $mensagem = "Erro ao atualizar senha.";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Redefinir Senha</title>
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

    input[type=password] {
      width: 100%;
      padding: 10px;
      border-radius: 20px;
      border: none;
      margin-top: 15px;
    }

    .btn {
      background-color: #a68bc7;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 20px;
      margin-top: 20px;
      cursor: pointer;
    }

    .mensagem {
      color: white;
      font-weight: bold;
      margin-top: 20px;
    }

    a {
      color: #fff;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <?php if ($mostrarFormulario): ?>
      <h2>Digite a nova senha</h2>
      <form method="POST">
        <input type="password" name="senha" placeholder="Nova senha" required>
        <button class="btn" type="submit">Salvar nova senha</button>
      </form>
    <?php endif; ?>

    <?php if ($mensagem): ?>
      <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
