<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto de Vida</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="menu">
            <a href="?pagina=inicio" class="<?php echo ($pagina == 'inicio') ? 'active' : ''; ?>">INÍCIO</a>
            <a href="?pagina=sonho" class="<?php echo ($pagina == 'sonho') ? 'active' : ''; ?>">SONHO</a>
            <a href="?pagina=objetivo" class="<?php echo ($pagina == 'objetivo') ? 'active' : ''; ?>">OBJETIVO</a>
            <a href="?pagina=topicos" class="<?php echo ($pagina == 'topicos') ? 'active' : ''; ?>">TÓPICOS</a>
        </div>
    