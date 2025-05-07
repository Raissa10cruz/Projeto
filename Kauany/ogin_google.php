<?php
session_start();
require_once 'config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = file_get_contents("php://input");
    $data = json_decode($token);

    if (isset($data->credential)) {
        $credential = $data->credential;

        // Verifica com Google (decodifica token JWT)
        $url = "https://oauth2.googleapis.com/tokeninfo?id_token=$credential";
        $response = file_get_contents($url);
        $userInfo = json_decode($response);

        if (isset($userInfo->email)) {
            // Procura no banco
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$userInfo->email]);
            $user = $stmt->fetch();

            if ($user) {
                // Usuário existe, faz login
                $_SESSION['usuario'] = $user['nome'];
                $_SESSION['id'] = $user['id'];
            } else {
                // Cadastra novo usuário (automático)
                $nome = $userInfo->name ?? 'Usuário Google';
                $email = $userInfo->email;
                $senha = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT); // Senha aleatória

                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $email, $senha]);

                $_SESSION['usuario'] = $nome;
                $_SESSION['id'] = $pdo->lastInsertId();
            }

            header("Location: home.php");
            exit;
        }
    }
}

http_response_code(400);
echo "Erro no login com Google.";
?>
