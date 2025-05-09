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
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=Quicksand:wght@400;600&display=swap"
    rel="stylesheet">
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
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .emoji-bounce {
      font-size: 38px;
      animation: bounce 1.8s infinite;
    }

    @keyframes bounce {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-8px);
      }
    }

    .header-img {
      width: 120px;
      margin-bottom: 20px;
      animation: zoomIn 1.3s ease;
    }

    @keyframes zoomIn {
      from {
        transform: scale(0.7);
        opacity: 0;
      }

      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    h1 {
      font-family: 'Comic Neue', cursive;
      font-size: 36px;
      color: #8e44ad;
      margin-bottom: 10px;
      text-align: center;
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

    .section-fofa {
      background-color: #fff0f5;
      border-radius: 25px;
      max-width: 800px;
      padding: 30px;
      font-family: 'Segoe UI', sans-serif;
    }

    .section-fofa h3 {
      color: #a855f7;
      font-size: 24px;
      margin-bottom: 15px;
      border-bottom: 2px solid #ffc0cb;
      display: inline-block;
      padding-bottom: 5px;
    }

    .section-fofa label {
      font-weight: bold;
      color: #a855f7;
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
    }

    .section-fofa input[type="text"],
    .section-fofa input[type="date"],
    .section-fofa select,
    .section-fofa textarea {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 15px;
      border: 2px solid #ffb6c1;
      border-radius: 15px;
      font-size: 16px;
      background-color: #fff;
      transition: 0.3s;
      box-sizing: border-box;
    }

    .section-fofa input:focus,
    .section-fofa textarea:focus,
    .section-fofa select:focus {
      border-color: #ff69b4;
      box-shadow: 0 0 5px #ff69b4;
      outline: none;
    }

    .section-fofa .dream-section {
      margin-bottom: 30px;
      padding: 20px;
      background-color: #fffafd;
      border: 1px dashed #ffb6c1;
      border-radius: 20px;
    }

    .section-fofa table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .section-fofa table th,
    .section-fofa table td {
      border: 1px solid #ffc0cb;
      padding: 10px;
      text-align: left;
      font-size: 14px;
    }

    .section-fofa table th {
      background-color: #ffe4e1;
      color: #a855f7;
    }

    .section-fofa .submit-btn {
      width: 100%;
      background: linear-gradient(to right, #ff85a2, #ffc0cb);
      color: white;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(255, 105, 180, 0.4);
      transition: 0.3s ease;
    }

    .section-fofa .submit-btn:hover {
      background-color: #ff69b4;
      transform: scale(1.03);
    }




    .section-fofa {
      max-width: 1000px;
      padding: 30px;
      text-align: left;
    }

    .section-title {
      text-align: center;
      font-size: 30px;
      color: #a855f7;
      margin-bottom: 20px;
      border-bottom: 3px solid white;
      display: inline-block;
      padding-bottom: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border: 1px solid #ddd;
      font-size: 1.1em;
    }

    th {
      background-color: #D25050;
      color: white;
      font-weight: bold;
    }

    td {
      background-color: #fff;
      color: #333;
    }

    /* Estilos para as linhas alternadas */
    tbody tr:nth-child(even) {
      background-color: #f4f4f4;
    }

    /* Hover para as linhas */
    tbody tr:hover {
      background-color: #f1f1f1;
    }

    /* Responsividade */
    @media (max-width: 768px) {
      table {
        font-size: 0.9em;
      }

      th,
      td {
        padding: 10px;
      }

      h1 {
        font-size: 2em;
      }
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


    .section-title {
      text-align: center;
      font-size: 32px;
      color: #a855f7;
      margin-bottom: 25px;
      border-bottom: 3px solid #ffb6c1;
      display: inline-block;
      padding-bottom: 8px;
    }

    .fofa-bloco {
      margin-bottom: 30px;
    }

    .fofa-bloco h3 {
      font-size: 22px;
      color: #d946ef;
      margin-bottom: 10px;
    }

    .fofa-bloco p {
      font-size: 16px;
      line-height: 1.6;
      color: #444;
    }

    .fofa-bloco ul {
      margin-top: 10px;
      padding-left: 20px;
    }

    .fofa-bloco ul li {
      margin-bottom: 8px;
      color: #555;
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
        <div class="section-fofa">
          <h1>Planeje Seu Futuro</h1>
          <h2 class="section-title">Como Planejar Seu Futuro</h2>
          <table>
            <thead>
              <tr>
                <th>Área da Vida</th>
                <th>Dica</th>
                <th>Como Colocar em Prática</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Estudos</td>
                <td>Organize uma rotina de estudos com horários definidos.</td>
                <td>Use agenda ou aplicativos para separar horários de leitura, revisão e descanso.</td>
              </tr>
              <tr>
                <td>Profissão</td>
                <td>Descubra suas habilidades e interesses.</td>
                <td>Pesquise profissões, faça testes vocacionais e converse com profissionais da área.</td>
              </tr>
              <tr>
                <td>Saúde</td>
                <td>Criar hábitos saudáveis.</td>
                <td>Pratique exercícios, alimente-se bem e faça exames de rotina.</td>
              </tr>
              <tr>
                <td>Família</td>
                <td>Fortaleça o relacionamento com seus familiares.</td>
                <td>Converse com frequência, participe de momentos juntos e demonstre carinho.</td>
              </tr>
              <tr>
                <td>Amizades</td>
                <td>Mantenha laços com pessoas positivas.</td>
                <td>Envie mensagens, marque encontros e seja presente nas conquistas e dificuldades.</td>
              </tr>
              <tr>
                <td>Finanças</td>
                <td>Aprenda a economizar e planejar gastos.</td>
                <td>Anote seus gastos, evite compras por impulso e crie metas de economia.</td>
              </tr>
              <tr>
                <td>Tempo Livre</td>
                <td>Tenha momentos de lazer e descanso.</td>
                <td>Desconecte-se um pouco do digital e faça coisas que te dão prazer: ler, desenhar, caminhar.</td>
              </tr>
              <tr>
                <td>Autoconhecimento</td>
                <td>Reflita sobre suas emoções, decisões e sonhos.</td>
                <td>Escreva em um diário, faça terapia ou converse com pessoas de confiança.</td>
              </tr>
            </tbody>
          </table>

          <h2 class="section-title">Planejamento de Futuro (Aprender a Fazer)</h2>

          <div class="fofa-bloco">
            <h3>🌟 Minhas Aspirações</h3>
            <p>Reflita sobre o que você deseja para o seu futuro. Quais valores são importantes para você? Que tipo de
              vida quer construir? Aspirações são mais do que sonhos — são direções. Pense em:</p>
            <ul>
              <li>Onde quero morar?</li>
              <li>Que impacto quero causar nas pessoas ao meu redor?</li>
              <li>Como quero me sentir com meu trabalho e minha rotina?</li>
            </ul>
          </div>

          <div class="fofa-bloco">
            <h3>🧸 Meu Sonho de Infância</h3>
            <p>Olhar para o passado nos ajuda a entender quem somos. Qual era seu maior sonho quando criança? O que esse
              sonho revela sobre seus desejos, talentos ou paixões? Nem sempre seguimos os mesmos caminhos, mas entender
              isso ajuda a conectar o presente com sua essência.</p>
          </div>

          <div class="fofa-bloco">
            <h3>💼 Escolha Profissional</h3>
            <p>A escolha profissional deve unir: aquilo que você ama, aquilo que sabe fazer, aquilo que o mundo precisa
              e pelo que você pode ser pago. Explore profissões, investigue possibilidades e descubra:</p>
            <ul>
              <li>O que essa profissão faz no dia a dia?</li>
              <li>Quais áreas de atuação ela oferece?</li>
              <li>Como estão os salários e o mercado?</li>
              <li>Você pode usar sites como o <strong>CBO (Classificação Brasileira de Ocupações)</strong> ou conversar
                com profissionais da área.</li>
            </ul>
          </div>

          <div class="fofa-bloco">
            <h3>🌈 Meus Sonhos Hoje</h3>
            <p>Liste os sonhos que você tem agora. Eles podem ser simples ou grandiosos. Para cada um, pense:</p>
            <ul>
              <li><strong>O que já estou fazendo</strong> para alcançar esse sonho?</li>
              <li><strong>O que ainda preciso fazer</strong> para chegar lá?</li>
            </ul>
            <p>Essa reflexão te ajuda a perceber que muitos passos já estão sendo dados, mesmo sem você perceber.</p>
          </div>

          <div class="fofa-bloco">
            <h3>🎯 Meus Principais Objetivos</h3>
            <p>Defina metas claras para três momentos da sua vida:</p>
            <ul>
              <li><strong>Curto prazo (1 ano):</strong> O que posso conquistar até o ano que vem?</li>
              <li><strong>Médio prazo (3 anos):</strong> Onde quero estar em alguns anos?</li>
              <li><strong>Longo prazo (7 anos):</strong> Qual é o grande plano?</li>
            </ul>
            <p>Use essa estrutura para transformar sonhos em ações reais, passo a passo.</p>
          </div>

          <div class="fofa-bloco">
            <h3>🔮 Como Me Vejo em 10 Anos</h3>
            <p>Feche os olhos por um momento e imagine: como você gostaria que sua vida estivesse daqui a 10 anos?</p>
            <ul>
              <li>Onde você está morando?</li>
              <li>Com quem você convive?</li>
              <li>O que você conquistou?</li>
              <li>Como é sua rotina e como você se sente?</li>
            </ul>
            <p>Escrever sobre isso é uma forma poderosa de traçar um destino, mesmo que ele mude com o tempo.</p>
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