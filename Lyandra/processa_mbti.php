<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: mbti.php");
    exit;
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
    echo "Erro: " . $e->getMessage();
    exit;
}

// Processar respostas
$tipo = "";
$pontuacoes = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $respostas = $_POST;
    $pontuacoes = [
        "E" => 0, "I" => 0,
        "S" => 0, "N" => 0,
        "T" => 0, "F" => 0,
        "J" => 0, "P" => 0,
    ];

    foreach ($_POST['respostas'] as $resposta) {
      if (strpos($resposta, '-') !== false) {
          list($valor, $letra) = explode('-', $resposta);
  
          // Garante que a letra é válida
          if (isset($pontuacoes[$letra])) {
              $pontuacoes[$letra] += (int)$valor;
          }
      }
  }
  
    // Determinar o tipo MBTI com maior diferença
    $tipo .= ($pontuacoes["E"] > $pontuacoes["I"]) ? "E" : "I";
    $tipo .= ($pontuacoes["S"] > $pontuacoes["N"]) ? "S" : "N";
    $tipo .= ($pontuacoes["T"] > $pontuacoes["F"]) ? "T" : "F";
    $tipo .= ($pontuacoes["J"] > $pontuacoes["P"]) ? "J" : "P";

    $_SESSION['tipo'] = $tipo;
    try {
        $stmt = $conn->prepare("INSERT INTO mbti_results (
            tipo, pontuacao_e, pontuacao_i, pontuacao_s, pontuacao_n,
            pontuacao_t, pontuacao_f, pontuacao_j, pontuacao_p, data_registro
        ) VALUES (
            :tipo, :e, :i, :s, :n, :t, :f, :j, :p, NOW()
        )");

        $stmt->execute([
            ':tipo' => $tipo,
            ':e' => $pontuacoes['E'],
            ':i' => $pontuacoes['I'],
            ':s' => $pontuacoes['S'],
            ':n' => $pontuacoes['N'],
            ':t' => $pontuacoes['T'],
            ':f' => $pontuacoes['F'],
            ':j' => $pontuacoes['J'],
            ':p' => $pontuacoes['P'],
        ]);
    } catch (PDOException $e) {
        echo "Erro ao salvar no banco: " . $e->getMessage();
    }
}


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

    .cute-button-container {
  position: relative;
  display: inline-block;
}

.cute-button {
  background: #ffd4da;
  color: #d25050;
  border: none;
  padding: 12px 24px;
  font-size: 16px;
  font-weight: bold;
  border-radius: 30px;
  box-shadow: 0 4px 12px rgba(210, 80, 80, 0.2);
  cursor: pointer;
  position: relative;
  overflow: hidden;
}

.floating-icon {
  position: absolute;
  font-size: 14px;
  opacity: 0;
  animation: floatUp 2s ease-out forwards;
}

@keyframes floatUp {
  0% {
    transform: translateY(0);
    opacity: 1;
  }
  100% {
    transform: translateY(-60px);
    opacity: 0;
  }
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
<?php
  include 'descricao_tipo_mbti.php'; 
  $dados = $descricoes_mbti[$_SESSION['tipo']];?>
  <div class="container">
    <h1>Resultado do Teste MBTI</h1>

    <?php if ($dados): ;?>
        <h1><?= $dados["nome"] ?> (<?= $tipo ?>)</h1>
        <p><?= $dados["descricao"] ?></p>
        <img src="<?= $dados["imagem"] ?>" alt="Tipo <?= $tipo ?>" style="max-width: 300px;">

        <div class="cute-button-container">
  <div class="cute-button-container">
  <button onclick="redirecionarParaTeste()" class="cute-button">Refazer o Teste</button>
</div>
    <?php else: ?>
        <p>Resultado não encontrado. Tente novamente.</p>
    <?php endif; ?>
</div>

<script>
function redirecionarParaTeste() {
  const container = document.querySelectorAll('.cute-button-container')[1]; // segundo botão
  const emojis = ['🐰', '❤️'];
  const total = 10;

  for (let i = 0; i < total; i++) {
    const span = document.createElement('span');
    span.classList.add('floating-icon');
    span.textContent = emojis[Math.floor(Math.random() * emojis.length)];
    span.style.left = `${Math.random() * 100}%`;
    span.style.top = `-10px`;
    span.style.fontSize = `${Math.random() * 10 + 12}px`;
    container.appendChild(span);
    setTimeout(() => span.remove(), 2000);
  }

  // Aguarda 600ms para redirecionar após começar os efeitos
  setTimeout(() => {
    window.location.href = "mbti.php";
  }, 600);
}
</script>



</body>
</html>
