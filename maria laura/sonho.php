<?php
session_start();

$foto = 'default.png';
$email = '';

if (isset($_SESSION['usuario_id'])) {
    try {
        $conn = new PDO('mysql:host=localhost;dbname=sistema_cadastro;charset=utf8', 'root', '');
        $stmt = $conn->prepare("SELECT email, foto_perfil FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $_SESSION['usuario_id']]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            if (!empty($resultado['foto_perfil'])) {
                $foto = $resultado['foto_perfil'];
            }
            $email = $resultado['email'];
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Mim</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&family=Raleway:wght@400;700&family=Shadows+Into+Light&display=swap"
        rel="stylesheet">
    <style>
        /* Adicionando o CSS do Menu Hambúrguer */
        #menu-toggle {
            display: none;
        }

        .menu-icon {
            position: absolute;
            top: 25px;
            left: 25px;
            width: 35px;
            height: 25px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1100;
        }

        .menu-icon span {
            height: 4px;
            background: white;
            border-radius: 2px;
            transition: 0.4s ease;
        }

        #menu-toggle:checked + .menu-icon span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        #menu-toggle:checked + .menu-icon span:nth-child(2) {
            opacity: 0;
        }

        #menu-toggle:checked + .menu-icon span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }
        .side-menu {
            position: fixed;
            top: 0;
            left: -250px;
            width: 200px;
            height: 100%;
            background-color:  #98A38F;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.4);
            padding-top: 100px;
            padding-left: 30px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            transition: left 0.4s ease;
            z-index: 1000;
        }

        .side-menu a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .side-menu a:hover {
            color: #98A38F;
        }

        #menu-toggle:checked ~ .side-menu {
            left: 0;
        }

        /* Fim do CSS do menu hambúrguer */
        
        body {
            margin: 0;
            font-family: "Playfair Display", serif;
            font-style: italic;
            background-color: #CDD5C6;
        }

        header {
            background-image: url('img/imagem.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: left;
            padding: 100px 20px;
            position: relative;
        }

        nav {
            position: absolute;
            top: 10px;
            left: 20px;
            right: 20px;
            display: flex;
            align-items: ;
            color: white;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        nav a:hover {
            color: rgb(173, 180, 168);
            transform: scale(1.1);
        }

      
        .perfil-container {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1001;
        }

        .perfil-link {
            display: inline-block;
            width: 45px;
            height: 45px;
            overflow: hidden;
            border-radius: 50%;
            border: 2px solid white;
            transition: transform 0.3s ease;
        }

        .perfil-link:hover {
            transform: scale(1.1);
        }

        .perfil-foto {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .perfil-email {
            font-size: 14px;
            color: white;
            font-weight: bold;
        }

        .header-text {
            text-align: left;
        }

        .header-text h1 {
            font-size: 3em;
            font-family: 'Fleur De Leah', cursive;
            margin: 0;
        }

        .conteudo {
            padding: 40px 200px;
        }

        .container {
            text-align: left;
        }

        .bloco1,
        .bloco2,
        .bloco3 {
            background: #98A38F;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 0px;
            display: inline-block;
            width: 600px;
        }

        .bloco1,
        .bloco3 {
            float: left;
            clear: both;
        }

        .bloco2 {
            float: right;
            clear: both;
        }

        h2 {
            color: rgb(0, 0, 0);
        }

        p {
            font-size: 1.1em;
            line-height: 1.6;
            color: white;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
            color: white;
        }

        ul li {
            margin-bottom: 10px;
            color: white;
        }

        .imagens-direita {
            position: absolute;
            top: 420px;
            right: 60px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .imagens-direita img {
            height: 90px;
        }

        .imagens-esquerda {
            position: absolute;
            top: 420px;
            left: 60px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .imagens-esquerda img {
            height: 90px;
        }
    </style>
</head>

<body>
    <!-- Menu Hambúrguer -->
    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <nav class="side-menu">
        <a href="index.php">Início</a>
        <a href="objetivo.php">Objetivos</a>
        <a href="plano.php">Plano de Ação</a>
    </nav>
    <!-- Fim Menu Hambúrguer -->

    <header>
        <div class="perfil-container">
            <span class="perfil-email"><?= htmlspecialchars($email) ?></span>
            <a href="perfil.php" class="perfil-link">
                <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Perfil" class="perfil-foto">
            </a>
        </div>
       

<div class="header-text">
            <h1>Meus Sonhos</h1>
            <p>"Os sonhos são as estrelas que iluminam o 
                <br>caminho da alma—siga-os com coragem, e eles
                <br> te levarão além do impossível."
            </p>
        </div>
    </header>

    <div class="imagens-direita">
        <img src="img/psychology.png" alt="Psicologia">
    </div>
    <div class="imagens-esquerda">
        <img src="img/psiquiatria.png" alt="Medicina">
    </div>

    <div class="bloco1" style="margin: 40px 200px;">
        <h2>Meu Sonho </h2>
        <p>Tenho um Sonho em me forma em psicologia e psiquiatria </p>
        <ul>
            <h2>Para cada sonho:</h2>
            <li><strong>
                    O que já estou fazendo:</strong> Estudando muito para passar na faculdade e correndo atrás para
                conseguir minha casa .</li>
            <li><strong>O que ainda preciso fazer:</strong> Trabalhar bastante e ser menos dependente das pessoas da
                minha familia .</li>
        </ul>
    </div>

    <main class="conteudo">
        <div class="bloco2">
            <h2>Meus Principais Objetivos</h2>
            <h3>Objetivos de Curto Prazo (1 ano)</h3>
            <ul>
                <li>Estar na faculdade de Psicologia ou Medicina.</li>
                <li>Começar a planejar minha casa.</li>
                <li>Ter uma rotina de estudos organizada.</li>
                <li>Desenvolver hábitos saudáveis para manter equilíbrio emocional e físico.</li>
                <li>Economizar dinheiro para futuras necessidades.</li>
                <li>Criar um cronograma de estudos eficiente para maximizar aprendizado.</li>
            </ul>

            <h3>Objetivos de Médio Prazo (3 anos)</h3>
            <ul>
                <li>Estar terminando a faculdade.</li>
                <li>Ter um planejamento financeiro sólido e uma reserva de emergência.</li>
                <li>Estar trabalhando na área e adquirindo experiência.</li>
                <li>Ter minha casa bem estruturada e decorada do jeito que quero.</li>
                <li>Construir uma rede de contatos profissionais para oportunidades futuras.</li>
            </ul>

            <h3>Objetivos de Longo Prazo (7 anos)</h3>
            <ul>
                <li>Estar formada e atuando na minha área.</li>
                <li>Ter uma carreira consolidada e bem-sucedida.</li>
                <li>Ser mãe e construir minha família.</li>
                <li>Se ainda não tiver feito, iniciar a especialização em Psiquiatria.</li>
                <li>Se já estiver formada em Psicologia, ingressar na faculdade de Medicina.</li>
                <li>Viajar para conhecer diferentes abordagens na minha área de atuação.</li>
            </ul>
        </div>

        <div class="bloco3">
            <h2>Minha Visão para os Próximos 10 Anos</h2>
            <p>Daqui a 10 anos, me imagino como uma profissional realizada, formada em Psicologia e Medicina, atuando na
                área de Psiquiatria. Quero estar bem-sucedida, com minha própria casa, financeiramente estável e com
                minha família constituída. Meu sonho é poder ajudar pessoas com minha profissão, trazendo impacto
                positivo para a sociedade.
                <br>
                <br>
                Se tudo der certo, conseguirei fazer Medicina primeiro e seguir diretamente para a especialização em
                Psiquiatria.
                Caso o caminho seja pela Psicologia primeiro, ainda assim estarei determinada a continuar e alcançar meu
                objetivo final.
                <br>
                <br>
                Além disso, quero ter uma vida equilibrada, aproveitando momentos com minha família e amigos, mantendo
                minha saúde física e mental em dia. Visualizo um futuro onde eu esteja feliz com minhas conquistas e
                sempre buscando crescimento pessoal e profissional. Quero também me envolver em projetos sociais para
                ajudar pessoas com dificuldades emocionais e mentais, contribuindo para uma sociedade mais saudável.</p>
        </div>
    </main>
</body>

</html>