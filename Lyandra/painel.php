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

// Buscando dados atualizados do usuário no banco (tabela correta: users)
$stmt = $conn->prepare("SELECT email, profile_pic FROM users WHERE email = :email");
$stmt->bindParam(':email', $emailSessao);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC); // <-- Correção aplicada aqui

// Definindo variáveis de exibição
$foto = (!empty($user['profile_pic']) && file_exists('uploads/' . $user['profile_pic']))
    ? 'uploads/' . $user['profile_pic']
    : 'perfil.png';

$email = htmlspecialchars($user['email']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>P.D.V.</title>
  <link rel="stylesheet" href="style.css">
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
  </style>
</head>
<body>
  <header class="header">
    <div class="logo-container">
      <div class="logo-flor">
        <img src="download.png">
      </div>
    </div>

    <a href="login.php" class="botao-voltar">← Voltar</a>

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
      <img src="coelhinho-da-pascoa (1).png" alt="Coelho" class="icone-coelho-menu" id="icone-coelho">
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

  <section class="pag">
    <main class="conteudo">
      <div class="container">
    <img src="download.png" alt="Coração fofo" class="header-img">

    <h1 class="emoji-bounce">💖 Bem-vindo ao seu PDV! 💖</h1>

    <p>Olá! Que alegria ter você por aqui! ✨</p>
    
    <p>Você está prestes a embarcar numa jornada incrível chamada <strong>Projeto de Vida</strong> – o famoso <strong>PDV</strong> 🌈📘</p>

    <p>Esse espaço é só seu! Aqui você pode refletir, sonhar alto, definir metas e descobrir o que te faz brilhar! ✨💭</p>

    <p>O PDV é o seu mapa para o futuro. Ele ajuda você a planejar os passos, entender quem você é e o que quer conquistar no mundo! 🌍🚀</p>

    <p>Lembre-se: cada objetivo é uma sementinha do seu sucesso! 🌱💡</p>

    <a href="painel.php" class="start-button">Começar minha jornada ✨</a>
  </div>
    </main>
  </section>

  <script>
    const botaoMenu = document.getElementById('botao-menu');
    const menu = document.getElementById('menu-navegacao');

    botaoMenu.addEventListener('click', () => {
      botaoMenu.classList.toggle('ativo');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
  </script>
</body>
</html>
