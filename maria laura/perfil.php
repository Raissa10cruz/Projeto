<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$host = 'localhost';
$dbname = 'sistema_cadastro';
$usuario_db = 'root';
$senha_db = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario_db, $senha_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$id = $_SESSION['usuario_id'];

// Atualizar dados se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = $_POST['nome'] ?? '';
    $novo_email = $_POST['email'] ?? '';
    $nova_data = $_POST['data'] ?? '';

    // Atualizar nome, email e data
    $stmt = $conn->prepare("UPDATE usuarios SET nome = :nome, email = :email, data_nascimento = :data WHERE id = :id");
    $stmt->execute([
        ':nome' => $novo_nome,
        ':email' => $novo_email,
        ':data' => $nova_data,
        ':id' => $id
    ]);

    // Atualizar foto se enviada
    if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['nova_foto']['name'], PATHINFO_EXTENSION);
        $novo_nome_arquivo = uniqid() . '.' . $ext;
        $caminho = 'uploads/' . $novo_nome_arquivo;

        if (move_uploaded_file($_FILES['nova_foto']['tmp_name'], $caminho)) {
            $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = :foto WHERE id = :id");
            $stmt->execute([
                ':foto' => $novo_nome_arquivo,
                ':id' => $id
            ]);
        }
    }
}

// Buscar dados atualizados do usuário
$stmt = $conn->prepare("SELECT nome, email, data_nascimento, foto_perfil FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

// Foto padrão se não houver no banco
$foto_perfil = $usuario['foto_perfil'] ? $usuario['foto_perfil'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&family=Raleway:wght@400;700&display=swap" rel="stylesheet">
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

        .foto-bloco {
            display: flex;
            flex-direction: column;
            align-items: center;
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
            margin-top: 10px;
            text-align: center;
        }

        .alterar-foto label {
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .alterar-foto label:hover {
            transform: scale(1.05);
            color: #d9ffd9;
        }

        .alterar-foto input {
            display: none;
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
            text-decoration: none;
            font-family: 'Raleway', sans-serif;
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
    </style>
</head>

<body>
    <div class="perfil-container">
        <div class="perfil-titulo">Meu perfil</div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="foto-nome-container">
                <div class="foto-bloco">
                    <div class="foto-perfil">
                        <img src="uploads/<?= htmlspecialchars($foto_perfil) ?>" alt="Foto de perfil">
                    </div>
                    <div class="alterar-foto">
                        <label for="nova_foto">Alterar Foto</label>
                        <input type="file" name="nova_foto" id="nova_foto" accept="image/*">
                    </div>
                </div>

                <div class="campo">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>">
                </div>
            </div>

            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>">
            </div>

            <div class="campo">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" value="••••••" readonly>
            </div>

            <div class="campo">
                <label for="data">Data de Nascimento:</label>
                <input type="date" id="data" name="data" value="<?= $usuario['data_nascimento'] ?>">
            </div>

            <button type="submit" class="botao-alterar">Salvar Alterações</button>
        </form>

        <a href="index.php" class="botao-voltar">← Voltar</a>
      
    </div>
</body>
</html>
