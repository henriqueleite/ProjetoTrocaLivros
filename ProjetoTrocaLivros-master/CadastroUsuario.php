<?php
require_once "Conexao.php";


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
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
	 <div id='cssmenu'>
      <div id='container'>
        <ul>
           <li><a href='index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
           <li><a href='index.php'><span>ÍNICIO</span></a></li>
           <li style="float: right" class="right"><a href='Login.php'><span>LOGIN</span></a></li>
           <li class='active' style="float: right" class="right"><a href='CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>
           <li><a href='Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
           <li><a href='Form_Ajuda.php'><span>SOBRE</span></a></li>
           <li class='last'><a href='Form_Ajuda.php'><span>CONTATO</span></a></li>
           <li>
           <form name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >
            <input type="text" name="palavra" />
            <input type="submit"  value="Buscar" />
          </li>
          </form>
        </ul>
      </div>
    </div>




<div id='corpo' style="height: 650px;">
<h2>Cadastro </h2>
	<form name="CadastroUsuario" method="post" action="?go=cadastrar">
		<table id="cad_table">
			<tr>
				<td>Nome:*</td>
				<td><input type="text" name="nome" id="nome" class="txt"  size=35 required/></td>
			</tr>
			<tr>
				<td>Email:*</td>
				<td><input type="email" name="email" id="email" class="txt" size=35 required/></td>
			</tr>
			<tr>
				<td>Idade: </td>
				<td><input type="text" name="idade" id="idade" class="txt" size=2 required/>&nbsp Anos</td>
			</tr>
			<tr>
				<td>CPF:*</td>
				<td><input type="text" name="cpf" id="cpf" class="txt2" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" size=35 required='aa'/></td>
			</tr>
			<tr>
				<td>Login:*</td>
				<td><input type="text" name="login" id="login" class="txt1" maxlength="10" size=35 required/></td>
			</tr>
			<tr>
				<td>Senha:*</td>
				<td><input type="password" name="senha" id="senha" class="txt1" maxlength="15" size=35 required/></td>
			</tr>
            <tr>
				<td>Telefone:</td>
				<td><input type="tel" name="telefone" id="telefone" class="txt2" maxlength="12" OnKeyPress="formatar('##-####-####', this)" size=35/></td>
			</tr>
			<tr>
				<td>Celular:</td>
				<td><input type="tel" name="celular" id="celular" class="txt2" maxlength="12" OnKeyPress="formatar('##-####-####', this)" size=35/></td>
			</tr>
			<tr>
				<td>Cep:*</td>
				<td><input type="text" name="cep" id="cep" class="txt2" maxlength="10" OnKeyPress="formatar('#####-###', this)" size=35 required/></td>
			</tr>
			<tr>
				<td>cidade:</td>
				<td><input type="text" name="cidade" id="cidade" class="txt2" maxlength="100"  size=35/></td>
			</tr>
			<tr>
				<td>Bairro:</td>
				<td><input type="text" name="bairro" id="bairro" class="txt" maxlength="50" size=35 /></td>
			</tr>

			<tr>
				<td>UF:</td>
				<td><input type="text" name="uf" id="uf" class="txt3" maxlength="2" size=2/></td>
			</tr>

				<td colspan="2"><input class='btn' type="submit" value="Cadatrar" id="buton1" name="btvalidar"><br>
				
				</td>
			</tr>
		</table>
		
		
	</form>
	<p class='campo-obrigatorio'>(*) Campos Obrigatórios</p>
</div>
    <footer style='margin-top: 110px;'>
      <div class="bar">
        Rodapé
      </div>
      <div class='footer2'>
      <div class="bar2">
        Copyright © 2015 by Troca Livro
      </div>
    </div>
    </footer>
</body>
</html>


<?php

require_once "Conexao.php";		
$conecta = mysql_connect("localhost", "root", ""); 
mysql_select_db("trocalivro", $conecta);

if(@$_GET['go'] == 'cadastrar'){
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
				echo "<script>alert('Email Inexistente'); history.back();</script>";			
		}elseif ($email_enviado == true) {
				echo "<script>;</script>";
			

		
		
		$query1 = mysql_query("SELECT COUNT(N_COD_USUARIO) FROM usuario WHERE V_LOGIN='$user'");
		$eReg = mysql_fetch_array($query1);
		$login_check = $eReg[0];

		$query3 = mysql_query("SELECT COUNT(V_CPF) FROM usuario WHERE V_CPF='$cpf'");
		$eReg3 = mysql_fetch_array($query3);
		$cpf_check = $eReg3[0];

		if ($login_check > 0){
			echo "<script>document.getElementById('#login').focus();</script>";
			echo "<script>alert('Login Inválido!!'); history.back();</script>";


		} if ($cpf_check > 0){
			echo "<script>alert('CPF já cadastrado!!'); history.back();</script>";
		}else{
			$data = date('Y,m,d');
			$query2 = mysql_query("insert into usuario (V_NOME, V_LOGIN, V_SENHA, V_EMAIL, V_CPF, V_IDADE, V_TELEFONE, V_CELULAR, V_BAIRRO, V_CIDADE, V_CEP, V_UF, D_DATA_CADASTRO, B_ATIVO, N_TIPO_USUARIO) values ('$nome','$user','$pwd','$email','$cpf','$idade','$telefone','$celular','$bairro','$cidade','$cep','$uf','$data','T','0')");		

			if (!$query2) {
			echo "<script>alert('Ocorreu um Erro'); history.back();</script>";
			}else{
			echo "<script>alert('Cadastrado com sucesso!!');</script>";
			echo "<meta http-equiv='refresh' content='0, url=Login.php'>"; 	
			}
		}
		}
		}
	}
}
	
/*N_TIPO_USUARIO = 0 (USUARIO NORMAL)
N_TIPO_USUARIO = 1 (USUARIO ADMINISTRADOR)
*/
}
?>
