<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: mbti.php");
    exit;
}

include 'conexao.php'; // Arquivo que conecta ao banco de dados

// Pegando o e-mail da sessão
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

// Processa o resultado do teste
$tipo = "";
$pontuacoes = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respostas = $_POST;
    $pontuacoes = [
        "E" => 0, "I" => 0,
        "S" => 0, "N" => 0,
        "T" => 0, "F" => 0,
        "J" => 0, "P" => 0,
    ];

    foreach ($respostas as $key => $value) {
        list($nivel, $letra) = explode("-", $value);
        if ($letra == "neutral") continue;
        $pontuacoes[$letra] += (int)$nivel;
    }

    $tipo .= ($pontuacoes["E"] >= $pontuacoes["I"]) ? "E" : "I";
    $tipo .= ($pontuacoes["S"] >= $pontuacoes["N"]) ? "S" : "N";
    $tipo .= ($pontuacoes["T"] >= $pontuacoes["F"]) ? "T" : "F";
    $tipo .= ($pontuacoes["J"] >= $pontuacoes["P"]) ? "J" : "P";

    // Salva no banco
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=pdv", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO mbti_results (
          tipo, pontuacao_e, pontuacao_i, pontuacao_s, pontuacao_n,
          pontuacao_t, pontuacao_f, pontuacao_j, pontuacao_p, data_registro
        ) VALUES (
          :tipo, :e, :i, :s, :n, :t, :f, :j, :p, NOW()
        )";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':e', $pontuacoes['E']);
        $stmt->bindParam(':i', $pontuacoes['I']);
        $stmt->bindParam(':s', $pontuacoes['S']);
        $stmt->bindParam(':n', $pontuacoes['N']);
        $stmt->bindParam(':t', $pontuacoes['T']);
        $stmt->bindParam(':f', $pontuacoes['F']);
        $stmt->bindParam(':j', $pontuacoes['J']);
        $stmt->bindParam(':p', $pontuacoes['P']);
        $stmt->execute();

        $mensagem = "<p>Resultado salvo com sucesso!</p>";
    } catch (PDOException $e) {
        $mensagem = "<p>Erro ao salvar: " . $e->getMessage() . "</p>";
    }
}

  $tipo = $_POST['tipo'] ?? '';

  $descricoes_mbti = [
    "ISTJ" => [
        "nome" => "O Realista",
        "descricao" => "Você é prático, responsável e organizado. Gosta de manter a ordem e seguir regras.",
        "imagem" => "./mbti/ISTJ.jpg"
    ],
    "ISFJ" => [
        "nome" => "O Protetor",
        "descricao" => "Você é leal, atencioso e tem um forte senso de dever. Preocupa-se com os outros.",
        "imagem" => "./mbti/ISFJ.jpg"
    ],
    "INFJ" => [
        "nome" => "O Visionário",
        "descricao" => "Idealista, profundo e visionário. Busca um propósito maior em tudo o que faz.",
        "imagem" => "./mbti/INFJ.jpg"
    ],
    "INTJ" => [
        "nome" => "O Estrategista",
        "descricao" => "Você é estrategista, independente e gosta de planejamento a longo prazo.",
        "imagem" => "./mbti/INTJ.jpg"
    ],
    "ISTP" => [
        "nome" => "O Lógico",
        "descricao" => "Analítico e prático, você gosta de resolver problemas de forma lógica.",
        "imagem" => "./mbti/ISTP.jpg"
    ],
    "ISFP" => [
        "nome" => "O Artista",
        "descricao" => "Sensível, gentil e tranquilo. Valoriza a beleza e a harmonia ao seu redor.",
        "imagem" => "./mbti/ISFP.jpg"
    ],
    "INFP" => [
        "nome" => "O Idealista",
        "descricao" => "Você é empático, idealista e valoriza autenticidade e significado.",
        "imagem" => "./mbti/INFP.jpg"
    ],
    "INTP" => [
        "nome" => "O Analista",
        "descricao" => "Curioso e lógico, você adora entender sistemas e conceitos complexos.",
        "imagem" => "./mbti/INTP.jpg"
    ],
    "ESTP" => [
        "nome" => "O Empreendedor",
        "descricao" => "Aventureiro e direto, você vive o momento e gosta de ação.",
        "imagem" => "./mbti/ESTP.jpg"
    ],
    "ESFP" => [
        "nome" => "O Animador",
        "descricao" => "Você é espontâneo, animado e adora aproveitar a vida ao máximo.",
        "imagem" => "./mbti/ESFP.jpg"
    ],
    "ENFP" => [
        "nome" => "O Inspirador",
        "descricao" => "Criativo, entusiástico e sociável. Sempre em busca de novas possibilidades.",
        "imagem" => "./mbti/ENFP.jpg"
    ],
    "ENTP" => [
        "nome" => "O Inovador",
        "descricao" => "Você é inventivo, expressivo e gosta de desafiar ideias estabelecidas.",
        "imagem" => "./mbti/ENTP.jpg"
    ],
    "ESTJ" => [
        "nome" => "O Executivo",
        "descricao" => "Organizado, direto e responsável. Gosta de liderar e fazer as coisas acontecerem.",
        "imagem" => "./mbti/ESTJ.jpg"
    ],
    "ESFJ" => [
        "nome" => "O Cuidador",
        "descricao" => "Sociável, protetor e confiável. Preza pela harmonia nos relacionamentos.",
        "imagem" => "./mbti/ESFJ.jpg"
    ],
    "ENFJ" => [
        "nome" => "O Líder",
        "descricao" => "Líder nato, empático e inspirador. Gosta de ajudar os outros a crescerem.",
        "imagem" => "./mbti/ENFJ.jpg"
    ],
    "ENTJ" => [
        "nome" => "O Comandante",
        "descricao" => "Você é determinado, eficiente e um verdadeiro estrategista nato.",
        "imagem" => "./mbti/ENTJ.jpg"
    ],
  ];
  

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Resultado MBTI</title>
  <link rel="stylesheet" href="css/style.css">
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
</head>
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
        <a href="pagina1.html">Página 1</a>
        <a href="pagina2.html">Página 2</a>
        <a href="pagina3.html">Página 3</a>
      </div>
    </nav>
  </section>

  <br><br><br>

  <div class="container">
    <h1>Resultado do Teste MBTI</h1>

    <?php if (isset($descricoes_mbti[$tipo])): ?>
      <p class="tipo-nome"><?= $tipo ?> - <?= $descricoes_mbti[$tipo]['nome'] ?></p>
      <img src="<?= $descricoes_mbti[$tipo]['imagem'] ?>" alt="Imagem do tipo <?= $tipo ?>">
      <p class="descricao"><?= $descricoes_mbti[$tipo]['descricao'] ?></p>

      <div class="botoes">
        <button class="compartilhar" onclick="compartilharResultado()">Compartilhar</button>
        <button class="refazer" onclick="window.location.href='index.html'">Refazer Teste</button>
      </div>
    <?php else: ?>
      <p>Tipo MBTI não encontrado. Tente novamente.</p>
    <?php endif; ?>
  </div>

  <script>
    function compartilharResultado() {
      const texto = "Descobri que meu tipo MBTI é <?= $tipo ?> - <?= $descricoes_mbti[$tipo]['nome'] ?>! Confira também!";
      if (navigator.share) {
        navigator.share({
          title: "Meu Tipo MBTI",
          text: texto,
          url: window.location.href
        });
      } else {
        alert("Copie e compartilhe:\n" + texto);
      }
    }
  </script>

</body>
</html>
