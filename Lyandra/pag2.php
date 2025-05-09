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
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 25px;
    }

    .bloco {
      background-color: #fef2f8;
      border: 2px solid #fbcfe8;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(248, 187, 208, 0.3);
    }

    .bloco h3 {
      font-size: 20px;
      color: #d946ef;
      margin-bottom: 10px;
    }

    .bloco p, .bloco ul {
      font-size: 16px;
      color: #444;
      line-height: 1.6;
    }

    .bloco ul {
      padding-left: 20px;
    }

    .tag-list span {
      background-color: #f3e8ff;
      padding: 5px 12px;
      margin: 5px;
      display: inline-block;
      border-radius: 20px;
      color: #7c3aed;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .grid {
        grid-template-columns: 1fr;
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
    <h2>🌸 Quem Sou Eu? – Por Lyandra Camille</h2>

<div class="grid">
  <div class="bloco">
    <h3>🙋‍♀️ Dados Pessoais</h3>
    <p><strong>Nome:</strong> Lyandra Camille da Silva Cruz<br>
    <strong>Idade:</strong> 17 anos<br>
    <strong>Local:</strong> Paraguaçu Paulista – SP<br>
    <strong>Escolaridade:</strong> 3º ano do Ensino Médio + Curso Técnico em Desenvolvimento de Sistemas</p>
  </div>

  <div class="bloco">
    <h3>📝 Fale Sobre Você</h3>
    <p>Sou uma jovem curiosa, criativa e cheia de vontade de entender o mundo e as pessoas. Tenho muitos interesses e estou em uma fase de descobertas, mas com os pés firmes nos meus sonhos. Acredito no poder de crescer, mudar e me reinventar conforme aprendo mais sobre mim.</p>
  </div>

  <div class="bloco">
    <h3>🎠 Minhas Lembranças</h3>
    <p>Lembro das brincadeiras de infância, dos momentos sonhando acordada com o futuro. Desde pequena, tive fascínio por entender o comportamento das pessoas, criar coisas novas, e imaginar mundos diferentes.</p>
  </div>

  <div class="bloco">
    <h3>💪 Pontos Fortes</h3>
    <ul>
      <li>Empatia</li>
      <li>Facilidade com tecnologia</li>
      <li>Curiosidade intelectual</li>
      <li>Criatividade</li>
    </ul>
  </div>

  <div class="bloco">
    <h3>🔧 Pontos a Melhorar</h3>
    <ul>
      <li>Insegurança com decisões difíceis</li>
      <li>Procrastinação em tarefas rotineiras</li>
      <li>Medo de falhar em escolhas importantes</li>
    </ul>
  </div>

  <div class="bloco">
    <h3>💖 Meus Valores</h3>
    <div class="tag-list">
      <span>Autenticidade</span>
      <span>Respeito</span>
      <span>Liberdade</span>
      <span>Aprendizado</span>
      <span>Empatia</span>
      <span>Justiça</span>
    </div>
  </div>

  <div class="bloco">
    <h3>🎓 Minhas Principais Aptidões</h3>
    <ul>
      <li>Observação de comportamentos</li>
      <li>Expressão criativa (design e arte)</li>
      <li>Interesse por ciência, história e línguas</li>
    </ul>
  </div>

  <div class="bloco">
    <h3>👥 Meus Relacionamentos</h3>
    <p><strong>Família:</strong> Base de apoio e inspiração emocional.<br>
    <strong>Amigos:</strong> Trocas sinceras, acolhimento e diversão.<br>
    <strong>Escola:</strong> Espaço de crescimento e desafios.<br>
    <strong>Sociedade:</strong> Um campo vasto de aprendizado e impacto futuro.</p>
  </div>

  <div class="bloco">
    <h3>⏳ Meu Dia a Dia</h3>
    <p><strong>Gosto de:</strong> Ler, ouvir música, aprender coisas novas, explorar design e comportamento humano.<br>
    <strong>Não gosto de:</strong> Superficialidade, rotina sem propósito, desorganização.<br>
    <strong>Rotina:</strong> Estudo no ensino médio e curso técnico, momentos de lazer com criatividade e reflexão.<br>
    <strong>Lazer:</strong> Criar, explorar, imaginar, assistir conteúdos sobre ciência e cultura.</p>
  </div>

  <div class="bloco">
    <h3>🏫 Minha Vida Escolar</h3>
    <p>Durante os anos escolares, desenvolvi minha consciência sobre as escolhas futuras. O curso técnico em Desenvolvimento de Sistemas trouxe habilidades novas e abriu portas, mesmo que meu sonho principal esteja na Psicologia. A escola é um espaço onde posso experimentar, errar e crescer.</p>
  </div>

  <div class="bloco">
    <h3>🔍 Minha Visão Sobre Mim</h3>
    <ul>
      <li><strong>Física:</strong> Cuido do meu corpo com carinho e atenção.</li>
      <li><strong>Intelectual:</strong> Tenho sede de aprender e descobrir.</li>
      <li><strong>Emocional:</strong> Sou sensível, intensa e em constante evolução emocional.</li>
    </ul>
  </div>

  <div class="bloco">
    <h3>👁 A Visão das Pessoas Sobre Mim</h3>
    <p><strong>Amigos:</strong> Criativa, confiável, engraçada.<br>
    <strong>Família:</strong> Carinhosa, sonhadora, inteligente.<br>
    <strong>Professores:</strong> Interessada, dedicada, cheia de potencial.</p>
  </div>
</div>
  <div class="bloco">
    <h3>🌟 Autovalorização</h3>
    <p>Reconhecer minhas conquistas, mesmo pequenas, me ajuda a construir autoestima. Saber que estou no caminho certo, mesmo com dúvidas, é parte da jornada.</p>
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
