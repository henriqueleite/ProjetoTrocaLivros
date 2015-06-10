<?php
require_once "../Dados/Conexao.php";
session_start();

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

$query12 =  mysql_query("SELECT troca.*, (LIVRO_SOLICITADO.V_FOTO) AS FOTO_SOLICITADO, (LIVRO_SOLICITANTE.V_TITULO) AS DESC_LIVRO_SOLICITADO,  (LIVRO_SOLICITADO.V_TITULO) AS DESC_LIVRO_SOLICITANTE ,(LIVRO_SOLICITANTE.V_FOTO) AS FOTO_SOLICITANTE, (USUARIO_SOLICITADO.V_NOME)  AS NOME_SOLICITANTE , (USUARIO_SOLICITANTE.V_NOME) AS NOME_SOLICITADO, (USUARIO_SOLICITANTE.N_COD_USUARIO) AS COD_SOLICITADO   FROM troca 
  INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE INNER JOIN usuario AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
  INNER JOIN usuario AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITANTE.N_COD_USUARIO_IE WHERE (LIVRO_SOLICITADO.N_COD_USUARIO_IE = '$codigo' OR LIVRO_SOLICITANTE.N_COD_USUARIO_IE = '$codigo') AND troca.N_COD_TROCA = ".$_SESSION["id_troca"]." ");
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
  <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
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
  <?php include('../Views/View_topo.php'); ?>


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
<?php include('../Views/View_rodape.php'); ?>
</body>
</html>
