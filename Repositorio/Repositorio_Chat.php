<?php
require_once "../Dados/Conexao.php";
session_start();
date_default_timezone_set("America/Sao_Paulo");

$mensagem = $_POST['mensagem'];
$para = $_SESSION["id_troca"];
$de = $_SESSION['codigo'];

$data = date("Y-m-d H:i:s");

if ($mensagem == ''){
	echo "<script>alert('Você não pode mandar uma mensagem em branco !! '); history.back();</script>";	
}else{
$query2 = mysql_query("INSERT INTO mensagens_troca (N_COD_TROCA_IE, N_USUARIO_DE, V_MENSAGEM, D_DATA_MENSAGEM) VALUES ($para, $de, '$mensagem', '$data')");
 
if ($query2){
	header('location: ../Views/View_ChatTroca.php');
}
}
?>