<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$dbname = 'sistema_cadastro';
$usuario = 'root';
$senha_db = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['foto_perfil'] = $usuario['foto_perfil'];

            header("Location: index.php");
            exit;
        } else {
            $mensagem = "❌ Email ou senha incorretos!";
        }
    } catch (PDOException $e) {
        $mensagem = "❌ Erro no banco de dados: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Tela de Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('img/imagem.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-container {
      padding: 5px;
      border-radius: 10px;
      width: 570px;
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .profile-img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 30px;
      border: 3px solid white;
    }
    .input-group {
      position: relative;
      width: 100%;
      margin-bottom: 30px;
    }
    .input-group input {
      width: 100%;
      padding: 14px 45px;
      font-size: 14px;
      border: none;
      border-radius: 20px;
      background-color: #e9efd9;
      outline: none;
    }
    .input-group.password input {
      background-color: transparent;
      border-radius: 0;
      border-bottom: 1px solid #444;
      padding-left: 35px;
      color: white;
    }
    .input-group i {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      font-size: 16px;
      color: #444;
    }
    .forgot-password {
      font-size: 12px;
      text-align: left;
      width: 100%;
      margin-top: -20px;
      margin-bottom: 30px;
    }
    .forgot-password a {
      color: #000;
      text-decoration: none;
    }
    .login-container button {
      background-color: #e9efd9;
      border: none;
      padding: 12px 35px;
      border-radius: 20px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .login-container button:hover {
      background-color: #d4dec2;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <img src="img/do-utilizador.png" alt="Avatar" class="profile-img">

    <form method="POST" action="login.php" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-group password">
        <i class="fas fa-lock"></i>
        <input type="password" name="senha" placeholder="Senha" required>
      </div>

      <div class="forgot-password">
        <a href="esqueci_senha.php">Esqueceu a Senha?</a> <!-- CORRIGIDO -->
      </div>

      <button type="submit">Entrar</button>

      <?php if (!empty($mensagem)): ?>
        <p style="margin-top: 20px; font-weight: bold; color: red;"><?= $mensagem ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>
