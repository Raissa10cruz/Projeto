<?php
require_once 'config/conexao.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: redefinir_senha.php?usuario=" . urlencode($usuario));
        exit;
    } else {
        $mensagem = "Usuário não encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
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

        input[type="email"] {
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
        <h2>Recuperar Senha</h2>

        <?php if (!empty($mensagem)): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="email" id="usuario" name="usuario" placeholder="Digite seu e-mail" required>
            <button type="submit">Enviar</button>
        </form>

        <div class="link">
