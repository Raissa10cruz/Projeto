<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Início</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            position: relative;
            width: 100%;
            height: 200px;
            background-image: url('kauany.jpg'); /* Substitua pelo seu banner */
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reflexao {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            text-align: center;
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 10px;
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

        .section-title {
            text-align: center;
            margin-top: 30px;
            font-size: 24px;
            color: #333;
            font-weight: bold;
            background-color: rgba(255,255,255,0.8);
            display: inline-block;
            padding: 10px 20px;
            border-radius: 10px;
        }

        .bloco-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 30px;
        }

        @media (max-width: 900px) {
            .bloco-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .bloco-container {
                grid-template-columns: 1fr;
            }
        }

        .bloco {
            background-color: rgba(255,255,255,0.9);
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
            text-decoration: none;
            color: black;
            transition: transform 0.2s;
            aspect-ratio: 1 / 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .bloco img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .bloco span {
            font-size: 14px;
            font-weight: bold;
            padding: 0 10px;
        }

        .bloco:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="reflexao">
            "A maior jornada começa com o primeiro passo."
        </div>
        <div class="icones">
            <a href="home.php" title="Voltar"><img src="img/home.png" alt="Voltar"></a>
            <a href="perfil.php" title="Perfil"><img src="img/perfil.png" alt="Perfil"></a>
            <a href="logout.php" title="Sair"><img src="img/sair.png" alt="Sair"></a>
        </div>
    </div>

    <h2 class="section-title">ASSUNTOS PRINCIPAIS</h2>

    <div class="bloco-container">
        <a href="quem-sou-eu.php" class="bloco">
            <img src="img/quem.png" alt="">
            <span>QUEM SOU EU?</span>
        </a>
        <a href="#" class="bloco">
            <img src="img/objetivos.png" alt="">
            <span>OBJETIVOS</span>
        </a>
        <a href="#" class="bloco">
            <img src="img/plano.png" alt="">
            <span>PLANO DE AÇÃO</span>
        </a>
        <a href="#" class="bloco">
            <img src="img/sonhos.png" alt="">
            <span>SONHOS</span>
        </a>
        <a href="#" class="bloco">
            <img src="img/profissoes.png" alt="">
            <span>PROFISSÕES</span>
        </a>
        <a href="#" class="bloco">
            <img src="img/personalidade.png" alt="">
            <span>TESTE DE PERSONALIDADE</span>
        </a>
        <a href="#" class="bloco">
            <img src="img/inteligencias.png" alt="">
            <span>TESTE DE INTELIGÊNCIAS</span>
        </a>
        <a href="#" class="bloco">
            <img src="img/projeto.png" alt="">
            <span>QUAL É O PROJETO DE VIDA?</span>
        </a>
        <a href="#" class="bloco">
            <img src="img/como-fazer.png" alt="">
            <span>COMO TER UM PROJETO DE VIDA?</span>
        </a>
    </div>
</body>
</html>
