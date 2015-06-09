<!DOCTYPE html>
<?php
require_once "../Dados/Conexao.php";
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
    <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
    <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>
</head>
<body>
    <?php include('../Views/View_topo_administrador.php'); ?>


    <div style="height: 700px; "id='corpo'>
    	<h2>Painel Administrativo</h2>

    
            <input style="width: 270px; height: 100px; margin-left: 70px; margin-top: 250px;" type="submit" value="GERENCIAR USUÁRIOS" class="btn" id="btn" onclick="javascript: location.href='../Repositorio/Repositorio_GerenciarUsuario.php';">
            <input style="width: 270px; height: 100px; margin: 0 em auto;" type="submit" value="EVENTOS / CAMPANHAS" class="btn" id="btn">
            <input style="width: 270px; height: 100px; margin: 0 em auto;" type="submit" value="SUPORTE" class="btn" id="btn" onclick="javascript: location.href='../Views/View_Suporte.php';">

    </div>

 <?php include('../Views/View_rodape.php'); ?>
</body>
</html>
