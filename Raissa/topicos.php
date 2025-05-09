<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
    exit();
}

// Conexão com o banco
$host = "localhost";
$user = "root";
$pass = "";
$db = "site_autoconhecimento";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT nome, email, imagem_perfil FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['usuario_id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Projeto de Vida</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Georgia, serif;
            background: url('./imgRaissa/flores.jfif') no-repeat center center fixed;
            background-size: cover;
            overflow-x: hidden;
        }

        .menu-toggle {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
            z-index: 1001;
        }

        .menu-toggle.rotated {
            transform: rotate(90deg);
        }

        .menu-toggle span {
            display: block;
            width: 22px;
            height: 2px;
            background-color: #fff;
            position: relative;
        }

        .menu-toggle span::before,
        .menu-toggle span::after {
            content: '';
            position: absolute;
            width: 22px;
            height: 2px;
            background-color: #fff;
            transition: 0.3s;
        }

        .menu-toggle span::before { top: -6px; }
        .menu-toggle span::after { top: 6px; }

        .menu {
            position: fixed;
            top: 80px;
            left: -220px;
            background-color: rgba(255, 255, 255, 0.25);
            border-radius: 15px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 180px;
            transition: left 0.4s ease;
            z-index: 1000;
        }

        .menu.show { left: 20px; }

        .menu a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            border-bottom: 1px solid white;
            padding-bottom: 5px;
            transition: 0.3s;
        }

        .menu a:hover { color: #f0e6ff; }

        .header {
            text-align: center;
            margin-top: 40px;
            font-size: 30px;
            color: white;
            font-weight: bold;
            text-shadow: 1px 1px 5px #000;
        }

        .top-bar {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            z-index: 1002;
        }

        .avatar-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
            transition: transform 0.3s ease;
        }

        .avatar-img:hover {
            transform: scale(1.05);
        }

        .profile-info {
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-align: right;
        }

        .btn-acao, .btn-logout {
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            color: white;
        }

        .btn-acao {
            background-color: #d2b8f4;
        }

        .btn-acao:hover {
            background-color: #c09cf3;
        }

        .btn-logout {
            background-color: #f36c6c;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background-color: #e15050;
        }

        .container-principal {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            margin: 40px auto;
        }

        .linha-superior,
        .linha-inferior {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .caixa {
            background-color: white;
            border-radius: 15px;
            width: 220px;
            height: 260px;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            text-align: center;
            font-family: Georgia, serif;
            font-size: 18px;
            font-weight: bold;
            color: black;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .caixa:hover {
            transform: scale(1.05);
        }

        .caixa img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .caixa-link {
            text-decoration: none;
            color: inherit;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="menu-toggle" onclick="toggleMenu()"><span></span></div>

    <div class="menu" id="menuLateral">
        <a href="dashboard.php">INÍCIO</a>
        <a href="sonho.php">SONHO</a>
        <a href="objetivo.php">OBJETIVO</a>
        <a href="topicos.php">TÓPICOS</a>
        <a href="quemsoueu.php">QUEM SOU EU?</a>
    </div>

    <div class="header">PROJETO DE VIDA</div>

    <div class="top-bar">
        <div class="profile-info">
            <?= htmlspecialchars($user['nome']) ?><br>
        </div>

        <?php
        $avatarPadrao = './imgRaissa/User_Clipart_PNG_Images__User_Avatar_Login_Interface_Abstract_Purple_User_Icon__Avatar__User__Login_Avatar_PNG_Image_For_Free_Download-removebg-preview.png';
        $caminhoImagem = (!empty($user['imagem_perfil']) && file_exists('./imgRaissa/' . $user['imagem_perfil']))
            ? './imgRaissa/' . htmlspecialchars($user['imagem_perfil'])
            : $avatarPadrao;
        ?>

        <a href="editar_perfil.php" title="Editar Perfil">
            <img src="<?= $caminhoImagem ?>" alt="Foto de Perfil" class="avatar-img">
        </a>

        <button class="btn-acao" onclick="location.href='plano_acao.php'">Plano de Ação</button>
        <button class="btn-logout" onclick="location.href='logout.php'">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-logout" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
        </button>
    </div>

    <div class="container-principal">
        <div class="linha-superior">
            <a href="profissoes.php" class="caixa-link">
                <div class="caixa">
                    <img src="./imgRaissa/Empregos e profissões _ Vetor Premium.jfif" alt="Imagem 1">
                    <div class="titulo-card">PROFISSÕES</div>
                </div>
            </a>
            <a href="teste-personalidade.php" class="caixa-link">
                <div class="caixa">
                    <img src="./imgRaissa/Analistas.jfif" alt="Imagem 2">
                    <div class="titulo-card">TESTE DE PERSONALIDADE</div>
                </div>
            </a>
            <a href="teste-inteligencias.php" class="caixa-link">
                <div class="caixa">
                    <img src="./imgRaissa/download (8).jfif" alt="Imagem 3">
                    <div class="titulo-card">TESTE DE MÚLTIPLAS INTELIGÊNCIAS</div>
                </div>
            </a>
        </div>
        <div class="linha-inferior">
            <a href="projeto-de-vida.php" class="caixa-link">
                <div class="caixa">
                    <img src="./imgRaissa/50 dicas para obter sucesso.jfif" alt="Imagem 4">
                    <div class="titulo-card">O QUE É O PROJETO DE VIDA?</div>
                </div>
            </a>
            <a href="como-ter-projeto-de-vida.php" class="caixa-link">
                <div class="caixa">
                    <img src="./imgRaissa/Homem de negócios meditando _ Vetor Grátis.jfif" alt="Imagem 5">
                    <div class="titulo-card">COMO TER UM PROJETO DE VIDA?</div>
                </div>
            </a>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menuLateral');
            const menuToggle = document.querySelector('.menu-toggle');
            menu.classList.toggle('show');
            menuToggle.classList.toggle('rotated');
        }
    </script>

</body>
</html>
