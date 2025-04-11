<?php include 'config/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-box">
        <h2>CADASTRO</h2>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">ENTRAR</button>
            <p class="link"><a href="index.php">Já tem uma conta? Faça login</a></p>
        </form>
        <?php
        if ($_POST) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            // Verifica se o email já está cadastrado
            $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $verifica->execute([$email]);

            if ($verifica->rowCount() > 0) {
                echo "<p style='color:orange;'>Este email já está cadastrado.</p>";
            } else {
                $inserir = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                if ($inserir->execute([$nome, $email, $senha])) {
                    echo "<p style='color:lightgreen;'>Cadastro realizado com sucesso!</p>";
                } else {
                    echo "<p style='color:red;'>Erro ao cadastrar. Tente novamente.</p>";
                }
            }
        }
        ?>
    </div>
</body>
</html>
