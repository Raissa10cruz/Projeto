<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "site_autoconhecimento";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
        ALTER TABLE usuarios
        ADD COLUMN nome VARCHAR(100) AFTER id,
        ADD COLUMN foto VARCHAR(255) AFTER senha
    ";

    $conn->exec($sql);
    echo "Tabela atualizada com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
