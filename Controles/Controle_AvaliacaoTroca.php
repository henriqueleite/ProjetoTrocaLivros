<?php

require_once "../Dados/Conexao.php";
session_start();

  $logado = $_SESSION['login'];
  $codigo = $_SESSION['codigo'];
  $tipo = $_SESSION['tipo'];
	//$idLivroSolicitado = $_SESSION['codigoLivroAlt'];

  

	$queryFinalizar = mysql_query("UPDATE troca SET V = 'F', D_DATA_FINALIZOU = '$data', V_STATUS = 'Finalizado' WHERE N_COD_TROCA = $idtroca");
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
else
{
	echo "<script>alert('Voce nao clicou no botao finalizar');history.back();/script>";
}

?>