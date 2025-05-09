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

        /* NOVO bloco das imagens fora da área de conteúdo */
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

        #menu-toggle:checked+.menu-icon span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        #menu-toggle:checked+.menu-icon span:nth-child(2) {
            opacity: 0;
        }

        #menu-toggle:checked+.menu-icon span:nth-child(3) {
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

        #menu-toggle:checked~.side-menu {
            left: 0;
        }
    </style>
</head>

<body>

    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
    </label>


    <nav class="side-menu">
        <a href="index.php">Início</a>
        <a href="sonho.php">Sonhos</a>
        <a href="objetivo.php">Objetivos</a>
        <a href="plano.php">Plano de Ação</a>
    </nav>

    <header>
        <nav>
            <div class="perfil-container">
                <span class="perfil-email"><?= htmlspecialchars($email) ?></span>
                <a href="perfil.php" class="perfil-link">
                    <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Perfil" class="perfil-foto">
                </a>
            </div>
        </nav>
        <div class="header-text">
            <h1>Quem sou Eu? </h1>
            <p>"Sou alguém em constante evolução, aprendendo com cada desafio e transformando obstáculos em
                <br>
                oportunidades. Minha força está na minha resiliência, e meu brilho vem da minha autenticidade.💭✨🌱

            </p>
        </div>
    </header>

    <div class="imagens-direita">
        <img src="img/psychology.png" alt="Psicologia">
    </div>

    <main class="conteudo">

        <div class="bloco1">
            <h2>Dados Pessoais</h2>
            <p>Nome: Maria Laura de Souza Silva<br>
                Data de Nascimento: 08/02/2008<br>
                Idade: 17 anos<br>
                Signo: Aquário</p>
        </div>

        <div class="bloco2">
            <h2>Fale sobre você</h2>
            <p>Sou uma pessoa amorosa, sensível e apaixonada pelo que faço. Meu coração está na psicologia e na
                psiquiatria, pois sempre tive o desejo de entender a mente humana e ajudar as pessoas a encontrarem
                equilíbrio e bem-estar. Embora meu sonho não seja fazer medicina, sei que preciso seguir esse caminho
                para alcançar minha verdadeira vocação.</p>
        </div>

        <div class="bloco3">
            <h2>Minhas Lembranças</h2>
            <p>Tenho muitas lembranças especiais com minha família e meu namorado. São momentos que me fazem sentir
                amada e fortalecem quem sou. Cada risada, cada conversa e cada abraço me trazem felicidade e me lembram
                da importância das pessoas que amo na minha vida.</p>

            <h2>Pontos Fortes e Pontos Fracos</h2>
            <p><strong>Pontos Fortes:</strong> Amorosidade, tenho empatia, dedicação, curiosidade intelectual,
                determinação e Eu também canto</p>
            <p><strong>Pontos Fracos:</strong> Insegurança, Me cobrar de mais, E sempre ter medo de errar.</p>
        </div>

        <div class="bloco2">
            <h2>Meus Valores</h2>
            <p>Respeito, amor, empatia, sinceridade, perseverança e compromisso com o que acredito.</p>

            <h2>Minhas Principais Aptidões</h2>
            <p>Tenho facilidade em ouvir e compreender as pessoas, o que me faz sentir ainda mais conectada com
                minha futura profissão. Sou dedicada aos estudos e gosto de aprender sobre comportamento humano,
                emoções e saúde mental.</p>
        </div>

        <div class="bloco1">
            <h2>Meus Relacionamentos</h2>
            <p><strong>Família:</strong> Eles são Minha base, sempre presente e cheia de amor.<br>
                <strong>Namorado:</strong> Amor da minha vida que sempre ta comigo quando eu preciso.<br>
                <strong>Amigos:</strong> Não tenho muitos mais os que tenho nunca me deixaram na mão.<br>
                <strong>Sociedade:</strong> Quero fazer a diferença ajudando as pessoas a se sentirem melhor consigo
                mesmas.
            </p>
        </div>

        <div class="bloco2">
            <h2>Meu Dia a Dia</h2>
            <p>O que gosto de fazer: Estudar sobre psicologia e psiquiatria, passar tempo com minha família e namorado,
                assistir séries, ouvir música e refletir sobre a vida.</p>
            <p> O que não gosto: Injustiça, falsidade e desvalorização dos sentimentos.
                Rotina: Divido meu tempo entre estudos, momentos de lazer e autoconhecimento.
            </p>
            <h2>Minha Vida Escolar</h2>
            <p>A escola é um espaço onde aprendo não só conteúdos acadêmicos, mas também sobre mim mesma. Sei que o
                caminho para alcançar meu sonho exige esforço, e estou disposta a enfrentar cada desafio.</p>

            <h2>Minha Visão Sobre Mim</h2>
            <p>Física: Tenho meus momentos de insegurança, mas sei que sou única e busco me sentir bem comigo mesma.
                Intelectual: Amo aprender, especialmente sobre a mente humana e as emoções.
                Emocional: Sou sensível e intensa, sinto tudo profundamente e, às vezes, isso me torna um pouco
                insegura.</p>

        </div>



        <div class="bloco1">
            <h2>A Visão das Pessoas Sobre Mim</h2>
            <p>Minha família e meu namorado me veem como uma pessoa amorosa e dedicada. Meus amigos sabem que sou alguém
                em quem podem confiar. Quero que as pessoas me enxerguem como alguém que faz a diferença na vida delas.
            </p>
        </div>

        <div class="bloco2">
            <h2>Autoavaliação</h2>
            <p>Mesmo com minha insegurança, sei que sou capaz. Tenho sonhos grandes e estou disposta a lutar por eles.
                Cada passo que dou me aproxima da profissional e da pessoa que quero ser.</p>
        </div>

    </main>

</body>

</html>
</body>

</html>