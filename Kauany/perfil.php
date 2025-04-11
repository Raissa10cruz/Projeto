<?php
session_start();
require_once 'config/conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$email = $_SESSION['email'] ?? '';
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sobre_mim = $_POST['sobre_mim'];
    $senha = $_POST['senha'];

    $foto_nome = null;

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $foto_nome = 'uploads/' . uniqid() . '_' . $_FILES['foto_perfil']['name'];
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $foto_nome);
    }

    $sql = "UPDATE usuario SET nome = :nome, sobre_mim = :sobre_mim";

    if (!empty($senha)) {
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
        $sql .= ", senha = :senha";
    }

    if ($foto_nome) {
        $sql .= ", foto_perfil = :foto";
    }

    $sql .= " WHERE email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':sobre_mim', $sobre_mim);
    $stmt->bindParam(':email', $email);

    if (!empty($senha)) {
        $stmt->bindParam(':senha', $senha_criptografada);
    }

    if ($foto_nome) {
        $stmt->bindParam(':foto', $foto_nome);
    }

    if ($stmt->execute()) {
        $mensagem = "Dados atualizados com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar.";
    }
}

$stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
$stmt->execute(['email' => $email]);
$usuario = $stmt->fetch();

if (!$usuario) {
    echo "<p style='color:red; text-align:center;'>Usuário não encontrado.</p>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            margin-left: 10px;
            vertical-align: middle;
        }

        .form-container {
            max-width: 500px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #d32f2f;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            margin-top: 20px;
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #b71c1c;
        }

        p img {
            margin-top: 10px;
            border-radius: 10px;
        }

        p a {
            color: #d32f2f;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .form-container {
                margin: 20px;
                padding: 20px;
            }

            .header p {
                font-size: 14px;
            }

            .header img {
                width: 20px;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <p>Perfil de <strong><?php echo htmlspecialchars($usuario['nome']); ?></strong></p>
    <div>
        <a href="home.php"><img src="img/voltar.png" alt="Voltar" width="24"></a>
        <a href="perfil.php"><img src="img/perfil.png" alt="Perfil" width="24"></a>
        <a href="logout.php"><img src="img/sair.png" alt="Sair" width="24"></a>
    </div>
</div>

<div class="form-container">
    <h2>Editar Perfil</h2>
    <?php if ($mensagem): ?>
        <p style="color: green;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>

        <label>Sobre Mim</label>
        <textarea name="sobre_mim"><?php echo htmlspecialchars($usuario['sobre_mim']); ?></textarea>

        <label>Nova Senha</label>
        <input type="password" name="senha" placeholder="Deixe em branco para não alterar">

        <label>Foto de Perfil</label>
        <input type="file" name="foto_perfil" accept="image/*">
        <?php if ($usuario['foto_perfil']): ?>
            <p><img src="<?php echo $usuario['foto_perfil']; ?>" alt="Foto de Perfil" width="100"></p>
        <?php endif; ?>

        <button type="submit">Salvar Alterações</button>
    </form>
</div>

</body>
</html>
