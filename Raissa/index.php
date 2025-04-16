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
      background-image: url('./imgRaissa/flores.jfif'); 
      background-size: cover;
      background-position: center;
      min-height: 100vh;
    }

    /* Ícone Hamburguer */
    .menu-hamburguer {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 30px;
      cursor: pointer;
      z-index: 1000;
      color: white;
      transition: transform 0.4s ease;
    }

    .menu-hamburguer.rotacionado {
      transform: rotate(90deg);
    }

    .menu-lateral {
      position: fixed;
      top: 70px;
      left: 20px;
      background-color: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(8px);
      border-radius: 15px;
      padding: 20px;
      display: none;
      flex-direction: column;
      gap: 15px;
      z-index: 999;
    }

    .menu-lateral a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      background-color: rgba(255, 255, 255, 0.1);
      padding: 10px 15px;
      border-radius: 10px;
      text-align: center;
      transition: background 0.3s;
    }

    .menu-lateral a:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }

    .topo-direita {
      position: absolute;
      top: 30px;
      right: 40px;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .icone-perfil {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      transition: transform 0.2s;
    }
    
/* css do cadastrar*/

    .icone-perfil:hover {
      transform: scale(1.1);
    }

    .icone-perfil img {
      width: 24px;
      height: 24px;
    }

    .btn-acao {
      background-color: #d2b8f4;
      color: white;
      padding: 10px 20px;
      border-radius: 20px;
      border: none;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-acao:hover {
      background-color: #bca0e6;
    }

    .titulo {
      text-align: center;
      color: white;
      margin-top: 80px;
      font-size: 20px;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.4);
    }

    .caixa-central {
      max-width: 600px;
      margin: 40px auto;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      backdrop-filter: blur(10px);
      padding: 30px;
      text-align: center;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    .caixa-central textarea {
      width: 100%;
      height: 100px;
      border: none;
      border-radius: 10px;
      padding: 10px;
      font-family: Georgia, serif;
      resize: none;
      background-color: rgba(255,255,255,0.9);
    }

    /* Modal Perfil */
    .modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .modal-conteudo {
      background: white;
      padding: 30px;
      border-radius: 15px;
      text-align: center;
      width: 300px;
    }

    .modal-conteudo h3 {
      margin-bottom: 20px;
    }

    .modal-conteudo input {
      width: 100%;
      padding: 8px;
      margin: 10px 0;
      border-radius: 10px;
      border: 1px solid #ccc;
    }

    .modal-conteudo button {
      margin-top: 15px;
      padding: 8px 15px;
      background: #d2b8f4;
      border: none;
      border-radius: 10px;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: Georgia, serif;
      background-image: url('imgRaissa/Flower hd 4k wallpaper 1920x1080 laptop desktop wpp_ 🌹.jfif');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: rgba(255, 255, 255, 0.25);
      border-radius: 30px;
      padding: 40px 30px;
      width: 300px;
      text-align: center;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .form-container img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .form-container h2 {
      color: white;
      font-weight: normal;
      margin-bottom: 20px;
    }

    label {
      display: block;
      text-align: left;
      color: white;
      font-weight: bold;
      margin: 10px 0 5px;
    }

    input {
      width: 100%;
      padding: 8px 12px;
      border-radius: 20px;
      border: none;
      outline: none;
      margin-bottom: 10px;
      background-color: rgba(255, 255, 255, 0.5);
      font-weight: bold;
    }

    .btn-cadastro {
      background-color: #d2b8f4;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 25px;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.3s;
    }

    .btn-cadastro:hover {
      background-color: #bca0e6;
    }

    .mensagem {
      margin-top: 15px;
      color: white;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <!-- Ícone do menu hamburguer -->
  <div class="menu-hamburguer" id="hamburguer" onclick="toggleMenu()">☰</div>

  <!-- Menu lateral -->
  <div class="menu-lateral" id="menuLateral">
    <a href="#inicio">INÍCIO</a>
    <a href="#sonho">SONHO</a>
    <a href="#objetivo">OBJETIVO</a>
    <a href="#topicos">TÓPICOS</a>
  </div>

  <!-- Topo com botão e perfil -->
  <div class="topo-direita">
    <div class="icone-perfil" onclick="abrirPerfil()" title="Ver Perfil">
      <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" alt="Perfil">
    </div>
    <button class="btn-acao">Plano de Ação</button>
  </div>


  <?php
// Conexão com o banco
$host = "localhost";
$user = "root";  // Altere se tiver senha
$pass = "";
$db = "site_autoconhecimento";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Erro de conexão: " . $conn->connect_error);
}

// Lógica de cadastro
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $confirmar = $_POST['confirmar'];

  // Verifica se as senhas são iguais
  if ($senha !== $confirmar) {
    $msg = "As senhas não coincidem!";
  } else {
    // Verificando se o e-mail já existe no banco de dados
    $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($emailExistente);
    $stmt->fetch();
    $stmt->close();

    if ($emailExistente > 0) {
      $msg = "Este e-mail já está cadastrado!";
    } else {
      // Criptografando a senha antes de armazená-la
      $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

      // Preparando a consulta para inserir os dados na tabela 'usuarios'
      $stmt = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
      $stmt->bind_param("ss", $email, $senhaHash);

      // Executando a consulta
      if ($stmt->execute()) {
        $msg = "Cadastro realizado com sucesso!";
      } else {
        // Se ocorrer algum erro na execução, exibe a mensagem de erro
        $msg = "Erro: " . $stmt->error;
      }

      $stmt->close();
    }
  }
}

$conn->close();  // Fecha a conexão com o banco de dados
?>







  <!-- Título -->
  <div class="titulo">
    <h1>PROJETO DE VIDA</h1>

    <div class="form-container">
    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="ícone perfil">
    <h2>CADASTRAR</h2>

    <form method="POST" action="">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="•••••@gmail.com" required>

      <label for="senha">Senha:</label>
      <input type="password" name="senha" required>

      <label for="confirmar">Confirme a senha:</label>
      <input type="password" name="confirmar" required>

      <button class="btn-cadastro" type="submit">CADASTRAR</button>

      <p style="color: white; text-align: center; margin-top: 20px;">
        Já tem uma conta? <a href="login.php" style="color: #ffffff; text-decoration: underline;">Entre.</a>
      </p>

   


  <!-- Modal de perfil -->
  <div class="modal" id="modalPerfil">
    <div class="modal-conteudo">
      <h3>Editar Perfil</h3>
      <input type="text" placeholder="Nome do Usuário">
      <input type="email" placeholder="Email">
      <button onclick="fecharPerfil()">Salvar</button>
    </div>
  </div>

  <script>
    function toggleMenu() {
      const menu = document.getElementById('menuLateral');
      const icon = document.getElementById('hamburguer');
      menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
      icon.classList.toggle('rotacionado');
    }

    function abrirPerfil() {
      document.getElementById('modalPerfil').style.display = 'flex';
    }

    function fecharPerfil() {
      document.getElementById('modalPerfil').style.display = 'none';
    }
  </script>
<?php if ($msg): ?>
        <p class="mensagem"><?= $msg ?></p>
      <?php endif; ?>

</body>
</html>
