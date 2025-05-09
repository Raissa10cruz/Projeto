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
    <title>Minhas Profissões</title>
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

        .profissoes-list {
            list-style-type: none;
            padding: 0;
        }

        .profissoes-list li {
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
            <h1>Minhas Profissões</h1>

            <p>Estou focada em construir um futuro sólido e com propósito. Abaixo, compartilho algumas das profissões que sonho seguir e como planejo alcançar esses objetivos:</p>

            <ul class="profissoes-list">
                <li><strong>Medicina</strong>: Minha principal paixão. Quero ser médica, de preferência especialista, e fazer a diferença na vida das pessoas, oferecendo cuidados de saúde com empatia e expertise.</li>
                <li><strong>Biomedicina</strong>: Caso a Medicina não seja possível por algum motivo, a Biomedicina é uma escolha que me encanta. Trabalhar nos bastidores da saúde, em laboratórios, me permitirá ajudar a salvar vidas de outra forma.</li>
                <li><strong>Enfermagem</strong>: Embora a Medicina e a Biomedicina sejam minhas grandes prioridades, a Enfermagem também é uma profissão que admiro profundamente. Cuidar das pessoas de perto, com carinho e dedicação, é essencial em qualquer área da saúde.</li>
                <li><strong>Direito</strong>: Se a carreira da saúde não se concretizar, talvez o Direito seja o caminho. Lutar pela justiça, defender os direitos das pessoas e promover a equidade é algo que sempre me atraiu. Quero ser advogada ou até mesmo juíza.</li>
                <li><strong>Escritora</strong>: Além das áreas relacionadas à saúde e justiça, o sonho de ser escritora nunca morreu. Escrever histórias que toquem o coração das pessoas e criar personagens que inspirem é uma paixão antiga que sempre fará parte dos meus planos.</li>
            </ul>

            <p class="frase">"Cada profissão é um passo em direção ao meu futuro. Seja cuidando da saúde, defendendo a justiça ou escrevendo histórias, o objetivo é sempre fazer a diferença na vida das pessoas."</p>
        </div>
    </div>

</body>
</html>
