<?php 
$conecta = mysql_connect("mysql.trocalivros.kinghost.net", "trocalivros", "projeto2015") or die("Não foi possível conectar com o servidor de dados!"); 
mysql_select_db("trocalivros", $conecta) or die("Banco de dados não localizado!");
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
date_default_timezone_set("America/Sao_Paulo");

?>