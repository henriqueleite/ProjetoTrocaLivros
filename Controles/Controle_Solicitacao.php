<?php
require_once "../Dados/Conexao.php";
session_start();

$idtroca = $_POST["codigosolicitacao"];

$query2 = mysql_query("SELECT troca.*, (LIVRO_SOLICITADO.N_COD_USUARIO_IE) AS IDSOLICITADO, (LIVRO_SOLICITANTE.N_COD_USUARIO_IE) AS IDSOLICITANTE, USUARIO_SOLICITANTE.V_NOME, (LIVRO_SOLICITADO.N_COD_LIVRO) AS COD_LIVRO_SOLICITADO, (LIVRO_SOLICITANTE.N_COD_LIVRO) AS COD_LIVRO_SOLICITANTE FROM troca INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE INNER JOIN usuario AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE INNER JOIN usuario AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITANTE.N_COD_USUARIO_IE WHERE troca.N_COD_TROCA = '$idtroca'");

$livros = mysql_fetch_array($query2);

$CODLIVROSOLICITADO = $livros["COD_LIVRO_SOLICITADO"];
$CODLIVROSOLICITANTE = $livros["COD_LIVRO_SOLICITANTE"];

$coluna = mysql_fetch_array($query2);

$NOME = $coluna["V_NOME"];
$_SESSION["id_troca"] = $idtroca;
$_SESSION["id_solicitado"] = $coluna['IDSOLICITADO'];
$_SESSION["id_solicitante"] = $coluna['IDSOLICITANTE'];

if(isset($_POST['Ver']) == 'Aceitar')
{

  $query3 = mysql_query("UPDATE livro SET B_ATIVO = 'F' WHERE N_COD_LIVRO = $CODLIVROSOLICITADO");
  $query4 = mysql_query("UPDATE livro SET B_ATIVO = 'F' WHERE N_COD_LIVRO = $CODLIVROSOLICITANTE");
  $query = mysql_query("UPDATE troca SET V_STATUS = 'ACEITO' where  N_COD_TROCA = $idtroca");
  if($query)
  {
	$query6 = mysql_query("DELETE FROM troca where N_COD_LIVRO = $CODLIVROSOLICITADO and N_COD_TROCA <> $idtroca AND V_STATUS='Pendente'");
	echo "<meta http-equiv='refresh' content='0, url=../Views/View_ChatTroca.php'>";
  }
}
  
 if(isset($_POST['Recusar']) == 'Recusar')
{
  $quer5 = mysql_query("DELETE FROM troca where N_COD_TROCA = $idtroca");
  if($query5)
  {
	unset($_SESSION['$idtroca']);
  }
	echo "<script>history.back();</script>";
}

?>