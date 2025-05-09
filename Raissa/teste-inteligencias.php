<?php
$host = 'localhost';
$db = 'site_autoconhecimento';
$user = 'root';
$pass = '';

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
            background: #1e1e2f;
            font-family: 'Segoe UI', sans-serif;
            color: #f1f1f1;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #a259ff;
            font-size: 32px;
            margin-bottom: 20px;
        }

        form {
            max-width: 800px;
            margin: auto;
            background: #2b2b3d;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(162, 89, 255, 0.3);
        }

        .pergunta {
            margin-bottom: 20px;
        }

        .pergunta label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #d2b7ff;
        }

        .pergunta select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: none;
            background: #3a3a50;
            color: #fff;
            font-size: 15px;
        }

        button {
            background: #a259ff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
            margin-top: 15px;
        }

        button:hover {
            background: #8b43e0;
        }

        .resultado {
            max-width: 700px;
            margin: 20px auto;
            background: #3a3a50;
            padding: 20px;
            border-left: 5px solid #a259ff;
            border-radius: 8px;
            font-size: 18px;
            color: #ffffff;
        }

        .voltar-wrapper {
            position: fixed;
            top: 20px;
            left: 20px;
        }

        .btn-voltar {
            background-color: #a259ff;
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
        }

        .btn-voltar:hover {
            background-color: #8b43e0;
        }

        .progress-bar {
            height: 10px;
            background: #444;
            border-radius: 5px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: #a259ff;
            width: 0%;
            transition: width 0.3s ease-in-out;
        }

        .grafico-link {
            background:#a259ff;
            color:white;
            padding:10px 18px;
            border-radius:8px;
            text-decoration:none;
            transition: background 0.3s;
        }

        .grafico-link:hover {
            background: #8b43e0;
        }
    </style>
    <script>
        function atualizarProgresso() {
            const total = document.querySelectorAll("select").length;
            const respondidas = Array.from(document.querySelectorAll("select")).filter(s => s.value !== "").length;
            const percent = Math.round((respondidas / total) * 100);
            document.querySelector(".progress").style.width = percent + "%";
        }

        window.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("select").forEach(select => {
                select.addEventListener("change", atualizarProgresso);
            });
        });
    </script>
</head>
<body>
    <h1>Teste de Inteligências Múltiplas</h1>

    <?php if ($resultado): ?>
        <div class="resultado"><?= $resultado ?></div>
        <div style="text-align:center;margin-top:20px;">
            <a href="grafico_resultados.php" class="grafico-link">📊 Ver Gráfico de Resultados</a>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="progress-bar"><div class="progress"></div></div>
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

    <div class="voltar-wrapper">
        <button onclick="window.location.href='topicos.php'" class="btn-voltar">← Voltar</button>
    </div>
</body>
</html>
