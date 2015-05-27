<!DOCTYPE html>
<?php
require_once "../Dados/Conexao.php";
session_start();

if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:../index.php');
}
$mensagem = '';
$codigo = $_SESSION['codigo'];



?>
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
  <link rel="stylesheet" type="text/css" href="../CSS/ChatTroca.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
  <script type='text/javascript' src='../js/chat.js'></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
</script>
</head>
<body>
 <div id='cssmenu'>
  <div id='container'>
    <ul>
     <li><a href='#'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
     <li class='active'><a href='#'><span>ÍNICIO</span></a></li>
     <li><a href='Views/View_Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
     <li><a href='Views/View_Form_Ajuda.php'><span>SOBRE</span></a></li>
     <li class='last'><a href='Views/View_Form_Ajuda.php'><span>CONTATO</span></a></li>
     <li><form name="frmBusca" method="post" action="iew_Buscar.php" >

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
  echo "<li style='float: right' class='right'><a href='../Views/View_CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>";
}
?> 

    </ul>
  </div><!--fim div container-->
</div><!--fim div cssmenu-->



  <div id='corpo'>  
  
     <?PHP 
	$query2 = mysql_query("SELECT (LIVRO_SOLICITADO.V_FOTO) AS FOTOSOLICITADO, (LIVRO_SOLICITANTE.V_FOTO) AS FOTOSOLICITANTE, (LIVRO_SOLICITADO.V_TITULO) AS LIVRONOMESOLICITADO, 
							(LIVRO_SOLICITANTE.V_TITULO) AS LIVRONOMESOLICITANTE 
							FROM mensagens_troca 
							INNER JOIN troca ON troca.N_COD_TROCA = mensagens_troca.N_COD_TROCA_IE
							INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO
							INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE
							WHERE mensagens_troca.N_COD_TROCA_IE = ".$_SESSION['id_troca']." LIMIT 1");
	while($dados = mysql_fetch_array($query2)){
	$FOTOSOLICITADO = $dados["FOTOSOLICITADO"]; 
	$FOTOSOLICITANTE = $dados["FOTOSOLICITANTE"];
	$LIVRONOMESOLICITADO = $dados["LIVRONOMESOLICITADO"];
	$LIVRONOMESOLICITANTE = $dados["LIVRONOMESOLICITANTE"];
	}
	?>
    <div class="livros">
	<table class="table_livros">
    <tr>
    <th><img src=../<?php echo $FOTOSOLICITADO ?> width="100px" height="100px"/></td>
    <th><img src=../Imagens/Troca.png width="50px" height="50px"/></td>
    <th>	<img src=../<?php echo $FOTOSOLICITANTE ?> width="100px" height="100px;"/></td>
    </tr>
    <tr>
    <td>    <P><?php echo $LIVRONOMESOLICITADO ?></P></td>
    <td>    <P> </P></td>
    <td>    <P><?php echo $LIVRONOMESOLICITANTE ?></P></td>
    </tr>
    </table>

	<input class="btn_finalizar" type="button" value="Solicitar Finalização da troca"/>
    </div>
    
  	<div id="janelas">
   		<div class="janela">
   			<div class="topo">
        		<span>Mensagens para troca</span>
        	</div>
    		<div class="corpomensagem">            
    			<div class="mensagens">
        			<ul class="listar">	
                    <?php
					$query = mysql_query("SELECT mensagens_troca.*, USUARIO_MENSAGEM.V_NOME from mensagens_troca INNER JOIN troca ON troca.N_COD_TROCA = mensagens_troca.N_COD_TROCA_IE
											INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = TROCA.N_COD_LIVRO
											INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = TROCA.N_COD_LIVRO_SOLICITANTE
											INNER JOIN usuario AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
											INNER JOIN usuario AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
											INNER JOIN usuario as USUARIO_MENSAGEM ON USUARIO_MENSAGEM.N_COD_USUARIO = mensagens_troca.N_USUARIO_DE 
											WHERE mensagens_troca.N_COD_TROCA_IE = ".$_SESSION['id_troca']." order by mensagens_troca.n_cod_mensagens_troca;");
					while ($consulta = mysql_fetch_array($query)){
					$mensagem = $consulta["V_MENSAGEM"];	
					$usuario = $consulta["V_NOME"];
                    echo '<li><span>'.$usuario.' disse:</span><p>'.$mensagem.'</p></li>';
					}	
					?>	
           	    	</ul>
       			</div>
                <form method="post" action="../Repositorio/Repositorio_Chat.php">
       				<input type="text" class="mensagem" id="mensagem" name="mensagem" maxlength="255"/>
                    <input type="submit" class="btn_mensagem" value="Enviar"/>
                </form>
              </div>
     	</div>
    </div> 
   

  </div>
<?php include('View_rodape.php'); ?>
</body>
</html>