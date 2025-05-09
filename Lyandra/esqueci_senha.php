<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $novaSenha = $_POST['nova_senha'] ?? '';

    if (!empty($email) && !empty($novaSenha)) {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "pdv";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verifica se o e-mail existe
            $sqlVerifica = "SELECT * FROM users WHERE email = :email";
            $stmtVerifica = $conn->prepare($sqlVerifica);
            $stmtVerifica->bindParam(':email', $email);
            $stmtVerifica->execute();

            if ($stmtVerifica->rowCount() > 0) {
                $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);
                $sqlAtualiza = "UPDATE users SET password = :password WHERE email = :email";
                $stmtAtualiza = $conn->prepare($sqlAtualiza);
                $stmtAtualiza->bindParam(':password', $senhaCriptografada);
                $stmtAtualiza->bindParam(':email', $email);
                $stmtAtualiza->execute();

                $mensagem = "Senha alterada com sucesso!";
            } else {
                $mensagem = "Email não encontrado.";
            }
        } catch (PDOException $e) {
            $mensagem = "Erro na conexão: " . $e->getMessage();
        }
    } else {
        $mensagem = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Esqueci a Senha</title>
  <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  <div class="container">
    <form method="post">

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>

      <div class="form-group">
        <label for="nova_senha">Nova Senha</label>
        <input type="password" name="nova_senha" id="nova_senha" required>
      </div>

      <button type="submit">Redefinir</button>

      <?php if (isset($mensagem)) : ?>
        <p style="color: white; text-align:center; margin-top:10px;">
          <?= htmlspecialchars($mensagem) ?>
        </p>
      <?php endif; ?>
    </form>
  </div>
  <script>
const botaoMenu = document.getElementById("botao-menu");
const menu = document.getElementById("menu-navegacao");

botaoMenu.addEventListener("click", () => {
    botaoMenu.classList.toggle("active");
    menu.classList.toggle("active");
});

  </script>
</body>
</html>
