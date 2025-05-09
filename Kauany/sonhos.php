<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meus Sonhos</title>
    <link rel="stylesheet" href="estilo.css"> <!-- mesmo css do "quem sou" -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .menu-icons {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .menu-icons img {
            width: 32px;
            margin-left: 12px;
        }

        .container {
            max-width: 900px;
            margin: 80px auto;
            background-color: rgba(255, 255, 255, 0.92);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }

        h1 {
            text-align: center;
            font-size: 36px;
            color: #444;
            margin-bottom: 30px;
        }

        .dreams-list {
            list-style-type: none;
            padding: 0;
        }

        .dreams-list li {
            margin: 15px 0;
            font-size: 18px;
            color: #333;
        }

        .frase {
            font-style: italic;
            margin-top: 30px;
            text-align: center;
            color: #555;
        }

        /* Ajuste da imagem de fundo */
        .background {
            background-image: url('kauany.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 150px 0;
            height: 100vh;
        }
    </style>
</head>
<body>

    <div class="menu-icons">
        <a href="home.php" title="Voltar"><img src="3.png" alt="Voltar"></a>
        <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
        <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
        </div>

    <div class="background">
        <div class="container">
            <h1>Meus Sonhos</h1>

            <p>Eu acredito que a vida é feita de sonhos e objetivos, e aqui estão alguns dos meus maiores sonhos e planos para o futuro:</p>

            <ul class="dreams-list">
                <li>Ser médica, com um jaleco branco e o poder de cuidar de vidas. A medicina é a minha paixão, e é nela que vejo meu futuro.</li>
                <li>Explorar o mundo, falar cinco idiomas e entender diferentes culturas, para me tornar uma cidadã global e fazer a diferença em vários cantos do planeta.</li>
                <li>Criar uma família, com filhos que compartilhem minha risada alta e meu amor pela vida. Quero ver meus sonhos se multiplicando ao lado de quem amo.</li>
                <li>Escrever livros que toquem o coração das pessoas, e talvez até criar um universo literário, com romance, emoção e personagens que se tornem eternos.</li>
                <li>Ter uma biblioteca particular que seja um verdadeiro templo de sabedoria e emoção, com livros raros e clássicos que me acompanhem por toda a vida.</li>
                <li>Lutar por justiça, seja no campo da lei, da medicina ou nas pequenas ações do cotidiano. Acredito no poder do trabalho em equipe e da verdade.</li>
            </ul>

            <p class="frase">"Se for para viver, que seja com coragem, livros e o coração cheio de esperança."</p>
        </div>
    </div>

</body>
</html>
