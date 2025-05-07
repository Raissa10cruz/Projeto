<?php
$host = 'localhost';
$db = 'site_autoconhecimento';
$user = 'root'; // altere se necessário
$pass = '';     // senha em branco (XAMPP padrão)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$resultado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pontuacoes = [
        'Lógica' => 0,
        'Linguística' => 0,
        'Musical' => 0,
        'Interpessoal' => 0,
    ];

    foreach ($_POST as $resposta) {
        if (isset($pontuacoes[$resposta])) {
            $pontuacoes[$resposta]++;
        }
    }

    arsort($pontuacoes);
    $tipo = array_key_first($pontuacoes);
    $resultado = "Sua inteligência predominante é: <strong>$tipo</strong>.";

    $stmt = $pdo->prepare("INSERT INTO resultados_inteligencia (resultado) VALUES (:resultado)");
    $stmt->execute(['resultado' => $tipo]);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste de Inteligências</title>
    <style>
        body {
            background: #fefefe;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #6c63ff;
        }

        form {
            max-width: 700px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .pergunta {
            margin-bottom: 20px;
        }

        .pergunta label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .pergunta select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            background: #6c63ff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }

        .resultado {
            max-width: 700px;
            margin: 20px auto;
            background: #e6f3ff;
            padding: 20px;
            border-left: 5px solid #6c63ff;
            border-radius: 8px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Teste de Inteligências Múltiplas</h1>

    <?php if ($resultado): ?>
        <div class="resultado"><?= $resultado ?></div>
    <?php endif; ?>

    <form method="POST">
        <?php
        $perguntas = [
            "Você prefere resolver problemas matemáticos ou escrever histórias?" => ['Lógica', 'Linguística'],
            "Você gosta mais de tocar instrumentos ou de conversar com outras pessoas?" => ['Musical', 'Interpessoal'],
            "Você se considera mais analítico ou comunicativo?" => ['Lógica', 'Linguística'],
            "Você prefere fazer cálculos ou escrever poesias?" => ['Lógica', 'Linguística'],
            "Você se expressa melhor com música ou em conversas em grupo?" => ['Musical', 'Interpessoal'],
            "Você prefere resolver quebra-cabeças ou escrever redações?" => ['Lógica', 'Linguística'],
            "Você gosta de cantar/tocar ou de liderar trabalhos em grupo?" => ['Musical', 'Interpessoal'],
            "Você se sente mais confortável com lógica ou com palavras?" => ['Lógica', 'Linguística'],
            "Você gosta mais de compor música ou motivar pessoas?" => ['Musical', 'Interpessoal'],
            "Você prefere resolver equações ou escrever uma crônica?" => ['Lógica', 'Linguística'],
        ];

        $i = 1;
        foreach ($perguntas as $texto => $opcoes):
        ?>
            <div class="pergunta">
                <label><?= $i . ". " . $texto ?></label>
                <select name="q<?= $i ?>" required>
                    <option value="">Escolha uma opção</option>
                    <option value="<?= $opcoes[0] ?>"><?= $opcoes[0] ?></option>
                    <option value="<?= $opcoes[1] ?>"><?= $opcoes[1] ?></option>
                </select>
            </div>
        <?php $i++; endforeach; ?>

        <button type="submit">Ver Resultado</button>
    </form>

    <a href="dashboard.php" style="display:inline-block;margin-top:15px;text-align:center;background:#ccc;color:#333;padding:10px 18px;border-radius:8px;text-decoration:none;font-size:16px;">
            ← Voltar para a página inicial
        </a>

</body>
</html>
