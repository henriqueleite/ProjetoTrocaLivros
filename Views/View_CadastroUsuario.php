<?php
require_once "../Dados/Conexao.php";
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../CSS/CadastrarAlterarUsuario.css">
	<link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
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
	  <?php include('View_topo.php'); ?>

<div id='corpo'>
<h2>Cadastro </h2>
<form method="post" action="../Repositorio/Repositorio_cadastrausuario.php">
  <div class="col-2" id="cad_table">
    <label>
      Nome*:
      <input type="text" name="nome" id="nome" class="txt"  size=35 required placeholder="Digite seu nome e sobrenome" tabindex="1" />
    </label>
  </div>
   <div class="col-2">
    <label>
      Email*:
      <input type="email" name="email" id="email" class="txt" size=35 placeholder="Digite seu email" tabindex="1" />
    </label>
  </div>
  <div class="col-2">
    <label>
      Data Nasc*.:
      <input type='text' name='dataNascimento' id="dataNascimento" class="txt" maxlength='10' size='14' onKeyPress='MascaraData(this); return SomenteNumero(event); ' required placeholder="Digite sua data de nascimento" tabindex="2" />
    </label>
  </div>
  <div style="box-shadow: 1px 2px #E4E4E4;" class="col-2">
    <label>
      Sexo*: 
      <select id="sexo" name="sexo" tabindex="5">
        <option value="M">MASCULINO</option>
        <option value="F">FEMININO</option>
      </select>
    </label>
  </div>
  <div class="col-2">
    <label>
      CPF*:
      <input type="text" name="cpf" id="cpf" class="txt2" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" size=35 required='aa' placeholder="Digite seu CPF (somente números)" tabindex="2" />
    </label>
  </div>
  <div class="col-2">
    <label>
      Contato telefónico*:
      <input type="tel" name="celular" id="celular" class="txt2" maxlength="14" onkeypress="formatar('##-#####-####', this); return SomenteNumero(event); "  size=35 placeholder="Digite seu telefone ou celular (somente números)" tabindex="4" />
    </label>
  </div>
  <div class="col-3">
    <label>
      Login*:
      <input type="text" name="login" id="login" class="txt1" maxlength="10" size=35 required placeholder="Digite seu login" tabindex="3" />
    </label>
  </div>
  <div class="col-3">
    <label>
      Senha*:
      <input type="password" name="senha" id="senha" class="txt1" maxlength="15" size=35 required placeholder="Digite sua senha" tabindex="3" />
    </label>
  </div>
  <div class="col-3">
    <label>
      Confirme a senha*:
      <input type="password" name="senha2" id="senha2" class="txt1" maxlength="15" size=35 required placeholder="Digite sua senha novamente" tabindex="3" />
    </label>
  </div>
  <div style='width: 28.333%;' class="col-3">
    <label>
      CEP*:
      <input type="text" name="cep" id="cep" class="txt2" maxlength="11" size=35 placeholder="Digite seu CEP (somente números)" tabindex="4" />
    </label>
  </div>
  <div style="width: 10.333%;" class="col-3">
    <label>
      UF:
      <input type="text" name="uf" id="uf" class="txt3" maxlength="2" size=2 placeholder="UF" tabindex="5" />
    </label>
  </div>
  <div class="col-3">
    <label>
      Cidade:
      <input type="text" name="cidade" id="cidade" class="txt2" maxlength="100"  size=35 placeholder="Digite sua cidade" tabindex="5" />
    </label>
  </div>
  <div style="width: 27.7%;" class="col-3">
    <label>
      Bairro:
      <input type="text" name="bairro" id="bairro" class="txt" maxlength="50" size=35 placeholder="Digite seu bairro" tabindex="5" />
    </label>
  </div>
  					<a href="http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuLogradouro">Clique aqui para Descobrir seu CEP</a>






<br><input class='btn' type="submit" id="buton1" name="btvalidar" value="cadastrar"><br>
				<div class="termos">
					<input class="checkbox" type="checkbox" name="termos"/>
					<h5> Li e Aceito os termos de uso</h5>
					
		 			</div>
		 			
					<input type="hidden" name="leia" value="0" /> 
		 			<br><a href="#" onclick="window.open('../Views/View_Termos.html', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Leia os termos de Uso</a><br>

		 			<div class="grid_7 map" id="map1"></div>

	<p class='campo-obrigatorio'>(*) Campos Obrigatórios</p>
</form>


</div>

<?php include('View_rodape.php'); ?>
</body>   
</html>


