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
           <li style="float: right" class="right"><a href='View_CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>
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

		<form method="post" action="Repositorio_autenticacao.php">
			<table id="login_table">
				<tr>
          <td><input class='login' type="text" placeholder='Login' name="usuario" id="usuario" class="txt" maxlength="15" required/></td>
				</tr>
				<tr>
					<td><input class='login' type="password" placeholder='Senha' name="senha" id="senha" class="txt" maxlength="15" required/></td>
				</tr>
        <tr>
          <td><a href="RecuperarSenha.php">Esqueceu sua senha?<a></td>
        </tr>
				<tr>
					<td colspan="2"><input type="submit" value="Entrar" class="btn" id="btnEntrar" name = "btnEntrar"> 
					&nbsp;<a style="text-decoration: none;" href="View_CadastroUsuario.php"><input style='margin-top: -10px;' type="button" value="Cadastre-se" class="btn" id="btnCad"></a></td>
				</tr>	
			</table>
		</form>
	  </div>
    </div>

    <?php include('View_rodape.php'); ?>
</body>
</html>

