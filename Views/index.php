<!DOCTYPE html>
<?php

//session_start();

//require_once "./Dados/Conexao.php";


?>

<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="CSS/index.css">
  <link rel="stylesheet" type="text/css" href="CSS/estilo.css">
  <link rel="stylesheet" type="text/css" href="CSS/menu-new.css">
  <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body >
  <div id='container'>
<<<<<<< HEAD
      <nav class="menu">
          <a href='#' class="logo"></a>
          <ul>
              <li><a href="index.php">Início</a></li>
              <li><a href="Views/View_Form_Ajuda.php">Sobre</a></li>
              <li><a href="Views/View_Form_Ajuda.php">Como Funciona</a></li>
              <li><a href="Views/View_Form_Ajuda.php">Contato</a></li>
          </ul>
          
          <div class="links-group">

              <?php
              /*
                if((isset ($_SESSION['login']) == true)){
                    echo "<a href='./Repositorio/PerfilUsuario.php' class='login painel'>Painel</a>";
                    echo "<a href='./Controles/Controle_Logout.php' class='cadastre-se sair'>Sair</a>";
                 //echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";
=======
    <ul>
     <li><a href='#'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
     <li class='active'><a href='#'><span>INICIO</span></a></li>
     <li><a href='Views/View_ComoFunciona.php'><span>COMO FUNCIONA</span></a></li>
     <li><a href='Views/View_Form_Ajuda.php'><span>SOBRE</span></a></li>
     <li class='last'><a href='Views/View_Form_Ajuda.php'><span>CONTATO</span></a></li>
     <li><form name="frmBusca" method="post" action="Views/View_Buscar.php" >
>>>>>>> origin/master

               } else {
                    echo "<a href='./Views/View_Login.php' class='login painel'>Login</a>";
                    echo "<a href='./Views/View_CadastroUsuario.php' class='cadastre-se sair'>Cadastre-se</a>";
              }*/

              echo "<a href='./Views/View_Login.php' class='login painel'>Login</a>";
              echo "<a href='./Views/View_CadastroUsuario.php' class='cadastre-se sair'>Cadastre-se</a>";
              ?>

          </div>

      </nav>

  </div><!--fim div container-->
  <form name="frmBusca" method="post" action="Views/View_Buscar.php" class="search">
              <input type="search" name="palavra" placeholder="Faça sua busca">
              <input type="submit" value="Buscar">
          </form>


  <div id='corpo'>
   
   <img src="books-reading-2974088-1920x1200.jpg" width="1210" height="550">
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
            <?php echo "<a href='Views/View_VisualizarLivro.php?id=$idlivro'>"?><span class="tituloLivro"><?php echo $nomeLivro;?></span></a><br>
            <b>Usuario</b><?php echo "<a href='PerfilUsuario.php'>";?><span class="colorinfoLivro"> <?php echo $nomeUser;?></span></a><br>
            <b>Autor</b><a href=""><span class="colorinfoLivro"> <?php echo $autor;?></span></a><br>
            <b>Editora</b><a href=""><span class="colorinfoLivro"> <?php echo $editora;?></span></a><br>
            <a href="Views/View_VisualizarLivro.php?id=<?php echo $idlivro ?>">Solicitar</a>
          </div><!--fim div infoLivro-->             
        </div><!--fim div box-livro-->
      <?php 
      }
      ?>

</div>
<?php include('Views/View_rodape.php'); ?>
</body>
</html>