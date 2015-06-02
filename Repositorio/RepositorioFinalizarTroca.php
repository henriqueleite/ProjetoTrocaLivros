<?php 
require_once "../Dados/Conexao.php";
session_start();

if(isset($_POST['btfinalizar']))
{
	$idtroca = $_SESSION["id_troca"];
	$data = date("Y-m-d H:i:s");
	$idLivroSolicitado = $_SESSION['codigoLivroAlt'];
	$queryFinalizar = mysql_query("UPDATE troca SET B_ATIVO = 'F', D_DATA_FINALIZOU = '$data', V_STATUS = 'Finalizado' WHERE N_COD_TROCA = $idtroca");
	if($queryFinalizar)
	{
		echo "<script>alert('Troca Finalizada');</script>";
		echo "<script>location.href = 'PerfilUsuario.php'</script>";

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