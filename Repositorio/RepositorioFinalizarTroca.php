<?php 
require_once "../Dados/Conexao.php";
session_start();

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];
$idtroca = $_SESSION["id_troca"];


if(isset($_POST['btfinalizar']))
{

	$queryconsulta = mysql_query("SELECT (LIVRO_SOLICITADO.N_COD_USUARIO_IE) AS CODIGOSOLICITADO, (LIVRO_SOLICITANTE.N_COD_USUARIO_IE) AS CODIGOSOLICITANTE, (LIVRO_SOLICITADO.N_COD_LIVRO) AS LIVROSOLICITADO, (LIVRO_SOLICITANTE.N_COD_LIVRO) AS LIVROSOLICITANTE
	FROM troca 
	INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO
	INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE
	WHERE troca.N_COD_TROCA = $idtroca LIMIT 1");

	$dadosconsulta = mysql_fetch_array($queryconsulta);
	$codigousuariosolicitado = $dadosconsulta["CODIGOSOLICITADO"];
	$codigousuariosolicitante = $dadosconsulta["CODIGOSOLICITANTE"];
	$codigolivrosolicitado = $dadosconsulta["LIVROSOLICITADO"];
	$codigolivrosolicitante = $dadosconsulta["LIVROSOLICITANTE"];
	
	if ($codigo != $codigousuariosolicitado){
		echo "<script>alert('Somente o usuário solicitado pode finalizar a troca !! '); history.back();</script>";	
	}else{
	$data = date("Y-m-d H:i:s");
	//$idLivroSolicitado = $_SESSION['codigoLivroAlt'];
	$queryFinalizar = mysql_query("UPDATE troca SET B_ATIVO = 'F', D_DATA_FINALIZOU = '$data', V_STATUS = 'Finalizado' WHERE N_COD_TROCA = $idtroca");
	if($queryFinalizar)
	{
		echo "<script>alert('Troca Finalizada');</script>";
		echo "<script>location.href = '../Views/View_AvaliacaoTroca.php'</script>";
	}
	else
	{
		echo "<script>alert('Erro ao finalizar troca');history.back();/script>";
	}
}
}



?>