<?php
session_start();

// Conexão com o banco usando PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pdv";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    if (empty($email) || empty($password)) {
        echo "Preencha todos os campos.";
    } else {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            // Usuário encontrado e senha válida
            $_SESSION["user"] = $user;
            header("Location: pag1.php"); // redireciona para a página principal do sistema
            exit;
        } else {
            echo "Email ou senha incorretos.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login - PDV-Ly</title>
  <link rel="stylesheet" href="styles1.css">
</head>
<body>
  <div class="container">
    <form method="post">
      <div class="form-group">
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="password">Senha</label><br>
        <input type="password" id="password" name="password">
      </div>
      <button type="submit">Entrar</button>
    </form>

    <p style="color: white; text-align: center; margin-top: 20px;">
    <a href="esqueci_senha.php" style="color: #ffffff; text-decoration: underline;">Esqueci minha senha.</a>
    </p>
  </div>

</body>
</html>
