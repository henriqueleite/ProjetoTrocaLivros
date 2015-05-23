<!DOCTYPE html>
<?php
session_start();
require_once "../Dados/Conexao.php";
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


?>
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
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

  if (isset ($_POST['Solicitar'])){
    echo "<script>alert('Solicitação enviada com sucesso!');</script>"; 
  }

  if (isset ($_POST['alterar'])){
    echo "<meta http-equiv='refresh' content='0, url=AltLivro.php'>"; ; 
  }

  $query = mysql_query("SELECT livro.*, categoria_livro.V_GENERO, usuario.V_NOME FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE INNER JOIN usuario on usuario.N_COD_USUARIO = livro.N_COD_USUARIO_IE WHERE N_COD_LIVRO = '$codigolivro'");

  while($linha=mysql_fetch_array($query)){

    $codigo = $linha['N_COD_LIVRO'];
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
     <div style="height: 450px;" id="lateral">
      <p style="margin-bottom: 0px;"><img style= "margin-top: -16px; border: 2px solid #133141;" src="<?php echo $foto; ?>"width="198" height="198"></p>
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


      <h2 style="margin-top: 10px;">Comentários</h2>
    </div>



    <input type='hidden' name="codigolivro" id="codigolivro" value="<?php echo $codigolivro;?>" >


  </div>
</form> 
<?php include('View_rodape.php'); ?>
</body>
</html>
