<?php
session_start();

if (!isset($_SESSION['inteligencias']) || !isset($_SESSION['principal'])) {
  header("Location: index.php");
  exit();
}

$inteligencias = $_SESSION['inteligencias'];
$principal = $_SESSION['principal'];

$descricoes = [
  'Linguística' => 'Você se destaca na comunicação verbal e escrita. Provavelmente gosta de ler, escrever, contar histórias e aprender idiomas.',
  'Lógico-Matemática' => 'Você possui raciocínio lógico afiado, gosta de resolver problemas, analisar padrões e lidar com números.',
  'Espacial' => 'Sua força está em visualizar formas e espaços. Tem facilidade para arte, design, mapas ou construções mentais.',
  'Musical' => 'Você tem sensibilidade auditiva apurada e gosta de música, sons, ritmos e melodias.',
  'Corporal-Cinestésica' => 'Você aprende melhor com o movimento e o uso do corpo. Possui habilidades físicas e coordenação.',
  'Interpessoal' => 'Você compreende bem os outros e se comunica com facilidade. Trabalha bem em grupo e entende as emoções alheias.',
  'Intrapessoal' => 'Você tem autoconhecimento, entende seus sentimentos, motivações e sabe trabalhar bem sozinho.',
  'Naturalista' => 'Você se conecta com a natureza, gosta de observar animais, plantas e fenômenos naturais.'
];

// Calcula o total de pontos (protege contra divisão por zero)
$totalPontos = array_sum($inteligencias);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Resultado do Teste</title>
  <style>
    body {
      font-family: 'Playfair Display', serif;
      margin: 0;
      padding: 0;
      background: url('img/imagem.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
    }

    .container {
      max-width: 900px;
      margin: 50px auto;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(14px);
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    h1, h2 {
      text-align: center;
      margin-bottom: 30px;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
    }

    .inteligencia {
      margin-bottom: 20px;
    }

    .barra {
      height: 24px;
      border-radius: 12px;
      background-color: rgba(255, 255, 255, 0.2);
      margin-top: 6px;
    }

    .preenchimento {
      height: 100%;
      background-color: #a0c39e;
      border-radius: 12px;
      text-align: right;
      padding-right: 10px;
      font-weight: bold;
      color: #2b2b2b;
    }

    .descricao {
      margin-top: 30px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.12);
      border-radius: 14px;
      font-size: 16px;
      line-height: 1.6;
    }

    .botao-voltar {
      display: inline-block;
      margin-top: 30px;
      padding: 12px 28px;
      font-size: 15px;
      font-weight: bold;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 30px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      color: #ffffff;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .botao-voltar:hover {
      background-color: rgba(255, 255, 255, 0.2);
      transform: scale(1.05);
      color: #d9ffd9;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Resultado do Teste</h1>
    <h2>Sua principal inteligência: <strong><?= htmlspecialchars($principal) ?></strong></h2>

    <?php foreach ($inteligencias as $tipo => $valor): 
      $percentual = ($totalPontos > 0) ? round(($valor / $totalPontos) * 100) : 0;
    ?>
      <div class="inteligencia">
        <strong><?= htmlspecialchars($tipo) ?> - <?= $percentual ?>%</strong>
        <div class="barra">
          <div class="preenchimento" style="width: <?= $percentual ?>%;"><?= $percentual ?>%</div>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="descricao">
      <strong><?= htmlspecialchars($principal) ?>:</strong>
      <?= $descricoes[$principal] ?? 'Descrição não disponível.' ?>
    </div>

    <div style="text-align: center;">
      <a href="teste-multiplas.php" class="botao-voltar">← Refazer Teste</a>
    </div>
  </div>
</body>
</html>
