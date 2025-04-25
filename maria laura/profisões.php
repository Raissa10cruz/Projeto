<?php
session_start();

$foto = 'default.png';
if (isset($_SESSION['usuario_id'])) {
    try {
        $conn = new PDO('mysql:host=localhost;dbname=sistema_cadastro;charset=utf8', 'root', '');
        $stmt = $conn->prepare("SELECT foto_perfil FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $_SESSION['usuario_id']]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado && !empty($resultado['foto_perfil'])) {
            $foto = $resultado['foto_perfil'];
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
    <title>Meus Objetivos</title>
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
            justify-content: space-between;
            align-items: center;
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

        .perfil-link {
            display: inline-block;
            width: 40px;
            height: 40px;
            overflow: hidden;
            border-radius: 50%;
            border: 2px solid white;
        }

        .perfil-foto {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-text {
            text-align: left;
            margin-top: 60px;
        }

        .header-text h1 {
            font-size: 3em;
            font-family: 'Fleur De Leah', cursive;
            margin: 0;
        }

        .header-text p {
            font-size: 1.1em;
            margin-top: 10px;
            max-width: 600px;
            margin-right: auto;
        }

        main {
            padding: 40px 20px;
        }

        .plano {
            background-color: #98A38F;
            padding: 30px;
            border-radius: 0px;
            max-width: 900px;
            margin: 0 auto;
            color: white;
        }

        .plano h2 {
            text-align: center;
            margin-bottom: 30px;
            font-style: italic;
            color: black;
        }

        .plano p {
            margin-bottom: 20px;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    <header>
        <nav>
            <div class="links-nav">
                <a href="index.php">Início</a>
                <a href="sonho.php">Sonhos</a>
                <a href="objetivo.php">Objetivo</a>

            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <a href="plano.php">Plano Ação</a>
                <a href="perfil.php" class="perfil-link">
                    <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Perfil" class="perfil-foto">
                </a>
            </div>
        </nav>
        <div class="header-text">
            <h1>Profissões</h1>
            <p>"Cada escolha que você faz construir o futuro que deseja. Sonhe, planeje e realize!"</p>
        </div>
    </header>

    <main>
        <section class="plano">
            <h2>Profissões do futuro</h2>
            <p>Desde cedo, sempre me interessei por entender as pessoas, o comportamento humano e como podemos melhorar
                a qualidade de vida de quem enfrenta dificuldades físicas, emocionais ou mentais. Por isso, no meu
                projeto de vida, venho refletindo bastante sobre as áreas que mais me identifico e que gostaria de
                seguir no futuro.
                <br>
                <br>
                Uma das opções que mais me chama atenção é a Psicologia, porque gosto de ouvir, aconselhar e tentar
                entender o que se passa na mente das pessoas. A ideia de poder ajudar alguém a superar traumas, medos ou
                crises me inspira muito.
                <br>
                <br>
                Outra área que considero é a Medicina, com o objetivo de me especializar em Psiquiatria. Sei que é um
                caminho longo e exige bastante dedicação, mas o desejo de tratar questões mais profundas da saúde
                mental, combinando o conhecimento clínico com o cuidado humano, me motiva a considerar essa
                possibilidade com carinho.
                <br>
                <br>
                Também penso bastante na Nutrição, porque acredito que a alimentação está totalmente ligada ao bem-estar
                físico e emocional. Vejo a nutrição como uma forma de prevenção e tratamento, e isso me encanta.
                <br>
                <br>
                Além disso, tenho interesse em Fisioterapia e Terapia Ocupacional, pois ambas envolvem ajudar pessoas a
                recuperarem suas funções e conquistarem mais autonomia no dia a dia. Gosto da ideia de estar próximo de
                quem precisa e acompanhar o progresso de cada um, fazendo parte dessa transformação.
                <br>
                <br>
                Ainda estou descobrindo qual desses caminhos combina mais comigo, mas uma coisa é certa: quero trabalhar
                com cuidado, escuta e empatia. Meu projeto de vida está sendo construído com base nesse desejo de fazer
                a diferença na vida das pessoas, seja qual for a profissão que eu escolher seguir.</p>
        </section>
    </main>

</body>

</html>