<!DOCTYPE html>
<?php
require_once "Conexao.php";
session_start();
if((!isset($_SESSION['login']) == true))
{
	unset($_SESSION['login']);
	header('location:index.php');
}

$nomeLogado = $_SESSION['login'];
$idLogado = $_SESSION['codigo'];
$tipoLogado = $_SESSION['tipo'];;

?>
<html>
<head>
	<title>Troca Livro</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<link rel="stylesheet" type="text/css" href="CSS/Menu.css">
	<link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
</script>
</head>
<body>
	<?php include('topo.php'); ?>

	<?php 
		//faço uma consulta de todos os livros do usuario logado para realizar a troca
		$queryListar = mysql_query("SELECT * FROM livro WHERE N_COD_USUARIO_IE = $idLogado");
		if($queryListar)
		{
			while($resultado = mysql_fetch_array($queryListar))
			{
				$titulo = $resultado['V_TITULO'];
				$idLivroTroca = $resultado['N_COD_LIVRO'];

			?>
				<div style="border:1px solid #ccc; width: 300px; margin-top: 10px">
					<h3>Livro: <a href=""><?php echo $titulo; ?></a></h3>&nbsp<a href="funcaoAceitarTroca.php?id=<?php echo $idLivroTroca; ?>">Trocar</a>
				</div>
			<?php				
			}						
		}
		else
		{
			echo "Erro na consulta";
		}
	?>








	<?php include('rodape.php'); ?>
</body>
</html>