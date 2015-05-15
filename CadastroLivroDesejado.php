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
      <?php include('topo.php'); ?>
  <div id='corpo'>
     <h2>Cadastro Livro Desejado</h2>

        <form name="CadastroUsuario" method="post" action="?go=cadastrar" enctype="multipart/form-data">
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

   <?php include('rodape.php'); ?>
</body>
</html>

<?php

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo   = $_SESSION['tipo'];


if(@$_GET['go'] == 'cadastrar'){

    $titulo     = strtoupper($_POST['titulo']);
    $genero     = $_POST['genero'];
    $ano        = $_POST['ano'];

   if ($titulo == ""){
      echo "<script>alert('Preencha o campo Titulo'); history.back(); </script>";
    }else if ($genero  == ""){
      echo "<script>alert('Preencha o campo Genero'); history.back(); </script>";
    }else if ($ano  == ""){
      echo "<script>alert('Preencha o campo Ano'); history.back(); </script>";
    }else{

      $query2 = mysql_query("INSERT INTO LIVRO_DESEJADO (V_TITULO, D_ANO, N_COD_CATEGORIA_IE, N_COD_USUARIO_IE) VALUES ('".$titulo."', '".$ano."',  '".$genero."', '".$codigo."')");

      if (!$query2) {
        echo "<script>alert('Falha no cadastro!!'); history.back();</script>";
        die();
      }else{
        echo "<script>alert('Livro cadastrado com sucesso!!');</script>"; 
        echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>";
        die();
      }
    }
}
?>