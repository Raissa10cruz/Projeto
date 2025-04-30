
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
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.botao-voltar:hover {
  background-color: rgba(255, 255, 255, 0.2);
  color: #d9ffd9;
  transform: scale(1.05);
  border-color: rgba(255, 255, 255, 0.3);
}

.botao-voltar:active {
  transform: scale(0.95);
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}


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
