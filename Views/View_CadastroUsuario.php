<?php
require_once "Conexao.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="CSS/CadastrarAlterarUsuario.css">
	<link rel="stylesheet" type="text/css" href="CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
	<link href="CSS/main.css" rel="stylesheet" />
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
	 <?php include('View_topo.php'); ?>

<div id='corpo'>
<h2>Cadastro </h2>
	<form method="post" action="Repositorio_cadastrausuario.php">
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
				
				</td>
			</tr>
		</table>
		
		
	</form>

				<div class="grid_7 map" id="map1"></div>

	<p class='campo-obrigatorio'>(*) Campos Obrigatórios</p>
</div>

</body>   
</html>


