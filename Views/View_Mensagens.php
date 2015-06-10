<?php
require_once "../Dados/Conexao.php";
session_start();
if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:../index.php');
}

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];

?>
<!DOCTYPE html>
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
     <li><a href='#'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
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
  echo "<li style='float: right' class='right'><a href='./Views/View_Login.php'><span>LOGIN</span></a></li>";
  echo "<li style='float: right' class='right'><a href='./Views/View_CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>";
}
?> 

    </ul>
  </div><!--fim div container-->
</div><!--fim div cssmenu-->


 <div style="height: 700px; "id='corpo'>
   <h2>Mensagens</h2>

   <form id="form1" name="form1" method="post" action="">
    <table width="" border="0" align="center">
      <tr>
        <td height="50" colspan="8" align="center" valign="middle"> 
          <label for="Descrição"> Nome:</label> 
          <input type="text" name="buscar" id="buscar" size=50 value="<?php 
          if(isset($pesquisa))
          {
            echo $pesquisa;
          }
          else
          {
            echo "";
          }
          ?>"/> 
          <label for="buscar"></label> 
          <input type="submit" name="btnPerfil" id="btnPerfil" value="buscar" /></td>
        </tr>
        <tr>

        </tr>
        <tr>
          <td width="80" align="center" valign="middle" bgcolor="#eee">Título</td>
          <td width="300" align="center" valign="middle" bgcolor="#eee">Tipo</td>
          <td width="100" align="center" valign="middle" bgcolor="#eee">Mensagem</td>
        </tr>
      </form>

      <?php


      $consulta = mysql_query("SELECT AJUDA.*, AJUDA_RESPOSTA.N_COD_USUARIO_IE FROM AJUDA INNER JOIN AJUDA AS AJUDA_RESPOSTA ON AJUDA_RESPOSTA.N_COD_AJUDA = AJUDA.N_COD_RESPOSTA WHERE AJUDA_RESPOSTA.N_COD_USUARIO_IE = '$codigo' AND AJUDA.N_COD_USUARIO_IE IS NULL");

      if (isset ($_POST['buscar'])){
        $consulta = mysql_query("SELECT * FROM ajuda where V_TITULO like'%".$_POST['buscar']."%'");
        $pesquisa = $_POST['buscar'];
      }

      while ($linha=mysql_fetch_array($consulta)){
        $codigoajuda   = $linha['N_COD_AJUDA'];
        $titulo = $linha['V_TITULO'];
        $tipo    = $linha['V_TIPO'];
        $mensagem    = $linha['V_MENSAGEM'];
        $reposta   = $linha['N_COD_RESPOSTA'];


        ?>
        <form id="form2" name="form2" method="post" action="">
          <tr>
            <td align="center" valign="middle" ><?php echo $titulo; ?></td>
            <td align="center" valign="middle" ><?php echo $tipo; ?></td>
            <td align="center" valign="middle" ><?php echo $mensagem; ?></td>
            <td align="center" valign="middle" ></td>
            <input type='hidden' name="codigo" id="codigo" value="<?php echo $codigo;?>" >
          </tr> 
        </form>
        <?php } ?>


      </table>
      <?php 
        //if ($countPedido <> 0) {
          //echo $countPedido." pedido(s), enviado com sucesso."; 
          //echo "<br>";
        //}
      ?>


    </div>

    <?php include('View_rodape.php'); ?>
  </body>
  </html>
