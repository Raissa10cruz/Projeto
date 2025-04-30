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
} else {
    // Redireciona se não estiver logado
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto de Vida</title>
    <link href="https://fonts.googleapis.com/css2?family=Fleur+De+Leah&family=Raleway:wght@400;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

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
            padding: 100px 20px;
            position: relative;
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
            width: 240px;
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

        .logout-button {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .logout-button:hover {
            background-color: white;
            color: #333;
        }

        .logout-form {
            margin: 0;
        }

        .header-text {
            margin-top: 60px;
            text-align: left;
            padding-left: 30px;
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

        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
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

        .card:hover {
            background-color:rgb(183, 194, 183);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
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
        }

        .card-content {
            padding: 15px;
        }

        .card-content p {
            font-size: 0.95em;
            color: #333;
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
        <a href="sonho.php">Sonhos</a>
        <a href="objetivo.php">Objetivos</a>
        <a href="plano.php">Plano de Ação</a>
    </nav>

    <header>
        <div class="perfil-container">
            <span class="perfil-email"><?= htmlspecialchars($email) ?></span>
            <a href="perfil.php" class="perfil-link">
                <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Perfil" class="perfil-foto">
            </a>
            <form class="logout-form" action="logout.php" method="post">
                <button type="submit" class="logout-button">Sair</button>
            </form>
        </div>

        <div class="header-text">
            <h1>Projeto de Vida</h1>
            <p>"Cada escolha que você faz constrói o futuro que deseja. Sonhe, planeje e realize!"</p>
        </div>
    </header>

    <main>
        <a href="teste-multiplas.php" class="card-link">
            <div class="card">
                <div class="card-image">
                    <img src="img/IMG3.jpg" alt="Múltiplas Inteligências">
                    <h3>Testes de Múltiplas Inteligências</h3>
                </div>
                <div class="card-content">
                    <p>Os Testes de Múltiplas Inteligências avaliam quais tipos de inteligência, segundo a teoria de Howard Gardner, são mais desenvolvidos em uma pessoa.</p>
                </div>
            </div>
        </a>

        <a href="profisões.php" class="card-link">
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

        <a href="quem.php" class="card-link">
            <div class="card">
                <div class="card-image">
                    <img src="img/IMG4.jpg" alt="Quem sou eu?">
                    <h3>Quem Sou Eu?</h3>
                </div>
                <div class="card-content">
                    <p>🌟Quem Sou Eu? Descubra o Fascinante Universo que É Você! 🌟 Você já se perguntou o que te torna único?</p>
                </div>
            </div>
        </a>

        <a href="teste-personalidade.php" class="card-link">
            <div class="card">
                <div class="card-image">
                    <img src="img/imagem.jpg" alt="Teste de Personalidade">
                    <h3>Teste de Personalidade</h3>
                </div>
                <div class="card-content">
                    <p>Testes que ajudam no autoconhecimento, desenvolvimento pessoal e orientação profissional.</p>
                </div>
            </div>
        </a>
    </main>
</body>

</html>
