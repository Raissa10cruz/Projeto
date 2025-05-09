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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = $_POST['nome'] ?? '';
    $novo_email = $_POST['email'] ?? '';
    $nova_data = $_POST['data'] ?? '';

    $stmt = $conn->prepare("UPDATE usuarios SET nome = :nome, email = :email, data_nascimento = :data WHERE id = :id");
    $stmt->execute([
        ':nome' => $novo_nome,
        ':email' => $novo_email,
        ':data' => $nova_data,
        ':id' => $id
    ]);

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

$stmt = $conn->prepare("SELECT nome, email, data_nascimento, foto_perfil FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

$foto_perfil = $usuario['foto_perfil'] ? $usuario['foto_perfil'] : 'default.png';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&family=Raleway:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Raleway', sans-serif;
            background-image: url('img/imagem.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(2px);
        }

        .perfil-container {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 20px;
            width: 95%;
            max-width: 820px;
            backdrop-filter: blur(14px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .perfil-titulo {
            font-size: 32px;
            margin-bottom: 25px;
            font-family: 'Fleur De Leah', cursive;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
        }

        .foto-nome-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-bottom: 25px;
        }

        .foto-bloco {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .foto-perfil {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.6);
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
            transition: transform 0.4s ease;
        }

        .foto-perfil:hover {
            transform: scale(1.05);
        }

        .foto-perfil img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .alterar-foto {
            margin-top: 12px;
        }

        .alterar-foto label {
            font-size: 15px;
            cursor: pointer;
            padding: 6px 18px;
            background-color: rgba(255, 255, 255, 0.25);
            border-radius: 12px;
            transition: all 0.3s ease;
            color: white;
        }

        .alterar-foto label:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }

        input[type="file"] {
            display: none;
        }

        .campo {
            margin-bottom: 10px;
            text-align: left;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }


        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            font-size: 16px;
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus {
            background-color: rgba(255, 255, 255, 0.25);
            outline: none;
        }

        .campo-senha {
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #eee;
            padding: 10px;
            border-radius: 12px;
            width: 100%;
            cursor: not-allowed;
        }

        .botao-alterar {
            font-family: 'Fleur De Leah', cursive;
            margin-top: 20px;
            padding: 14px 40px;
            font-size: 22px;
            font-weight: normal;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.15);
            background-size: 200% 200%;
            color: white;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            transition: background-position 0.5s ease, transform 0.3s ease;
        }


        .botao-alterar:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3); );
        }

        .botao-voltar {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.25);
            color: white;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .botao-voltar:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="perfil-container">
        <div class="perfil-titulo">Meu Perfil</div>

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
                <input type="password" id="senha" name="senha" value="••••••" readonly class="campo-senha">
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