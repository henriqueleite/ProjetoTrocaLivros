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
</script>
<script>


    </script>
</head>
<body >
  <?php include('../Views/View_topo.php'); ?>

 
  <div id='corpo'>
   
  <img src="books-bookshelf-buildings-library-man-made-2730837-1920x1200.jpg" width="1210" height="550">   

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
</body>
</html>