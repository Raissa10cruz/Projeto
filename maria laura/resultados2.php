<?php
session_start();

if (!isset($_SESSION['inteligencias'])) {
  header("Location: index.php"); // Se o usuário tentar acessar sem realizar o teste
  exit();
}

$inteligencias = $_SESSION['inteligencias'];
$principal = $_SESSION['principal'];

$explicacoes = [
  'Linguística' => "A inteligência linguística é a habilidade de usar palavras de forma eficaz, tanto ao falar quanto ao escrever. Pessoas com essa inteligência se destacam na leitura, escrita e oratória.",
  'Lógico-Matemática' => "A inteligência lógico-matemática envolve a capacidade de analisar problemas de maneira lógica, realizar operações matemáticas e investigar questões científicas.",
  'Espacial' => "A inteligência espacial refere-se à capacidade de pensar em três dimensões. As pessoas com essa inteligência são boas em visualizar, criar e manipular imagens mentais.",
  'Musical' => "A inteligência musical está relacionada à habilidade de perceber, discriminar, transformar e expressar formas musicais. Pessoas com essa inteligência têm boa percepção de ritmo, melodia e timbre.",
  'Corporal-Cinestésica' => "A inteligência corporal-cinestésica envolve a capacidade de usar o corpo para resolver problemas ou criar produtos. Atletas e dançarinos costumam possuir essa inteligência.",
  'Interpessoal' => "A inteligência interpessoal diz respeito à habilidade de entender e interagir efetivamente com outras pessoas. Pessoas com essa inteligência têm empatia e sabem lidar bem com diferentes situações sociais.",
  'Intrapessoal' => "A inteligência intrapessoal é a capacidade de compreender e gerenciar os próprios sentimentos, motivações e comportamentos. Indivíduos com essa inteligência possuem grande autoconhecimento.",
  'Naturalista' => "A inteligência naturalista está relacionada à habilidade de reconhecer e categorizar elementos do mundo natural. Pessoas com essa inteligência possuem afinidade com a natureza e os seres vivos."
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Resultado do Teste de Múltiplas Inteligências</title>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet">
  <style>
  body {
      font-family: 'Raleway', sans-serif;
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
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(14px);
      border-radius: 20px;
      padding: 40px;
      max-width: 900px;
      width: 95%;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.45);
    }

    h2 {
      text-align: center;
      font-size: 30px;
      margin-bottom: 30px;
    }

    .pergunta-container {
      margin-bottom: 25px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
    }

    .pergunta-container strong {
      display: block;
      margin-bottom: 10px;
      font-size: 18px;
    }

    .opcoes label {
      background-color: #dbffe3;
      padding: 10px 20px;
      border-radius: 30px;
      margin-right: 10px;
      cursor: pointer;
      color: #2b2b2b;
    }

    .botao-circular-container {
      text-align: center;
      margin-top: 40px;
    }

    .botao-circular {
      padding: 14px 40px;
      border-radius: 30px;
      background: #c5dbc1;
      color: #2b2b2b;
      font-weight: bold;
      cursor: pointer;
      border: 2px solid #4b7f53;
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.3);
    }

    .resultado {
      margin-top: 30px;
      text-align: center;
      font-size: 22px;
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 15px;
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
  <div class="container">
    <h2>Resultado do Teste</h2>
    <div class="resultado">
      <h3>Sua inteligência dominante é: <span style="color: #dfffe0;"><?= $principal ?></span></h3>
      <p><?= $explicacoes[$principal] ?></p>

      <h4>Outras inteligências:</h4>
      <ul>
        <?php foreach ($inteligencias as $tipo => $pontuacao): ?>
          <li><strong><?= $tipo ?>:</strong> <?= $pontuacao ?> pontos</li>
        <?php endforeach; ?>
      </ul>
    </div>


    <a href="teste-multiplhas.php" class="voltar">← Refazer o teste</a>
    </div>
  </div>
</body>
</html>
