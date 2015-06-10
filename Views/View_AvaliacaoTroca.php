<!DOCTYPE html>
<?php
session_start();
require_once "../Dados/Conexao.php";

if(isset($_POST["codigoTroca"]))
{
  $_SESSION["id_troca"] = $_POST["codigoTroca"];
}


if(isset( $_SESSION["id_troca"]))
{

}
else
{
  header("Location: ../Repositorio/PerfilUsuario.php");  
  die();
}

if((isset ($_SESSION['login']) == true))
{
  $logado = $_SESSION['login'];
  $codigo = $_SESSION['codigo'];
  $tipo = $_SESSION['tipo'];
}

$query12 =  mysql_query("SELECT TROCA.*, (LIVRO_SOLICITADO.V_FOTO) AS FOTO_SOLICITADO, (LIVRO_SOLICITANTE.V_TITULO) AS DESC_LIVRO_SOLICITADO,  (LIVRO_SOLICITADO.V_TITULO) AS DESC_LIVRO_SOLICITANTE ,(LIVRO_SOLICITANTE.V_FOTO) AS FOTO_SOLICITANTE, (USUARIO_SOLICITADO.V_NOME)  AS NOME_SOLICITANTE , (USUARIO_SOLICITANTE.V_NOME) AS NOME_SOLICITADO, (USUARIO_SOLICITANTE.N_COD_USUARIO) AS COD_SOLICITADO   FROM TROCA 
  INNER JOIN LIVRO AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = TROCA.N_COD_LIVRO INNER JOIN LIVRO AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = TROCA.N_COD_LIVRO_SOLICITANTE INNER JOIN USUARIO AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
  INNER JOIN USUARIO AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITANTE.N_COD_USUARIO_IE WHERE (LIVRO_SOLICITADO.N_COD_USUARIO_IE = '$codigo' OR LIVRO_SOLICITANTE.N_COD_USUARIO_IE = '$codigo') AND TROCA.N_COD_TROCA = ".$_SESSION["id_troca"]." ");
?>
<script LANGUAGE="JavaScript">

function mostrarResultado(box,num_max,campospan){
  var contagem_carac = box.length;
  if (contagem_carac != 0){
    document.getElementById(campospan).innerHTML = contagem_carac + "/255 caracteres digitados";
    if (contagem_carac == 1){
      document.getElementById(campospan).innerHTML = contagem_carac + "/255 caracter digitado";
    }
    if (contagem_carac >= num_max){
      document.getElementById(campospan).innerHTML = "Limite de 255 caracteres...";
    }
  }else{
    document.getElementById(campospan).innerHTML = "0/255 caracteres digitados...";
  }
}



</script> 
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <!--<link rel="stylesheet" href="style.css" media="all" />-->
  <link rel="stylesheet" type="text/css" href="../CSS/VisualizarLivro.css">
  <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">

  <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
  <script type="text/javascript" src="../jquery.js"></script>
  <script type="text/javascript" src="../jquery.rating.js"></script>
  <script type="text/javascript">
    jQuery(function(){
      jQuery('form.rating').rating();
    });
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
    echo "<li style='float: right' class='right'><a href='#'><span>CADASTRAR-SE</span></a></li>";
  }
  ?> 

</ul>
</div><!--fim div container-->
</div><!--fim div cssmenu-->

<div id="corpo">
  <h2>Avaliação da Troca</h2>
     <form method="post" action="../Repositorio/Repositorio_AvaliacaoTroca.php">
      <?php
while ($linhasolicitacao=mysql_fetch_array($query12)){
              $codigosolicitacao = $linhasolicitacao["N_COD_TROCA"];
              $foto_solicitado = $linhasolicitacao["FOTO_SOLICITADO"];
              $foto_solicitante= $linhasolicitacao['FOTO_SOLICITANTE']; 
              $usuario_solicitado= $linhasolicitacao['NOME_SOLICITADO']; 
              $codigousuariosolicitado = $linhasolicitacao['COD_SOLICITADO']; 
              $usuario_solicitante= $linhasolicitacao['NOME_SOLICITANTE']; 
              $livro_solicitante = $linhasolicitacao['DESC_LIVRO_SOLICITANTE']; 
              $livro_solicitado = $linhasolicitacao['DESC_LIVRO_SOLICITADO']; 
              ?>
              <h5 class="listar-solicitacoes">
         <table class="table-listar-solicitacoes">
                    <tr class="listar-solicitacoes">
                      <td class="listar-solicitacoes-foto-solicitado"><img src="../<?php echo $foto_solicitado; ?>"width="50" height="50"></td>
                      <td class="listar-solicitacoes-foto-troca"><img src="../Imagens/Troca.png"width="50" height="50"></td>
                      <td class="listar-solicitacoes-foto-solicitante"><img src="../<?php echo $foto_solicitante; ?>"width="50" height="50"></td>
                        <?php
                        if ($codigo == $codigousuariosolicitado){
                        ?> <td class="listar-livro-solicitacoes-usuario-solicitado"><?php echo $usuario_solicitante.",".$livro_solicitante;?></td>
                        <?php
                          
                        }else{
                          ?> <td class="listar-livro-solicitacoes-usuario-solicitado"><?php echo $usuario_solicitado.",".$livro_solicitado;?></td>
                          <?php
                        }    
                        ?>

          
                    </tr>
                  </table>
                  </h5>
 <?php } ?>

      <textarea name="avaliacao" id="avaliacao" rows="5" cols="80" onkeyup="mostrarResultado(this.value,255,'spcontando');contarCaracteres(this.value,255,'sprestante')"/></textarea>
              <br><span id="spcontando">0/255 caracteres digitados...</span>
        <br></br>
      <input type="submit" value="Enviar Avaliação" name="btAvaliacao"/>
   

    </form>  
</div>
</form> 
<?php include('View_rodape.php'); ?>
</body>
</html>
