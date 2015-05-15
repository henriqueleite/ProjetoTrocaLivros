<?php  
require_once "Conexao.php";
session_start();
	if((!isset ($_SESSION['login']) == true))
	{
	  unset($_SESSION['login']);
	  header('location:index.php');
	 }

	$logado = $_SESSION['login'];
	$codigo = $_SESSION['codigo'];
	$tipo = $_SESSION['tipo'];

	$sql = mysql_query("SELECT V_NOME, V_EMAIL, V_IDADE, V_CPF, V_LOGIN, V_SENHA, V_TELEFONE, V_CELULAR, V_CEP, V_CIDADE, V_BAIRRO, V_UF FROM usuario WHERE N_COD_USUARIO = '$codigo' ");
	$linha = mysql_fetch_assoc($sql);
	if (!$linha) {
	  //Se o select não retornou registros, é porque não tem o que apagar
	  header("Location: painel.php");
	  die();
	}
	$nome = $linha["V_NOME"];
	$email = $linha["V_EMAIL"];
	$idade = $linha["V_IDADE"];
	$cpf = $linha["V_CPF"];
	$login = $linha["V_LOGIN"];
	$senha = $linha["V_SENHA"];
	$telefone = $linha["V_TELEFONE"];
	$celular = $linha["V_CELULAR"];
	$cep = $linha["V_CEP"];
	$cidade = $linha["V_CIDADE"];
	$bairro = $linha["V_BAIRRO"];
	$uf = $linha["V_UF"];
	?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<link rel="stylesheet" type="text/css" href="CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
	<title>Troca Livro</title>
	<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}


</script>
</head>
<body>
	   <?php include('topo.php'); ?>

<div id='corpo' style="height: 680px;">
<h2>Editar Perfil </h2>
	<form name="CadastroUsuario" method="post" action="?go=salvar">
		<table id="cad_table">
			<tr>
				<td>Nome:*</td>
				<td><input type="text" name="nome" id="nome" class="txt" value="<?php echo $nome; ?>" size=35 required/></td>
			</tr>
			<tr>
				<td>Email:*</td>
				<td><input type="email" name="email" id="email" class="txt" value="<?php echo $email; ?>" size=35 required/></td>
			</tr>
			<tr>
				<td>Idade: </td>
				<td><input type="text" name="idade" id="idade" class="txt" value="<?php echo $idade; ?>" size=2 required/>&nbsp Anos</td>
			</tr>
			<tr>
				<td>CPF:*</td>
				<td><input type="text" name="cpf" id="cpf" class="txt2" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" value="<?php echo $cpf; ?>" size=35 required='aa'/></td>
			</tr>
			<tr>
				<td>Login:*</td>
				<td><input type="text" name="login" id="login" class="txt1" maxlength="10" value="<?php echo $login; ?>" size=35 required/></td>
			</tr>
			<tr>
				<td>Senha:*</td>
				<td><input type="password" name="senha" id="senha" class="txt1" maxlength="15" value="<?php echo $senha; ?>" size=35 required/></td>
			</tr>
            <tr>
				<td>Telefone:</td>
				<td><input type="tel" name="telefone" id="telefone" class="txt2" maxlength="12" OnKeyPress="formatar('##-####-####', this)" value="<?php echo $telefone; ?>" size=35/></td>
			</tr>
			<tr>
				<td>Celular:</td>
				<td><input type="tel" name="celular" id="celular" class="txt2" maxlength="12" OnKeyPress="formatar('##-####-####', this)" value="<?php echo $celular; ?>" size=35/></td>
			</tr>
			<tr>
				<td>Cep:*</td>
				<td><input type="text" name="cep" id="cep" class="txt2" maxlength="10" OnKeyPress="formatar('#####-###', this)" value="<?php echo $cep; ?>" size=35 required/></td>
			</tr>
			<tr>
				<td>cidade:</td>
				<td><input type="text" name="cidade" id="cidade" class="txt2" maxlength="100"  value="<?php echo $cidade; ?>" size=35/></td>
			</tr>
			<tr>
				<td>Bairro:</td>
				<td><input type="text" name="bairro" id="bairro" class="txt" maxlength="50" value="<?php echo $bairro; ?>" size=35 /></td>
			</tr>

			<tr>
				<td>UF:</td>
				<td><input type="text" name="uf" id="uf" class="txt3" maxlength="2" value="<?php echo $uf; ?>" size=2/></td>
			</tr>

				<td colspan="2"><input class='btn' type="submit" value="Salvar" id="buton1" name="btvalidar">
					<br><input class='btn' type="button" value="Cancelar" onclick="location.href='PerfilUsuario.php'" id="buton1" name="btvalidar">
				
				</td>
			</tr>
		</table>
		
		
	</form>
	<p class='campo-obrigatorio'>(*) Campos Obrigatórios</p>
