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

$stmt = $pdo->query("SELECT resultado, COUNT(*) as total FROM resultados_inteligencia GROUP BY resultado");
$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$valores = [];
$cores = ['#00c9a7', '#ff6b6b', '#4dabf7', '#ffd43b'];
$totalGeral = 0;

foreach ($dados as $item) {
    $labels[] = $item['resultado'];
    $valores[] = $item['total'];
    $totalGeral += $item['total'];
}

$porcentagens = array_map(function($v) use ($totalGeral) {
    return round(($v / $totalGeral) * 100, 1);
}, $valores);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Resultados</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #1e1e2f;
            color: #f1f1f1;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 40px;
        }

        h1 {
            color:rgb(205, 118, 255);
            margin-bottom: 40px;
        }

        .grafico-container {
            max-width: 500px;
            margin: 0 auto;
            background: #2e2e40;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(203, 31, 255, 0.2);
        }

        .btn-voltar {
            margin-top: 40px;
            background-color:rgb(218, 124, 255);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-voltar:hover {
            background-color:rgb(211, 115, 255);
        }
    </style>
</head>
<body>
    <h1>Distribuição das Inteligências</h1>
    <div class="grafico-container">
        <canvas id="graficoPizza"></canvas>
    </div>
    <button class="btn-voltar" onclick="history.back()">← Voltar</button>

    <script>
        const ctx = document.getElementById('graficoPizza').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_map(function($label, $perc) {
                    return "$label ({$perc}%)";
                }, $labels, $porcentagens)); ?>,
                datasets: [{
                    data: <?php echo json_encode($valores); ?>,
                    backgroundColor: <?php echo json_encode(array_slice($cores, 0, count($valores))); ?>,
                    borderWidth: 2,
                    borderColor: '#1e1e2f'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#f1f1f1',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
