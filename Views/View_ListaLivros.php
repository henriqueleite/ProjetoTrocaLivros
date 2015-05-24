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
	<link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
	<link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
	<link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
</script>
</head>
<body>
	  <div id='cssmenu'>
  <div id='container'>
    <ul>
     <li><a href='../index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
     <li class='active'><a href='../index.php'><span>ÍNICIO</span></a></li>
     <li><a href='../Views/View_Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
     <li><a href='../Views/View_Form_Ajuda.php'><span>SOBRE</span></a></li>
     <li class='last'><a href='../Views/View_Form_Ajuda.php'><span>CONTATO</span></a></li>
     <li><form name="frmBusca" method="post" action="iew_Buscar.php" >

      <input type="text" name="palavra" />
      <input type="submit"  value="Buscar" />
    </li>
  </form>

  <?php

  if((isset ($_SESSION['login']) == true)){
   echo "<li style='float: right' class='right'><a href='../Controles/Controle_Logout.php'><span>SAIR</span></a></li>";
   echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";  
   echo "<li style='float: right' class='right'><a href='../Repositorio/PerfilUsuario.php'><span>PAINEL</span></a></li>";
 } else {
  echo "<li style='float: right' class='right'><a href='../Views/View_Login.php'><span>LOGIN</span></a></li>";
  echo "<li style='float: right' class='right'><a href='#'><span>CADASTRAR-SE</span></a></li>";
}
?> 

    </ul>
  </div><!--fim div container-->
</div><!--fim div cssmenu-->

	<?php 
		//faço uma consulta de todos os livros do usuario logado para realizar a troca
		$queryListar = mysql_query("SELECT * FROM livro WHERE N_COD_USUARIO_IE = $idLogado");
		if($queryListar)
		{
			while($resultado = mysql_fetch_array($queryListar))
			{
				$titulo       = $resultado['V_TITULO'];
				$idLivroTroca = $resultado['N_COD_LIVRO'];
				$foto         = $resultado['V_FOTO'];
				$autor        = $resultado['V_AUTOR'];

			?>
				<div style="border:1px solid #ccc; width: 300px; margin-top: 10px">
					      <p style="margin-bottom: 0px;"><img style= "margin-top: -16px; border: 2px solid #133141;" src="<?php echo $foto; ?>"width="110" height="110"></p>
					<h4>Titulo: <a><?php echo $titulo; ?></a></h4>
					<h4>Autor: <a><?php echo $autor; ?></a></h4>
					&nbsp
					<a href="../Controles/Controle_funcaoAceitarTroca.php?id=<?php echo $idLivroTroca; ?>">Trocar</a>
				</div>
			<?php				
			}						
		}
		else
		{
			echo "Erro na consulta";
			header("Location: index.php");  
			die();
		}
	?>

	<?php include('View_rodape.php'); ?>
</body>
</html>