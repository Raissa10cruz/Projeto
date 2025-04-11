
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$dbname = 'sistema_cadastro';
$usuario = 'root';
$senha_db = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar'];
    $data_nascimento = $_POST['data'];
    $sobre_mim = ''; // opcional

    // Verifica se as senhas conferem
    if ($senha !== $confirmar) {
        $mensagem = "❌ As senhas não coincidem!";
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Upload da imagem
        $foto_perfil = '';
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $extensao = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $novo_nome = uniqid('foto_', true) . '.' . $extensao;
            $destino = 'uploads/' . $novo_nome;

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destino)) {
                $foto_perfil = $novo_nome;
            }
        }

        // Inserir no banco
        try {
            $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, sobre_mim, foto_perfil, created_at, updated_at) 
                    VALUES (:nome, :email, :senha, :data_nascimento, :sobre_mim, :foto_perfil, NOW(), NOW())";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha_hash);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->bindParam(':sobre_mim', $sobre_mim);
            $stmt->bindParam(':foto_perfil', $foto_perfil);

            if ($stmt->execute()) {
                $mensagem = "✅ Usuário cadastrado com sucesso!";
            } else {
                $mensagem = "❌ Erro ao cadastrar usuário.";
            }
        } catch (PDOException $e) {
            $mensagem = "❌ Erro no banco de dados: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <form class="form" action="cadastro.php" method="POST" enctype="multipart/form-data">
      <label for="avatarInput" class="avatar"></label>
      <input type="file" name="avatar" id="avatarInput" accept="image/*" style="display: none;">

      <div class="input-nome">
        <label for="nome"><i class="fa-solid fa-user"></i></label>
        <input type="text" id="nome" name="nome" placeholder="Nome" required>
      </div>

      <div class="input-group">
        <label for="email"><i class="fa-solid fa-envelope"></i></label>
        <input type="email" id="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-group">
        <label for="data"><i class="fa-solid fa-calendar-days"></i></label>
        <input type="date" id="data" name="data" required>
      </div>

      <div class="input-row">
        <div class="input-group half">
          <label for="senha"><i class="fa-solid fa-lock"></i></label>
          <input type="password" id="senha" name="senha" placeholder="Senha" required>
        </div>
        <div class="input-group half">
          <label for="confirmar"><i class="fa-solid fa-lock"></i></label>
          <input type="password" id="confirmar" name="confirmar" placeholder="Confirme a Senha" required>
        </div>
      </div>

      <button type="submit" class="btn">Cadastrar</button>

      <p style="color: white; text-align: center; margin-top: 20px;">
  Já tem uma conta? <a href="login.php" style="color: #ffffff; text-decoration: underline;">Entre.</a>
</p>

     <!-- (restante do HTML igual) -->
<?php if (!empty($mensagem)): ?>
  <p style="margin-top: 20px; font-weight: bold; color: <?= str_contains($mensagem, '✅') ? 'green' : 'red' ?>;">
    <?= $mensagem ?>
  </p>
<?php endif; ?>
    </form>
  </div>
</body>
</html>