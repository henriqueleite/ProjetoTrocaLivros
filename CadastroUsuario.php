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
           <li style="float: right" class="right"><a href='#'><span>LOGIN</span></a></li>
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




<div id='corpo' style="height: 600px;">
<h2>Cadastro </h2>
	<form method="post" action="cadastrausuario.php">
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
				<td><input type="text" name="cep" id="cep" class="txt2" maxlength="9" OnKeyPress="formatar('#####-###', this)" size=35 required/></td>
			</tr>
			<tr>
				<td>Rua:</td>
				<td><input type="text" name="rua" id="rua" class="txt" maxlength="100" size=35 /></td>
			</tr>
			<tr>
				<td>cidade:</td>
				<td><input type="text" name="cidade" id="cidade" class="txt2" maxlength="100"  size=35/></td>
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
