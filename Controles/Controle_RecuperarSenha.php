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
    <link rel="stylesheet" type="text/css" href="CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
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

		<form method="post" action="?go=Enviar">
			<table id="login_table">
				<tr>
          <td><input class='login' type="text" placeholder='Email' name="email" id="email" class="txt" maxlength="100" required/></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Enviar" class="btn" id="btnEntrar" name = "btnEntrar"> 
				</tr>	
			</table>
		</form>
	  </div>
    </div>

    <?php include('rodape.php'); ?>
</body>
</html>

<?php
if(@$_GET['go'] == 'Enviar'){


//pega a variavel via post
$email = $_POST['email'];
//busca no db o usuario com o email 
$result = mysql_query("SELECT * FROM usuario WHERE V_EMAIL ='$email'");
//conta quantos tem
$num_rows = mysql_num_rows($result);
//se tiver  + de 1 cadastrado
if($num_rows=='1'){
  //faz um while para vc coloar os dados nas variavels
  while($Row_email = mysql_fetch_array($result)){
    $rowemail = $Row_email['V_EMAIL'];
    $rowsenha = $Row_email['V_SENHA'];
    }
    

//enviar um email para variavel email juntamente com a variável senha;
$mensage ="Você solicitou a recuperação de senha confira seu dados.";
$mensage .="E-mail= " . $rowemail;
$mensage .="Senha:" . $rowsenha;
$headers = 'From: bruno.jo.gos@hotmail.com' . "\r\n" .
    'Reply-To: bruno.jo.gos@hotmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($rowemail, "Troca Livros, recuperação de senha", $mensage, $headers);

echo"<script>alert('Sua senha foi enviada para o e-mail indicado.');window.open('Login.php','_self')</script>";


}else{
  
  
  echo"<script>alert('E-mail não cadastrado em nosso sistema');window.open('RecuperarSenha.php','_self')</script>";
  
}
}


?>