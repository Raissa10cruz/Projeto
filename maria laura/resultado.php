<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Resultado do Teste</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400&display=swap" rel="stylesheet">
  <style>
    /* Adicione o mesmo estilo que você já usou na página de resultado */
    body {
      margin: 0;
      padding: 0;
      background: url('img/imagem.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Playfair Display', serif;
      color: #fff;
    }

    .resultado-container {
      max-width: 800px;
      margin: 80px auto;
      background: rgba(255, 255, 255, 0.08);
      padding: 40px;
      border-radius: 20px;
      backdrop-filter: blur(14px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    h2 {
      text-align: center;
      font-size: 32px;
      margin-bottom: 30px;
      text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
    }

    .tag {
      display: inline-block;
      background: #a0c39e;
      color: #fff;
      padding: 10px 25px;
      border-radius: 30px;
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 25px;
      text-align: center;
    }

    .barras {
      margin: 30px 0;
    }

    .barra {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      overflow: hidden;
      margin-bottom: 15px;
    }

    .barra span {
      display: block;
      padding: 10px;
      background: #a0c39e;
      color: #fff;
      font-weight: bold;
      transition: width 0.5s ease;
    }

    p {
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .voltar {
      display: inline-block;
      margin-top: 30px;
      padding: 12px 28px;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      text-decoration: none;
      border-radius: 30px;
      font-weight: bold;
      backdrop-filter: blur(8px);
      transition: all 0.3s ease;
    }

    .voltar:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #d9ffd9;
      transform: scale(1.05);
    }
  </style>
</head>

<body>
  <div class="resultado-container">
    <?php
    // Supondo que o formulário foi enviado via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Pontuação para cada pergunta
      $pontuacoes = [];
      for ($i = 0; $i < 20; $i++) {
        if (isset($_POST["q$i"])) {
          $pontuacoes[$i] = (int) $_POST["q$i"];
        }
      }

      // Inicializando variáveis para a pontuação de cada personalidade
      $personalidadeA = 0;
      $personalidadeB = 0;
      $personalidadeC = 0;
      $personalidadeD = 0;

      // Cálculo das pontuações para diferentes perfis
      foreach ($pontuacoes as $index => $pontuacao) {
        if ($index < 5) {
          $personalidadeA += $pontuacao;
        } elseif ($index >= 5 && $index < 10) {
          $personalidadeB += $pontuacao;
        } elseif ($index >= 10 && $index < 15) {
          $personalidadeC += $pontuacao;
        } else {
          $personalidadeD += $pontuacao;
        }
      }

      // Determinar o perfil de personalidade com base na maior pontuação
      $personalidade = '';
      $maxPontuacao = max($personalidadeA, $personalidadeB, $personalidadeC, $personalidadeD);

      if ($maxPontuacao == $personalidadeA) {
        $personalidade = 'Personalidade A';
        $descricao = "A Personalidade A é marcada por uma tendência profunda à introspecção, análise e autoconhecimento. Pessoas com esse perfil costumam pensar antes de agir, refletindo cuidadosamente sobre os impactos de suas decisões. São metódicas, organizadas e prezam por coerência emocional e intelectual. Preferem ambientes calmos e previsíveis, onde possam exercer sua autonomia e focar em suas paixões pessoais. Embora possam parecer reservadas, elas valorizam relações profundas e significativas. São ótimas conselheiras, pois escutam com empatia e pensam de maneira crítica e ponderada. Essa personalidade busca crescimento interior constante, questionando padrões e buscando significado nas experiências da vida.";

      } elseif ($maxPontuacao == $personalidadeB) {
        $personalidade = 'Personalidade B';
        $descricao = "A Personalidade B é caracterizada por uma orientação voltada ao futuro, inovação e otimismo. Indivíduos com esse perfil são visionários, movidos por objetivos claros e grande ambição. Possuem uma mente criativa e prática, que busca constantemente novas soluções e caminhos alternativos. Gostam de planejar, liderar e influenciar mudanças em seu meio. São resilientes diante de desafios e preferem correr riscos a permanecerem estagnados. Valorizam liberdade e progresso, tanto no campo pessoal quanto profissional. Essa personalidade tende a inspirar os outros com sua energia proativa, capacidade de sonhar grande e transformar ideias em ação.";

      } elseif ($maxPontuacao == $personalidadeC) {
        $personalidade = 'Personalidade C';
        $descricao = "A Personalidade C é dominada por um foco interno intenso, regido pela sensibilidade emocional e compreensão profunda do mundo subjetivo. Pessoas com esse perfil são empáticas, intuitivas e possuem grande capacidade de captar sutilezas nos comportamentos e sentimentos dos outros. São criativas, expressivas e tendem a canalizar suas emoções em formas artísticas ou cuidadosas interações humanas. Apesar de emocionalmente intensas, conseguem se equilibrar ao entender e acolher sua própria vulnerabilidade. Essa personalidade valoriza conexões autênticas, ambientes harmoniosos e momentos de introspecção. Costumam ser excelentes ouvintes e possuem uma visão emocionalmente rica da realidade.";

      } else {
        $personalidade = 'Personalidade D';
        $descricao = "A Personalidade D representa indivíduos movidos por uma sede de conhecimento, exploração e experiências únicas. São pessoas curiosas, intelectualmente inquietas e apaixonadas por descobrir como o mundo funciona — tanto em termos práticos quanto filosóficos. Costumam ser não-convencionais, adaptáveis e atraídas por temas fora do senso comum. Preferem a diversidade à rotina e abraçam o desconhecido com coragem e entusiasmo. Essa personalidade valoriza liberdade intelectual, desafios mentais e a chance de expandir seus horizontes constantemente. Muitas vezes são pioneiras em suas áreas de interesse, guiadas por uma necessidade inata de ir além do superficial e mergulhar nas complexidades da vida.";
      }

      // Exibindo o resultado
      echo "<h1>Resultado do Teste de Personalidade</h1>";
      echo "<p><strong>Seu tipo de personalidade é: $personalidade</strong></p>";
      echo "<p><strong>Descrição:</strong> $descricao</p>";
      echo "<p><strong>Pontuação total de cada perfil:</strong></p>";
      echo "<ul>";
      echo "<li>Personalidade A: $personalidadeA</li>";
      echo "<li>Personalidade B: $personalidadeB</li>";
      echo "<li>Personalidade C: $personalidadeC</li>";
      echo "<li>Personalidade D: $personalidadeD</li>";
      echo "</ul>";
      ?>
      <!-- Gráfico de barras usando Chart.js -->
      <canvas id="graficoPersonalidade" width="400" height="200"></canvas>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        var ctx = document.getElementById('graficoPersonalidade').getContext('2d');
        var graficoPersonalidade = new Chart(ctx, {
          type: 'bar', // Tipo do gráfico (barras)
          data: {
            labels: ['Personalidade A', 'Personalidade B', 'Personalidade C', 'Personalidade D'],
            datasets: [{
              label: 'Pontuação das Personalidades',
              data: [<?php echo $personalidadeA; ?>, <?php echo $personalidadeB; ?>, <?php echo $personalidadeC; ?>, <?php echo $personalidadeD; ?>],
              backgroundColor: ['#d0debe', '#a1bd90', '#719c63', '#427a35'],
              borderColor: ['#3e7b31', '#2e6225', '#1f4a19', '#0f310c'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 10
                }
              }
            }
          }
        });
      </script>
      <?php
    } else {
      echo "Nenhuma resposta foi enviada.";
    }
    ?>


    <a href="teste-personalidade.php" class="voltar">← Refazer o teste</a>
  </div>
</body>

</html>