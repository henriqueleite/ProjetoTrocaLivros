<!DOCTYPE html>
<html>
<head>
	<title>Como Funciona</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
	<link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
</head>
<body>
	<div id='cssmenu'>
  <div id='container'>
    <ul>
     <li><a href='index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
     <li class='active'><a href='../index.php'><span>ÍNICIO</span></a></li>
     <li><a href='View_Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
     <li><a href='View_Form_Ajuda.php'><span>SOBRE</span></a></li>
     <li class='last'><a href='View_Form_Ajuda.php'><span>CONTATO</span></a></li>
     <li><form name="frmBusca" method="post" action="View_Buscar.php" >

      <input type="text" name="palavra" />
      <input type="submit"  value="Buscar" />
    </li>
  </form>

  <?php

  if((isset ($_SESSION['login']) == true)){
   echo "<li style='float: right' class='right'><a href='../Controles/Controle_Logout.php'><span>SAIR</span></a></li>";
   echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";  
   echo "<li style='float: right' class='right'><a href='../Repositorio/PerfilUsuario.php'><span>PAINEL</span></a></li>";
 } else {
  echo "<li style='float: right' class='right'><a href='View_Login.php'><span>LOGIN</span></a></li>";
  echo "<li style='float: right' class='right'><a href='View_CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>";
}
?> 
    </ul>
  </div><!--fim div container-->
</div><!--fim div cssmenu-->
	<div id="conteudo">
		<div class="meio">
			<p>O TrocaLivro tem como objetivo de facilitar para os mais necessitados de ter um livro para estudar,
			Você cadastra um livro, um usuario ver o seu livro e solicita para fazer uma troca com um livro que ele tenha
			se você se interessar pelo livro, vocês conversam e marcam um lugar ou envia pelos correios.</p>
			
		</div><!--fim div meio-->
		
	</div><!--fim div conteudo-->
	<?php include "View_rodape.php"; ?>
</body>
</html>