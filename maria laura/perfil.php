<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
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

$id = $_SESSION['usuario_id'];
$stmt = $conn->prepare("SELECT nome, email, data_nascimento, foto_perfil FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&family=Raleway:wght@400;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Cursive', sans-serif;
            background-image: url('img/imagem.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .perfil-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            backdrop-filter: brightness(0.9);
        }

        .perfil-titulo {
            font-size: 24px;
            margin-bottom: 20px;
            font-family: 'Fleur De Leah', cursive;
        }

        .foto-nome-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .foto-perfil {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #d9ffd9;
            background-color: #d9ffd9;
            overflow: hidden;
        }

        .foto-perfil img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .alterar-foto {
            color: white;
            font-size: 14px;
            margin-top: 5px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .alterar-foto:hover {
            transform: scale(1.05);
            color: #d9ffd9;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-style: italic;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 250px;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            font-size: 16px;
            font-style: italic;
        }

        input::placeholder {
            color: white;
            opacity: 0.8;
        }

        .botao-alterar {
            margin-top: 15px;
            padding: 10px 25px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            background-color: transparent;
            color: white;
            cursor: pointer;
            font-style: italic;
            font-family: 'Fleur De Leah', cursive;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .botao-alterar:hover {
            transform: scale(1.05);
            color: #d9ffd9;
        }

        .botao-voltar {
            margin-top: 10px;
            padding: 8px 20px;
            font-size: 14px;
            border: none;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            cursor: pointer;
            font-style: italic;
            transition: transform 0.2s ease, color 0.2s ease, background-color 0.2s ease;
        }

        .botao-voltar:hover {
            transform: scale(1.05);
            color: #d9ffd9;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .campo {
            margin-bottom: 10px;
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
    <div class="perfil-container">
        <div class="perfil-titulo">Meu perfil</div>

        <div class="foto-nome-container">
            <div>
                <div class="foto-perfil">
                    <img src="uploads/<?= htmlspecialchars($usuario['foto_perfil']) ?>" alt="Foto de perfil">
                </div>
                <div class="alterar-foto">Alterar Foto</div>
            </div>

            <div class="campo">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" readonly>
            </div>
        </div>

        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>" readonly>
        </div>

        <div class="campo">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" placeholder="••••••" value="" readonly>
        </div>

        <div class="campo">
            <label for="data">Data:</label>
            <input type="date" id="data" value="<?= $usuario['data_nascimento'] ?>" readonly>
        </div>

        <button class="botao-alterar">Alterar o Perfil</button>
        <a href="index.php" class="botao-voltar">← Voltar</a>
    </div>
</body>

</html>