</div>
    <?php include('rodape.php'); ?>
</body>
</html>


<?php

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];

require_once "Conexao.php";		
$conecta = mysql_connect("localhost", "root", ""); 
mysql_select_db("trocalivro", $conecta);

if(@$_GET['go'] == 'salvar'){
		$nome = $_POST['nome'];
		$user = $_POST['login'];
		$pwd = $_POST['senha'];
		$email = $_POST['email'];
		$idade = $_POST['idade'];
		$cpf = $_POST['cpf'];
		$telefone = $_POST['telefone'];
		$celular =$_POST['celular'];
		$bairro = $_POST['bairro'];
		$cidade =$_POST['cidade'];
		$cep = $_POST['cep'];
		$uf = $_POST['uf'];


		//if ($nome == ''){
		//	echo "<script>alert('Preencha o campo Nome'); history.back(); </script>";
		//}else if ($user == ''){
		//	echo "<script>alert('Preencha o campo Login'); history.back(); </script>";
		//}else if ($pwd == ''){
		//	echo "<script>alert('Preencha o campo Senha'); history.back(); </script>";
		//}else if ($email == ''){
		//	echo "<script>alert('Preencha o campo Email'); history.back(); </script>";
		//}else if ($idade == ''){
		//	echo "<script>alert('Preencha o campo Idade'); history.back(); </script>";
		//}else if ($cpf == ''){
		//	echo "<script>alert('Preencha o campo CPF'); history.back(); </script>";
		//}else{

		function validaCPF($cpf){	
			// Verifiva se o número digitado contém todos os digitos
		    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
			
			// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'){
				return false;
		    }else{   // Calcula os números para verificar se o CPF é verdadeiro
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
		if(isset($_POST['btvalidar'])){// Adiciona o numero enviado na variavel $cpf_enviado, poderia ser outro nome, e executa a função acima
			$cpf_enviado = validaCPF($_POST['cpf']);
			// Verifica a resposta da função e exibe na tela
			if($cpf_enviado == false){
				echo "<script>alert('CPF Inválido'); history.back();</script>";
			} elseif($cpf_enviado == true){
				echo "<script>;</script>";
				

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
			if($email_enviado == false){
				echo "<script>alert('Email Inválido'); history.back();</script>";			
		}elseif ($email_enviado == true) {
				echo "<script>;</script>";
			
		$query4 = mysql_query("SELECT V_LOGIN, V_CPF FROM usuario WHERE N_COD_USUARIO = $codigo ");
		$dados = mysql_fetch_row($query4);
		
		
		$query1 = mysql_query("SELECT COUNT(N_COD_USUARIO) FROM usuario WHERE V_LOGIN='$user'");
		$eReg = mysql_fetch_array($query1);
		$login_check = $eReg[0];

		$query3 = mysql_query("SELECT COUNT(V_CPF) FROM usuario WHERE V_CPF='$cpf'");
		$eReg3 = mysql_fetch_array($query3);
		$cpf_check = $eReg3[0];

		if (($dados[0] != $user) && ($login_check > 0)){
			echo "<script>document.getElementById('#login').focus();</script>";
			echo "<script>alert('Login Inválido!!'); history.back();</script>";
		} 
			
		if (($dados[1] != $cpf) && ($cpf_check > 0)){
			echo "<script>alert('CPF já cadastrado no sistema!!'); history.back();</script>";
		}else{

			$query2 = mysql_query("update usuario set V_NOME = '$nome', V_LOGIN = '$user', V_SENHA = '$pwd', V_EMAIL = '$email', V_CPF = '$cpf', V_IDADE = '$idade', V_TELEFONE = '$telefone', V_CELULAR = '$celular', V_BAIRRO = '$bairro', V_CIDADE = '$cidade', V_CEP = '$cep', V_UF = '$uf' where N_COD_USUARIO = $codigo");		

			if (!$query2) {
			echo "<script>alert('Erro'); history.back();</script>";
			}else{
			echo "<script>alert('Cadastrado alterado com sucesso!!');</script>";
			echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>"; 	
			}
		}
		}
		}
	}
}
	

}
?>