<!DOCTYPE html>
<?php
  session_start();
  require_once "Conexao.php";
  if((!isset ($_SESSION['login']) == true))
  {
    unset($_SESSION['login']);
    header('location:index.php');
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
      <?php include('View_topo.php'); ?>
  <div id='corpo'>
     <h2>Cadastro Livro Desejado</h2>

        <form name="CadastroUsuario" method="post" action="repositorioLivrodesejado.php" enctype="multipart/form-data">
          <table id="cad_table">
            <tr>
              <td>Título:*</td>
              <td><input type="text" name="titulo" id="titulo" class="txt"  size=35 required/></td>
            </tr>
            <tr>
              <td>Genero:*</td>
              <td> <select id="genero" name="genero">
              <option value="1">Comédia</option>
              <option value="2">Drama</option>
              <option value="3">Ficcão</option>
              </select> </td>
            </tr>
            <tr>
              <td>Ano:*</td>
              <td><input type="text" name="ano" id="ano" class="txt1" maxlength="10" size=35 required/></td>
            </tr>
              <td colspan="2"><input style="  width: 390px;" class='btn' type="submit" value="Cadatrar Livro Desejado" id="buton1" name="btvalidar"><br>
              </td>
            </tr>
          </table>
        </form>
    </div>

   <?php include('View_rodape.php'); ?>
</body>
</html>

