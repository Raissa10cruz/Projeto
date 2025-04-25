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
    <title>Meu Plano de Ação</title>
    <link rel="stylesheet" href="estilo.css"> <!-- mesmo css do "quem sou" -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('kauany.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
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

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 14px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .frase {
            font-style: italic;
            margin-top: 30px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="menu-icons">
        <a href="home.php" title="Voltar"><img src="3.png" alt="Voltar"></a>
        <a href="perfil.php" title="Perfil"><img src="2.png" alt="Perfil"></a>
        <a href="logout.php" title="Sair"><img src="icone1.png" alt="Sair"></a>
        </div>

    <div class="container">
        <h1>Meu Plano de Ação</h1>

        <table>
            <thead>
                <tr>
                    <th>Etapa</th>
                    <th>Ação</th>
                    <th>Prazo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Aprovação no ENEM/Vestibular</td>
                    <td>Estudar 4h/dia, fazer simulados, treinar inglês com séries</td>
                    <td>Até nov/dez 2025</td>
                    <td>Em andamento</td>
                </tr>
                <tr>
                    <td>Plano B em Ação</td>
                    <td>Pesquisar faculdades, fazer inscrições paralelas</td>
                    <td>Paralelo à etapa 1</td>
                    <td>Ativando plano B com estilo</td>
                </tr>
                <tr>
                    <td>Idiomas para dominar o mundo</td>
                    <td>Praticar inglês, reforçar espanhol, iniciar francês, alemão e russo</td>
                    <td>Até 2028</td>
                    <td>Multilíngue a caminho</td>
                </tr>
                <tr>
                    <td>Autocuidado e Criatividade</td>
                    <td>Cozinhar, escrever, jogar vôlei e manter equilíbrio</td>
                    <td>Permanente</td>
                    <td>Já sendo Kauany em modo completo</td>
                </tr>
                <tr>
                    <td>Cidadania e Justiça</td>
                    <td>Participar de ações sociais, escrever sobre justiça, debater</td>
                    <td>Desde já até sempre</td>
                    <td>Justiceira de jaleco ativada</td>
                </tr>
                <tr>
                    <td>Futuro Pessoal e Familiar</td>
                    <td>Guardar ideias, planejar metas, manter valores firmes</td>
                    <td>Próximos anos</td>
                    <td>Em andamento</td>
                </tr>
            </tbody>
        </table>

        <p class="frase">"Se for pra viver, que seja com garra, livros raros, um jaleco branco e muito café."</p>
    </div>

</body>
</html>
