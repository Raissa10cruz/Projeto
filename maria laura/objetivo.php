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

        .objetivo {
            background-color: #98A38F;
            padding: 30px;
            border-radius: 0px;
            max-width: 900px;
            margin: 0 auto;
            color: white;
        }

        .objetivo h2 {
            text-align: center;
            margin-bottom: 30px;
            font-style: italic;
            color: black;
        }

        .objetivo p {
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .img-psicologia {
            display: flex;
            justify-content:  right;
            margin-top: 30px;
        }

        .img-psicologia img {
            width: 80px;
            height: auto;
        }
    </style>
</head>

<body>

    <header>
        <nav>
            <div class="links-nav">
                <a href="index.php">Início</a>
                <a href="sonho.php">Sonhos</a>

            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <a href="plano.php">Plano Ação</a>
                <a href="perfil.php" class="perfil-link">
                    <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Perfil" class="perfil-foto">
                </a>
            </div>
        </nav>
        <div class="header-text">
            <h1>Meus Objetivos</h1>
            <p>"Defina seu objetivo, acredite no seu potencial e avance com determinação — cada passo conta na jornada
                para transformar sonhos em realidade." ✨✨</p>
        </div>
    </header>

    <main>
        <section class="objetivo">
            <h2>Meu objetivo de vida</h2>
            <p>Meu maior propósito na vida é construir um futuro sólido e equilibrado, tanto no âmbito profissional
                quanto no pessoal. Desde cedo, sempre sonhei em fazer a diferença na vida das pessoas, e, por isso,
                escolhi seguir o caminho da Psicologia. Quero compreender a mente humana em profundidade, ajudando
                aqueles que precisam de apoio emocional e psicológico. No entanto, minha jornada não para por aí. Meu
                objetivo é, depois de me formar em Psicologia, ingressar na faculdade de Medicina para me especializar
                em Psiquiatria, ampliando ainda mais minha capacidade de cuidar da saúde mental das pessoas.
                <br>
                <br>
                Durante essa caminhada, quero me dedicar aos estudos e ao trabalho, garantindo minha independência e
                estabilidade financeira. Meu plano é conquistar minha casa exatamente do jeito que sonho, um espaço que
                seja um verdadeiro lar para mim e, futuramente, para minha família. Ter minha própria família é um dos
                pilares dos meus planos de vida. Quero me casar com o amor da minha vida, construir uma relação baseada
                em amor, respeito e parceria. Quero ter filhos e proporcionar a eles uma vida cheia de amor, segurança e
                oportunidades, garantindo que cresçam em um ambiente acolhedor e repleto de possibilidades para
                realizarem seus próprios sonhos.
                <br>
                <br>
                Sei que esse caminho exigirá muito esforço, dedicação e perseverança, mas estou disposta a enfrentar
                cada desafio com determinação. Cada passo que dou hoje é um investimento no futuro que desejo construir,
                e minha maior motivação é saber que, ao alcançar meus objetivos, poderei viver a vida que sempre sonhei,
                tanto profissionalmente quanto ao lado das pessoas que amo.</p>
            <div class="img-psicologia">
            <img src="img/psiquiatria.png" alt="Símbolo de Psicologia">

            </div>
        </section>
    </main>

</body>

</html>