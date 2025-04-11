
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto de Vida</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&family=Raleway:wght@400;700&family=Shadows+Into+Light&display=swap"
        rel="stylesheet">


    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        a.card {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .header-text {
            margin-top: 60px;
            text-align: left;
            padding-left: 30px;
            /* opcional, para afastar da borda */
        }

        body {
            margin: 0;
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: italic;
            background-color: #d9ded7;
        }

        header {
            background-image: url('img/imagem.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
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
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        nav a:hover {
            color: #98A38F;
            /* dourado suave */
            transform: scale(1.1);
        }


        .header-text {
            margin-top: 60px;
        }

        .header-text h1 {
            font-size: 3em;
            margin: 0;
            font-family: 'Fleur De Leah', cursive;
        }

        .header-text p {
            font-size: 1.2em;
        }

        main {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 40px 100px;
            justify-items: center;
        }

        .card:hover {
            background-color: #f0f0f0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }

        .card {
            background-color: white;
            width: 100%;
            max-width: 300px;
            border-radius: 0px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.5s ease-in-out;
        }


        .card-image {
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-image h3 {
            position: absolute;
            top: 10px;
            left: 10px;
            margin: 0;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 1em;
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: italic;
        }

        .card-content {
            padding: 15px;
        }

        .card-content p {
            font-size: 0.95em;
            color: #333;
        }

        .perfil-link {
            display: inline-block;
            width: 40px;
            height: 40px;
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
    </style>
</head>

<body>
    <header>
        <nav>
            <div>
                <a href="#">Início</a>
                <a href="#">Somos</a>
                <a href="#">Objetivos</a>
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <a href="perfil.php">Plano Ação</a>
                <a href="perfil.php" class="perfil-link">
                    <img src="img/foto de perfil.webp" alt="Perfil" class="perfil-foto">
                </a>
            </div>
        </nav>

        <div class="header-text">
            <h1>Projeto de Vida</h1>
            <p>"Cada escolha que você faz construir o futuro que deseja. Sonhe, planeje e realize!" 💭✨🌱</p>
        </div>

    </header>
    <main>
        <a href="multiplas-inteligencias.html" class="card-link">
            <div class="card">
                <div class="card-image">
                    <img src="img/IMG3.jpg" alt="Múltiplas Inteligências">
                    <h3>Testes de Múltiplas Inteligências</h3>
                </div>
                <div class="card-content">
                    <p>
                        Os Testes de Múltiplas Inteligências avaliam quais tipos de inteligência, segundo a teoria de
                        Howard Gardner, são mais desenvolvidos em uma pessoa.</p>
                </div>
            </div>
        </a>

        <a href="profissoes.html" class="card-link">
            <div class="card">
                <div class="card-image">
                    <img src="img/IMG2.jpg" alt="Profissões">
                    <h3>Profissões</h3>
                </div>
                <div class="card-content">
                    <p>Venha saber mais sobre a sua profissão escolhida.</p>
                </div>
            </div>
        </a>

        <a href="quem-sou-eu.html" class="card-link">
            <div class="card">
                <div class="card-image">
                    <img src="img/IMG4.jpg" alt="Quem sou eu?">
                    <h3>Quem Sou Eu?</h3>
                </div>
                <div class="card-content">
                    <p>
                        🌟Quem Sou Eu? Descubra o Fascinante Universo que É Você! 🌟
                        Você já se perguntou o que te torna único? O que há por trás do seu sorriso, das suas escolhas e
                        dos seus sonhos? Quem Sou Eu? não é apenas uma pergunta, é uma jornada emocionante para explorar
                        o que faz de você, VOCÊ!
                        ✨ Por que descobrir quem você é?
                    </p>
                </div>
            </div>
        </a>

        <a href="teste-personalidade.html" class="card-link">
            <div class="card">
                <div class="card-image">
                    <img src="img/imagem.jpg" alt="Teste de Personalidade">
                    <h3>Teste de Personalidade</h3>
                </div>
                <div class="card-content">
                    <p>Os Testes de Personalidade avaliam características psicológicas e padrões de comportamento de uma
                        pessoa. Eles ajudam no autoconhecimento, no desenvolvimento pessoal e na orientação
                        profissional.</p>
                </div>
            </div>
        </a>

        </div>
    </main>
</body>

</html>