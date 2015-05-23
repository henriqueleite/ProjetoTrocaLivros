<?php
session_start();
require_once"./Dados/Conexao.php";
if(isset($_GET['id']))
{
	$idLivroTroca = $_GET['id'];
	if(isset($_SESSION['idLivroSolicitado']))
	{		
		$idLivroSolicitado = $_SESSION['idLivroSolicitado'];
		$data = date('Y,m,d');		
		$queryInsert = mysql_query("INSERT INTO troca(N_COD_LIVRO, N_COD_LIVRO_SOLICITANTE, D_DATA, V_STATUS) VAlUES($idLivroTroca, $idLivroSolicitado, '$data', 'Pendente')");
		echo $queryInsert;
		if($queryInsert)
		{		
			echo "<script>alert('Solicitacao enviada');</script>";
			echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>";
			//header("Location:PerfilUsuario.php");
		}
	}
	else
	{
		echo "Nao existe a sessao idLivroSolicitado";
	}
}
else
{
	echo "Nao existe o id do vindo do GET";
}


?>