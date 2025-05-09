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

<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php'; // Conexão com o banco

// Pegando o e-mail da sessão
$userSessao = $_SESSION["user"];
$emailSessao = $userSessao["email"] ?? '';

try {
    // Buscando dados atualizados do usuário no banco (tabela correta: users)
    $stmt = $conn->prepare("SELECT email, profile_pic FROM users WHERE email = :email");
    $stmt->bindParam(':email', $emailSessao);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Definindo variáveis de exibição
    $foto = (!empty($user['profile_pic']) && file_exists('uploads/' . $user['profile_pic']))
        ? 'uploads/' . $user['profile_pic']
        : 'perfil.png';

    $email = htmlspecialchars($user['email']);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    exit;
}







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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painéis de Autoconhecimento</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <style>


    .usuario-logado {
      position: absolute;
      top: 15px;
      right: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
    }

    .usuario-logado img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid white;
    }

    .usuario-logado span {
      color: white;
      font-size: 14px;
    }

    .usuario-logado:hover {
      opacity: 0.8;
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

    .container {
      background-color: #ffffffcc;
      border-radius: 25px;
      padding: 50px 40px;
      max-width: 750px;
      width: 90%;
      position: center;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1.5s ease;
      margin: 0 auto;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .emoji-bounce {
      font-size: 38px;
      animation: bounce 1.8s infinite;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }

    .header-img {
      width: 120px;
      margin-bottom: 20px;
      animation: zoomIn 1.3s ease;
    }

    @keyframes zoomIn {
      from { transform: scale(0.7); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    h1 {
      font-family: 'Comic Neue', cursive;
      font-size: 36px;
      color: #8e44ad;
      margin-bottom: 10px;
    }

    p {
      font-size: 18px;
      line-height: 1.6;
      color: #333;
      margin-bottom: 15px;
    }

    .start-button {
      background: linear-gradient(90deg, #ff9ff3, #c56cf0);
      color: white;
      border: none;
      padding: 14px 28px;
      font-size: 16px;
      border-radius: 30px;
      cursor: pointer;
      margin-top: 20px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .start-button:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .pergunta {
      margin-bottom: 15px;
    }
    .botoes button {
      margin-right: 10px;
      padding: 5px 10px;
    }
    #resultado {
      display: none;
      margin-top: 30px;
    }
    canvas {
      max-width: 100%;
    }
  </style>
</head>
<body>
<header class="header">
    <div class="logo-container">
      <div class="logo-flor">
        <img src="img/download.png">
      </div>
    </div>

    <a href="pag1.php" class="botao-voltar">← Voltar</a>

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

  <br><br><br>

  <div class="container">
  <h1>Teste de Inteligências Múltiplas</h1>

  <form method="POST" action="">
  <?php
 $perguntas = [
  // Lógico-Matemática
  ['texto' => 'Gosto de resolver quebra-cabeças.', 'tipo' => 'Lógico-Matemática'],
  ['texto' => 'Tenho facilidade com operações matemáticas.', 'tipo' => 'Lógico-Matemática'],
  ['texto' => 'Consigo identificar padrões facilmente.', 'tipo' => 'Lógico-Matemática'],
  ['texto' => 'Gosto de desafios que envolvem lógica.', 'tipo' => 'Lógico-Matemática'],
  ['texto' => 'Sinto-me confortável com problemas numéricos.', 'tipo' => 'Lógico-Matemática'],

  // Linguística
  ['texto' => 'Costumo escrever bem.', 'tipo' => 'Linguística'],
  ['texto' => 'Gosto de ler livros e escrever textos.', 'tipo' => 'Linguística'],
  ['texto' => 'Aprendo melhor ouvindo e falando.', 'tipo' => 'Linguística'],
  ['texto' => 'Tenho vocabulário amplo.', 'tipo' => 'Linguística'],
  ['texto' => 'Gosto de contar histórias ou apresentar ideias.', 'tipo' => 'Linguística'],

  // Espacial
  ['texto' => 'Tenho boa noção de espaço e direção.', 'tipo' => 'Espacial'],
  ['texto' => 'Gosto de desenhar, pintar ou criar mapas.', 'tipo' => 'Espacial'],
  ['texto' => 'Consigo imaginar objetos em 3D com facilidade.', 'tipo' => 'Espacial'],
  ['texto' => 'Sou bom com quebra-cabeças visuais.', 'tipo' => 'Espacial'],
  ['texto' => 'Tenho facilidade para interpretar gráficos e diagramas.', 'tipo' => 'Espacial'],

  // Musical
  ['texto' => 'Tenho facilidade para perceber ritmos e melodias.', 'tipo' => 'Musical'],
  ['texto' => 'Gosto de cantar ou tocar instrumentos musicais.', 'tipo' => 'Musical'],
  ['texto' => 'Aprendo melhor com músicas ou batidas.', 'tipo' => 'Musical'],
  ['texto' => 'Costumo lembrar de músicas com facilidade.', 'tipo' => 'Musical'],
  ['texto' => 'Consigo identificar sons e tons com precisão.', 'tipo' => 'Musical'],

  // Corporal-Cinestésica
  ['texto' => 'Gosto de praticar esportes ou dançar.', 'tipo' => 'Corporal-Cinestésica'],
  ['texto' => 'Aprendo melhor fazendo, com atividades físicas.', 'tipo' => 'Corporal-Cinestésica'],
  ['texto' => 'Tenho boa coordenação motora.', 'tipo' => 'Corporal-Cinestésica'],
  ['texto' => 'Gosto de construir ou montar coisas.', 'tipo' => 'Corporal-Cinestésica'],
  ['texto' => 'Sou ativo e prefiro atividades práticas.', 'tipo' => 'Corporal-Cinestésica'],

  // Interpessoal
  ['texto' => 'Sou bom em entender as emoções dos outros.', 'tipo' => 'Interpessoal'],
  ['texto' => 'Trabalho bem em grupo.', 'tipo' => 'Interpessoal'],
  ['texto' => 'As pessoas costumam me procurar para conversar.', 'tipo' => 'Interpessoal'],
  ['texto' => 'Tenho facilidade para liderar.', 'tipo' => 'Interpessoal'],
  ['texto' => 'Consigo fazer amigos facilmente.', 'tipo' => 'Interpessoal'],

  // Intrapessoal
  ['texto' => 'Tenho facilidade para entender meus sentimentos.', 'tipo' => 'Intrapessoal'],
  ['texto' => 'Prefiro estudar ou trabalhar sozinho.', 'tipo' => 'Intrapessoal'],
  ['texto' => 'Tenho metas bem definidas para minha vida.', 'tipo' => 'Intrapessoal'],
  ['texto' => 'Costumo refletir sobre meus erros e acertos.', 'tipo' => 'Intrapessoal'],
  ['texto' => 'Consigo manter o foco nos meus objetivos.', 'tipo' => 'Intrapessoal'],

  // Naturalista
  ['texto' => 'Gosto de estar em contato com a natureza.', 'tipo' => 'Naturalista'],
  ['texto' => 'Tenho interesse por animais e plantas.', 'tipo' => 'Naturalista'],
  ['texto' => 'Presto atenção às mudanças no ambiente.', 'tipo' => 'Naturalista'],
  ['texto' => 'Gosto de aprender sobre ecossistemas e meio ambiente.', 'tipo' => 'Naturalista'],
  ['texto' => 'Sinto-me conectado com o mundo natural.', 'tipo' => 'Naturalista'],
];

  foreach ($perguntas as $index => $pergunta) {
    echo "<div class='pergunta'>";
    echo "<p><strong>" . ($index + 1) . ".</strong> " . htmlspecialchars($pergunta['texto']) . "</p>";
    echo "<label><input type='radio' name='resposta$index' value='" . $pergunta['tipo'] . "' required> Concordo</label> ";
    echo "<label><input type='radio' name='resposta$index' value='-' required> Discordo</label>";
    echo "</div>";
  }
  ?>
  <br>
  <button type="submit" class="start-button">Ver Resultado</button>
</form>

<script>

  renderizarPerguntas();
const botaoMenu = document.getElementById("botao-menu");
const menu = document.getElementById("menu-navegacao");

botaoMenu.addEventListener("click", () => {
    botaoMenu.classList.toggle("active");
    menu.classList.toggle("active");
});

  </script>
</body>
</html>

