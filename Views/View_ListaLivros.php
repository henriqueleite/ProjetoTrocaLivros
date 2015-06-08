<!DOCTYPE html>
<?php
require_once "../Dados/Conexao.php";
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
	<link rel="stylesheet" type="text/css" href="../CSS/ListaLivro.css">
	<link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
	<link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
	<link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
</script>
</head>
<body>
	  <?php include('../Views/View_topo.php'); ?>
	<div id='corpo'>  
		<h2>Selecione um livro seu para solicitar a troca</h2>
		<h3>Livros desejados do usuario solicitado:</h3>
	<?php 
		//faço uma consulta de todos os livros do usuario logado para realizar a troca
		$queryListar = mysql_query("SELECT * FROM livro WHERE N_COD_USUARIO_IE = $idLogado and B_ATIVO = 'T'");

		$queryusuario = mysql_query("SELECT LIVRO.*, usuario.N_COD_USUARIO FROM livro INNER JOIN USUARIO ON USUARIO.N_COD_USUARIO = LIVRO.N_COD_USUARIO_IE WHERE LIVRO.N_COD_LIVRO = ".$_SESSION['idLivroSolicitado']."");

		$dadosusuario = mysql_fetch_array($queryusuario);
		$codigousuariosolicitado = $dadosusuario["N_COD_USUARIO"];

		$querylivrosdesejados = mysql_query("SELECT * FROM LIVRO_DESEJADO WHERE LIVRO_DESEJADO.N_COD_USUARIO_IE = $codigousuariosolicitado");

		if($querylivrosdesejados)
		{
			while($resultadolivrodesejado = mysql_fetch_array($querylivrosdesejados))
			{
				$titulolivrodesejado      = $resultadolivrodesejado['V_TITULO'];
				$arraytitulodesejado = array($resultadolivrodesejado['V_TITULO']);


			?>
			

					<span class="h4">Título: <a><?php echo $titulolivrodesejado; ?></a></span>

			<?php				
			}						
		}
		?>
		<h3>Seus Livros:</h3>
		<?php

		if($queryListar)
		{
			while($resultado = mysql_fetch_array($queryListar))
			{
				$titulo       = $resultado['V_TITULO'];
				$idLivroTroca = $resultado['N_COD_LIVRO'];
				$foto         = $resultado['V_FOTO'];
				$autor        = $resultado['V_AUTOR'];
				$arraytitulo = array($resultado['V_TITULO']);

			?>
			
				<div style="border:1px solid #ccc; width: 200px; margin-top: 10px; margin-bottom: 15px; text-align: center">
					      <p style="margin-bottom: 0px;"><img style= "margin-top: -16px; border: 2px solid #133141;" src="../<?php echo $foto; ?>"width="110" height="110"></p>
					<span class="h5">Título: <a><?php echo $titulo; ?></a></span>
					&nbsp
					<a href="../Controles/Controle_funcaoAceitarTroca.php?id=<?php echo $idLivroTroca; ?>"><button class="btn">Trocar</button></a>
				</div>


			<?php	
			$result = array_intersect($arraytitulodesejado, $arraytitulo);
			echo "<span class='h6'>Quantidade de Livros que você tem que interessam ao solicitado: " . count($result) . "</span>";		
			}						
		}
		else
		{
			echo "Erro na consulta";
			header("Location: index.php");  
			die();
		}
	?>
</div>
	<?php include('../Views/View_rodape.php'); ?>
</body>
</html>