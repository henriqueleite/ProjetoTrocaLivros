
<?php
ini_set('display_errors', 0 );
error_reporting(0);
	require_once "../Dados/Conexao.php";
	//destruo as variaveis da session.

	session_start();

	$logado = $_SESSION['login'];
	$codigo = $_SESSION['codigo'];
	$tipo = $_SESSION['tipo'];
	$data = date("Y-m-d H:i:s");

	$query2 = mysql_query("update usuario set D_DATA_ULTIMO_LOGIN = '$data' where N_COD_USUARIO = $codigo");

	session_destroy();

	echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
	

?>
