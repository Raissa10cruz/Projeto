<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Quem Sou Eu?</title>
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
        <div class="titulo">QUEM SOU EU?</div>
        <div class="icones">
            <a href="home.php" title="Voltar"><img src="3.png" alt="Voltar"></a>
            <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
            <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
        </div>
    </div>

    <div class="container">
        <img src="images.png" alt="Imagem representativa">
        <div class="texto">
            <p>Apresento Kauany Gabrielly: quase adulta, totalmente desenrolada (e com um estoque de livros românticos pra ninguém botar defeito).</p>

            <p>Olha só, se você está procurando alguém que transforma "vou fazer rapidinho" em obra-prima, achou! Sou Kauany, 17 anos (mas em breve 18, então já vou treinando a cara de "não sou mais sua filha, sou uma cidadã"). Minhas especialidades? Romance literário (se o casal não se beijar no capítulo 3, eu processo), vôlei (dou piti se a bola cai, mas depois faço um bolo pra reconciliação) e cozinha experimental (tradução: invento pratos que às vezes dão certo, às vezes viram caso de polícia).</p>

            <p>Atualmente, tô no último ano do SESI, me preparando para o "mundo real", que eu imagino sendo tipo Grey’s Anatomy, mas com menos drama e mais cafezinho. Minha futura profissão? Bom, oscilo entre:</p>
            <ul>
                <li>Biomedicina (pra descobrir se o vírus do amor existe de verdade);</li>
                <li>Medicina (imagina eu de estetoscópio dizendo "respira fundo e conta do seu ex");</li>
                <li>Enfermagem (basicamente, ser a heroína de plantão);</li>
                <li>Direito (porque JUSTIÇA é meu lema, e se precisar, eu levo um processo até pra quem rasgar meus livros).</li>
            </ul>

            <p>Minhas qualidades em 3 atos:</p>
            <ul>
                <li>Perfeccionista nível Cruella (se o trabalho em grupo não estiver caprichado, eu refaço, mas com sorriso de "tamo junto").</li>
                <li>Solução de problemas na velocidade de um meme (enquanto todos panikam, eu tô tipo: "calma, já tenho 5 planos, 3 deles envolvem Google e um lanche").</li>
                <li>Equilibro razão e emoção como ninguém (de manhã, calculo fórmulas; de tarde, choro com final de livro; à noite, debato ética filosófica no grupo da família).</li>
            </ul>

            <p>Valor inegociável? JUSTIÇA. Se vejo alguém cortando fila, viro a Batman das redes sociais. Se o professor esquece de corrigir minha prova, viro a advogada de porta de sala. E se o crush me dá ghosting, viro a poeta das indiretas do Twitter (sim, ainda uso Twitter, julguem).</p>

            <p><strong>Resumo da ópera:</strong> sou uma mistura de She-Ra com MasterChef, só que com a pressão de escolher uma faculdade até dezembro. E se tudo der errado, viro escritora de romances onde a protagonista é, obviamente, uma biomédica justiceira que joga vôlei. Fica a dica, Netflix. 📚⚖️🍳</p>

            <p><em>(P.S.: Aceito sugestões de universidades… ou de receitas que não explodam o micro-ondas.) 😉</em></p>
        </div>
    </div>

</body>
</html>
