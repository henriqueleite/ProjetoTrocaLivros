<?php
require_once "../Dados/Conexao.php";
session_start();

$mensagem = $_POST['mensagem'];
$para = $_SESSION["id_troca"];
$de = $_SESSION['codigo'];


if ($mensagem == ''){
	echo "<script>alert('Você não pode mandar uma mensagem em branco !! '); history.back();</script>";	
}else{
$query2 = mysql_query("INSERT INTO mensagens_troca (N_COD_TROCA_IE, N_USUARIO_DE, V_MENSAGEM) VALUES ($para, $de, '$mensagem')");
 
if ($query2){
	header('location: ../Views/View_ChatTroca.php');
}
}
?>