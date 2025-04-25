<?php
session_start();

$foto = 'default.png';
if (isset($_SESSION['usuario_id'])) {
    try {
        $conn = new PDO('mysql:host=localhost;dbname=sistema_cadastro;charset=utf8', 'root', '');
        $stmt = $conn->prepare("SELECT foto_perfil FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $_SESSION['usuario_id']]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado && !empty($resultado['foto_perfil'])) {
            $foto = $resultado['foto_perfil'];
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Mim</title>
    <link href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&family=Raleway:wght@400;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Playfair Display", serif;
            font-style: italic;
            background-color:#CDD5C6;
        }

        header {
            background-image: url('img/imagem.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: left;
            padding: 100px 20px;
            position: relative;
        }

        nav {
            position: absolute;
            top: 10px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        nav a:hover {
            color: #98A38F;
            transform: scale(1.1);
        }

        .perfil-link {
            display: inline-block;
            width: 40px;
            height: 40px;
            overflow: hidden;
            border-radius: 50%;
            border: 2px solid white;
        }

        .perfil-foto {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-text {
            text-align: left;
        }

        .header-text h1 {
            font-size: 3em;
            font-family: 'Fleur De Leah', cursive;
            margin: 0;
        }

        .conteudo {
            padding: 40px 200px;
        }

        .bloco {
            background: #98A38F;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        h2 {
            color:rgb(0, 0, 0);
        }

        p {
            font-size: 1.1em;
            line-height: 1.6;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 10px;
        }

        /* NOVO bloco das imagens fora da área de conteúdo */
        .imagens-direita {
            position: absolute;
            top: 420px;
            right: 60px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .imagens-direita img {
            height: 80px;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <div>
            <a href="index.php">Início</a>
            <a href="sonho.php">Sonhos</a>
            <a href="sobre.php">Sobre</a>
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <a href="plano.php">Plano Ação</a>
            <a href="perfil.php" class="perfil-link">
                <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Perfil" class="perfil-foto">
            </a>
        </div>
    </nav>
    <div class="header-text">
        <h1>Meu Projeto de Vida</h1>
        <p>"Os sonhos são os sorrisos que dormem nas entrelinhas do tempo. Só acordam quando os chamamos pelo nome."</p>
    </div>
</header>

<!-- IMAGENS FORA DO CONTEÚDO E DO BLOCO -->
<div class="imagens-direita">
    <img src="img/psychology.png" alt="Psicologia">
    <img src="img/psiquiatria.png" alt="Medicina">
</div>

<!-- BLOCO DE TEXTO SEPARADO -->
<div class="bloco" style="margin: 40px 200px;">
    <h2>Meu Sonho</h2>
    <p>Tenho um sonho em me formar em Psicologia e Psiquiatria.</p>
    <ul>
        <li><strong>Por que escolhi esse sonho?</strong> Eu acredito que posso fazer diferença na felicidade e conforto das pessoas que sofrem em silêncio.</li>
        <li><strong>O que me ajuda nesse foco:</strong> Meu desejo de ajudar pessoas e famílias em sofrimento.</li>
    </ul>
</div>

<main class="conteudo">
    <div class="bloco">
        <h2>Meus Principais Objetivos</h2>
        <h3>Objetivos de Curto Prazo (1 ano)</h3>
        <ul>
            <li>Entrar na faculdade de Psicologia ou Medicina.</li>
            <li>Estudar hábitos de saúde mental.</li>
            <li>Desenvolver habilidades emocionais.</li>
        </ul>

        <h3>Objetivos de Médio Prazo (3 anos)</h3>
        <ul>
            <li>Ter um bom desempenho na faculdade.</li>
            <li>Participar de eventos, congressos e grupos de estudo.</li>
        </ul>

        <h3>Objetivos de Longo Prazo (7 anos)</h3>
        <ul>
            <li>Ser formada em ambas as áreas.</li>
            <li>Trabalhar com pessoas em vulnerabilidade.</li>
            <li>Viver com propósito e contribuir com a sociedade.</li>
        </ul>
    </div>

    <div class="bloco">
        <h2>Minha Visão para os Próximos 10 Anos</h2>
        <p>Daqui a 10 anos, quero ser uma profissional reconhecida, formada em Psicologia e Medicina, ajudando famílias e impactando positivamente a sociedade. Meu sonho é poder cuidar e guiar pessoas em momentos difíceis, promovendo saúde mental e emocional.</p>
    </div>
</main>
</body>
</html>
