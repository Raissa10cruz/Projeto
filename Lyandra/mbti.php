<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: processa_mbti.php");
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $respostas = $_POST;

  $pontuacoes = [
    "E" => 0,
    "I" => 0,
    "S" => 0,
    "N" => 0,
    "T" => 0,
    "F" => 0,
    "J" => 0,
    "P" => 0,
  ];

  foreach ($respostas as $key => $value) {
    list($nivel, $letra) = explode("-", $value);
    if ($letra == "neutral")
      continue;
    $pontuacoes[$letra] += (int) $nivel;
  }

  echo "<pre><strong>Pontuação final:</strong>\n";
  print_r($pontuacoes);
  echo "</pre>";

  $tipo = "";
  $tipo .= ($pontuacoes["E"] >= $pontuacoes["I"]) ? "E" : "I";
  $tipo .= ($pontuacoes["S"] >= $pontuacoes["N"]) ? "S" : "N";
  $tipo .= ($pontuacoes["T"] >= $pontuacoes["F"]) ? "T" : "F";
  $tipo .= ($pontuacoes["J"] >= $pontuacoes["P"]) ? "J" : "P";

  echo "<p>Seu tipo MBTI é: <strong>$tipo</strong></p>";

  try {
    $pdo = new PDO("mysql:host=localhost;dbname=SEUBANCO", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO mbti_results (tipo, data_registro) VALUES (:tipo, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->execute();

    echo "<p>Resultado salvo no banco com sucesso!</p>";
    echo "<p>ID do registro: " . $pdo->lastInsertId() . "</p>";
  } catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao salvar no banco: " . $e->getMessage() . "</p>";
  }
}

include 'conexao.php';

$userSessao = $_SESSION["user"];
$emailSessao = $userSessao["email"] ?? '';

