<!DOCTYPE html>
<?php
require_once "Conexao.php";
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
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="CSS/AJUDA.css">
    <link rel="stylesheet" type="text/css" href="CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>
</head>
<body>
  <div id='cssmenu'>
      <div id='container'>
        <ul>
           <li><a href='index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
           <li><a href='GerenciarUsuario.php'><span>GERENCIAR USUÁRIOS</span></a></li>
           <li><a href='index.php'><span>EVENTO/CAMPANHA</span></a></li>
           <li><a href='Suporte.php'><span>SUPORTE</span></a></li>
           <li style="float: right" class="right"><a href='Logout.php'><span>SAIR</span></a></li>
           <li style="float: right" class="right"><span style="margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; ">|</span></li>  
           <li class='active' style="float: right" class="right"><a href='PerfilAdministrador.php'><span>PAINEL</span></a></li> 
        </ul>
      </div>
    </div>

  <?php

  $query = mysql_query("SELECT * FROM AJUDA WHERE N_COD_AJUDA = '$idajuda'");

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
        <label for="name">Título</label>
        <input class='input_formulario' readonly="readonly" type="text" name="titulo" id="titulo" size="50" value="<?php echo $titulo; ?>" required/>
    </p>
    <p class="email">
         <label for="name">Tipo</label>
         <select name="tipo" readonly="readonly" id="tipo" required>
            <option value="Dúvida">Dúvida</option>
            <option value="Sugestão">Sugestão</option>
            <option value="Reclamação">Reclamação</option>
         </select>
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
        <label for="name">Título</label>
        <label for="titulo">RE-<?php echo $titulo; ?></label>
    </p>
    <p class="email">
         <label for="name">Tipo</label>
         <label for="tipo"><?php echo $tipoajuda; ?></label>
    </p>
    <p class="text">
        <label for="mensagem">Resposta</label>
        <textarea name="resposta" id="resposta" placeholder="Escreva sua mensagem" required/></textarea>
    </p>
    <p class="submit">
        <input type="submit" value="Enviar" />
    </p>
    </form>
  </div>

<?php } ?>
     

    </div>

    <footer>
      <div class="bar">
        Rodapé
      </div>
      <div class='footer2'>
      <div class="bar2">
        Copyright © 2015 by Troca Livro
      </div>
    </div>
    </footer>
</body>
</html>

<?php
if(@$_GET['go'] == 'Enviar'){
  $reposta = $_POST['resposta'];
  $tituloresposta = 'RE-'. $_POST['$tituloajuda'];
  $tipoajuda = $_POST['tipoajuda'];
  $idmensagemreposta = $_POST['$codigoajuda'];

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
        echo "<meta http-equiv='refresh' content='0, url=Suporte.php'>";  
    }


  }
}



?>
