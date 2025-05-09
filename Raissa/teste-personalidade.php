<?php
// CONEXÃO COM PDO
$dsn = "mysql:host=localhost;dbname=site_autoconhecimento;charset=utf8mb4";
$usuario = "root"; // Altere se necessário
$senha = "";       // Altere se tiver senha

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// DESCRIÇÕES MBTI
$descricoes = [
    'ISTJ' => 'Prático, confiável e sério. Gosta de estrutura e valoriza tradições.',
    'ISFJ' => 'Protetor, sensível e leal. Preocupa-se profundamente com os outros.',
    'INFJ' => 'Visionário, idealista e reservado. Procura significado em tudo.',
    'INTJ' => 'Estratégico, determinado e independente. Ama desafios intelectuais.',
    'ISTP' => 'Lógico, curioso e prático. Gosta de entender como as coisas funcionam.',
    'ISFP' => 'Artístico, gentil e tranquilo. Valoriza a harmonia e a beleza.',
    'INFP' => 'Sonhador, empático e reservado. Movido por valores internos profundos.',
    'INTP' => 'Analítico, criativo e independente. Ama explorar ideias complexas.',
    'ESTP' => 'Aventureiro, direto e prático. Vive o momento e age com rapidez.',
    'ESFP' => 'Espontâneo, divertido e sociável. Gosta de entreter e curtir a vida.',
    'ENFP' => 'Entusiasta, criativo e emocional. Inspira os outros com suas ideias.',
    'ENTP' => 'Inventivo, curioso e persuasivo. Gosta de debates e inovação.',
    'ESTJ' => 'Organizado, decisivo e eficiente. Gosta de liderança e ordem.',
    'ESFJ' => 'Sociável, prestativo e leal. Valoriza a harmonia e as conexões sociais.',
    'ENFJ' => 'Carismático, empático e motivador. Ajuda os outros a crescer.',
    'ENTJ' => 'Líder nato, lógico e confiante. Focado em resultados e eficiência.',
];

// PROCESSAMENTO DO FORMULÁRIO
$resultadoHTML = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? 'Anônimo';
    $scores = ['E'=>0, 'I'=>0, 'S'=>0, 'N'=>0, 'T'=>0, 'F'=>0, 'J'=>0, 'P'=>0];

    foreach ($_POST as $key => $value) {
        if (isset($scores[$value])) {
            $scores[$value]++;
        }
    }

    $mbti = '';
    $mbti .= ($scores['E'] >= $scores['I']) ? 'E' : 'I';
    $mbti .= ($scores['S'] >= $scores['N']) ? 'S' : 'N';
    $mbti .= ($scores['T'] >= $scores['F']) ? 'T' : 'F';
    $mbti .= ($scores['J'] >= $scores['P']) ? 'J' : 'P';

    // Salvando no banco
    $stmt = $pdo->prepare("INSERT INTO resultados_mbti (nome, resultado) VALUES (:nome, :resultado)");
    $stmt->execute([':nome' => $nome, ':resultado' => $mbti]);

    $descricao = $descricoes[$mbti] ?? 'Descrição não disponível.';

    $resultadoHTML = "
        <div class='resultado'>
            <h2>Seu tipo MBTI é: <strong>$mbti</strong></h2>
            <p><strong>Descrição:</strong> $descricao</p>
            <p>Obrigado por participar, <strong>$nome</strong>!</p>
            <a href='teste-personalidade.php'>Refazer teste</a>
        </div>
    ";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Teste MBTI</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f0ff;
            color: #4a2c78;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #6a2d97;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-top: 20px;
        }

        label {
            font-size: 1.1em;
            display: block;
            color: #6a2d97;
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #d6a9f0;
            width: 100%;
            margin-bottom: 20px;
            font-size: 1em;
        }

        input[type="submit"] {
            background-color: #9b4d96;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #7a378c;
        }

        .pergunta {
            background: #f3e5f5;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #d6a9f0;
        }

        .opcao {
            display: block;
            margin: 5px 0;
        }

        .opcao input {
            margin-right: 10px;
        }

        .resultado {
            background: #fff;
            border: 2px solid #9b4d96;
            padding: 30px;
            border-radius: 12px;
            max-width: 700px;
            text-align: center;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .resultado h2 {
            color: #6a2d97;
            font-size: 2em;
        }

        .resultado a {
            display: inline-block;
            margin-top: 20px;
            color: #9b4d96;
            font-weight: bold;
            text-decoration: none;
        }

        .resultado a:hover {
            text-decoration: underline;
        }

        .btn-voltar:hover {
  background-color: #9375d6;
}

.voltar-wrapper {
  position: fixed;
  top: 80px;
  left: 20px;
  z-index: 999;
}



.btn-voltar {
  background-color: #a58ae7;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 20px;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 16px;
  display: flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  transition: background-color 0.3s ease;
}

.btn-voltar:hover {
  background-color: #9375d6;
}
    </style>





</head>
<body>
    <h1>Teste de Personalidade MBTI</h1>

    <?= $resultadoHTML ?>

    <?php if (empty($resultadoHTML)): ?>
    <form method="post">
        <label><strong>Seu nome (opcional):</strong>
            <input type="text" name="nome">
        </label>
        <?php
        $perguntas = [
            ["Você se sente revigorado ao socializar com outras pessoas?", "E", "I"],
            ["Você prefere fatos concretos a ideias abstratas?", "S", "N"],
            ["Você toma decisões mais com base na lógica do que nas emoções?", "T", "F"],
            ["Você gosta de ter tudo planejado do que agir de forma espontânea?", "J", "P"],
            ["Você prefere falar a ouvir?", "E", "I"],
            ["Você se concentra mais nos detalhes do que no todo?", "S", "N"],
            ["Você evita tomar decisões com base em sentimentos?", "T", "F"],
            ["Você gosta de cumprir prazos e cronogramas?", "J", "P"],
            ["Você gosta de participar de eventos sociais grandes?", "E", "I"],
            ["Você prefere aprender por experiências práticas?", "S", "N"],
            ["Você acredita que lógica supera sentimentos?", "T", "F"],
            ["Você sente desconforto com mudanças de planos?", "J", "P"],
            ["Você se sente esgotado depois de muita interação social?", "I", "E"],
            ["Você confia mais na intuição do que nos dados?", "N", "S"],
            ["Você é sensível às emoções dos outros?", "F", "T"],
            ["Você se adapta facilmente a mudanças?", "P", "J"],
            ["Você tende a pensar em voz alta?", "E", "I"],
            ["Você gosta de explorar ideias imaginativas?", "N", "S"],
            ["Você costuma se guiar pelo coração?", "F", "T"],
            ["Você prefere manter opções em aberto do que decidir logo?", "P", "J"],
        ];

        foreach ($perguntas as $i => $p) {
            echo "<div class='pergunta'>";
            echo "<p><strong>" . ($i + 1) . ". {$p[0]}</strong></p>";
            echo "<label class='opcao'><input type='radio' name='q$i' value='{$p[1]}' required> Sim</label>";
            echo "<label class='opcao'><input type='radio' name='q$i' value='{$p[2]}'> Não</label>";
            echo "</div>";
        }
        ?>
        <input type="submit" value="Ver resultado">
    </form>

    <div class="voltar-wrapper">
  <button onclick="window.location.href='topicos.php'" class="btn-voltar">← Voltar</button>
</div>
    <?php endif; ?>
</body>
</html>
