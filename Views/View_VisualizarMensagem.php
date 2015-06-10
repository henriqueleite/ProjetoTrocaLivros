<?php
require_once "../Dados/Conexao.php";
session_start();
if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:index.php');

}else if ($_SESSION['tipo'] != 1)
{
  unset($_SESSION['login']);
  header('location:index.php'); 
}

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];


$id = $_POST["idajuda"];

$_SESSION["idsuporte"] = $id;

$idajuda = $_SESSION["idsuporte"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Suporte.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>
</head>
<body>
  <?php include('../Views/View_topo_administrador.php'); ?>

  <?php

  $query = mysql_query("SELECT * FROM ajuda WHERE N_COD_AJUDA = '$idajuda'");

  while ($linha=mysql_fetch_array($query)){
        $codigoajuda   = $linha['N_COD_AJUDA'];
       $titulo= $linha['V_TITULO'];
       $tipoajuda    = $linha['V_TIPO'];
       $mensagem    = $linha['V_MENSAGEM'];
       $usuario   = $linha['N_COD_USUARIO_IE'];

  ?>

    <div style="heigth: auto; "id='corpo'>
    	<h2 class="h2_suporte">Visualizar Mensagem</h2>

      <div class='formulario_suporte'>
    <form>
    <p class="name">
        <label for="name">Título:</label>
        <label><b>RE-<?php echo $titulo; ?></b></label>
    </p>
    <p class="email">
         <label for="name">Tipo:</label>
         <label><b><?php echo $tipoajuda; ?></b></label>
    </p>
    <p class="text">
        <label for="mensagem">Mensagem</label>
        <textarea name="mensagem" readonly="readonly" id="mensagem" required/><?php echo $mensagem; ?></textarea>
    </p>

    </form>
  </div>

  <h2 class="h2_suporte_2">Responder Mensagem</h2>

      <div class="formulario_suporte_2">
    
    <form method="post" Action="?go=Enviar" class="form">
      <p class="name">
        <input type="hidden" name="codigoajuda" id="codigoajuda" value="<?php echo $codigoajuda;?>">
        <label for="name">Título:</label>
        
        <label for="titulo"><b>RE-<?php echo $titulo; ?></b></label>
        </p>
        <input type="hidden" name="tituloajuda" id="tituloajuda" value="<?php echo $titulo; ?>">
         <p class="email">
         <label for="name">Tipo:</label>
         <label for="tipo"><b><?php echo $tipoajuda; ?></b></label>

        <input type="hidden" name="tipoajuda" id="tipoajuda" value="Resposta">
        </p>
        <p class="text">
        <label for="mensagem">Resposta</label>
        <textarea name="resposta" id="resposta" placeholder="Escreva sua mensagem" required/></textarea>
        </p>
        <input type="submit" value="Enviar" />
    </form>
  </div>

<?php } ?>
     

    </div>

    <?php include('../Views/View_rodape.php'); ?>
</body>
</html>

<?php
if(@$_GET['go'] == 'Enviar'){

  $reposta = $_POST['resposta'];
  $tituloresposta = $_POST['tituloajuda'];
  $tipoajuda = $_POST['tipoajuda'];
  $idmensagemreposta = $_POST['codigoajuda'];

  if ($reposta == ""){
      echo "<script>alert('Preencha o campo Resposta'); history.back(); </script>";
  }
  else{

    $query2 = mysql_query("INSERT INTO ajuda (V_TITULO, V_TIPO, V_MENSAGEM, N_COD_RESPOSTA) VALUES('$tituloresposta','$tipoajuda','$resposta','$idmensagemreposta')");  
      if (!$query2) 
      {       
        echo "<script>alert('Erro'); history.back();</script>";
      }else
      {
        echo "<script>alert('Resposta enviada com sucesso!!');</script>";
        echo "<meta http-equiv='refresh' content='0, url=View_Suporte.php'>";  
    }


  }
}



?>
