<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados usando PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pdv";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $password_raw = $_POST["password"] ?? '';

    if (empty($name) || empty($email) || empty($password_raw)) {
        echo "Por favor, preencha todos os campos.";
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        return;
    }

    // Criptografar senha
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    $profile_pic_destination = null;

    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == UPLOAD_ERR_OK) {
        $profile_pic = $_FILES["profile_pic"];
        $profile_pic_name = basename($profile_pic["name"]);
        $profile_pic_tmp = $profile_pic["tmp_name"];
        $profile_pic_destination = "uploads/" . $profile_pic_name;

        if (!is_dir("uploads") || !is_writable("uploads")) {
            echo "Não foi possível salvar a foto de perfil. Verifique se o diretório 'uploads' existe e tem permissão de escrita nele.";
            return;
        }

        if (!move_uploaded_file($profile_pic_tmp, $profile_pic_destination)) {
            echo "Erro ao enviar a foto de perfil.";
            return;
        }
    }

    try {
        if ($profile_pic_destination) {
            $sql = "INSERT INTO users (name, email, password, profile_pic) VALUES (:name, :email, :password, :profile_pic)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":profile_pic", $profile_pic_name);
        } else {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
        }

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o usuário.";
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar o usuário: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDV-Ly</title>
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

<form method="post" enctype="multipart/form-data">
  <div class="container">
  <div class="profile-pic-container">
    <div class="profile-pic">
      <div class="profile-pic-preview">
        <img src="<?= !empty($_SESSION['user']['foto_perfil']) ? $_SESSION['user']['foto_perfil'] : 'perfil.png' ?>" alt="Foto de Perfil" id="profile-image">
      </div>
      <input type="file" name="profile_pic" id="profile_pic" accept="image/*" onchange="openCropper(this.files[0])">
      <label for="profile_pic">
        <img src="/Lyandra/perfil.png" alt="">
      </label>
    </div>
  </div>

  <!-- Botões de salvar/cancelar do cropper -->
  <div class="cropper-container" id="cropper-container" style="display: none;">
    <div class="cropper-wrapper">
      <div class="cropper-image-container">
        <img src="" alt="Foto de Perfil" id="cropper-image">
      </div>
      <div class="cropper-controls">
        <button type="submit">Salvar</button>
        <button type="button" onclick="closeCropper()">Cancelar</button>
      </div>
    </div>
  </div>


      <div class="form-group">
        <label for="name">Nome</label>
        <br>
        <input type="text" id="name" name="name">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <br>
        <input type="email" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <br>
        <input type="password" id="password" name="password">
      </div>
      <button type="submit">Cadastrar</button>
    </form>

    <p style="color: white; text-align: center; margin-top: 20px;">
      Já tem uma conta? <a href="login.php" style="color: #ffffff; text-decoration: underline;">Entre.</a>
    </p>
  </div>

  <script>
    function updateProfilePic(file) {
      const profileImage = document.getElementById('profile-image');
      profileImage.src = URL.createObjectURL(file);
    }

    let cropper;

    function openCropper(file) {
      const cropperContainer = document.getElementById('cropper-container');
      const cropperImage = document.getElementById('cropper-image');

      cropperContainer.style.display = 'flex';
      cropperImage.src = URL.createObjectURL(file);

      cropper = new Cropper(cropperImage, {
        aspectRatio: 1,
        guides: true,
        autoCropArea: 0.8,
        viewMode: 2,
        movable: true,
        zoomable: true,
        cropBoxMovable: true,
        cropBoxResizable: true,
      });
    }

    function cropImage() {
      const croppedCanvas = cropper.getCroppedCanvas();
      const croppedImage = croppedCanvas.toDataURL('image/jpeg');

      console.log(croppedImage);

      closeCropper();
    }

    function closeCropper() {
      const cropperContainer = document.getElementById('cropper-container');
      cropperContainer.style.display = 'none';
      cropper.destroy();
    }
  </script>
</body>
</html>
