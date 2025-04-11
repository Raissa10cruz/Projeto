<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php'; // Conexão com o banco

// Pegando o e-mail da sessão
$user = $_SESSION["user"];
$email = $user["email"] ?? '';

// Buscando dados atualizados do usuário no banco (tabela correta: users)
$stmt = $conn->prepare("SELECT email, profile_pic FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Definindo variáveis de exibição
$foto = (!empty($user['profile_pic']) && file_exists('uploads/' . $user['profile_pic']))
    ? 'uploads/' . $user['profile_pic']
    : 'img/perfil_padrao.png';

$email = htmlspecialchars($user['email']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>P.D.V.</title>
  <link rel="stylesheet" href="style.css">
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
      opacity: 0.8;}

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
      <div class="caixa-texto">
        <p>
          Um P.D.V. (Projeto de Vida) é um planejamento pessoal que ajuda uma pessoa a definir objetivos...
        </p>
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
