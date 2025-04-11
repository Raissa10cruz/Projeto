<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$host = 'localhost';
$dbname = 'sistema_cadastro';
$usuario = 'root';
$senha_db = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$mensagens = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_alvo = trim($_POST['email_alvo'] ?? '');

    if (!empty($email_alvo) && filter_var($email_alvo, FILTER_VALIDATE_EMAIL)) {
        // Verifica se o e-mail existe no banco
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email_alvo);
        $stmt->execute();
        $usuario_alvo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario_alvo) {
            $alvo_id = $usuario_alvo['id'];

            // Atualiza a senha se enviada
            $nova_senha = $_POST['nova_senha'] ?? '';
            $confirmar_senha = $_POST['confirmar_senha'] ?? '';

            if (!empty($nova_senha) && !empty($confirmar_senha)) {
                if ($nova_senha === $confirmar_senha) {
                    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
                    $stmt->bindParam(':senha', $senha_hash);
                    $stmt->bindParam(':id', $alvo_id);
                    $stmt->execute();
                    $mensagens[] = "✅ Senha de {$email_alvo} alterada com sucesso!";
                } else {
                    $mensagens[] = "❌ As senhas não coincidem.";
                }
            }

            // Atualizar o e-mail, se fornecido
            $novo_email = trim($_POST['novo_email'] ?? '');
            if (!empty($novo_email) && filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
                $stmt = $conn->prepare("UPDATE usuarios SET email = :email WHERE id = :id");
                $stmt->bindParam(':email', $novo_email);
                $stmt->bindParam(':id', $alvo_id);
                $stmt->execute();
                $mensagens[] = "✅ E-mail atualizado com sucesso!";
            }

        } else {
            $mensagens[] = "❌ Usuário com este e-mail não encontrado.";
        }
    } else {
        $mensagens[] = "❌ E-mail alvo inválido.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alterar Dados</title>
    <style>
        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 50px 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('img/imagem.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        h2 {
            color: #fff;
            margin-bottom: 35px;
            font-weight: 600;
            font-size: 24px;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            text-align: left;
            margin: 15px 0 8px;
            font-size: 14px;
            color: #fff;
            font-weight: 500;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 18px;
            border-radius: 30px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        input::placeholder {
            color: #e0e0e0;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 2px #d4dec2;
        }

        input[type="submit"] {
            margin-top: 30px;
            width: 100%;
            background-color: #e9efd9;
            border: none;
            padding: 14px;
            border-radius: 30px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            color: #333;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #d4dec2;
            transform: translateY(-2px);
        }

        .mensagem {
            margin-top: 20px;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 14px;
            color: #333;
            background-color: rgba(255, 255, 255, 0.85);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .botao-voltar {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 8px 20px;
            font-size: 14px;
            border: none;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            cursor: pointer;
            font-style: italic;
            transition: transform 0.2s ease, color 0.2s ease, background-color 0.2s ease;
            text-decoration: none;
            font-family: 'Raleway', sans-serif;
        }

        .botao-voltar:hover {
            transform: scale(1.05);
            color: #d9ffd9;
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>🔒 Alterar Dados de Usuário</h2>

        <form method="POST">
            <label for="email_alvo">E-mail do usuário a ser alterado:</label>
            <input type="email" name="email_alvo" placeholder="E-mail do usuário" required>

            <label for="novo_email">Novo e-mail (opcional):</label>
            <input type="email" name="novo_email" placeholder="Novo e-mail">

            <label for="nova_senha">Nova senha:</label>
            <input type="password" name="nova_senha" placeholder="Digite nova senha">

            <label for="confirmar_senha">Confirmar nova senha:</label>
            <input type="password" name="confirmar_senha" placeholder="Confirme nova senha">

            <input type="submit" value="Atualizar dados">
        </form>

        <?php if (!empty($mensagens)): ?>
            <?php foreach ($mensagens as $mensagem): ?>
                <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="login.php" class="botao-voltar">← Voltar</a>
    </div>
</body>
</html>
