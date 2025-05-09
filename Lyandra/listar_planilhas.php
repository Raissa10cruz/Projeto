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
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Meus Projetos</title>
  <link rel="stylesheet" href="css/style.css">
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

    .form-fofa {
  border-radius: 5%;
  background-color:rgb(255, 255, 255);
  max-width: 500px;
  margin: 40px auto;
  padding: 20px;
  text-align: center;
}

.form-fofa h2 {
  font-size: 30px;
  color: #a855f7;
  margin-bottom: 10px;
  border-bottom: 3px solid white;
  display: inline-block;
  padding-bottom: 5px;
}

.form-fofa input[type="text"],
.form-fofa textarea {
  width: 100%;
  padding: 12px 15px;
  margin: 15px 0;
  border: 2px solid #ffb6c1;
  border-radius: 20px;
  font-size: 16px;
  resize: vertical;
  background-color: #fff;
  transition: 0.3s ease;
  box-sizing: border-box;
}

.form-fofa input[type="text"]:focus,
.form-fofa textarea:focus {
  border-color: #ff69b4;
  box-shadow: 0 0 5px #ff69b4;
  outline: none;
}

.form-fofa button {
  width: 100%;
  background: linear-gradient(to right, #ff85a2, #ffc0cb);
  color: white;
  padding: 12px;
  margin-top: 10px;
  font-size: 16px;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(255, 105, 180, 0.4);
  transition: 0.3s ease;
}

.form-fofa button:hover {
  background-color: #ff69b4;
  transform: scale(1.03);
}

</style>
<header class="header">
    <div class="logo-container">
      <div class="logo-flor">
        <img src="img/download.png">
      </div>
    </div>

    <a href="projetos.php" class="botao-voltar">← Voltar</a>

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
  <?php
$stmt = $conn->prepare("SELECT * FROM planilhas WHERE email_usuario = :email ORDER BY data_criacao DESC");
$stmt->bindParam(':email', $emailSessao);
$stmt->execute();
$planilhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="form-fofa">
  <h2>Minhas Planilhas</h2>
  <?php if ($planilhas): ?>
    <ul style="list-style-type: none; padding: 0;">
      <?php foreach ($planilhas as $p): ?>
        <li style="margin-bottom: 20px; border: 1px solid #ffb6c1; border-radius: 15px; padding: 15px;">
          <strong><?= htmlspecialchars($p['titulo']) ?></strong><br>
          <small><?= date('d/m/Y H:i', strtotime($p['data_criacao'])) ?></small><br><br>
          <a href="editar_planilha.php?id=<?= $p['id'] ?>" style="color: #a855f7; text-decoration: none; font-weight: bold;">Editar</a> |
          <a href="listar_planilhas.php" class="excluir-link" data-id="<?= $p['id'] ?>" style="color: #ff69b4; text-decoration: none; font-weight: bold;">Excluir</a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Você ainda não criou nenhuma planilha.</p>
  <?php endif; ?>
</div>


  <script>
document.querySelectorAll('.excluir-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        const id = this.dataset.id;
        if (confirm("Tem certeza que deseja excluir?")) {
            fetch('excluir_planilha.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + encodeURIComponent(id)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Remove o item da lista
                    this.closest('li').remove();
                } else {
                    alert('Erro ao excluir: ' + (data.message || 'Tente novamente'));
                }
            })
            .catch(() => alert('Erro na requisição'));
        }
    });
});


const botaoMenu = document.getElementById("botao-menu");
const menu = document.getElementById("menu-navegacao");

botaoMenu.addEventListener("click", () => {
    botaoMenu.classList.toggle("active");
    menu.classList.toggle("active");
});

  </script>
  
</body>
</html>
