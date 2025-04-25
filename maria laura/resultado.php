<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Resultado do Teste</title>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Playfair Display", serif;
      font-style: italic;
      margin: 0;
      padding: 0;
      background: url('img/imagem.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      color: #fff;
    }
    .resultado-container {
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(16px);
      border-radius: 20px;
      padding: 40px;
      max-width: 800px;
      width: 95%;
      box-shadow: 0 0 30px rgba(0,0,0,0.4);
    }
    h2 {
      font-size: 28px;
      margin-bottom: 20px;
      text-align: center;
    }
    .tag {
      display: inline-block;
      background: #222;
      color: white;
      padding: 5px 12px;
      font-size: 13px;
      border-radius: 12px;
      margin-bottom: 10px;
    }
    p {
      font-size: 16px;
      line-height: 1.6;
    }

    .botao-voltar {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 8px 20px;
            font-size: 14px;
            border: none;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            cursor: pointer;
            font-style: italic;
            text-decoration: none;
            font-family: 'Raleway', sans-serif;
            transition: transform 0.2s ease, color 0.2s ease, background-color 0.2s ease;
        }

        .botao-voltar:hover {
            transform: scale(1.05);
            color: #d9ffd9;
            background-color: rgba(255, 255, 255, 0.2);
        }
  </style>
</head>
<body>
  <div class="resultado-container">
    <?php
      $score = 0;
      for ($i = 0; $i < 20; $i++) {
        if (isset($_POST["q$i"])) {
          $score += (int)$_POST["q$i"];
        }
      }

      echo "<h2>Seu Resultado</h2>";

      if ($score >= 80) {
        echo "<span class='tag'>LÍDER ANALÍTICO</span>";
        echo "<p>Você possui uma mente altamente estruturada, com grande capacidade de análise e planejamento. 
        Gosta de resolver problemas complexos e mantém a racionalidade mesmo sob pressão. 
        Seu perfil é ideal para carreiras que exigem tomada de decisão e organização, como gestão, direito, engenharia ou consultoria estratégica.</p>";
        echo "<p><strong>Fortalezas:</strong> Racionalidade, foco, liderança, consistência.</p>";
        echo "<p><strong>Desafios:</strong> Trabalhar melhor suas emoções e tolerância à imprevisibilidade.</p>";
      } elseif ($score >= 60) {
        echo "<span class='tag'>EQUILIBRADO HUMANISTA</span>";
        echo "<p>Você demonstra um bom equilíbrio entre razão e emoção, sendo empático e cooperativo, 
        mas também analítico quando necessário. Gosta de entender pessoas e situações em profundidade. 
        Se adapta bem a mudanças e costuma refletir antes de agir.</p>";
        echo "<p><strong>Fortalezas:</strong> Empatia, diplomacia, adaptabilidade.</p>";
        echo "<p><strong>Desafios:</strong> Definir limites e priorizar suas próprias necessidades.</p>";
      } else {
        echo "<span class='tag'>SONHADOR INTUITIVO</span>";
        echo "<p>Você é guiado por emoções e ideias abstratas. Possui forte sensibilidade emocional, imaginação ativa e interesse por questões existenciais. 
        Idealista e criativo, tende a buscar propósito e significado em tudo que faz.</p>";
        echo "<p><strong>Fortalezas:</strong> Visão, intuição, empatia, criatividade.</p>";
        echo "<p><strong>Desafios:</strong> Enraizar suas ideias em planos concretos e manter o foco a longo prazo.</p>";
      }
    ?>
      <a href="teste-personalidade.php" class="botao-voltar">← Voltar</a>
  </div>
</body>
</html>
