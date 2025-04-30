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



        /* Ícone do menu hambúrguer */
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
        <a href="index.php">Inicio</a>  
        <a href="sonho.php">Sonho</a>
        <a href="objetivo.php">Objetivos</a>
      
    </nav>
    <header>
        <div class="perfil-container">
            <span class="perfil-email"><?= htmlspecialchars($email) ?></span>
            <a href="perfil.php" class="perfil-link">
                <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Perfil" class="perfil-foto">
            </a>
        </div>
        </nav>
        <div class="header-text">
            <h1>Plano de Ação</h1>
            <p>"Cada escolha que você faz construir o futuro que deseja. Sonhe, planeje e realize!"</p>
        </div>
    </header>

    <main>
        <section class="plano">
            <h2>Meu Plano de Ação</h2>
            <p>Meu plano de ação é bem claro: primeiro, vou me formar em Psicologia, porque quero entender a mente
                humana a fundo e ajudar as pessoas desde a base. Depois, meu próximo passo é entrar na Medicina para me
                especializar em Psiquiatria, ampliando meu conhecimento e atuação. Sei que o caminho é desafiador, mas
                estou determinada. Paralelamente, vou construindo minha vida, trabalhando, conquistando minha
                independência, minha casa e, no momento certo, formando minha família. Esse é o meu sonho e estou
                disposta a dar tudo de mim para realizá-lo!</p>
        </section>
    </main>

</body>

</html>