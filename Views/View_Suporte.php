<!DOCTYPE html>
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
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
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


    <div style="height: 700px; "id='corpo'>
    	<h2>Gerenciador de Usuários</h2>

      <form id="form1" name="form1" method="post" action="">
    <table width="" border="0" align="center">
    <tr>
      <td height="50" colspan="8" align="center" valign="middle"> <label for="Descrição"> Nome:</label> <input type="text" name="buscar" id="buscar" size=50 value="<?php echo $pesquisa; ?>"/>  <input type="submit" name="btnPerfil" id="btnPerfil" value="buscar" /> <label for="buscar"></label></td>
    </tr>
    <tr>

    </tr>
    <tr>
      <td style="color: #036564;" width="80" align="center" valign="middle" bgcolor="#133141">Código</td>
      <td style="color: #036564;" width="300" align="center" valign="middle" bgcolor="#133141">Título</td>
      <td style="color: #036564;" width="100" align="center" valign="middle" bgcolor="#133141">Tipo</td>
      <td style="color: #036564;" width="30" align="center" valign="middle" bgcolor="#133141">Mensagem</td>
      <td style="color: #036564;" width="30" align="center" valign="middle" bgcolor="#133141">Ação</td>
    </tr>
  </form>

      <?php

      $consulta = mysql_query("SELECT * FROM ajuda");

      if (isset ($_POST['buscar'])){
        $consulta = mysql_query("SELECT * FROM ajuda where V_TITULO like'%".$_POST['buscar']."%'");
        $pesquisa = $_POST['buscar'];
      }

      while ($linha=mysql_fetch_array($consulta)){
        $codigoajuda   = $linha['N_COD_AJUDA'];
       $nome= $linha['V_TITULO'];
       $login    = $linha['V_TIPO'];
       $cpf    = $linha['V_MENSAGEM'];
       $ativo   = $linha['N_COD_USUARIO_IE'];

          if ($ativo == "T") {
            $cor = "#eee";
            $descStatus = "Ativo";
            $ImagemStatus = "Imagens/BloqueiaUsuario.png";
            $AcaoStatus = "Bloquear Usuário";
            $Form = "Bloquear";
          } else if ($ativo == "F") {
            $cor = "#CD5555";
            $descStatus = "Inativo";
            $ImagemStatus = "Imagens/DesbloqueiaUsuario.png";
            $AcaoStatus = "Desbloquear Usuário";
            $Form = "Desbloquear";
          }
          
      ?>
        <form id="form2" name="form2" method="post" action="VisualizarMensagem.php">
        <tr>
          <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo $codigoajuda; ?></td>
          <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo $nome; ?></td>
          <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo $login; ?></td>
          <td style='width:30px; height: auto;' align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo $cpf; ?></td>
          <td align="center" valign="middle" bgcolor="<?php echo $cor ?>">
            <input type="hidden" name="idajuda" id="idajuda" value="<?php echo $codigoajuda;?>">
            <input style="width: 80px;" title="Responder" type="submit" name="Responder"  id="Responder"   value="Responder" />
          </td>
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
