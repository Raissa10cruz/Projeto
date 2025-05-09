<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$usuario_id = $_SESSION['id'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=site_autoconhecimento", "root", "");
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sobre = $_POST['sobre'];
    $id = $usuario_id;

    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE usuarios SET nome=?, email=?, sobre=?, senha=?  WHERE id=?");
        $stmt->execute([$nome, $email,$sobre, $senha,  $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE usuarios SET nome=?, email=?,sobre=?, senha=?  WHERE id=?");
        $stmt->execute([$nome, $email,$sobre, $senha,  $id]);
    }

    if (!empty($_FILES['foto']['name'])) {
        $foto = "fotos/" . uniqid() . "-" . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

        $stmt = $pdo->prepare("UPDATE usuarios SET foto=? WHERE id=?");
        
        $stmt->execute([$foto, $id]);
        //$_SESSION['usuario']['foto'] = $foto;
    }    

    header("Location: perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <style>
 
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #D23636;
        }
        .header {
            position: relative;
            width: 100%;
            height: 200px;
            background-image: url('kauany.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .reflexao {
            color: white;
            font-size: 22px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
            background-color: rgba(0,0,0,0.4);
            padding: 12px 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 90%;
        }
        .icones {
            position: absolute;
            top: 10px;
            right: 15px;
            display: flex;
            gap: 10px;
        }
        .icones a img {
            width: 30px;
            height: 30px;
            background-color: white;
            border-radius: 6px;
            padding: 4px;
        }
        .container {
            background-color: white;
            border-radius: 20px;
            max-width: 700px;
            width: 100%;
            margin: 40px auto;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .titulo {
            background-color: #c62828;
            color: white;
            font-size: 24px;
            text-align: center;
            font-family: 'Comic Sans MS', cursive;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #c62828;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 20px auto 0;
        }
        img.perfil {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 20px;
            border: 4px solid #c62828;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="reflexao">
        "A vida é um projeto em construção, e cada escolha que fazemos define o caminho que seguimos..."
    </div>
    <div class="icones">
        <a href="home.php" title="Voltar"><img src="3.png" alt="Voltar"></a>
        <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
        <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
    </div>
</div>

<div class="container">
    <div class="titulo">MEU PERFIL</div>

    <?php if (!empty($usuario['foto'])): ?>
        <img src="<?= htmlspecialchars($usuario['foto']) ?>" class="perfil" alt="Foto de Perfil">
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= isset($usuario['nome']) ? htmlspecialchars($usuario['nome']) : '' ?>" required>
           
       
        </div>
        

        <div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" value="<?= isset($usuario['email']) ? htmlspecialchars($usuario['email']) : '' ?>" required>
</div>

<div class="form-group">
    <label for="senha">Nova Senha (opcional)</label>
    <input type="password" id="senha" name="senha">
</div>

<div class="form-group">
    <label for="sobre">Sobre Mim</label>
    <textarea id="sobre" name="sobre" rows="4"><?= isset($usuario['sobre']) ? htmlspecialchars($usuario['sobre']) : '' ?></textarea>
</div>

<div class="form-group">
    <label for="foto">Foto de Perfil</label>
    <input type="file" id="foto" name="foto" accept="image/*">
</div>

<button type="submit">Salvar Alterações</button>
<a href="visualizacao.php" style="text-decoration: none;">
    <button type="button" style="margin-top: 10px;">Ver Perfil</button>
</a>

    </form>
</div>

</body>
</html>
