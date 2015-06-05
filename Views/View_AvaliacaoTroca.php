<!DOCTYPE html>
<?php
session_start();
require_once "../Dados/Conexao.php";

if(isset( $_SESSION["id_troca"]))
{

}
else
{
  header("Location: ../Repositorio/PerfilUsuario.php");  
  die();
}

if((isset ($_SESSION['login']) == true))
{
  $logado = $_SESSION['login'];
  $codigo = $_SESSION['codigo'];
  $tipo = $_SESSION['tipo'];
}


?>
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <!--<link rel="stylesheet" href="style.css" media="all" />-->
  <link rel="stylesheet" type="text/css" href="../CSS/VisualizarLivro.css">
  <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">

  <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
  <script type="text/javascript" src="../jquery.js"></script>
  <script type="text/javascript" src="../jquery.rating.js"></script>
  <script type="text/javascript">
    jQuery(function(){
      jQuery('form.rating').rating();
    });
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
     echo "<li style='float: right' class='right'><a href='../Controles/Controle_Logout.php'><span>SAIR</span></a></li>";
     echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";  
     echo "<li style='float: right' class='right'><a href='../Repositorio/PerfilUsuario.php'><span>PAINEL</span></a></li>";
   } else {
    echo "<li style='float: right' class='right'><a href='../Views/View_Login.php'><span>LOGIN</span></a></li>";
    echo "<li style='float: right' class='right'><a href='#'><span>CADASTRAR-SE</span></a></li>";
  }
  ?> 

</ul>
</div><!--fim div container-->
</div><!--fim div cssmenu-->

<div id="corpo">
  <h2>Avaliação da Troca</h2>
     <form method="post" action="../Repositorio/Repositorio_AvaliacaoTroca.php">
      <textarea name="avaliacao" id="avaliacao" required></textarea>
      <input type="submit" value="Enviar Avaliação"/>
   

    </form>  
</div>
</form> 
<?php include('View_rodape.php'); ?>
</body>
</html>
