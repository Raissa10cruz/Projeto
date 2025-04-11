<?php
// Conexão com o banco
$host = "localhost";
$user = "root";  // Altere se tiver senha
$pass = "";
$db = "site_autoconhecimento";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Erro de conexão: " . $conn->connect_error);
}

// Lógica de cadastro
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $confirmar = $_POST['confirmar'];

  // Verifica se as senhas são iguais
  if ($senha !== $confirmar) {
    $msg = "As senhas não coincidem!";
  } else {
    // Verificando se o e-mail já existe no banco de dados
    $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($emailExistente);
    $stmt->fetch();
    $stmt->close();

    if ($emailExistente > 0) {
      $msg = "Este e-mail já está cadastrado!";
    } else {
      // Criptografando a senha antes de armazená-la
      $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

      // Preparando a consulta para inserir os dados na tabela 'usuarios'
      $stmt = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
      $stmt->bind_param("ss", $email, $senhaHash);

      // Executando a consulta
      if ($stmt->execute()) {
        $msg = "Cadastro realizado com sucesso!";
      } else {
        // Se ocorrer algum erro na execução, exibe a mensagem de erro
        $msg = "Erro: " . $stmt->error;
      }

      $stmt->close();
    }
  }
}

$conn->close();  // Fecha a conexão com o banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
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

    .btn-cadastro {
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

    .btn-cadastro:hover {
      background-color: #bca0e6;
    }

    .mensagem {
      margin-top: 15px;
      color: white;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="ícone perfil">
    <h2>CADASTRAR</h2>

    <form method="POST" action="">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="•••••@gmail.com" required>

      <label for="senha">Senha:</label>
      <input type="password" name="senha" required>

      <label for="confirmar">Confirme a senha:</label>
      <input type="password" name="confirmar" required>

      <button class="btn-cadastro" type="submit">CADASTRAR</button>

      <p style="color: white; text-align: center; margin-top: 20px;">
        Já tem uma conta? <a href="login.php" style="color: #ffffff; text-decoration: underline;">Entre.</a>
      </p>

      <?php if ($msg): ?>
        <p class="mensagem"><?= $msg ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>
