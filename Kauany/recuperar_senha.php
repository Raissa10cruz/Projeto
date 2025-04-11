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
            background: #f2f2f2;
        }

        .header {
            background-color: #d32f2f;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .form-container {
            max-width: 400px;
            margin: 60px auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            color: #d32f2f;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #d32f2f;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #b71c1c;
        }

        p {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        a {
            color: #d32f2f;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .mensagem {
            color: #d32f2f;
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="header">Recuperar Senha</div>

    <div class="form-container">
        <h2>Digite seu e-mail</h2>

        <?php if (!empty($mensagem)): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>

        <form method="post">
            <label for="usuario">E-mail</label>
            <input type="email" id="usuario" name="usuario" required>
            <button type="submit">Enviar</button>
        </form>
        <p><a href="index.php">Voltar para o login</a></p>
    </div>

</body>
</html>
