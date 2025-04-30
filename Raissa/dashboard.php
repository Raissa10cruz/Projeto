<?php
session_start();

// Redirecionar se não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: cadastra.php");
    exit();
}

// Conectar ao banco
$host = "localhost";
$user = "root";
$pass = "";
$db = "site_autoconhecimento";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT nome, email, imagem_perfil FROM usuarios WHERE id = :id");

    $stmt->bindParam(':id', $_SESSION['usuario_id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Projeto de Vida</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Georgia, serif;
      background: url('./imgRaissa/flores.jfif') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }

    .menu-toggle {
      position: absolute;
      top: 20px;
      left: 20px;
      width: 40px;
      height: 40px;
      background-color: rgba(255, 255, 255, 0.4);
      border-radius: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease;
      z-index: 1001;
    }

    .menu-toggle.rotated {
      transform: rotate(90deg);
    }

    .menu-toggle span {
      display: block;
      width: 22px;
      height: 2px;
      background-color: #fff;
      position: relative;
    }

    .menu-toggle span::before,
    .menu-toggle span::after {
      content: '';
      position: absolute;
      width: 22px;
      height: 2px;
      background-color: #fff;
      transition: 0.3s;
    }

    .menu-toggle span::before {
      top: -6px;
    }

    .menu-toggle span::after {
      top: 6px;
    }

    .menu {
      position: fixed;
      top: 80px;
      left: -220px;
      background-color: rgba(255, 255, 255, 0.25);
      border-radius: 15px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 15px;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 180px;
      transition: left 0.4s ease;
      z-index: 1000;
    }

    .menu.show {
      left: 20px;
    }

    .menu a {
      text-decoration: none;
      color: white;
      font-weight: bold;
      border-bottom: 1px solid white;
      padding-bottom: 5px;
      transition: 0.3s;
    }

    .menu a:hover {
      color: #f0e6ff;
    }

    .header {
      text-align: center;
      margin-top: 40px;
      font-size: 30px;
      color: white;
      font-weight: bold;
      text-shadow: 1px 1px 5px #000;
    }

    .top-bar {
      position: absolute;
      top: 20px;
      right: 20px;
      display: flex;
      align-items: center;
      gap: 20px;
      z-index: 1002;
    }

    .avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }

    .profile-info {
      color: white;
      font-weight: bold;
      font-size: 14px;
      text-align: right;
      max-width: 180px;
    }

    .profile-info a {
      color: #d2b8f4;
      text-decoration: underline;
      font-weight: normal;
    }

    .btn-acao {
      background-color: #d2b8f4;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 20px;
      padding: 10px 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-acao:hover {
      background-color: #c09cf3;
    }
 
    
    .btn-acao:hover {
      background-color: #c09cf3;
    }

    .btn-logout {
  background-color: #f36c6c;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 20px;
  padding: 10px 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: 0.3s;
}

.btn-logout:hover {
  background-color: #e15050;
}

.btn-logout {
  background-color: #f36c6c;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 20px;
  padding: 10px 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: 0.3s;
}

.btn-logout:hover {
  background-color: #e15050;
}

.icon-logout {
  width: 20px;
  height: 20px;
}

    

    .content {
      max-width: 700px;
      margin: 180px auto 40px;
      background-color: rgba(255, 255, 255, 0.25);
      padding: 30px 40px;
      border-radius: 30px;
      text-align: center;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      color: #333;
      font-size: 18px;
      line-height: 1.6;
    }
    .btn-avatar {
  background: none;
  border: none;
  padding: 0;
  cursor: pointer;
}

.avatar-img {
  width: 40px;
  height: 40px;
  border-radius: 50%; /* deixa a imagem redonda */
  object-fit: cover;  /* garante que a imagem se encaixe perfeitamente */
  border: 2px solid #ccc; /* opcional: borda ao redor do avatar */
}

  </style>
</head>
<body>

  <!-- Menu Hamburguer -->
  <div class="menu-toggle" onclick="toggleMenu()">
    <span></span>
  </div>

  <!-- Menu Lateral -->
  <div class="menu" id="menuLateral">
    <a href="#">INÍCIO</a>
    <a href="sonho.php">SONHO</a>
    <a href="objetivo.php">OBJETIVO</a>
    <a href="topicos.php">TÓPICOS</a>
    <a href="quemsoueu.php">QUEM SOU EU?</a>
  </div>

  <!-- Título -->
  <div class="header">PROJETO DE VIDA</div>

  <!-- Topo com Perfil + Botões -->
  <div class="top-bar">
  <div class="profile-info">
    <?= htmlspecialchars($user['nome']) ?><br>
    <?= htmlspecialchars($user['email']) ?><br>
  </div>

  <?php
    // Caminho padrão
    $avatarPadrao = './imgRaissa/User_Clipart_PNG_Images__User_Avatar_Login_Interface_Abstract_Purple_User_Icon__Avatar__User__Login_Avatar_PNG_Image_For_Free_Download-removebg-preview.png';
    
    // Caminho da imagem de perfil (se existir)
    $caminhoImagem = isset($user['imagem_perfil']) && !empty($user['imagem_perfil']) 
        ? './imgRaissa/' . htmlspecialchars($user['imagem_perfil']) 
        : $avatarPadrao;
  ?>

  <button class="btn-avatar" onclick="location.href='editar_perfil.php'">
    <img src="<?= $caminhoImagem ?>" alt="Avatar" class="avatar-img">
  </button>

  <button class="btn-acao" onclick="location.href='plano_acao.php'">Plano de Ação</button>
  <button class="btn-logout" onclick="location.href='logout.php'">
  <svg xmlns="http://www.w3.org/2000/svg" class="icon-logout" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
    <polyline points="16 17 21 12 16 7" />
    <line x1="21" y1="12" x2="9" y2="12" />
  </svg>
  
</button>
</div>


  <!-- Conteúdo -->
  <div class="content">
    <h2>Bem-vindo ao Meu Projeto de Vida!</h2>
    <p>
      Aqui, compartilho meus sonhos, metas e aprendizados ao longo da minha jornada.
      <br><br>
      Este espaço é dedicado ao crescimento pessoal, planejamento e motivação para alcançar objetivos, sejam eles profissionais, acadêmicos ou pessoais.
      <br><br>
      Acompanhe minha evolução, descubra dicas valiosas e inspire-se para construir o seu próprio caminho rumo ao sucesso!
    </p>
  </div>

  <script>
    function toggleMenu() {
      const menu = document.getElementById('menuLateral');
      const toggle = document.querySelector('.menu-toggle');
      menu.classList.toggle('show');
      toggle.classList.toggle('rotated');
    }
  </script>
</body>
</html>
