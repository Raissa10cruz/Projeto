<?php
// Conexão com o banco via PDO
$dsn = "mysql:host=localhost;dbname=site_autoconhecimento;charset=utf8mb4";
$usuario = "root"; // Altere conforme necessário
$senha = "";       // Altere conforme necessário

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// Consulta os resultados ordenados por data
$stmt = $pdo->query("SELECT nome, resultado, data_hora FROM resultados_mbti ORDER BY data_hora DESC");
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultados do Teste MBTI</title>
    <style>
        /* Estilo base */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f3f9;
            color: #4a2c78;
            max-width: 900px;
            margin: auto;
            padding: 40px 20px;
        }

        h1 {
            color: #9b4d96;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        /* Estilo da tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #d6a9f0;
        }

        th {
            background-color: #f1e6fb;
            font-size: 1.1em;
            color: #9b4d96;
        }

        td {
            background-color: #faf1fd;
            color: #4a2c78;
            font-size: 1em;
        }

        td a {
            text-decoration: none;
            color: #9b4d96;
        }

        /* Links e Botões */
        a {
            display: inline-block;
            margin-top: 30px;
            text-align: center;
            padding: 12px 20px;
            background-color: #9b4d96;
            color: white;
            border-radius: 10px;
            font-size: 1.1em;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #7a378c;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            h1 {
                font-size: 2em;
            }

            table {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <h1>Resultados do Teste de Personalidade MBTI</h1>

    <?php if (count($resultados) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo MBTI</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $res): ?>
                    <tr>
                        <td><?= htmlspecialchars($res['nome']) ?: 'Anônimo' ?></td>
                        <td><?= htmlspecialchars($res['resultado']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($res['data_hora'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; color: #9b4d96;">Nenhum resultado registrado ainda.</p>
    <?php endif; ?>

    <p style="text-align: center;"><a href="teste-personalidade.php">Voltar para o teste</a></p>
</body>
</html>
