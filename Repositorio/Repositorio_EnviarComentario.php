<?php
require_once "../Dados/Conexao.php";
session_start();

$codigo = $_SESSION["codigo"];
$mensagem = strtoupper($_POST["comentario"]);
$livro = $_SESSION['codigoLivroAlt'];
$data = date("Y-m-d");

if ($mensagem == ''){
	echo "<script>alert('Você não pode mandar um comentário em branco !! '); history.back();</script>";	
}else{
$query2 = mysql_query("INSERT INTO comentario (N_COD_USUARIO_IE, N_COD_LIVRO_IE, V_COMENTARIO, D_DATA) VALUES ($codigo, $livro, '$mensagem', '$data')");
 
if ($query2){

	header("Location: ../Views/View_VisualizarLivro.php?id=$livro");
}
}
?>