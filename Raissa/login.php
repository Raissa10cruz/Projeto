<?php
session_start();

// Conexão com o banco
$host = "localhost";
$user = "root";  // ou outro usuário
$pass = "";
$db = "site_autoconhecimento";

try {
    // Usando PDO para a conexão
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Definir o modo de erro do PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Verificação de login
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Corrigido para a tabela correta, por exemplo, "usuarios"
    $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Verifica se o usuário existe
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a senha
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario_id'] = $user['id'];
            header("Location: dashboard.php"); // redirecionar após login
            exit();
        } else {
            $msg = "Senha incorreta.";
        }
    } else {
        $msg = "Email não encontrado.";
    }
}

$conn = null;  // Fecha a conexão PDO
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Georgia, serif;
      background-image: url('imgRaissa/Flower hd 4k wallpaper 1920x1080 laptop desktop wpp_ 🌹.jfif');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: rgba(255, 255, 255, 0.25);
      border-radius: 30px;
      padding: 40px 30px;
      width: 300px;
      text-align: center;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .form-container img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 10px;
      border: 5px solid #bfa8f3;
    }

    .form-container h2 {
      color: white;
      font-weight: normal;
      margin-bottom: 20px;
    }

    label {
      display: block;
      text-align: left;
      color: white;
      font-weight: bold;
      margin: 10px 0 5px;
    }

    input {
      width: 100%;
      padding: 8px 12px;
      border-radius: 20px;
      border: none;
      outline: none;
      margin-bottom: 10px;
      background-color: rgba(255, 255, 255, 0.5);
      font-weight: bold;
    }

    .btn-login {
      background-color: #d2b8f4;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 25px;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.3s;
    }

    .btn-login:hover {
      background-color: #bca0e6;
    }

    .mensagem {
      margin-top: 15px;
      color: white;
      font-weight: bold;
    }

    .link {
      display: block;
      margin-top: 10px;
      color: #4a347d;
      font-size: 13px;
      text-decoration: none;
    }

    .link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <img src='./imgRaissa/User_Clipart_PNG_Images__User_Avatar_Login_Interface_Abstract_Purple_User_Icon__Avatar__User__Login_Avatar_PNG_Image_For_Free_Download-removebg-preview.png' alt=ícone usuário>
    <h2>LOGIN</h2>

    <form method="POST" action="">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="•••••@gmail.com" required>

      <label for="senha">Senha:</label>
      <input type="password" name="senha" required>

      <button class="btn-login" type="submit">ENTRAR</button>

      <a href="esqueci_senha.php" class="link">esqueceu a senha?</a>

      <?php if ($msg): ?>
        <p class="mensagem"><?= $msg ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>
