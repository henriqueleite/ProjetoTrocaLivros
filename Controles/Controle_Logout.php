
<?php
	require_once "./Dados/Conexao.php";
	//destruo as variaveis da session.
	session_start();
	date_default_timezone_set("America/Sao_Paulo");

	$logado = $_SESSION['login'];
	$codigo = $_SESSION['codigo'];
	$tipo = $_SESSION['tipo'];
	$data = date("Y-m-d H:i:s");
	$query2 = mysql_query("update usuario set D_DATA_ULTIMO_LOGIN = '$data' where N_COD_USUARIO = $codigo");

	session_destroy();
	session_unset(); 
	header("Location: index.php");  
	die();
?>
