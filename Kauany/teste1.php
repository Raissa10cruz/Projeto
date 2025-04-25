<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Variáveis para armazenar as respostas do teste
    $respostas = [
        "pergunta1" => $_POST['pergunta1'],
        "pergunta2" => $_POST['pergunta2'],
        "pergunta3" => $_POST['pergunta3'],
        "pergunta4" => $_POST['pergunta4'],
        "pergunta5" => $_POST['pergunta5'],
        "pergunta6" => $_POST['pergunta6'],
        "pergunta7" => $_POST['pergunta7'],
        "pergunta8" => $_POST['pergunta8'],
        "pergunta9" => $_POST['pergunta9'],
        "pergunta10" => $_POST['pergunta10'],
    ];

    // Calculando a pontuação
    $pontuacao = 0;
    foreach ($respostas as $resposta) {
        $pontuacao += (int)$resposta;
    }

    // Armazenando a pontuação na sessão
    $_SESSION['pontuacao'] = $pontuacao;

    // Redirecionando para a página de resultados
    header("Location: resultado.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Teste de Personalidade</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('kauany.jpg'); /* Substitua pelo caminho da imagem de fundo */
            background-size: cover;
            background-position: center;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 80px auto;
            background-color: rgba(0, 0, 0, 0.7); /* Fundo semitransparente */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
        }

        .pergunta {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .opcoes input {
            margin-right: 10px;
        }

        .botao {
            display: block;
            width: 100%;
            padding: 15px;
            background-color:rgb(0, 0, 0);
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 30px;
        }

        .botao:hover {
            background-color:rgb(0, 0, 0);
        }

        /* Estilo para os ícones no topo */
        .menu-icons {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .menu-icons a {
            text-decoration: none;
            color: white;
        }

        .menu-icons img {
            width: 32px;
            margin-left: 12px;
        }
    </style>
</head>
<body>

    <!-- Ícones no topo, ajustados para o lado direito -->
    <div class="menu-icons">
        <a href="home.php" title="Voltar"><img src="3.png" alt="Voltar"></a>
        <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
        <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
        </div>

    <div class="container">
        <h1>Teste de Personalidade</h1>
        <form method="POST" action="teste1.php">
            <div class="pergunta">
                <label>1. Você prefere atividades ao ar livre ou em ambientes fechados?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta1" value="1"> Ao ar livre<br>
                    <input type="radio" name="pergunta1" value="2"> Em ambientes fechados<br>
                </div>
            </div>

            <div class="pergunta">
                <label>2. Você costuma ser mais impulsivo ou mais analítico?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta2" value="1"> Impulsivo<br>
                    <input type="radio" name="pergunta2" value="2"> Analítico<br>
                </div>
            </div>

            <div class="pergunta">
                <label>3. Você costuma se sentir energizado em ambientes com muitas pessoas?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta3" value="1"> Sim<br>
                    <input type="radio" name="pergunta3" value="2"> Não<br>
                </div>
            </div>

            <div class="pergunta">
                <label>4. Você prefere trabalhar em equipe ou sozinho?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta4" value="1"> Em equipe<br>
                    <input type="radio" name="pergunta4" value="2"> Sozinho<br>
                </div>
            </div>

            <div class="pergunta">
                <label>5. Você costuma planejar as coisas ou prefere ser mais espontâneo?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta5" value="1"> Planejar<br>
                    <input type="radio" name="pergunta5" value="2"> Ser espontâneo<br>
                </div>
            </div>

            <div class="pergunta">
                <label>6. Você gosta de assumir riscos ou prefere segurança?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta6" value="1"> Assumir riscos<br>
                    <input type="radio" name="pergunta6" value="2"> Preferir segurança<br>
                </div>
            </div>

            <div class="pergunta">
                <label>7. Você se sente confortável com mudanças ou prefere a estabilidade?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta7" value="1"> Com mudanças<br>
                    <input type="radio" name="pergunta7" value="2"> Preferir estabilidade<br>
                </div>
            </div>

            <div class="pergunta">
                <label>8. Você gosta de ser o centro das atenções ou prefere ficar mais na sua?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta8" value="1"> Centro das atenções<br>
                    <input type="radio" name="pergunta8" value="2"> Ficar na minha<br>
                </div>
            </div>

            <div class="pergunta">
                <label>9. Você costuma ser otimista ou pessimista?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta9" value="1"> Otimista<br>
                    <input type="radio" name="pergunta9" value="2"> Pessimista<br>
                </div>
            </div>

            <div class="pergunta">
                <label>10. Você se sente confortável em situações sociais ou prefere evitá-las?</label><br>
                <div class="opcoes">
                    <input type="radio" name="pergunta10" value="1"> Confortável<br>
                    <input type="radio" name="pergunta10" value="2"> Evitar<br>
                </div>
            </div>

            <button type="submit" class="botao">Ver Resultados</button>
        </form>
    </div>

</body>
</html>
