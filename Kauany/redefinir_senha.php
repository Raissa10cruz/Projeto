<?php
require_once 'config/conexao.php';

$mensagem = "";
$usuarios = $_GET['usuario'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novaSenha = $_POST['senha'] ?? '';
    $usuarios = $_POST['usuario'] ?? '';

    if (!empty($novaSenha) && !empty($usuarios)) {
        // Criptografar a senha
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE email = :usuario");
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':usuario', $usuarios);
        $stmt->execute();

        if ($stmt->rowCount()) {
            $mensagem = "Senha redefinida com sucesso!";
        } else {
            $mensagem = "Erro ao redefinir. Verifique o e-mail.";
        }
    } else {
        $mensagem = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('kauany.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 30px;
            width: 90%;
            max-width: 400px;
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input, button {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 25px;
            font-size: 16px;
        }

        input[type="password"] {
            background-color: #fff;
            color: #000;
        }

        button {
            background: white;
            color: black;
            font-weight: bold;
            cursor: pointer;
        }

        .mensagem {
            color: #f66;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .link {
            margin-top: 15px;
        }

        .link a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Redefinir Senha</h2>

        <?php if (!empty($mensagem)): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="password" id="senha" name="senha" placeholder="Nova Senha" required>
            <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuarios) ?>">
            <button type="submit">Redefinir Senha</button>
        </form>

        <div class="link">
            <a href="index.php">Voltar para o login</a>
        </div>
    </div>

</body>
</html>
