<?php
require_once "Conexao.php";		
		$nome = $_POST['nome'];
		$user = $_POST['login'];
		$pwd = $_POST['senha'];
		$email = $_POST['email'];
		$cpf = $_POST['cpf'];
		$telefone = $_POST['telefone'];
		$celular =$_POST['celular'];
		$rua = $_POST['rua'];
		$cidade =$_POST['cidade'];
		$cep = $_POST['cep'];
		$uf = $_POST['uf'];

		function validaCPF($cpf)
		{	// Verifiva se o número digitado contém todos os digitos
		    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
			
			// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
			{
			return false;
		    }
			else
			{   // Calcula os números para verificar se o CPF é verdadeiro
		        for ($t = 9; $t < 11; $t++) {
		            for ($d = 0, $c = 0; $c < $t; $c++) {
		                $d += $cpf{$c} * (($t + 1) - $c);
		            }
		 
		            $d = ((10 * $d) % 11) % 10;
		 
		            if ($cpf{$c} != $d) {
		                return false;
		            }
		        }
		 
		        return true;
		    }
		}
// Verifica se o botão de validação foi acionado
			if(isset($_POST['btvalidar']))
				{// Adiciona o numero enviado na variavel $cpf_enviado, poderia ser outro nome, e executa a função acima
				$cpf_enviado = validaCPF($_POST['cpf']);
				// Verifica a resposta da função e exibe na tela
				if($cpf_enviado == true)
					echo "<script>alert('CPF Válido'); history.back();</script>";
				elseif($cpf_enviado == false)
					echo "<script>alert('CPF Inválido'); history.back();</script>";
				}

			function validaemail($email){
			//verifica se e-mail esta no formato correto de escrita
			if (!ereg('^([a-zA-Z0-9.-])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
				$mensagem='E-mail Inv&aacute;lido!';
				return $mensagem;
		    }
		    else{
				//Valida o dominio
				$dominio=explode('@',$email);
				if(!checkdnsrr($dominio[1],'A')){
					$mensagem='E-mail Inv&aacute;lido!';
					return $mensagem;
				}
				else{return true;} // Retorno true para indicar que o e-mail é valido
			}
		}	
		if(isset($_POST['btvalidar'])){
			$email_enviado = validaemail($_POST['email']);
			if ($email_enviado == true) 
				echo "<script>alert('Email Válido'); history.back();</script>";
			elseif($cpf_enviado == false)
				echo "<script>alert('Email Inválido'); history.back();</script>";			
		}

		
			if (empty($nome)) {
			echo "<script>alert('Preencha o campo Nome para completar cadastro.'); history.back();</script>";
		}elseif (empty($email)) {
			echo "<script>alert('Preencha o campo enail para completar cadastro.'); history.back();</script>";
		}elseif (empty($cpf)) {
			echo "<script>alert('Preencha o campo cpf para completar cadastro.'); history.back();</script>";
		}elseif (empty($user)) {
			echo "<script>alert('Preencha o campo usuario para completar cadastro.'); history.back();</script>";
		}elseif (empty($apelido)) {
			echo "<script>alert('Preencha o campo Apelido para completar cadastro.'); history.back();</script>";
		}elseif (empty($pwd)) {
			echo "<script>alert('Preencha o campo senha para completar cadastro.'); history.back();</script>";
		}elseif (empty($telefone)) {
			echo "<script>alert('Preencha o campo telefone para completar cadastro.'); history.back();</script>";
		}elseif (empty($celular)) {
			echo "<script>alert('Preencha o campo celular para completar cadastro.'); history.back();</script>";
		}elseif (empty($rua)) {
			echo "<script>alert('Preencha o campo Lugradouro para completar cadastro.'); history.back();</script>";
		}elseif (empty($cidade)) {
			echo "<script>alert('Preencha o campo cidade para completar cadastro.'); history.back();</script>";
		}elseif (empty($cep)) {
			echo "<script>alert('Preencha o campo Cep para completar cadastro.'); history.back();</script>";
		}elseif (empty($uf)) {
			echo "<script>alert('Preencha o campo UF para completar cadastro.'); history.back();</script>";
		}else{
			$query1 = mysql_num_rows(mysql_query("SELECT * FROM usuario WHERE usuario = '$user'"));
			if ($query1 == 1) {
				echo "<script>alert('Esse Nome de Usuário já existe.'); history.back();</script>";
			}else{
				mysql_query("insert into usuario (V_NOME, V_LOGIN, V_SENHA, V_USUARIO, V_EMAIL, V_CPF, V_TELEFONE, V_CELULAR, V_LOGRADOURO, V_CIDADE, V_CEP, V_UF) values ('$nome','$user','$pwd','$email','$cpf','$telefone','$celular','$rua','$cidade','$cep','$uf')");				echo "<script>alert('Usuário cadastrado com sucesso.'); </script>";
				echo "<meta http-equiv='refresh' content='0, url=Principal.php'>";
				header("location:index.php");
			}
		}

	
// Gravar Mensagem ************
	//$usuario = $_GET['nome'];
	//$mensagen =  $_POST['mensagen'];
	//if ($_GET['funcao'] == "gravar") {
	//$sql_gravar = mysql_query("update usuario set mensagen='$mensagen' where usuario='$usuario'");
	//header('location:Contato.php');
	//}

//******************************************************************
//******	if($_GET['funcao'] == "editar"){
	//	$id = $_GET['id'];
	//	$sql_alterar = mysql_query("update usuario set nome='$alterar_nome', email='$alterar_email', usuario='$alterar_user', senha='$alterar_pwd' where id = '$id'");
	//	header('Location:Listar.php');
	//}/////*****
//***********************************************************************************8888888
	//	if($_GET['funcao'] == "excluir"){
//			$id = $_GET['id'];
//			$sql_excluir = mysql_query("delete from usuario where id = '$id'");
//			header('Location:Listar.php');

		//}
?>