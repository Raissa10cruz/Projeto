<?php
require_once 'config/conexao.php';

$mensagem = "";
$usuario = $_GET['usuario'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novaSenha = $_POST['senha'] ?? '';
    $usuario = $_POST['usuario'] ?? '';

    if (!empty($novaSenha) && !empty($usuario)) {
        // (Opcional) Criptografar a senha com password_hash
        // $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $senhaHash = $novaSenha; // Se quiser sem criptografia, mantenha assim

        $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE email = :usuario");
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        if ($stmt->rowCount()) {
            $mensagem = "Senha redefinida com sucesso!";
        } else {
            $mensagem = "Erro ao redefinir. Verifique o e-mail.";
        }
    } else {
        $mensagem = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="assets/recuperar.css">
</head>
<body>

    <div class="header">Redefinir Senha</div>

    <div class="container">
        <h2>Digite sua nova senha</h2>

        <?php if (!empty($mensagem)): ?>
            <p style="color: #d32f2f; text-align: center; font-weight: bold;"><?= $mensagem ?></p>
        <?php endif; ?>

        <form method="post">
            <label for="senha">Nova Senha</label>
            <input type="password" id="senha" name="senha" required>

            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($_GET['usuario'] ?? ''); ?>">

            <button type="submit">Redefinir Senha</button>
        </form>
        <p><a href="index.php">Voltar para o login</a></p>
    </div>

</body>
</html>
