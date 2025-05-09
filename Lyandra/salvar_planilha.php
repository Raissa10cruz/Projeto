<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["user"]["email"] ?? '';
$titulo = $_POST['titulo'] ?? '';
$conteudo = $_POST['conteudo'] ?? '';

if ($email && $titulo && $conteudo) {
    $stmt = $conn->prepare("INSERT INTO planilhas (email_usuario, titulo, conteudo) VALUES (:email, :titulo, :conteudo)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->execute();
    header("Location: projetos.php"); // volte para sua página principal
    exit;
} else {
    echo "Dados incompletos.";
}
