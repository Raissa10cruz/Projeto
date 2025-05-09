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
      font-family: 'Playfair Display', serif;
      color: #333;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 50px 20px;
      gap: 40px;
      flex-wrap: wrap;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(14px);


    }

    h2 {
      width: 100%;
      text-align: center;
      font-size: 28px;
      color: #fff;
      margin-bottom: 30px;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    .pergunta {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      margin: 20px;
      max-width: 900px;
      width: 100%;
    }

    .pergunta strong {
      display: block;
      margin-bottom: 20px;
      font-size: 18px;
      color: #333;
    }

    .likert {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 20px;
    }

    .likert label {
      flex: 1;
      max-width: 160px;
      text-align: center;
      padding: 15px;
      border-radius: 25px;
      background: rgba(255, 255, 255, 0.1);
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      font-size: 14px;
      cursor: pointer;
    }

    .likert label:hover {
      transform: scale(1.05);
    }

    .likert input[type="radio"] {
      display: none;
    }

    .circle {
      display: block;
      margin: auto;
      margin-bottom: 8px;
      border: 2px solid #6A7D5A;
      border-radius: 50%;
      background-color: #fff;
    }

    .maior .circle {
      width: 24px;
      height: 24px;
    }

    .medio .circle {
      width: 18px;
      height: 18px;
    }

    .menor .circle {
      width: 14px;
      height: 14px;
    }

    .likert input[type="radio"]:checked+.circle {
      background-color: #a0c39e;
    }

    .botao-circular-container {
      display: flex;
      justify-content: center;
      margin-top: 45px;
      width: 100%;
    }

    .botao-circular {
      padding: 14px 40px;
      border-radius: 30px;
      background: #a0c39e;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.3);
      text-align: center;
      letter-spacing: 1px;
    }

    .botao-circular:hover {
      background-color: #a0c39e;
      transform: scale(1.05);
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
  <form action="resultado.php" method="POST">
    <div class="container">
      <h2>Descubra Sua Personalidade</h2>
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

      $reflexoes = [
        "Você considera todas as consequências possíveis antes de agir?",
        "Você sente ansiedade por não ter controle sobre o que virá?",
        "Você costuma ser o ombro amigo das pessoas próximas?",
        "Você sente que ainda não atingiu seu verdadeiro potencial?",
        "Você prefere observar o ambiente antes de interagir?",
        "Você sente que conversas rasas o deixam esgotado?",
        "Você enxerga críticas como oportunidades de crescimento?",
        "Você sente propósito ao impactar positivamente alguém?",
        "Você gosta de debater temas abstratos por prazer?",
        "Você revisita suas crenças antigas com frequência?",
        "Você busca estímulo mental em livros ou debates?",
        "Você consegue 'ler' o clima emocional de uma sala?",
        "Você escreve para entender melhor o que sente?",
        "Você recarrega suas energias em momentos de silêncio?",
        "Você termina aquilo que começa, mesmo sem motivação?",
        "Você evita atalhos em nome da profundidade?",
        "Você sente curiosidade em vez de medo diante do novo?",
        "Você controla suas emoções em momentos de crise?",
        "Você sente prazer em contemplar questões existenciais?",
        "Você prefere qualidade a quantidade nas relações?"
      ];

      foreach ($perguntas as $index => $pergunta) {
        echo "<div class='pergunta'>";
        echo "<strong>" . ($index + 1) . ". $pergunta</strong>";
        echo "<em style='display:block; margin-bottom: 15px; color:#555;'>" . $reflexoes[$index] . "</em>";
        echo "<div class='likert'>";
        echo "<label class='menor'><input type='radio' name='q$index' value='1' required><span class='circle'></span>Discordo totalmente</label>";
        echo "<label class='medio'><input type='radio' name='q$index' value='2'><span class='circle'></span>Discordo</label>";
        echo "<label class='maior'><input type='radio' name='q$index' value='3'><span class='circle'></span>Neutro</label>";
        echo "<label class='medio'><input type='radio' name='q$index' value='4'><span class='circle'></span>Concordo</label>";
        echo "<label class='menor'><input type='radio' name='q$index' value='5'><span class='circle'></span>Concordo totalmente</label>";
        echo "</div></div>";
      }
      ?>

      <div class="botao-circular-container">
        <input type="submit" class="botao-circular" value="Pronto">
      </div>
    </div>
  </form>
  <a href="index.php" class="botao-voltar">← Voltar</a>
</body>

</html>

