<?php 
require_once "../Dados/Conexao.php";
session_start();

if( (!isset ($_SESSION['login']) == true) and (!isset ($_POST['avaliacao']) )){
	unset($_SESSION['login']);
	header('location:../index.php');
}

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo   = $_SESSION['tipo'];
$idtroca = $_SESSION["id_troca"];
$avaliacao = $_POST["avaliacao"];




if(isset($_POST['btAvaliacao'])){

	
	$queryconsulta = mysql_query("SELECT (LIVRO_SOLICITADO.N_COD_USUARIO_IE) AS CODIGOSOLICITADO, (LIVRO_SOLICITANTE.N_COD_USUARIO_IE) AS CODIGOSOLICITANTE
	FROM troca 
	INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO
	INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE
	WHERE troca.N_COD_TROCA = $idtroca LIMIT 1");

	$dadosconsulta = mysql_fetch_array($queryconsulta);
	$codigousuariosolicitado  = $dadosconsulta["CODIGOSOLICITADO"];
	$codigousuariosolicitante = $dadosconsulta["CODIGOSOLICITANTE"];

	
	if ($codigo == $codigousuariosolicitado){
		$queryFinalizar = mysql_query("UPDATE troca SET V_AVALIACAO_TROCA = '$avaliacao' WHERE N_COD_TROCA = $idtroca");
	}else{
		$queryFinalizar = mysql_query("UPDATE troca SET V_AVALIACAO_TROCA_SOLICITANTE = '$avaliacao' WHERE N_COD_TROCA = $idtroca");
	}


	if($queryFinalizar)
	{
		echo "<script>alert('Enviado com susseso');</script>";
		echo "<script>location.href = '../Repositorio/PerfilUsuario.php'</script>";
	}
	else
	{
		echo "<script>alert('Erro ao finalizar troca');history.back();/script>";
	}

}



?>