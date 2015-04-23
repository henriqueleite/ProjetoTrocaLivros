<meta http-equiv="Content-Type" content="text/html, charset=utf-8">
<?php

$con = @mysql_connect("localhost", "root", "") or die("Não foi possível conectar com o servidor de dados!");
mysql_select_db("ajuda", $con) or die("Banco de dados não localizado!");
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

$titulo = $_POST["titulo"];
$tipo = $_POST["tipo"];
$mensagem = $_POST["mensagem"];


$query = mysql_query("insert into ajuda (Titulo, Tipo, Mensagem) values ('$titulo','$tipo','$mensagem')");

if ($query){
	header("Location: Form_Ajuda.php");
}else{
	echo "nao";
}

?>