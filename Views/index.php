<?php
session_start();
require_once "../Dados/Conexao.php";

?>
<!DOCTYPE html>
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="../CSS/index.css">
  <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
  <link rel="shortcult icon" type="image/x-icon" href="favicon.png">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
  <script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</script>
<script>


    </script>
</head>
<body >
  <?php include('../Views/View_topo.php'); ?>

 
  <div id='corpo'>
 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1210" height="550" id="FlashID" title="teste">
   <param name="movie" value="teste2.swf">
   <param name="quality" value="high">
   <param name="wmode" value="opaque">
   <param name="swfversion" value="15.0.0.0">
   <!-- Esta tag param solicita que os usuários com o Flash Player 6.0 r65 e versões posteriores baixem a versão mais recente do Flash Player. Exclua-o se você não deseja que os usuários vejam o prompt. -->
   <param name="expressinstall" value="Scripts/expressInstall.swf">
   <!-- A tag object a seguir aplica-se a navegadores que não sejam o IE. Portanto, oculte-a do IE usando o IECC. -->
   <!--[if !IE]>-->
   <object type="application/x-shockwave-flash" data="teste2.swf" width="1210" height="550">
     <!--<![endif]-->
     <param name="quality" value="high">
     <param name="wmode" value="opaque">
     <param name="swfversion" value="15.0.0.0">
     <param name="expressinstall" value="Scripts/expressInstall.swf">
     <!-- O navegador exibe o seguinte conteúdo alternativo para usuários que tenham o Flash Player 6.0 e versões anteriores. -->
     <div>
       <h4>O conteúdo desta página requer uma versão mais recente do Adobe Flash Player.</h4>
       <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obter Adobe Flash player" width="112" height="33" /></a></p>
     </div>
     <!--[if !IE]>-->
   </object>
   <!--<![endif]-->
 </object>
<h2 style='margin-top: 20px' class='index'>DESTAQUES</H2>

      <?php 
      $query = mysql_query("SELECT livro.*, usuario.V_NOME  FROM livro inner join usuario on usuario.N_COD_USUARIO = livro.N_COD_USUARIO_IE WHERE livro.N_COD_LIVRO < 100 and livro.B_ATIVO = 'T' ORDER BY rand() LIMIT 16");
      while ($lista = mysql_fetch_array($query))
      {
         $idlivro = $lista['N_COD_LIVRO'];
         $foto = $lista['V_FOTO'];
         $nomeLivro = $lista['V_TITULO'];
         $nomeUser = $lista['V_NOME'];
         $autor = $lista['V_AUTOR'];
         $editora = $lista['V_EDITORA'];                         
         ?>
         <a class="box-livro" href="../Views/View_VisualizarLivro.php?id=<?php echo $idlivro ?>">
         <div id="pricing-table" class="clear">
          <div class="plan">
          <h3><?php echo $nomeLivro;?><span><img style="border-radius: 100px;" src="../<?php echo $foto; ?>" width="100" height="100"></span></h3>
          <ul>
            <li><b>Usuario:</b><?php echo $nomeUser;?></li>
            <li><b>Autor:</b><?php echo $autor;?></li>
            <li><b>Editora:</b><?php echo $editora;?></li>      
        </ul>   
        <span class="signup" href="">Ver</span> 
        </div><!--fim div box-livro <a href="Views/View_VisualizarLivro.php?id=<?php echo $idlivro ?>">Solicitar</a> -->
      </div>
      </a>
      <?php 
      }
      ?>
</div>
<?php include('../Views/View_rodape.php'); ?>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>