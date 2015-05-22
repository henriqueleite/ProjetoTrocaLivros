<!DOCTYPE html>
<?php
require_once "../Dados/Conexao.php";
session_start();
?>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../CSS/Ajuda.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>

</head>


<body>
  <div id='cssmenu'>
  <div id='container'>
    <ul>
     <li><a href='../index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
     <li class='active'><a href='../index.php'><span>ÍNICIO</span></a></li>
     <li><a href='../Views/View_Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
     <li><a href='../Views/View_Form_Ajuda.php'><span>SOBRE</span></a></li>
     <li class='last'><a href='../Views/View_Form_Ajuda.php'><span>CONTATO</span></a></li>
     <li><form name="frmBusca" method="post" action="iew_Buscar.php" >

      <input type="text" name="palavra" />
      <input type="submit"  value="Buscar" />
    </li>
  </form>

  <?php

  if((isset ($_SESSION['login']) == true)){
   echo "<li style='float: right' class='right'><a href='./Controles/Controle_Logout.php'><span>SAIR</span></a></li>";
   echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";  
   echo "<li style='float: right' class='right'><a href='Repositorio/PerfilUsuario.php'><span>PAINEL</span></a></li>";
 } else {
  echo "<li style='float: right' class='right'><a href='../Views/View_Login.php'><span>LOGIN</span></a></li>";
  echo "<li style='float: right' class='right'><a href='../Views/View_CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>";
}
?> 

    </ul>
  </div><!--fim div container-->
</div><!--fim div cssmenu-->

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
            <option value="Dúvida">Dúvida</option>
            <option value="Sugestão">Sugestão</option>
            <option value="Reclamação">Reclamação</option>
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

  <?php include('View_rodape.php'); ?>
    
</body>
</html>
