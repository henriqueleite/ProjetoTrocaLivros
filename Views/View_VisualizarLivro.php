<?php
require_once "../Dados/Conexao.php";
session_start();

if(isset($_POST['codigolivro']))
{
  $codigolivro = $_POST['codigolivro'];
  $_SESSION['codigoLivroAlt'] = $codigolivro;
}
//se a o id do livro tiver vindo da pagina index ele vai visualizar o livro
else if(isset($_GET['id']))
{
  $codigolivro = $_GET['id'];
  $_SESSION['codigoLivroAlt'] = $codigolivro;
}


if((isset ($_SESSION['login']) == true))
{
  $logado = $_SESSION['login'];
  $codigo = $_SESSION['codigo'];
  $tipo = $_SESSION['tipo'];
}

if (isset ($_POST['excluir']))
{
  $codigoLivro = $_SESSION['codigoLivroAlt'];

  $deletarcomentarios = mysql_query("DELETE FROM comentario where N_COD_LIVRO_IE = '$codigoLivro'");
  $excluir = mysql_query("DELETE FROM livro WHERE N_COD_LIVRO  = '$codigoLivro'");


  if($excluir)
  {
   echo "<script>alert('Livro excluido com sucesso!');</script>";
   echo "<meta http-equiv='refresh' content='0, url=../Repositorio/PerfilUsuario.php'>";
   die();
 }
 else
 {
  echo "<script>alert('O livro não pode ser excluido, pois está sendo utilizado em alguma troca!');</script>";
}
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <!--<link rel="stylesheet" href="style.css" media="all" />-->
  <link rel="stylesheet" type="text/css" href="../CSS/VisualizarLivro.css">
  <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
  <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
  <script type="text/javascript" src="../jquery.js"></script>
  <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="../jquery.rating.js"></script>
  <script type="text/javascript">
    jQuery(function(){
      jQuery('form.rating').rating();
    });
  </script>
  
  <style type="text/css">
    .rating{clear: both; cursor: pointer; display: block; width: 100px;}
    .rating:after{content: '.'; display: block; height: 0;width: 0;clear: both; visibility: hidden;}
    .cancel, .star {float: left; width: 17px;height: 15px;overflow: hidden;text-indent: -999em;cursor: pointer; }

    .star,
    .star a {background: url(../star.gif) no-repeat 0 0px;}
    .star a { display: block; width: 100%; height: 100%; background-position: 0 0px; }

    div.rating div.on a { background-position: 0 -16px;}
    div.rating div.hover a, div.rating div a:hover { background-position: 0 -32px; }

    div.done, div.done a { cursor: default; }

    #votosComputados{font-family: sans-serif; font-size: 12px;}
  </style>
</head>

<body>
   <?php include('../Views/View_topo.php'); ?>
<?php
if (isset ($_POST['Solicitar'])){
  echo "<meta http-equiv='refresh' content='0, url=../Controles/Controle_funcaoSolicitarLivro.php?id=$codigolivro'>";  
}

if (isset ($_POST['alterar'])){
  echo "<meta http-equiv='refresh' content='0, url=View_AltLivro.php'>"; 
}

$query = mysql_query("SELECT livro.*, categoria_livro.V_GENERO, usuario.V_NOME FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE INNER JOIN usuario on usuario.N_COD_USUARIO = livro.N_COD_USUARIO_IE WHERE N_COD_LIVRO = '$codigolivro'");

while($linha=mysql_fetch_array($query)){

  $codigolivro = $linha['N_COD_LIVRO'];
  $titulo = $linha['V_TITULO'];
  $autor = $linha['V_AUTOR'];
  $editora = $linha['V_EDITORA'];
  $estado = $linha['V_ESTADO_LIVRO'];
  $observacao = $linha['V_OBSERVACAO'];
  $foto = $linha['V_FOTO'];
  $genero = $linha['V_GENERO'];
  $ano = $linha['V_ANO'];
  $nomeusuario = $linha['V_NOME'];
  $codigousuario = $linha['N_COD_USUARIO_IE'];
}

?>
<form id="form2" name="form2" method="post" action="">
  <div style="height: 500px;" id='corpo'>
   <h2>Livro: <?php echo $titulo; ?></h2>
   <div style="height: 210px;" id="lateral">
    <p style="margin-bottom: 0px;"><img style= "margin-top: -16px; border: 2px solid #133141;" src="../<?php echo $foto; ?>" width="198" height="198"></p>  
  </div>
  <div id="centro">
    <p style="text-transform: uppercase; font-size: 20pt; margin-bottom:0px; margin-top: 0px;"><?php echo $titulo; ?></p>
    <p style="text-transform: uppercase; font-size: 10pt; margin-bottom:0px; margin-top: 0px;">Dono: <?php echo $nomeusuario; ?></p>

    <fieldset style="margin-top: 10px;">
      <p class='info-central'>Autor: <?php echo $autor; ?></p>
      <p class='info-central'>Editora: <?php echo $editora; ?></p>
      <p class='info-central'>Estado do livro: <?php echo $estado; ?></p>
      <p class='info-central'>Gênero: <?php echo $genero; ?></p>
      <p class='info-central'>Ano: <?php echo $ano; ?></p>
      <p class='info-central'>Observação: <?php echo $observacao; ?></p>

    </fieldset>
    <?php
    if( (isset ($_SESSION['login']) == true) and ($_SESSION['codigo'] <> $codigousuario)){
      ?>
      <td colspan="2"><input style="  width: 200px;" type="submit" class='btn' name="Solicitar" id="Solicitar" value="Solicitar"/>
        <?php
      }
      ?>
      <?php 
      if((isset ($_SESSION['login']) == true) and ($_SESSION['codigo'] == $codigousuario)){
        ?>
        <input style=" width: 200px; margin-top: 4px;" type="submit" name="excluir" class='btn' id="excluir" value="Excluir"/> 
        <input style="  width: 200px; margin-top: 4px;" type="submit" class='btn' name="alterar" id="alterar" value="Alterar"/>
        <?php

      } 
      ?>
    </td>

  </form>



  <div class="comentarios">

   <h2 class="h2_comentarios" id="h2_comentarios" style="margin-top: 10px;     border-top-left-radius: 0px;
    border-top-right-radius: 0px;">Comentários</h2>
   <?php
   if(isset($_SESSION['codigo'])){
     ?>	 
     <p>Comentário:</p>
     <form method="post" action="../Repositorio/Repositorio_EnviarComentario.php">
      <textarea name="comentario" id="comentario" required></textarea>
      <input type="submit" value="Enviar Comentário"/>
    </form>
  <!--   <p>Avaliação desse livro:</p> -->
     <!-- <form style="display:none" title="Average Rating: <?=$r?>" class="rating" action="../rate.php"> -->
    <!--   <input type="hidden" name="valor" value="<?php //echo $codigolivro; ?>">  -->                          
    <!--   <select id="r1"> -->
    <!--     <option value="1">1</option> -->
    <!--     <option value="2">2</option> -->
    <!--     <option value="3">3</option> -->
    <!--     <option value="4">4</option> -->
    <!--     <option value="5">5</option> -->
     <!--  </select>
    </form>
    <div id="votosComputados">
      <?php //echo "Pontuação: ". $r."/5 (".$rf['V_VOTOS']." votos)"; ?>
    </div><!--fim div votosComputados-->  
    <!--<div id="votosComputados">-->
      <?php //echo "Pontuação: ". $r."/5 (".$rf['V_VOTOS']." votos)"; ?>
     <!--</div><!fim div votosComputados--> 

    <!--termina a avaliação por estrelas-->


   




    <hr>
     <?php
   }
    $querycomentarios = mysql_query("SELECT comentario.*, usuario.V_NOME, usuario.V_FOTO FROM comentario inner join usuario on usuario.N_COD_USUARIO = comentario.N_COD_USUARIO_IE WHERE comentario.N_COD_LIVRO_IE = $codigolivro");

    while($consulta = mysql_fetch_array($querycomentarios)){
     $fotousuario = $consulta["V_FOTO"];
     $nomeusuario = $consulta["V_NOME"];
     $comentario = $consulta["V_COMENTARIO"];	
     $datacomentario = $consulta["D_DATA"];


     ?>
     <TABLE>
       <ul class="tabela_comentarios">
         <li class="tabela_comentarios_foto"><img src="<?php echo $fotousuario ?>"/></li>
         <li class="tabela_comentarios_nome"><?php echo $nomeusuario ?> comentou:</li>
         <li class="tabela_comentarios_data"><?php echo date("d/m/Y", strtotime($datacomentario)) ?></li>
         <li class="tabela_comentarios_comentario"><?php echo $comentario ?></li>
         <hr>
       </ul>
     </TABLE>
     <?php } ?>

   </div>
 </div>



 <input type='hidden' name="codigolivro" id="codigolivro" value="<?php echo $codigolivro;?>" >

 


</div>
</form> 
<?php include('../Views/View_rodape.php'); ?>
</body>
</html>
