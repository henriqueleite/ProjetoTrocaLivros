<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!--Como refresh abaixo,direcionamos para a pagina loga.html em 3 segundos -->
<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">
<title>Logout</title>
</head>

<?php
require_once "Conexao.php";
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


echo "<h5 style='width: 900px; margin: 0px auto; font-size: 25px;'>Você foi desconectado e será redirecionado para a página inicial em 3 segundos...</h5>";

?>

<body>
</body>
</html>