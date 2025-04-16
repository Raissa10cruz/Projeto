<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['usuario_id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$nova_imagem = '';

if (!empty($_FILES['imagem']['name'])) {
    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $nova_imagem = 'perfil_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nova_imagem);
}

$sql = "UPDATE usuarios SET nome = ?, email = ?" . ($nova_imagem ? ", imagem_perfil = ?" : "") . " WHERE id = ?";
$stmt = $pdo->prepare($sql);

$params = [$nome, $email];
if ($nova_imagem) $params[] = $nova_imagem;
$params[] = $id;

$stmt->execute($params);

header("Location: index.php");
