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
  <div id='cssmenu'>
    <div id='container'>
      <ul>
        <li><a href='index.php'><img class='logo' src="LogoTrocaLivro.png"></img></a></li>
        <li class='active'><a href='index.php'><span>ÍNICIO</span></a></li>
        <li><a href='Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
        <li><a href='Form_Ajuda.php'><span>SOBRE</span></a></li>
        <li class='last'><a href='Form_Ajuda.php'><span>CONTATO</span></a></li>
        <li><form name="frmBusca" method="post" action="Buscar.php" >
            <input type="text" name="palavra" />
            <input type="submit"  value="Buscar" /></form></li>

        <?php
          if((isset ($_SESSION['login']) == true)){
            echo "<li class='right'><a href='Logout.php'><span>SAIR</span></a></li>";
            echo "<li class='right'><span class='span'>|</span></li>";  
            echo "<li class='right'><a href='PerfilUsuario.php'><span>PAINEL</span></a></li>";
          } else {
            echo "<li class='right'><a href='Login.php'><span>LOGIN</span></a></li>";
            echo "<li class='right'><a href='CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>";
          }
        ?>
      </ul>
    </div>
  </div>

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

  <footer>
    <div class="bar">
        Rodapé
    </div>
    <div class='footer2'>
    <div class="bar2">
        Copyright © 2015 by Troca Livro
    </div>
    </div>
  </footer>
    
</body>
</html>
