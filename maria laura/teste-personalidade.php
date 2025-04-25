<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Teste de Personalidade</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Playfair Display", serif;
      background: url('img/imagem.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      color: #fff;
    }
    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 40px;
      max-width: 900px;
      width: 95%;
      box-shadow: 0 0 30px rgba(0,0,0,0.4);
    }
    h2 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 30px;
    }
    .pergunta-container {
      margin-bottom: 25px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }
    .pergunta-container:hover {
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
    }
    .pergunta-container strong {
      display: block;
      margin-bottom: 12px;
      font-size: 18px;
      font-weight: 600;
    }
    .opcoes {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
    }
    .opcoes label {
      display: inline-flex;
      align-items: center;
      background-color: #c5dbc1;
      padding: 10px 20px;
      border-radius: 30px;
      font-size: 14px;
      font-weight: 600;
      color: #2b2b2b;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }
    .opcoes input[type="radio"] {
      display: none;
    }
    .opcoes label:hover {
      background-color: #b3caae;
      transform: translateY(-2px);
    }
    .opcoes input[type="radio"]:checked + label {
      background-color: #a0c39e;
      border-color: #4b7f53;
      color: #fff;
    }
    input[type="submit"] {
      width: 100%;
      background-color: #c5dbc1;
      border: none;
      padding: 14px;
      font-size: 16px;
      border-radius: 30px;
      font-weight: bold;
      margin-top: 30px;
      color: #2b2b2b;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    input[type="submit"]:hover {
      background-color: #b3caae;
      transform: translateY(-2px);
    }
    /* Estilizando o botão "Voltar" no canto superior esquerdo */
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
  <div class="container">
    <h2>Descubra Sua Personalidade</h2>
    <form action="resultado.php" method="POST">
      <?php
        $perguntas = [
          "Você reflete profundamente antes de tomar decisões importantes?",
          "Você costuma pensar mais no futuro do que no presente?",
          "Você se sente confortável lidando com emoções intensas dos outros?",
          "Você sente necessidade constante de autoaperfeiçoamento?",
          "Você se considera mais observador do que comunicativo?",
          "Você evita superficialidades em conversas e relacionamentos?",
          "Você lida bem com críticas construtivas?",
          "Você se sente realizado ao ajudar outras pessoas?",
          "Você gosta de explorar ideias abstratas e complexas?",
          "Você frequentemente questiona suas próprias crenças?",
          "Você se sente motivado por desafios intelectuais?",
          "Você consegue identificar emoções alheias com facilidade?",
          "Você mantém um diário, escreve ou reflete com frequência sobre si?",
          "Você prefere ambientes calmos e introspectivos?",
          "Você é do tipo que termina projetos pessoais com persistência?",
          "Você tende a desconfiar de soluções fáceis ou rápidas?",
          "Você se sente confortável com o desconhecido?",
          "Você consegue manter a calma mesmo em situações de tensão?",
          "Você tem interesse por filosofia, psicologia ou espiritualidade?",
          "Você prefere um pequeno grupo de amigos íntimos à socialização ampla?"
        ];

        foreach ($perguntas as $index => $pergunta) {
          echo "<div class='pergunta-container'>";
          echo "<strong>" . ($index + 1) . ". $pergunta</strong>";
          echo "<div class='opcoes'>";
          echo "<input type='radio' id='q{$index}_1' name='q$index' value='1' required><label for='q{$index}_1'>Discordo totalmente</label>";
          echo "<input type='radio' id='q{$index}_2' name='q$index' value='2'><label for='q{$index}_2'>Discordo</label>";
          echo "<input type='radio' id='q{$index}_3' name='q$index' value='3'><label for='q{$index}_3'>Neutro</label>";
          echo "<input type='radio' id='q{$index}_4' name='q$index' value='4'><label for='q{$index}_4'>Concordo</label>";
          echo "<input type='radio' id='q{$index}_5' name='q$index' value='5'><label for='q{$index}_5'>Concordo totalmente</label>";
          echo "</div></div>";
        }
      ?>
      <input type="submit" value="Ver Resultado">
    </form>
  </div>
  <a href="index.php" class="botao-voltar">← Voltar</a>
</body>
</html>
