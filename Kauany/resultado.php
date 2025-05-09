<?php
session_start();

// Verificar se a pontuação foi armazenada na sessão
if (!isset($_SESSION['pontuacao'])) {
    header("Location: teste1.php");
    exit();
}

// Obter a pontuação da sessão
$pontuacao = $_SESSION['pontuacao'];

// Dicas baseadas na pontuação
if ($pontuacao <= 15) {
    $resultado = "Você tende a ser mais introvertido e cauteloso. Focar em se abrir mais para novas experiências pode ser um bom passo!";
    $dicas = "Tente ser mais flexível com mudanças e procure formas de se socializar sem se sobrecarregar.";
} elseif ($pontuacao <= 25) {
    $resultado = "Você tem um equilíbrio interessante entre introversão e extroversão. É ótimo, mas pode melhorar o equilíbrio!";
    $dicas = "Continue com sua abordagem equilibrada, mas tente ser mais espontâneo e lidar melhor com a pressão.";
} else {
    $resultado = "Você é muito extrovertido e gosta de estar no centro das atenções! Continue aproveitando essa energia!";
    $dicas = "Tente prestar mais atenção às necessidades dos outros e considerar momentos de introspecção para equilibrar sua vida.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Teste de Personalidade</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .background {
            background-image: url('kauany.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 150px 0;
            height: 100vh;
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

        .container {
            max-width: 900px;
            margin: 80px auto;
            background-color: rgba(255, 255, 255, 0.92);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }

        h1 {
            text-align: center;
            font-size: 36px;
            color: #444;
            margin-bottom: 30px;
        }

        p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .dicas {
            font-style: italic;
            color: #555;
        }

        .botao {
            display: block;
            margin: 30px auto;
            padding: 10px 20px;
            background-color:rgb(0, 0, 0);
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
        }

        .botao:hover {
            background-color:rgb(0, 0, 0);
        }

        .grafico {
            text-align: center;
            margin-top: 40px;
        }

        .grafico img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <!-- Ícones no topo, ajustados para o lado direito -->
    <div class="menu-icons">
        <a href="home.php" title="Voltar"><img src="3.png" alt="Voltar"></a>
        <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
        <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
    </div>

    <!-- Div para imagem de fundo -->
    <div class="background">
        <div class="container">
            <h1>Resultado do Teste de Personalidade</h1>
            <p><strong>Resultado:</strong> <?php echo $resultado; ?></p>
            <p class="dicas"><strong>Dicas para melhorar:</strong> <?php echo $dicas; ?></p>

            <!-- Gráfico ilustrativo -->
            <div class="grafico">
                <img src="grafico_resultado_personalidade.png" alt="Gráfico de Resultado">
            </div>

            <!-- Botão para refazer o teste -->
            <a href="teste1.php" class="botao">Refazer o Teste</a>
        </div>
    </div>

</body>
</html>
