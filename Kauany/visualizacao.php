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

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualização de Perfil</title>
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
            width: 90%;
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

        .perfil-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 20px;
            border: 4px solid #c62828;
        }

        .info-box {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            color: #333;
            font-size: 16px;
            text-align: left;
        }

        .botao-alterar {
            display: block;
            width: fit-content;
            margin: 20px auto 0;
            background-color: #c62828;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 10px;
            font-size: 16px;
            text-align: center;
        }

        .botao-alterar:hover {
            background-color: #a71d1d;
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
        <img src="<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto de Perfil" class="perfil-img">
    <?php endif; ?>

    <div class="info-box">
        <strong>Nome:</strong><br> <?= htmlspecialchars($usuario['nome']) ?>
    </div>
    <div class="info-box">
        <strong>Email:</strong><br> <?= htmlspecialchars($usuario['email']) ?>
    </div>
    <div class="info-box">
        <strong>Sobre:</strong><br> <?= nl2br(htmlspecialchars($usuario['sobre'])) ?>
    </div>

    <a href="perfil.php" class="botao-alterar">Alterar Perfil</a>
</div>

</body>
</html>
