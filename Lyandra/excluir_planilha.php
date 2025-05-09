<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $emailSessao = $_SESSION["user"]["email"] ?? '';

    // Confirma que o item pertence ao usuário logado
    $stmt = $conn->prepare("DELETE FROM planilhas WHERE id = :id AND email_usuario = :email");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $emailSessao);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir']);
    }
}
?>
