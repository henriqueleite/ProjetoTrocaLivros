<!DOCTYPE html>
<?php
require_once "Conexao.php";
session_start();
?>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="CSS/Ajuda.css">
    <link rel="stylesheet" type="text/css" href="CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>

</head>


<body>
  <?php include('topo.php'); ?>

  <div class='formulario'>
    <h2 class='titulo_formulario'>Formulário de Ajuda/Contato</h2>
    <form method="post" Action="Ajuda.php" class="form">
    <p class="name">
        <label for="name">Título</label>
        <input class='input_formulario' type="text" name="titulo" id="titulo" size="50" placeholder="Título" required/>
    </p>
    <p class="email">
         <label for="name">Tipo</label>
         <select name="tipo" id="tipo" required>
            <option value="1">Dúvida</option>
            <option value="2">Sugestão</option>
         </select>
    </p>
    <p class="text">
        <label for="mensagem">Mensagem</label>
        <textarea name="mensagem" id="mensagem" placeholder="Escreva sua mensagem" required/></textarea>
    </p>
    <p class="submit">
        <input type="submit" value="Enviar" />
    </p>
    </form>
  </div>

  <?php include('rodape.php'); ?>
    
</body>
</html>
