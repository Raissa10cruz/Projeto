<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>O que é um Projeto de Vida?</title>
    <style>
        body {
            margin: 0;
            background-color: #c62828;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            padding: 0;
        }

        .header {
            width: 100%;
            height: 200px;
            background-image: url('kauany.jpg'); /* imagem de fundo */
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header .titulo {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 28px;
            font-family: 'Comic Sans MS', cursive;
            padding: 10px 20px;
            border-radius: 10px;
            text-align: center;
        }

        .icones {
            position: absolute;
            top: 10px;
            right: 15px;
            display: flex;
            gap: 10px;
        }

        .icones a img {
            width: 30px;
            height: 30px;
            background-color: white;
            border-radius: 6px;
            padding: 4px;
        }

        .container {
            background-color: white;
            border-radius: 20px;
            max-width: 800px;
            width: 90%;
            padding: 30px;
            margin: 30px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .container img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .texto {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }

        ul {
            margin-top: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="titulo">O QUE É UM PROJETO DE VIDA?</div>
        <div class="icones">
            <a href="home.php" title="Voltar"><img src="3.png" alt="Voltar"></a>
            <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
            <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
        </div>
    </div>

    <div class="container">
        <img src="7.jpg" alt="Imagem representativa">
        <div class="texto">
        <h3>O que é um projeto de vida?</h3>

            <p>Um projeto de vida é mais do que apenas uma lista de objetivos. Ele é a construção do caminho que queremos seguir, a junção de nossas aspirações, valores e sonhos mais profundos. É uma forma de direcionar nossos esforços para algo maior e mais significativo, algo que nos impulsiona todos os dias a continuar, mesmo nas dificuldades.</p>

            <p>Esse projeto envolve as escolhas que fazemos em diferentes áreas da nossa vida — desde a carreira até os relacionamentos, passando pela nossa saúde e bem-estar. Ele é uma reflexão constante sobre quem somos, onde queremos chegar e o que nos motiva a seguir em frente.</p>

            <p>Para construir um projeto de vida, é essencial se conhecer profundamente: entender suas paixões, habilidades, limitações e valores. Depois, é necessário definir metas claras, que estejam alinhadas com o que realmente importa para você, e tomar atitudes práticas para alcançá-las.</p>

            <p>Em alguns momentos, o projeto de vida pode passar por ajustes. Nossas prioridades podem mudar, e tudo bem. O mais importante é ter clareza sobre o que queremos e não ter medo de recomeçar, sempre que necessário, com novas perspectivas e aprendizados.</p>

            <p>Ter um projeto de vida é ter um propósito. É não se deixar levar pelas circunstâncias ou pela pressão externa, mas sim viver de acordo com o que se acredita ser o melhor caminho para a nossa realização pessoal. Quando nos dedicamos a esse projeto, criamos uma vida com mais significado e satisfação.</p>

            <p>Por isso, é importante olhar para o futuro com esperança, mas sem esquecer do presente. O projeto de vida se constrói dia após dia, com pequenas decisões que moldam nosso destino e nos aproximam de nossos objetivos.</p>
        </div>
    </div>

</body>
</html>
