<?php
session_start();

// Verificar se a pontuação foi armazenada na sessão
if (!isset($_SESSION['pontuacao'])) {
    header("Location: teste2.php");
    exit();
}

// Obter a pontuação da sessão
$pontuacao = $_SESSION['pontuacao'];

// Dicas baseadas na pontuação
if ($pontuacao <= 15) {
    $resultado = "Você tem uma inclinação para a inteligência lógico-matemática e naturalista. Busque atividades que envolvam análise e resolução de problemas!";
    $dicas = "Tente aplicar suas habilidades analíticas em desafios complexos, como programação ou ciências.";
} elseif ($pontuacao <= 25) {
    $resultado = "Você tem um bom equilíbrio entre a inteligência lógico-matemática e linguística. Continue explorando essas áreas!";
    $dicas = "Busque aprimorar sua comunicação e envolvimento com questões analíticas.";
} else {
    $resultado = "Você é muito criativo e extrovertido, com grande inteligência linguística e interpessoal! Continue cultivando essa energia!";
    $dicas = "Experimente atividades criativas como escrita ou oratória para usar sua inteligência ao máximo.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Teste de Múltiplas Inteligências</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('kauany.jpg'); /* Substitua pelo caminho da sua imagem de fundo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 80px auto;
            background-color: rgba(0, 0, 0, 0.7); /* Fundo semitransparente */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            color: white;
        }

        p {
            font-size: 18px;
            color: white;
            margin-bottom: 20px;
        }

        .dicas {
            font-style: italic;
            color: #ddd;
        }

        .botao {
            display: block;
            width: 100%;
            padding: 15px;
            background-color:rgb(0, 0, 0);
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 30px;
            text-align: center;
            text-decoration: none;
        }

        .botao:hover {
            background-color:rgb(0, 0, 0);
        }

        .menu-icons {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .menu-icons a {
            text-decoration: none;
            color: white;
        }

        .menu-icons img {
            width: 32px;
            margin-left: 12px;
        }
    </style>
</head>
<body>

    <!-- Ícones no topo -->
    <div class="menu-icons">
        <a href="home.php" title="Voltar"><img src="3.png" alt="Voltar"></a>
        <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
        <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
    </div>

    <div class="container">
        <h1>Resultado do Teste de Múltiplas Inteligências</h1>
        <p><strong>Resultado:</strong> <?php echo $resultado; ?></p>
        <p class="dicas"><strong>Dicas para melhorar:</strong> <?php echo $dicas; ?></p>

        <!-- Botão para refazer o teste -->
        <a href="teste2.php" class="botao">Refazer o Teste</a>
    </div>

</body>
</html>
