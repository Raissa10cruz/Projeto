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
            background-image: url('kauany.jpg'); /* imagem de fundo */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .header {
            background-color: #d32f2f;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .reflexao {
            font-size: 18px;
            font-weight: bold;
        }

        .icones {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .icones a img {
            width: 24px;
            height: 24px;
            vertical-align: middle;
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
            <a href="home.php" title="Voltar"><img src="" alt="Voltar"></a>
            <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
            <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
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
