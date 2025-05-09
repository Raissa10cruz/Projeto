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
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>P.D.V.</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
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

    .blocos {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
    }

    .bloco {
      background-color: #fff;
      padding: 20px;
      border-left: 6px solid  #ff9ff3;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
      flex: 1 1 calc(48% - 30px);
      min-width: 280px;
    }

    ul {
      padding-left: 20px;
      margin-top: 10px;
    }

    ul li {
      margin-bottom: 8px;
    }

    @media (max-width: 768px) {
      .bloco {
        flex: 1 1 100%;
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

  <section class="pag">
    <main class="conteudo">
      <div class="container">
        <div class="Coracao">
    <img src="img/download.png" alt="Coração fofo" class="header-img">
  </div>
  <h1>🌟 Projeto de Vida: Construindo um Caminho Significativo</h1>
    <p><strong>O que é um Projeto de Vida?</strong><br>
      Um Projeto de Vida é um processo contínuo de planejamento e reflexão sobre os objetivos pessoais, profissionais e sociais. Ele visa criar um caminho para a realização de sonhos e a busca por uma vida mais plena e significativa. Envolve definir metas, identificar recursos, criar um plano de ação e manter o foco na busca por esses objetivos.
    </p>

    <h2>🧭 Componentes Essenciais do Projeto de Vida</h2>

    <div class="blocos">
      <div class="bloco">
        <h3>1. Autoconhecimento</h3>
        <p>Compreender quem você é, suas paixões, habilidades, valores e limitações. Este é o alicerce para definir metas alinhadas com sua essência.</p>
      </div>

      <div class="bloco">
        <h3>2. Definição de Metas</h3>
        <p>Estabelecer objetivos claros e alcançáveis em diversas áreas da vida, como educação, carreira, relacionamentos e saúde.</p>
        <p><strong>Utilize a metodologia SMART:</strong></p>
        <ul>
          <li><strong>Específicas:</strong> Claras e bem definidas.</li>
          <li><strong>Mensuráveis:</strong> Quantificáveis para acompanhar o progresso.</li>
          <li><strong>Alcançáveis:</strong> Realistas e possíveis de serem atingidas.</li>
          <li><strong>Relevantes:</strong> Significativas e alinhadas com seus valores.</li>
          <li><strong>Temporais:</strong> Com prazos definidos para conclusão.</li>
        </ul>
      </div>

      <div class="bloco">
        <h3>3. Planejamento de Ações</h3>
        <p>Desenvolver um plano detalhado com as etapas necessárias para alcançar cada meta, identificando recursos, prazos e possíveis obstáculos.</p>
      </div>

      <div class="bloco">
        <h3>4. Avaliação e Ajustes</h3>
        <p>Periodicamente, revisar o progresso, refletir sobre os aprendizados e realizar ajustes no plano conforme necessário.</p>
      </div>
    </div>

</div>


    
  </div>
    </main>
  </section>

  <script>
const botaoMenu = document.getElementById("botao-menu");
const menu = document.getElementById("menu-navegacao");

botaoMenu.addEventListener("click", () => {
    botaoMenu.classList.toggle("active");
    menu.classList.toggle("active");
});

  </script>
</body>
</html>
