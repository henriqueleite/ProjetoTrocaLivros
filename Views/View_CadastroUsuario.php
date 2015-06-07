<?php
require_once "../Dados/Conexao.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../CSS/CadastrarAlterarUsuario.css">
	<link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
	<link href="../CSS/main.css" rel="stylesheet" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="js/gmaps.js" type="text/javascript"></script>
    <script src="js/cep.js" type="text/javascript"></script>
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

function MascaraData(obj) 
{
   switch (obj.value.length) 
   {
      case 2:
           obj.value = obj.value + "/";
           break;
      case 5:
           obj.value = obj.value + "/";
           break;
   }
}

function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
      if (tecla==8 || tecla==0) return true;
  else  return false;
    }
}


</script>

        <script>
            $(function(){
                wscep({map: 'map1',auto:true});
                wsmap('08615-000','555','map2');
            })
        </script>
</head>
<body>
	 <div id='cssmenu'>
  <div id='container'>
    <ul>
     <li><a href='../index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
     <li class='active'><a href='../index.php'><span>ÍNICIO</span></a></li>
     <li><a href='../Views/View_Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
     <li><a href='../Views/View_Form_Ajuda.php'><span>SOBRE</span></a></li>
     <li class='last'><a href='../Views/View_Form_Ajuda.php'><span>CONTATO</span></a></li>
     <li><form name="frmBusca" method="post" action="View_Buscar.php" >

      <input type="text" name="palavra" />
      <input type="submit"  value="Buscar" />
    </li>
  </form>

  <?php

  if((isset ($_SESSION['login']) == true)){
   echo "<li style='float: right' class='right'><a href='../Controles/Controle_Logout.php'><span>SAIR</span></a></li>";
   echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";  
   echo "<li style='float: right' class='right'><a href='../Repositorio/PerfilUsuario.php'><span>PAINEL</span></a></li>";
 } else {
  echo "<li style='float: right' class='right'><a href='../Views/View_Login.php'><span>LOGIN</span></a></li>";
  echo "<li style='float: right' class='right'><a href='#'><span>CADASTRAR-SE</span></a></li>";
}
?> 

    </ul>
  </div><!--fim div container-->
</div><!--fim div cssmenu-->

<div id='corpo'>
<h2>Cadastro </h2>
	<form method="post" action="../Repositorio/Repositorio_cadastrausuario.php">
		<table id="cad_table">
			<tr>
				<td class='tr_cadastro'>Nome:*</td>
				<td><input type="text" name="nome" id="nome" class="txt"  size=35 required/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Email:*</td>
				<td><input type="email" name="email" id="email" class="txt" size=35 required/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Data Nasc.: </td>
				<td><input type='text' name='dataNascimento' id="dataNascimento" class="txt" maxlength='10' size='14' onKeyPress='MascaraData(this); return SomenteNumero(event); ' required/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Sexo: </td>
				<td><select id="sexo" name="sexo">
              			<option value="M">MASCULINO</option>
              			<option value="F">FEMININO</option>
             		 </select></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>CPF:*</td>
				<td><input type="text" name="cpf" id="cpf" class="txt2" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" size=35 required='aa'/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Login:*</td>
				<td><input type="text" name="login" id="login" class="txt1" maxlength="10" size=35 required/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Senha:*</td>
				<td><input type="password" name="senha" id="senha" class="txt1" maxlength="15" size=35 required/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Confirme a Senha:*</td>
				<td><input type="password" name="senha2" id="senha2" class="txt1" maxlength="15" size=35 required/></td>
			</tr>
            <tr>
				<td class='tr_cadastro'>Telefone:</td>
				<td><input type="tel" name="telefone" id="telefone" class="txt2" maxlength="12" onkeypress="formatar('##-####-####', this); return SomenteNumero(event); "  size=35/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Celular:</td>
				<td><input type="tel" name="celular" id="celular" class="txt2" maxlength="12" onkeypress="formatar('##-####-####', this); return SomenteNumero(event); "  size=35/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Cep:*</td>
				<td><input type="text" name="cep" id="cep" class="txt2" maxlength="11" size=35 /></td>
				<td><a href="http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuLogradouro">Clique aqui para Descobrir seu CEP</a></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>cidade:</td>
				<td><input type="text" name="cidade" id="cidade" class="txt2" maxlength="100"  size=35/></td>
			</tr>
			<tr>
				<td class='tr_cadastro'>Bairro:</td>
				<td><input type="text" name="bairro" id="bairro" class="txt" maxlength="50" size=35 /></td>
			</tr>

			<tr>
				<td class='tr_cadastro'>UF:</td>
				<td><input type="text" name="uf" id="uf" class="txt3" maxlength="2" size=2/></td>
			</tr>
				
				<td colspan="2"><input class='btn' type="submit" id="buton1" name="btvalidar" value="cadastrar"><br>
				<td><input type="checkbox" name="termos"/><h5> Li e Aceito os termos de uso</h5></td>
				<td><input type="hidden" name="leia" value="0" /> </td><td><a href="#" onclick="window.open('../Views/View_Termos.html', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Leia os termos de Uso</a></td>
				
				</td>
			</tr>

		</table>
	</form>
		 			<div class="grid_7 map" id="map1"></div>

	<p class='campo-obrigatorio'>(*) Campos Obrigatórios</p>
</div>

</body>   
</html>


