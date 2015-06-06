<?php
require_once "../Dados/Conexao.php";	


		$nome = strtoupper($_POST['nome']);
		$user = $_POST['login'];
		$pwd = $_POST['senha'];
		$pwd2 = $_POST['senha2'];
		$email = $_POST['email'];
		$dataNascimento = $_POST['dataNascimento'];
		$cpf = $_POST['cpf'];
		$telefone = $_POST['telefone'];
		$celular = $_POST['celular'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];
		$cep = $_POST['cep'];
		$uf = $_POST['uf'];
		$sexo = $_POST['sexo'];
		
		
		$patternBr    = "^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9]{2}^";
        $patternMySQL = "^(19|20)[0-9]{2}[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])^";
		  
        $output = implode('/', array_reverse(explode('/', $dataNascimento)));
            
		
		//confirma senha
		if( $pwd != $pwd2){
				echo "<script>alert('senhas diferentes'); history.back();</script>";
			}else{
							
	

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


		} else {
			if ($cpf_check > 0){
			echo "<script>alert('CPF já cadastrado!!'); history.back();</script>";
		}else{
			$data = date('Y,m,d');
			$query2 = mysql_query("insert into usuario (V_NOME, V_LOGIN, V_SENHA, V_EMAIL, V_CPF, D_DATA_NASC, V_TELEFONE, V_CELULAR, V_BAIRRO, V_CIDADE, V_CEP, V_UF, D_DATA_CADASTRO, B_ATIVO, N_TIPO_USUARIO,V_SEXO) values ('$nome','$user','$pwd','$email','$cpf', '$output','$telefone','$celular','$bairro','$cidade','$cep','$uf','$data','T','0','$sexo')");		

			if (!$query2) {
			echo "<script>alert('Ocorreu um Erro'); history.back();</script>";
			}else{
			echo "<script>alert('Cadastrado com sucesso!!');</script>";
			echo "<meta http-equiv='refresh' content='0, url=../Views/View_Login.php'>"; 	
			}
		}
		}
		}
	}
}	
}
}
/*N_TIPO_USUARIO = 0 (USUARIO NORMAL)
N_TIPO_USUARIO = 1 (USUARIO ADMINISTRADOR)
*/

?>