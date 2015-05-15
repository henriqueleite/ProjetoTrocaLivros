<!DOCTYPE html>
<?php
require_once "Conexao.php";
session_start();
if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:index.php');

}else if ($_SESSION['tipo'] != 1)
{
  unset($_SESSION['login']);
  header('location:index.php'); 
}

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];

?>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="stylesheet" type="text/css" href="CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>
</head>
<body>
  <div id='cssmenu'>
      <div id='container'>
        <ul>
           <li><a href='index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
           <li><a href='GerenciarUsuario.php'><span>GERENCIAR USUÁRIOS</span></a></li>
           <li><a href='index.php'><span>EVENTO/CAMPANHA</span></a></li>
           <li style="float: right" class="right"><a href='Logout.php'><span>SAIR</span></a></li>
           <li style="float: right" class="right"><span style="margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; ">|</span></li>  
           <li class='active' style="float: right" class="right"><a href='PerfilAdministrador.php'><span>PAINEL</span></a></li> 
        </ul>
      </div>
    </div>


    <div style="height: 700px; "id='corpo'>
    	<h2>Painel Administrativo</h2>

    
            <input style="width: 300px; height: 100px; margin-left: 175px; margin-top: 250px;" type="submit" value="GERENCIAR USUÁRIOS" class="btn" id="btn" onclick="javascript: location.href='GerenciarUsuario.php';">
            <input style="width: 300px; height: 100px; margin: 0 em auto;" type="submit" value="EVENTOS / CAMPANHAS" class="btn" id="btn">

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
