<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <title>Teste de Personalidade</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400&display=swap"
    rel="stylesheet" />
  <style>
    body {
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

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 40px;
      max-width: 900px;
      width: 95%;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
    }

    h2 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 30px;
    }

    .pergunta-container {
      margin-bottom: 25px;
      padding: 20px;
      background:
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

    .opcoes input[type="radio"]:checked+label {
      background-color: #a0c39e;
      border-color: #4b7f53;
      color: #fff;
    }

    .botao-circular-container {
      display: flex;
      justify-content: center;
      margin-top: 45px;
    }

    .botao-circular {
      padding: 14px 40px;
      border-radius: 30px;
      background: #c5dbc1;
      color: #2b2b2b;
      font-size: 16px;
      font-weight: bold;
      border: 2px solid  #4b7f53;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.3);
      text-align: center;
      letter-spacing: 1px;
    }

    .botao-circular:hover {
      background-color: #a9cba5;
      transform: scale(1.05);
      color: white;
    }

    .botao-circular:active {
      transform: scale(0.96);
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }


    .botao-voltar {
      position: absolute;
      top: 20px;
      left: 20px;
      padding: 10px 22px;
      font-size: 14px;
      font-weight: bold;
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 30px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      color: #ffffff;
      cursor: pointer;
      font-style: italic;
      text-decoration: none;
      font-family: 'Raleway', sans-serif;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .botao-voltar:hover {
      background-color: rgba(255, 255, 255, 0.2);
      color: #d9ffd9;
      transform: scale(1.05);
      border-color: rgba(255, 255, 255, 0.3);
    }

    .botao-voltar:active {
      transform: scale(0.95);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
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
      <div class="botao-circular-container">
        <input type="submit" class="botao-circular" value="Pronto">
      </div>
    </form>
  </div>
  <a href="index.php" class="botao-voltar">← Voltar</a>
</body>

</html>