try {
  $stmt = $conn->prepare("SELECT email, profile_pic FROM users WHERE email = :email");
  $stmt->bindParam(':email', $emailSessao);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $foto = (!empty($user['profile_pic']) && file_exists('uploads/' . $user['profile_pic']))
    ? 'uploads/' . $user['profile_pic']
    : 'perfil.png';

  $email = htmlspecialchars($user['email']);
} catch (PDOException $e) {
  echo "Erro na conexão com o banco de dados: " . $e->getMessage();
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Resultado MBTI</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<style>
  .container {
    background-color: #ffffffcc;
    border-radius: 25px;
    padding: 50px 40px;
    max-width: 750px;
    width: 90%;
    margin: 80px auto;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1.5s ease;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(30px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  h1 {
    font-size: 36px;
    color: #8e44ad;
    margin-bottom: 10px;
  }

  p {
    font-size: 18px;
    color: #333;
  }

  .usuario-logado {
    position: absolute;
    top: 15px;
    right: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .usuario-logado img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
  }

  .usuario-logado span {
    color: #444;
    font-size: 14px;
  }

  .botao-voltar {
    position: absolute;
    top: 15px;
    left: 20px;
    background-color: #fff;
    color: #333;
    padding: 8px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    border: 1px solid #ccc;
  }

  .botao-voltar:hover {
    background-color: #f0f0f0;
  }
</style>

<body>
  <header class="header">
    <div class="logo-container">
      <div class="logo-flor">
        <img src="img/download.png">
      </div>
    </div>

    <a href="painel.php" class="botao-voltar">← Voltar</a>

    <!-- Info do usuário logado -->
    <a class="usuario-logado" href="perfil.php" title="Meu Perfil">
      <img src="<?= $foto ?>" alt="Foto de perfil">
      <span><?= $email ?></span>
    </a>
  </header>

  <section class="hamburguer">
    <div class="menu-hamburguer" id="botao-menu">
      <div class="linha"></div>
      <div class="linha"></div>
      <div class="linha"></div>
      <img src="img/coelho-acordando.gif" alt="Coelho" class="icone-coelho-menu" id="icone-coelho">
    </div>

    <nav class="menu" id="menu-navegacao">
      <div class="quadro-menu">
      <a href="pag3.php">Projeto de Vida</a>
        <a href="pag4.php">Plano de ação</a>
        <a href="pag2.php">Quem sou eu?</a>
      </div>
    </nav>
  </section>

  <div class="container">
    <h1>Teste MBTI</h1>
    <div class="info">
      Para um resultado mais preciso, evite marcar a opção <strong>neutro</strong>. Responda com sinceridade!
    </div>

    <form action="processa_mbti.php" method="POST">
      <?php
      $perguntas = [
        ["texto" => "Você se sente energizado após interações sociais?", "letra" => "E"],
        ["texto" => "Você prefere refletir antes de agir?", "letra" => "I"],
        ["texto" => "Você gosta de estar no centro das atenções?", "letra" => "E"],
        ["texto" => "Você se sente cansado após eventos sociais longos?", "letra" => "I"],
        ["texto" => "Você se comunica com facilidade com estranhos?", "letra" => "E"],
        ["texto" => "Você prefere conversar em grupo do que em encontros individuais?", "letra" => "E"],
        ["texto" => "Você precisa de tempo sozinho para recarregar as energias?", "letra" => "I"],
        ["texto" => "Você se sente à vontade ao iniciar conversas com desconhecidos?", "letra" => "E"],


        ["texto" => "Você confia mais em ideias do que em fatos concretos?", "letra" => "N"],
        ["texto" => "Você é detalhista em suas observações?", "letra" => "S"],
        ["texto" => "Você prefere pensar no futuro do que no presente?", "letra" => "N"],
        ["texto" => "Você presta atenção a detalhes visuais?", "letra" => "S"],
        ["texto" => "Você gosta de explorar possibilidades?", "letra" => "N"],
        ["texto" => "Você confia no que pode ver e tocar ao tomar decisões?", "letra" => "S"],
        ["texto" => "Você costuma pensar em possibilidades que ainda não existem?", "letra" => "N"],
        ["texto" => "Você prefere instruções práticas a teorias abstratas?", "letra" => "S"],


        ["texto" => "Você considera os sentimentos dos outros ao tomar decisões?", "letra" => "F"],
        ["texto" => "Você baseia decisões em lógica objetiva?", "letra" => "T"],
        ["texto" => "Você evita confrontos para manter a harmonia?", "letra" => "F"],
        ["texto" => "Você analisa os prós e contras antes de decidir?", "letra" => "T"],
        ["texto" => "Você se emociona facilmente com histórias?", "letra" => "F"],
        ["texto" => "Você acredita que a justiça deve prevalecer sobre os sentimentos?", "letra" => "T"],
        ["texto" => "Você se preocupa em como suas decisões afetam os outros emocionalmente?", "letra" => "F"],
        ["texto" => "Você tende a confortar alguém antes de resolver o problema?", "letra" => "F"],


        ["texto" => "Você prefere planejar do que improvisar?", "letra" => "J"],
        ["texto" => "Você lida bem com mudanças inesperadas?", "letra" => "P"],
        ["texto" => "Você gosta de cumprir prazos rigorosamente?", "letra" => "J"],
        ["texto" => "Você prefere manter as opções em aberto?", "letra" => "P"],
        ["texto" => "Você se sente satisfeito ao concluir tarefas?", "letra" => "J"],
        ["texto" => "Você prefere seguir uma rotina do que ser espontâneo?", "letra" => "J"],
        ["texto" => "Você costuma deixar decisões importantes para o último momento?", "letra" => "P"],
        ["texto" => "Você se sente mais confortável com planos do que com improvisações?", "letra" => "J"],
      ];

      foreach ($perguntas as $index => $p) {
        $texto = $p["texto"];
        $letra = $p["letra"];
    
        // Substituir os valores para -2 a +2 conforme a escala
        $opcoes = [
            -2 => ["texto" => "Discordo totalmente", "classe" => "maior"],
            -1 => ["texto" => "Discordo", "classe" => "medio"],
             0 => ["texto" => "Neutro", "classe" => "menor"],
             1 => ["texto" => "Concordo", "classe" => "medio"],
             2 => ["texto" => "Concordo totalmente", "classe" => "maior"]
        ];
    
        echo '<div class="pergunta">';
        echo "<p>{$texto}</p>";
        echo '<div class="likert">';
    
        foreach ($opcoes as $valor => $opcao) {
            echo '<label class="' . $opcao["classe"] . '">';
            echo '<input type="radio" name="respostas[' . $index . ']" value="' . $valor . '-' . $letra . '">';
            echo '<span class="circle"></span>';
            echo $opcao["texto"];
            echo '</label>';
        }
    
        echo '</div>';
        echo '</div>';
    }
    
      ?>

      <div style="text-align: center; margin-top: 30px;">
        <button type="submit"
          style="padding: 12px 30px; font-size: 16px; background-color: #D25050; color: white; border: none; border-radius: 12px; cursor: pointer;">
          Ver meu Tipo MBTI
        </button>
      </div>
    </form>
  </div>
</body>

</html>