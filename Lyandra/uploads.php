<?php // Verificar se o arquivo foi enviado 
if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) { $file = $_FILES['file']; $target_dir = "uploads/"; $target_file = $target_dir . basename($file["name"]); 
 if (!is_dir($target_dir) || !is_writable($target_dir)) { 
    echo "O diretório de uploads não existe ou você não tem permissão de escrita nele."; exit; } 
     if (move_uploaded_file($file["tmp_name"], $target_file)) { echo "Arquivo enviado com sucesso."; } 
     else { echo "Erro ao enviar o arquivo."; } } 
     else { echo "Nenhum arquivo foi enviado."; } ?> 
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data"> 
    <input type="file" name="file" id="file"> 
    <input type="submit" value="Enviar" name="submit"> </form>