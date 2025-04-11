<?php
require_once 'config/conexao.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :usuario");
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
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap');

        body {
            font-family: 'Dancing Script', cursive;
            background: url('img/flores.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .header {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 20px;
            font-size: 30px;
            color: #c44;
            font-style: italic;
            font-weight: bold;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 450px;
            margin: 60px auto;
            padding: 35px;
            border-radius: 25px;
            box-shadow: 6px 6px 18px rgba(0,0,0,0.25);
        }

        h2 {
            color: #c44;
            font-style: italic;
            margin-bottom: 30px;
            font-size: 28px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 20px;
            color: #c44;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 25px;
            border: 1px solid #ccc;
            border-radius: 12px;
            font-size: 16px;
            font-family: cursive;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #c44;
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Dancing Script', cursive;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #a33;
        }

        .mensagem {
            color: #c44;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 18px;
        }

        p {
            margin-top: 15px;
            font-size: 18px;
        }

        a {
            color: #c44;
            text-decoration: none;
            font-style: italic;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .form-container {
                margin: 30px 20px;
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            button {
                font-size: 16px;
            }
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
