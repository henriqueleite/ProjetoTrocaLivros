<?php
require_once "../Dados/Conexao.php";	
include('../Controles/valida-cpf.php');
include('../Controles/valida-email.php');

		$nome = strtoupper($_POST['nome']);
		$user = $_POST['login'];
		$pwd = $_POST['senha'];
		$pwd2 = $_POST['senha2'];
		$email = $_POST['email'];
		$dataNascimento = $_POST['dataNascimento'];
		$cpf = $_POST['cpf'];
		$celular = $_POST['celular'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];
		$cep = $_POST['cep'];
		$uf = $_POST['estado'];
		$sexo = $_POST['sexo'];
		$termos = $_POST['termos'];



 	/*if ($nome == ""){
      echo "Preencha o campo Nome";
    }else if ($user == ""){
      echo "Preencha o campo Login";
    }else if ($pwd  == ""){
     echo "Preencha o campo Senha";
    }else if ($pwd2  == ""){
      echo "Preencha o campo Confirmar Senha";
    }else if ($email  == ""){
      echo "Preencha o campo Email";
    }else if ($dataNascimento  == ""){
      echo "Preencha o campo Data de Nascimento";
    }else if ($cpf  == ""){
      echo "Preencha o campo CPF";
    }else if ($cep  == ""){
      echo "Preencha o campo CEP";
    }else if ($celular  == ""){
      echo "Preencha o campo Contato Telefônico";
    }else{ */

		
		
		$patternBr    = "^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9]{2}^";
        $patternMySQL = "^(19|20)[0-9]{2}[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])^";
		  
        $output = implode('/', array_reverse(explode('/', $dataNascimento)));
         
         
          
				
		if(isset($_POST['termos']) == false){
			echo "Você precisa aceitar os termos de usuario!!";
		}else{
  

		//confirma senha
		if( $pwd != $pwd2){
				echo "As senhas digitadas não conferem!!";
			}else{

		if ( valida_cpf( $cpf ) == false ) {
			echo "CPF Inválido.";
		} else {
		
		if ( valida_email( $email ) == false ) {
			echo "Email Inválido.";
		} else {	
	
		
		$query1 = mysql_query("SELECT COUNT(N_COD_USUARIO) FROM usuario WHERE V_LOGIN='$user'");
		$eReg = mysql_fetch_array($query1);
		$login_check = $eReg[0];

		$query3 = mysql_query("SELECT COUNT(V_CPF) FROM usuario WHERE V_CPF='$cpf'");
		$eReg3 = mysql_fetch_array($query3);
		$cpf_check = $eReg3[0];

		if ($login_check > 0){
			echo "Login Inválido!!";


		} else {
			if ($cpf_check > 0){
			echo "CPF já cadastrado!!";
		}else{
			$data = date('Y,m,d');
			$query2 = mysql_query("insert into usuario (V_NOME, V_LOGIN, V_SENHA, V_EMAIL, V_CPF, D_DATA_NASC, V_CELULAR, V_BAIRRO, V_CIDADE, V_CEP, V_UF, D_DATA_CADASTRO, B_ATIVO, N_TIPO_USUARIO,V_SEXO) values ('$nome','$user','$pwd','$email','$cpf', '$output','$celular','$bairro','$cidade','$cep','$uf','$data','T','0','$sexo')");		

			if (!$query2) {
			echo "Ocorreu um Erro!!";
			}else{
			echo false;
			}
		}
	}
	}
	}
	}
}

//}

/*N_TIPO_USUARIO = 0 (USUARIO NORMAL)
N_TIPO_USUARIO = 1 (USUARIO ADMINISTRADOR)
*/

?>