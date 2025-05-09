<?php
session_start();

// Verificar se a pontuação foi armazenada na sessão
if (!isset($_SESSION['pontuacao'])) {
    header("Location: teste1.php");
    exit();
}

// Obter a pontuação da sessão
$pontuacao = $_SESSION['pontuacao'];

// Resultado e dicas baseados na pontuação
if ($pontuacao <= 15) {
    $resultado = "Você tende a ser mais introvertido e cauteloso. Focar em se abrir mais para novas experiências pode ser um bom passo!";
    $dicas = "Tente ser mais flexível com mudanças e procure formas de se socializar sem se sobrecarregar.";
    $tipo = "Introvertido";
} elseif ($pontuacao <= 25) {
    $resultado = "Você tem um equilíbrio interessante entre introversão e extroversão. É ótimo, mas pode melhorar o equilíbrio!";
    $dicas = "Continue com sua abordagem equilibrada, mas tente ser mais espontâneo e lidar melhor com a pressão.";
    $tipo = "Equilibrado";
} else {
    $resultado = "Você é muito extrovertido e gosta de estar no centro das atenções! Continue aproveitando essa energia!";
    $dicas = "Tente prestar mais atenção às necessidades dos outros e considerar momentos de introspecção para equilibrar sua vida.";
    $tipo = "Extrovertido";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Teste de Personalidade</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('kauany.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
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
            background-color: rgb(0, 0, 0);
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
        }

        .botao:hover {
            background-color: rgb(0, 0, 0);
        }

        .grafico {
            max-width: 600px;
            margin: 40px auto;
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

    <!-- Conteúdo -->
    <div class="container">
        <h1>Resultado do Teste de Personalidade</h1>
        <p><strong>Resultado:</strong> <?php echo $resultado; ?></p>
        <p class="dicas"><strong>Dicas para melhorar:</strong> <?php echo $dicas; ?></p>

        <!-- Gráfico -->
        <div class="grafico">
            <canvas id="graficoPersonalidade"></canvas>
        </div>

        <!-- Botão -->
        <a href="teste1.php" class="botao">Refazer o Teste</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const pontuacao = <?= $pontuacao ?>;      // sua pontuação PHP → JS
    const tipo      = "<?= $tipo ?>";         // Introvertido | Equilibrado | Extrovertido

    // valores-base (marcam os intervalos de corte: 15 – 25 – 30)
    const base = [15, 25, 30];

    // cria um vetor só com zeros
    const destaque = [0, 0, 0];

    // coloca a pontuação apenas na categoria certa
    if (tipo === 'Introvertido') {
        destaque[0] = pontuacao;
    } else if (tipo === 'Equilibrado') {
        destaque[1] = pontuacao;
    } else {
        destaque[2] = pontuacao;
    }

    const ctx = document.getElementById('graficoPersonalidade').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Introversão', 'Equilíbrio', 'Extroversão'],
            datasets: [
                {
                    label: 'Limite da Faixa',
                    data: base,
                    backgroundColor: 'rgba(200,200,200,0.35)',
                    borderColor: 'rgba(200,200,200,0.7)',
                    borderWidth: 1,
                },
                {
                    label: 'Sua Pontuação',
                    data: destaque,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',   // azul
                        'rgba(255, 206, 86, 0.8)',   // amarelo
                        'rgba(255, 99, 132, 0.8)'    // vermelho
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 30,
                    ticks: { stepSize: 5 }
                }
            },
            plugins: {
                legend: { labels: { color: '#333' } }
            }
        }
    });
</script>

</body>
</html>
