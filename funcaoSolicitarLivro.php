<?php 
session_start();
require_once"Conexao.php";
//se existir algum usuario logado
if(isset($_SESSION['login']))
{
	$nomeLogado = $_SESSION['login'];
	$idLogado   = $_SESSION['codigo'];
	$tipoLogado = $_SESSION['tipo'];

	//verificar se o usuario tem livro cadastrado
	$queryExisteLivro = mysql_query("SELECT * FROM livro WHERE N_COD_USUARIO_IE = $idLogado");
	$resultado = mysql_num_rows($queryExisteLivro);
	//se o usuario tiver pelo menos um livro 
	if($resultado >= 1){
		//pega o id do livro
		if(isset($_GET['id'])){

			$idLivroSolicitado = $_GET['id'];
			$_SESSION['idLivroSolicitado'] = $idLivroSolicitado;
			//faz uma consulta para verificar se o livro solicitado é o seu proprio livro 
			$sql = mysql_query("SELECT usuario.N_COD_USUARIO, usuario.V_NOME from livro inner join usuario on usuario.N_COD_USUARIO = livro.N_COD_USUARIO_IE where livro.N_COD_LIVRO = $idLivroSolicitado");
			$resul = mysql_fetch_row($sql);
			$userid = $resul[0];
			$nomeUsuario = $resul[1];
			//se o uusuario tentar solicitar o seu proprio livro, ele recebe uma mensagem 
			if($idLogado == $userid)
			{
				echo "<script>alert('Voce nao pode solicitar seu proprio livro');history.back();</script>";	
			}
			//se ele solicitar o livro de outro usuairo, ele é jogando para a pagina de perfil para escolher um livro a ser trocado 
			else
			{
				$query = mysql_query("SELECT N_COD_USUARIO FROM usuario where N_COD_USUARIO = $idLogado");	
				if($query)
				{
					echo "<script>alert('Escolha um livro para trocar com $nomeUsuario');</script>";
					header("Location: ListaLivros.php");
					
				}
				/*$data = date('Y/m/d');
				$update = mysql_query("INSERT INTO troca(N_COD_LIVRO_SOLICITANTE, D_DATA, V_STATUS) VALUES ($idLogado, $idLivroSolicitado, '$data', 'Pendente')");
				if($update)
				{
					echo "Solicitacao enviada";
				}
				else
				{
					echo "Erro ao solicitar";
				}*/
			} 


		}
	}
	//se o usuario nao tiver nenhum livro
	else
	{
		echo "<script>alert('Você não tem livro cadastrado, para continuar cadastre pelo menos um livro'); history.back();</script>";
	}
}
//se um usuario tentar solicitar um livro sem está logado volta para a pagina index
else
{
	unset($_SESSION['login']);
	header('location:index.php');
}
?>