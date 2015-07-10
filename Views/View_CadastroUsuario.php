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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
  <link rel="shortcut icon" href="../favicon.ico"> 
  <script src="js/modernizr.custom.63321.js"></script>
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.form.js'></script>

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
        <script type="text/javascript">
        // Quando carregado a página
        $(function($) {

            // Quando enviado o formulário
            $('#form-cadastro').submit(function() {

                // Limpando mensagem de erro
                $('div.mensagem-erro').hide();

                // Mostrando loader
                $('div.loader').show();

                // Enviando informações do formulário via AJAX
                $(this).ajaxSubmit(function(resposta) {

                    // Se não retornado nenhum erro
                    if (!resposta)
                        // Redirecionando para o painel
                        window.location.href = '../Views/View_Login.php';
                    else
                    {
                        // Encondendo loader
                        $('div.loader').hide();

                        // Exibimos a mensagem de erro
                        $('div.mensagem-erro').html('<img src="../Imagens/Alerta.png" width=20px height=20px/> <span>'+resposta+'</span>');

                        $('div.mensagem-erro').show();
                    }

                });

                // Retornando false para que o formulário não envie as informações da forma convencional
                return false;

            });
        });
        </script>

<script>
    function consultacep(cep){
      cep = cep.replace(/\D/g,"")
      url="http://cep.correiocontrol.com.br/"+cep+".js"
      s=document.createElement('script')
      s.setAttribute('charset','utf-8')
      s.src=url
      document.querySelector('head').appendChild(s)
    }

    function correiocontrolcep(valor){
      if (valor.erro) {
        alert('Cep não encontrado');        
        return;
      };
      document.getElementById('bairro').value=valor.bairro
      document.getElementById('cidade').value=valor.localidade
      document.getElementById('estado').value=valor.uf
    }
    </script>




</head>
<body>
	  <?php include('View_topo.php'); ?>

<div id='corpo'>
<h2>Cadastro </h2>

<div class="loader" style="display: none;"><img src="../Imagens/loader.gif" alt="Carregando" /></div>
<div class="mensagem-erro" style="display: none;" ></div>
<form method="post" action="../Repositorio/Repositorio_cadastrausuario.php" class="form-cadastro" id="form-cadastro">



  <div class="col-2" id="cad_table">
    <label>
      Nome*:
      <input type="text" name="nome" id="nome" class="txt" required size=35  placeholder="Digite seu nome e sobrenome" tabindex="1" />
    </label>
  </div>
   <div class="col-2">
    <label>
      Email*:
      <input type="email" name="email" id="email" class="txt" required size=35 placeholder="Digite seu email" tabindex="1" />
    </label>
  </div>
  <div class="col-2">
    <label>
      Data Nasc*.:
      <input type='text' name='dataNascimento' id="dataNascimento" required class="txt" maxlength='10' size='14' onKeyPress='MascaraData(this); return SomenteNumero(event); ' placeholder="Digite sua data de nascimento" tabindex="2" />
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
      <input type="text" name="cpf" id="cpf" class="txt2" required maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" size=35  placeholder="Digite seu CPF (somente números)" tabindex="2" />
    </label>
  </div>
  <div class="col-2">
    <label>
      Contato telefônico*:
      <input type="tel" name="celular" id="celular" class="txt2" required maxlength="14" onkeypress="formatar('##-#####-####', this); return SomenteNumero(event); "  size=35 placeholder="Digite seu telefone ou celular (somente números)" tabindex="4" />
    </label>
  </div>
  <div class="col-3">
    <label>
      Login*:
      <input type="text" name="login" id="login" required class="txt1" maxlength="10" size=35  placeholder="Digite seu login" tabindex="3" />
    </label>
  </div>
  <div class="col-3">
    <label>
      Senha*:
      <input type="password" name="senha" id="senha" required class="txt1" maxlength="15" size=35  placeholder="Digite sua senha" tabindex="3" />
    </label>
  </div>
  <div class="col-3">
    <label>
      Confirme a senha*:
      <input type="password" name="senha2" id="senha2" required class="txt1" maxlength="15" size=35 placeholder="Digite sua senha novamente" tabindex="3" />
    </label>
  </div>
  <div style='width: 28.333%;' class="col-3">
    <label>
      CEP*:
      <input type="text" name="cep" id="cep" required class="cep"  OnKeyPress="formatar('#####-###', this)" onblur="consultacep(this.value)" maxlength="9" size=35 placeholder="Digite seu CEP (somente números)" tabindex="4" />
    </label>
  </div>
  <div style="width: 10.333%;" class="col-3">
    <label>
      UF:
      <input readonly="true" type="text" name="estado" id="estado" class="estado" maxlength="2" size=2 placeholder="UF" tabindex="5" />
    </label>
  </div>
  <div class="col-3">
    <label>
      Cidade:
      <input readonly="true" type="text" name="cidade" id="cidade" class="cidade" maxlength="100"  size=35 placeholder="Sua cidade" tabindex="5" />
    </label>
  </div>
  <div style="width: 27.7%;" class="col-3">
    <label>
      Bairro:
      <input readonly="true" type="text" name="bairro" id="bairro" class="bairro" maxlength="50" size=35 placeholder="Seu bairro" tabindex="5" />
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


	<p class='campo-obrigatorio'>(*) Campos Obrigatórios</p>
</form>


</div>

<?php include('View_rodape.php'); ?>
</body>   
</html>


