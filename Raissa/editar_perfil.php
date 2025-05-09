<?php
session_start();
include 'conexao.php'; 

// Substitua isso com o ID real da sessão do usuário
$usuario_id = $_SESSION['usuario_id'] ?? 1;

try {
    // Buscar dados atuais do usuário
    $stmt = $pdo->prepare("SELECT nome, email, imagem_perfil FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar usuário: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $novo_nome = $_POST['novo_nome'] ?? '';
    $novo_email = $_POST['novo_email'] ?? '';

    $imagem_nome = '';
    if (isset($_FILES['nova_imagem']) && $_FILES['nova_imagem']['name']) {
        $imagem_nome = "perfil_" . time() . "_" . basename($_FILES['nova_imagem']['name']);
        $destino = "imgRaissa/" . $imagem_nome;

        if (!move_uploaded_file($_FILES['nova_imagem']['tmp_name'], $destino)) {
            die("Erro ao enviar a imagem.");
        }
    }

    try {
        if ($imagem_nome) {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, imagem_perfil = :imagem WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $novo_nome);
            $stmt->bindParam(':email', $novo_email);
            $stmt->bindParam(':imagem', $imagem_nome);
            $stmt->bindParam(':id', $usuario_id);
        } else {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $novo_nome);
            $stmt->bindParam(':email', $novo_email);
            $stmt->bindParam(':id', $usuario_id);
        }

        if ($stmt->execute()) {
            header("Location: dashboard.php?msg=Perfil atualizado com sucesso!");
            exit();
        } else {
            echo "Erro ao atualizar perfil.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('./imgRaissa/Flower hd 4k wallpaper 1920x1080 laptop desktop wpp_ 🌹.jfif') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
      padding: 40px;
      width: 350px;
      color: #fff;
      text-align: center;
      position: relative;
    }

    .card h2 {
      margin-bottom: 20px;
      color: #fff;
    }

    .form-group {
      text-align: left;
      margin-bottom: 15px;
    }

    .form-group label {
      font-weight: bold;
      color: #fff;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 10px;
      outline: none;
      margin-top: 5px;
      background: rgba(255, 255, 255, 0.3);
      color: #000;
    }

    .form-group input[type="file"] {
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
    }

    .btn {
      background-color: #b89eff;
      color: white;
      border: none;
      border-radius: 20px;
      padding: 12px;
      width: 100%;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
      margin-top: 15px;
    }

    .btn:hover {
      background-color: #a182ff;
    }

    .btn-voltar {
      position: absolute;
      top: 15px;
      left: 15px;
      background-color: #b89eff;
      color: white;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: bold;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      transition: background-color 0.3s ease;
      font-size: 14px;
    }

    .btn-voltar:hover {
      background-color: #a182ff;
    }

    .foto-perfil-atual {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid white;
      margin: 10px auto;
      display: block;
    }
  </style>
</head>
<body>

<div class="card">
  <a href="dashboard.php" class="btn-voltar">← Voltar</a>

  <h2>Editar Perfil</h2>

  <!-- Foto de perfil atual -->
  <img src="imgRaissa/<?= htmlspecialchars($usuario['imagem_perfil'] ?? 'User_Clipart_PNG_Images__User_Avatar_Login_Interface_Abstract_Purple_User_Icon__Avatar__User__Login_Avatar_PNG_Image_For_Free_Download-removebg-preview.png') ?>" alt="Foto de Perfil" class="foto-perfil-atual">

  <form action="editar_perfil.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="novo_nome">Nome:</label>
      <input type="text" name="novo_nome" id="novo_nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
    </div>

    <div class="form-group">
      <label for="novo_email">Email:</label>
      <input type="email" name="novo_email" id="novo_email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
    </div>

    <div class="form-group">
      <label for="nova_imagem">Nova Imagem de Perfil:</label>
      <input type="file" name="nova_imagem" id="nova_imagem" accept="image/*">
    </div>

    <button type="submit" class="btn">Salvar Alterações</button>
  </form>
</div>

</body>
</html>
