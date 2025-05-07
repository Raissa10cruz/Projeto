<?php
$inteligencias = [
  'Linguística' => 0,
  'Lógico-Matemática' => 0,
  'Espacial' => 0,
  'Musical' => 0,
  'Corporal-Cinestésica' => 0,
  'Interpessoal' => 0,
  'Intrapessoal' => 0,
  'Naturalista' => 0
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($_POST as $key => $valor) {
    // Espera-se valor no formato "5:Linguística"
    list($peso, $tipo) = explode(':', $valor);
    if (isset($inteligencias[$tipo])) {
      $inteligencias[$tipo] += (int)$peso;
    }
  }

  arsort($inteligencias);
  $principal = array_key_first($inteligencias);
  session_start();
  $_SESSION['inteligencias'] = $inteligencias;
  $_SESSION['principal'] = $principal;
  header("Location: resultados2.php");
  exit();
}
?>


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Teste de Múltiplas Inteligências</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
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

    .pergunta-container {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      margin: 20px;
      max-width: 900px;
      width: 100%;
    }

    .pergunta-container strong {
      display: block;
      margin-bottom: 20px;
      font-size: 18px;
      color: #333;
    }

    .opcoes {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 20px;
    }

    .opcoes label {
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
      color: #fff;
    }

    .opcoes label:hover {
      transform: scale(1.05);
    }

    .opcoes input[type="radio"] {
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

    .opcoes input[type="radio"]:checked+label {
      background-color: #a0c39e;
      color: #2b2b2b;
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

</style>
</head>

<body>
  <form method="POST">
    <div class="container">
      <h2>Teste de Múltiplas Inteligências</h2>

      <?php
      $perguntas = [
        "Gosto de brincar com as palavras, escrever textos e explorar diferentes formas de linguagem." => "Linguística",
        "Me sinto desafiado e animado ao resolver problemas complexos ou fazer cálculos mentais." => "Lógico-Matemática",
        "Costumo visualizar mentalmente objetos, lugares ou caminhos com facilidade." => "Espacial",
        "Sinto grande conexão com a música, prestando atenção aos detalhes sonoros como ritmo e melodia." => "Musical",
        "Aprendo melhor quando uso meu corpo, como ao praticar esportes, atuar ou construir algo." => "Corporal-Cinestésica",
        "Tenho facilidade em compreender e me comunicar com diferentes tipos de pessoas." => "Interpessoal",
        "Costumo refletir sobre minhas emoções, motivações e objetivos pessoais com frequência." => "Intrapessoal",
        "Sinto paz e curiosidade quando estou em ambientes naturais, como florestas, parques ou jardins." => "Naturalista",
        "Gosto de ler, contar histórias ou me expressar por meio de textos escritos." => "Linguística",
        "Geralmente encontro padrões e soluções em situações que envolvem lógica e estratégia." => "Lógico-Matemática",
        "Consigo imaginar como objetos se encaixam ou funcionam mesmo sem vê-los fisicamente." => "Espacial",
        "Identifico notas, instrumentos e padrões sonoros com facilidade ao ouvir música." => "Musical",
        "Sinto necessidade de movimentar meu corpo regularmente, mesmo em atividades do dia a dia." => "Corporal-Cinestésica",
        "Percebo com facilidade quando alguém está triste, desconfortável ou precisa de ajuda." => "Interpessoal",
        "Tenho facilidade em perceber meus pontos fortes e fracos, e procuro crescer com isso." => "Intrapessoal",
        "Tenho interesse em fenômenos naturais, como clima, ecossistemas ou comportamento animal." => "Naturalista",
        "Gosto de aprender novos idiomas ou explorar expressões culturais através da linguagem." => "Linguística",
        "Me sinto confortável resolvendo charadas, desafios matemáticos ou jogos de lógica." => "Lógico-Matemática",
        "Organizar espaços ou criar mapas mentais me ajuda a entender melhor o mundo ao meu redor." => "Espacial",
        "A música influencia fortemente meu humor e minha concentração." => "Musical",
        "Sinto que meu corpo precisa participar do meu processo de aprendizado, seja escrevendo, caminhando ou praticando algo." => "Corporal-Cinestésica",
        "Tenho facilidade para liderar grupos, ouvir opiniões e ajudar a resolver conflitos." => "Interpessoal",
        "Geralmente entendo o que estou sentindo e consigo explicar isso de forma clara." => "Intrapessoal",
        "Observar o comportamento dos animais ou o ciclo das plantas me desperta curiosidade e admiração." => "Naturalista"
      ];


      $i = 0;
      foreach ($perguntas as $texto => $tipo) {
        echo "<div class='pergunta-container'>
             <strong>" . ($i + 1) . ". $texto</strong>
             <div class='opcoes'>
               <input type='radio' name='q$i' id='q{$i}_1' value='5:$tipo' required>
               <label for='q{$i}_1'>Concordo totalmente</label>
   
               <input type='radio' name='q$i' id='q{$i}_2' value='4:$tipo'>
               <label for='q{$i}_2'>Concordo</label>
   
               <input type='radio' name='q$i' id='q{$i}_3' value='3:$tipo'>
               <label for='q{$i}_3'>Neutro</label>
   
               <input type='radio' name='q$i' id='q{$i}_4' value='2:$tipo'>
               <label for='q{$i}_4'>Discordo</label>
   
               <input type='radio' name='q$i' id='q{$i}_5' value='1:$tipo'>
               <label for='q{$i}_5'>Discordo totalmente</label>
             </div>
           </div>";
        $i++;
      }
      ?>


      <div class="botao-circular-container">
        <button type="submit" class="botao-circular">Ver Resultado</button>
      </div>
    </div>
  </form>
  <a href="index.php" class="botao-voltar">← Voltar</a>
</body>

</html>