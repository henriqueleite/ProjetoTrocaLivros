<!DOCTYPE html>
<?php

session_start();

//require_once "Conexao.php";


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
  <?php include('View_topo.php'); ?>

  <div id='corpo'>
    Corpo do Site</br>
    Corpo do Site</br>
    Corpo do Site</br>
    Corpo do Site</br>
    Corpo do Site</br>
    Corpo do Site</br>
    Corpo do Site</br>
    Corpo do Site</br>
    <h2 style='margin-top: 20px' class='index'>DESTAQUES</H2>

      <?php 
      $query = mysql_query("SELECT livro.*, usuario.V_NOME  FROM livro inner join usuario on usuario.N_COD_USUARIO = livro.N_COD_USUARIO_IE");
      while ($lista = mysql_fetch_array($query))
      {
         $idlivro = $lista['N_COD_LIVRO'];
         $foto = $lista['V_FOTO'];
         $nomeLivro = $lista['V_TITULO'];
         $nomeUser = $lista['V_NOME'];
         $autor = $lista['V_AUTOR'];
         $editora = $lista['V_EDITORA'];                         
         ?>
         <div id="box-livro">
          <div id="fotoLivro">
            <a><img src="<?php echo $foto; ?>" width="100" height="150"></a>
          </div><!--fim div fotoLivro-->
          <div id="infoLivro">
            <?php echo "<a href='VisualizarLivro.php?id=$idlivro'>"?><span class="tituloLivro"><?php echo $nomeLivro;?></span></a><br>
            <b>Usuario</b><?php echo "<a href='PerfilUsuario.php'>";?><span class="colorinfoLivro"> <?php echo $nomeUser;?></span></a><br>
            <b>Autor</b><a href=""><span class="colorinfoLivro"> <?php echo $autor;?></span></a><br>
            <b>Editora</b><a href=""><span class="colorinfoLivro"> <?php echo $editora;?></span></a><br>
            <a href="funcaoSolicitarLivro.php?id=<?php echo $idlivro ?>">Solicitar</a>
          </div><!--fim div infoLivro-->             
        </div><!--fim div box-livro-->
      <?php 
      }
      ?>
      <img src="C:\xampp\htdocs\ProjetoTrocaLivros\Imagens\LogoTrocaLivro.png">
</div>
<?php include('Views/View_rodape.php'); ?>
</body>
</html>