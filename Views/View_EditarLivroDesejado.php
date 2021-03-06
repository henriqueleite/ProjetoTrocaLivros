<?php
  session_start();
  require_once "../Dados/Conexao.php";
  if((!isset ($_SESSION['login']) == true))
  {
    unset($_SESSION['login']);
    header('location:../index.php');
  }

$cod_livro_desejado = $_POST["codigolivrodesejado"];

$_SESSION["COD_LIVRO_DESEJADO"] = $cod_livro_desejado;

$sql = mysql_query("SELECT V_TITULO, D_ANO, N_COD_CATEGORIA_IE FROM livro_desejado WHERE N_COD_LIVRO_DESEJADO = $cod_livro_desejado");
  $linha = mysql_fetch_assoc($sql);
  if (!$linha) {
    //Se o select não retornou registros, é porque não tem o que apagar
    header("Location: ../Repositorio/PerfilUsuario.php");
    die();
  }
  $titulo = $linha["V_TITULO"];
  $categoria = $linha["N_COD_CATEGORIA_IE"];
  $ano = $linha["D_ANO"];


?>
<!DOCTYPE html>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../CSS/CadastrarAlterarLivroDesejado.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script> 
</head>
<body>
    <?php include('../Views/View_topo.php'); ?>

  <div id='corpo'>
     <h2>Cadastro Livro Desejado</h2>

        <form name="CadastroUsuario" method="post" action="../Repositorio/Repositorio_EditarLivroDesejado.php" enctype="multipart/form-data">
          <table id="cad_table">
            <tr>
              <td>Título:*</td>
              <td><input type="text" name="titulo" id="titulo" class="txt" value="<?php echo $titulo; ?>" size=35 required/></td>
            </tr>
            <tr>
              <td>Genero:*</td>
              <td> <select id="genero" name="genero">
              <option <?php if ($categoria == 1 ) echo 'selected'; ?> value="1">Comédia</option>
              <option <?php if ($categoria == 2 ) echo 'selected'; ?> value="2">Drama</option>
              <option <?php if ($categoria == 3 ) echo 'selected'; ?> value="3">Ficcão</option>
              <option <?php if ($categoria == 4 ) echo 'selected'; ?> value="4">Gibi</option>
              <option <?php if ($categoria == 5 ) echo 'selected'; ?> value="5">Didatico</option>
              <option <?php if ($categoria == 6 ) echo 'selected'; ?> value="6">Historia</option>
              <option <?php if ($categoria == 7 ) echo 'selected'; ?> value="7">Matemática</option>
              <option <?php if ($categoria == 8 ) echo 'selected'; ?> value="8">Musica</option>
              <option <?php if ($categoria == 9 ) echo 'selected'; ?> value="9">Quadrinhos</option>
              <option <?php if ($categoria == 10 ) echo 'selected'; ?> value="10">Sexo</option>
              <option <?php if ($categoria == 11 ) echo 'selected'; ?> value="11">Terror</option>
              <option <?php if ($categoria == 12 ) echo 'selected'; ?> value="12">Cronica</option>
              <option <?php if ($categoria == 13 ) echo 'selected'; ?> value="13">Vestibular</option>
              <option <?php if ($categoria == 14 ) echo 'selected'; ?> value="14">Poesia</option>
              <option <?php if ($categoria == 15 ) echo 'selected'; ?> value="15">Biblia</option>
              <option <?php if ($categoria == 16 ) echo 'selected'; ?> value="16">Romance</option>
              <option <?php if ($categoria == 17 ) echo 'selected'; ?> value="17">Biologia</option>
              <option <?php if ($categoria == 18 ) echo 'selected'; ?> value="18">Auto ajuda</option>
              <option <?php if ($categoria == 19 ) echo 'selected'; ?> value="19">Religioso</option>
              <option <?php if ($categoria == 20 ) echo 'selected'; ?> value="20">Infantil</option>
              <option <?php if ($categoria == 21 ) echo 'selected'; ?> value="21">Concurso</option>
              </select> </td>
            </tr>
            <tr>
              <td>Ano:*</td>
              <td><input type="text" name="ano" id="ano" class="txt1" maxlength="10" value="<?php echo $ano; ?>" size=35 required/></td>
            </tr>
              <td colspan="2"><input style="  width: 390px;" class='btn' type="submit" value="Cadastrar Livro Desejado" id="buton1" name="btvalidar"><br>
              </td>
            </tr>
          </table>
        </form>
    </div>

   <?php include('../Views/View_rodape.php'); ?>
</body>
</html>

