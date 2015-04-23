<!DOCTYPE html>
<?php
require_once "Conexao.php";
session_start();
?>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>
</head>
<body>
    <div id='cssmenu'>
      <div id='container'>
        <ul>
           <li><a href='index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
           <li class='active'><a href='index.php'><span>ÍNICIO</span></a></li>
           <li style="float: right" class="right"><a href='#'><span>LOGIN</span></a></li>
           <li style="float: right" class="right"><a href='CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>
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

    <div id='corpo'>
    	<h2>Login</h2>
      <div id="login">

		<form method="post" action="?go=logar">
			<table id="login_table">
				<tr>
         <td><?php 
                if(isset($_SESSION['errologin'])){
                  echo $_SESSION['errologin'];
                  unset($_SESSION['errologin']);
                }
              ?></td>
              </tr>
              <tr>
          <td><input class='login' type="text" placeholder='Login' name="usuario" id="usuario" class="txt" maxlength="15" required/></td>
				</tr>
				<tr>
					<td><input class='login' type="password" placeholder='Senha' name="senha" id="senha" class="txt" maxlength="15" required/></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Entrar" class="btn" id="btnEntrar"> 
					&nbsp;<a style="text-decoration: none;" href="CadastroUsuario.php"><input style='margin-top: -10px;' type="button" value="Cadastre-se" class="btn" id="btnCad"></a></td>
				</tr>	
			</table>
		</form>
	  </div>
    </div>

    <footer>
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
if(@$_GET['go'] == 'logar'){
	$user = $_POST['usuario'];
	$pwd = $_POST['senha'];

    $query2 = mysql_query("SELECT IdUsuario, Login, TipoUsuario FROM usuario WHERE Login = '$user' AND Senha = '$pwd' ");
    $dados = mysql_fetch_row($query2);

    $codusuario = $dados[0];
    $tipousuario = $dados[2];

		$query1 = mysql_query("SELECT Ativo FROM usuario WHERE Login = '$user' AND Senha = '$pwd'");
    $ativo = mysql_fetch_row($query1);
    if ($ativo[0] == 'T'){

     
    $dados = mysql_num_rows($query1);
    
    
		if($dados == 1){
			echo "<script>alert('Bem vindo, ".$user." !!');</script>";
			$_SESSION["login"]     = $user;
      $_SESSION["codigo"]    = $codusuario;
      $_SESSION["tipo"]      = $tipousuario;
			echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>"; 
		}else{
			unset ($_SESSION['login']);
      $_SESSION['errologin'] = "Usuário e senha nao correspondem, tente novamente!";
			//echo "<script>alert('Usuário e senha não correspondem, tente novamente !! '); history.back();</script>";

		}
  }else{
    $_SESSION['errologin'] = "Usuário e senha nao correspondem, tente novamente!";
     //echo "<script>alert('O usuário ".$user.", não pode mais utilizar o sistema, pois está bloqueado !! '); history.back();</script>"; 
  }
}