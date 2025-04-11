<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Projeto de Vida</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Georgia, serif;
      background-image: url('./imgRaissa/flores.jfif'); 
      background-size: cover;
      background-position: center;
      min-height: 100vh;
    }

    .menu-lateral {
      position: fixed;
      top: 40px;
      left: 20px;
      background-color: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(8px);
      border-radius: 15px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .menu-lateral a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      background-color: rgba(255, 255, 255, 0.1);
      padding: 10px 15px;
      border-radius: 10px;
      text-align: center;
      transition: background 0.3s;
    }

    .menu-lateral a:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }

    .topo-direita {
      position: absolute;
      top: 30px;
      right: 40px;
    }

    .btn-acao {
      background-color: #d2b8f4;
      color: white;
      padding: 10px 20px;
      border-radius: 20px;
      border: none;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-acao:hover {
      background-color: #bca0e6;
    }

    .titulo {
      text-align: center;
      color: white;
      margin-top: 80px;
      font-size: 32px;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.4);
    }
  </style>
</head>
<body>

  <div class="menu-lateral">
    <a href="#inicio">INÍCIO</a>
    <a href="#sonho">SONHO</a>
    <a href="#objetivo">OBJETIVO</a>
    <a href="#topicos">TÓPICOS</a>
  </div>

  <div class="topo-direita">
    <button class="btn-acao">Plano de Ação</button>
  </div>

  <div class="titulo">
    <h1>PROJETO DE VIDA</h1>
    <h2>SONHO:</h2>
  </div>

</body>
</html>
