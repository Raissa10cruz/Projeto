<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

$email = $_SESSION["user"]["email"] ?? '';

$stmt = $conn->prepare("SELECT name, email, profile_pic, descricao FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();



// Atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $novoNome = $_POST['name'] ?? $user['name'];
  $descricao = $_POST['descricao'] ?? '';

  // Upload da nova foto
  if (!empty($_FILES['profile_pic']['name'])) {
    $destino = 'uploads/' . basename($_FILES['profile_pic']['name']);
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destino);
    $user['profile_pic'] = basename($_FILES['profile_pic']['name']);
  }

  $stmt = $conn->prepare("UPDATE users SET name = :name, descricao = :descricao, profile_pic = :foto WHERE email = :email");
  $stmt->bindParam(':name', $novoNome);
  $stmt->bindParam(':descricao', $descricao);
  $stmt->bindParam(':foto', $user['profile_pic']);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  header("Location: perfil.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style3.css"> <!-- ou cole o CSS diretamente no <style> -->
</head>
<body>
  <div class="container">
    <form method="post" enctype="multipart/form-data">
      <div class="profile-pic-container">
        <div class="profile-pic" style="background-image: url('uploads/<?= htmlspecialchars($user['profile_pic'] ?? 'padrao.jpg') ?>');">
          <div class="profile-pic-preview">
            <i class="fas fa-camera"></i>
          </div>
          <input type="file" name="profile_pic" accept="image/*">
        </div>
      </div>

      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
      </div>

      <div class="form-group">
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" value="<?= htmlspecialchars($user['descricao'] ?? '') ?>">
      </div>

      <button type="submit">Salvar Alterações</button>
    </form>
  </div>
</body>
</html>
