
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
    if (isset($inteligencias[$valor])) {
      $inteligencias[$valor]++;
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

    .opcoes input[type="radio"]:checked + label {
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
        "Prefiro escrever histórias ou poemas." => "Linguística",
        "Gosto de resolver quebra-cabeças lógicos." => "Lógico-Matemática",
        "Tenho facilidade em desenhar ou imaginar objetos em 3D." => "Espacial",
        "Sou sensível a sons e ritmos musicais." => "Musical",
        "Aprendo melhor com atividades físicas." => "Corporal-Cinestésica",
        "Entendo bem os sentimentos dos outros." => "Interpessoal",
        "Tenho um forte conhecimento de mim mesmo." => "Intrapessoal",
        "Gosto de estar em contato com a natureza." => "Naturalista",
        "Consigo explicar bem minhas ideias." => "Linguística",
        "Sou bom em matemática ou lógica." => "Lógico-Matemática",
        "Consigo montar objetos com facilidade." => "Espacial",
        "Toco ou gostaria de tocar um instrumento." => "Musical",
        "Tenho boa coordenação motora." => "Corporal-Cinestésica",
        "Consigo fazer amigos facilmente." => "Interpessoal",
        "Refletir sobre meus sentimentos é natural para mim." => "Intrapessoal",
        "Presto atenção em animais e plantas." => "Naturalista",
        // Perguntas adicionais
        "Tenho facilidade em aprender novas línguas." => "Linguística",
        "Eu consigo ver padrões em números e sequências." => "Lógico-Matemática",
        "Sinto prazer em organizar meu espaço." => "Espacial",
        "Consigo reconhecer facilmente os diferentes tons musicais." => "Musical",
        "Sinto que preciso me expressar fisicamente, seja dançando ou praticando esportes." => "Corporal-Cinestésica",
        "Me sinto confortável em ambientes com outras pessoas e interajo facilmente." => "Interpessoal",
        "Gosto de refletir sobre minhas emoções e pensamentos internos." => "Intrapessoal",
        "Adoro observar animais em seu ambiente natural." => "Naturalista"
      ];

      $i = 0;
      foreach ($perguntas as $texto => $tipo) {
        echo "<div class='pergunta-container'>
                <strong>" . ($i + 1) . ". $texto</strong>
                <div class='opcoes'>
                  <input type='radio' name='q$i' id='q{$i}_1' value='$tipo' required>
                  <label for='q{$i}_1'>Sim</label>

                  <input type='radio' name='q$i' id='q{$i}_2' value=''>
                  <label for='q{$i}_2'>Não</label>
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
