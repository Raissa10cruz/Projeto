<?php include 'config/conexao.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-box">
        <h2>LOGIN</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">ENTRAR</button>
            <p><a href="recuperar_senha.php">Esqueceu sua senha?</a></p>
            <p class="link"><a href="cadastro.php">Não tem conta? Cadastre-se agora</a></p>
        </form>
        <?php
        if ($_POST) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($senha, $user['senha'])) {
                $_SESSION['usuario'] = $user['nome'];
                header("Location: home.php");
                exit;
            } else {
                echo "<p style='color:red;'>Email ou senha inválidos!</p>";
            }
        }
        ?>
    </div>
</body>
</html>
