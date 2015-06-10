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

if (isset ($_POST['buscar'])){
   $pesquisa = $_POST['buscar'];
}else{
  $pesquisa = '';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Suporte.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>
</head>
<body>
  <?php include('../Views/View_topo_administrador.php'); ?>


    <div id='corpo'>
    	<h2>Suporte</h2>

      <form id="form1" name="form1" method="post" action="">
    <table width="" border="0" align="center">
    
  </form>
  
   <div class="wrapper">
                <div id="st-accordion" class="st-accordion">
      <?php

      $consulta = mysql_query("SELECT ajuda.*, usuario.V_NOME FROM ajuda inner join usuario on usuario.N_COD_USUARIO = ajuda.N_COD_USUARIO_IE ORDER BY ajuda.N_COD_AJUDA DESC");

      if (isset ($_POST['buscar'])){
        $consulta = mysql_query("SELECT ajuda.*, usuario.V_NOME FROM ajuda inner join usuario on usuario.N_COD_USUARIO = ajuda.N_COD_USUARIO_IE where V_TITULO like'%".$_POST['buscar']."%' ORDER BY ajuda.N_COD_AJUDA DESC");
        $pesquisa = $_POST['buscar'];
      }

      while ($linha=mysql_fetch_array($consulta)){
        $codigoajuda   = $linha['N_COD_AJUDA'];
       $titulomensagem= $linha['V_TITULO'];
       $tipomensagem    = $linha['V_TIPO'];
       $mensagem    = $linha['V_MENSAGEM'];
       $codusuariomensagem   = $linha['N_COD_USUARIO_IE'];
       $nomeusuario   = $linha['V_NOME'];

      
      ?>
      <form id="form2" name="form2" method="post" action="View_VisualizarMensagem.php">
     
                    <ul>
                        <li>
                            <a href="#">Código: <?php echo $codigoajuda; ?> | Título: <b> <?php echo $titulomensagem; ?></b> | Tipo: <?php echo $tipomensagem; ?> | Usuário: <?php echo $nomeusuario; ?>(<?php echo $codusuariomensagem; ?>)   <span class="st-arrow">Open or Close</span></a>
                            <div class="st-content">
                              <span style='width:30px; height: auto;' align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo $mensagem; ?></span>   <br>
                              <input type="hidden" name="idajuda" id="idajuda" value="<?php echo $codigoajuda;?>">
                              <input style="width: 80px;" title="Responder" type="submit" name="Responder"  id="Responder"   value="Responder" />
                            </div>
                        </li>
                    </ul>



          </form>


         <?php } ?>
      

                </div>
            </div>
       </table>



      <?php 
        //if ($countPedido <> 0) {
          //echo $countPedido." pedido(s), enviado com sucesso."; 
          //echo "<br>";
        //}
      ?>


    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.accordion.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
      
        $('#st-accordion').accordion();
        
            });
        </script>

   <?php include('../Views/View_rodape.php'); ?>
</body>
</html>
