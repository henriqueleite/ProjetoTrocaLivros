<?php
require_once "../Dados/Conexao.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />

    <link rel="stylesheet" type="text/css" href="../CSS/Login.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
	<link rel="shortcut icon" href="../favicon.ico"> 
	<script src="js/modernizr.custom.63321.js"></script>
	<script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.form.js'></script>
    </script>

     <script type="text/javascript">
        // Quando carregado a página
        $(function($) {

            // Quando enviado o formulário
            $('#form-2').submit(function() {

                // Limpando mensagem de erro
                $('div.mensagem-erro').html('');

                // Mostrando loader
                $('div.loader').show();

                // Enviando informações do formulário via AJAX
                $(this).ajaxSubmit(function(resposta) {

                    // Se não retornado nenhum erro
                    if (!resposta)
                        // Redirecionando para o painel
                        window.location.href = 'index.php';
                    else
                    {
                        // Encondendo loader
                        $('div.loader').hide();

                        // Exibimos a mensagem de erro
                        $('div.mensagem-erro').html(resposta);
                    }

                });

                // Retornando false para que o formulário não envie as informações da forma convencional
                return false;

            });
        });
        </script>
</head>
<body>
     <?php include('View_topo.php'); ?>


      <div id="login">

		<form class="form-2" id="form-2" method="post" action="../Repositorio/Repositorio_autenticacao.php">
					<h1><span class="log-in">Logar</span> ou <a href="View_CadastroUsuario.php"><span class="sign-up"> Cadastre-se</span></a></h1>

					<div class="loader" style="display: none;"><img src="../Imagens/loader.gif" alt="Carregando" /></div>
                	<div class="mensagem-erro"></div>

					<p class="float">

						<label for="login"><i class="icon-user"></i>Usuario</label>
						<input type="text" name="usuario" placeholder="Usuario">
					</p>
					<p class="float">
						<label for="password"><i class="icon-lock"></i>Senha</label>
						<input type="password" name="senha" placeholder="Senha" class="showpassword">
					</p>
					<p class="clearfix"> 
						<a href="View_CadastroUsuario.php" class="log-twitter">CADASTRE-SE</a>    
						<input type="submit" name="submit" value="LOGIN">
					</p>
		</form>​​
	  </div>

   
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Password' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Show password")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
		</script>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
		 <?php include('View_rodape.php'); ?>
</body>
</html>

