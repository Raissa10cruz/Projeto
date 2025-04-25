<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto_perfil'])) {
    // Configurações de upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto_perfil"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar se o arquivo é uma imagem
    if (getimagesize($_FILES["foto_perfil"]["tmp_name"]) === false) {
        echo "Arquivo não é uma imagem.";
        $uploadOk = 0;
    }

    // Verificar se o arquivo já existe
    if (file_exists($target_file)) {
        echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

    // Limitar o tamanho do arquivo (5MB)
    if ($_FILES["foto_perfil"]["size"] > 5000000) {
        echo "Desculpe, o arquivo é muito grande.";
        $uploadOk = 0;
    }

    // Apenas permitir determinados formatos de imagem
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
        $uploadOk = 0;
    }

    // Verificar se $uploadOk está definido como 0 por um erro
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi enviado.";
    } else {
        if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $target_file)) {
            // Atualizar o banco de dados com a nova foto
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "site_autoconhecimento";

            try {
                $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("UPDATE usuarios SET foto = :foto WHERE id = :id");
                $stmt->bindParam(':foto', $target_file);
                $stmt->bindParam(':id', $_SESSION['usuario_id']);
                $stmt->execute();

                echo "A foto foi alterada com sucesso!";
                header("Location: projeto_de_vida.php"); // Redirecionar de volta
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        } else {
            echo "Desculpe, ocorreu um erro ao enviar o arquivo.";
        }
    }
}
?>
