<!DOCTYPE html>
<?php
require_once "Conexao.php";
session_start();

if((isset ($_SESSION['login']) == true))
{
  $logado = $_SESSION['login'];
  $codigo = $_SESSION['codigo'];
  $tipo = $_SESSION['tipo'];

}
if (isset ($_POST['buscar'])){
   $pesquisa = $_POST['buscar'];
}else{
  $pesquisa = '';
}
(isset($_POST["filtro"])) ? $filtro = $_POST["filtro"] : $filtro=1;

if (isset($_POST["palavra"])) {
  $pesquisa = $_POST["palavra"];
}

    echo $pesquisa;
?>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="CSS/Buscar.css">
    <link rel="stylesheet" type="text/css" href="CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>
</head>
<body>
  <div id='cssmenu'>
    <div id='container'>
      <ul>
        <li><a href='index.php'><img class='logo' src="LogoTrocaLivro.png"></img></a></li>
        <li class='active'><a href='index.php'><span>ÍNICIO</span></a></li>
        <li><a href='Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
        <li><a href='Form_Ajuda.php'><span>SOBRE</span></a></li>
        <li class='last'><a href='Form_Ajuda.php'><span>CONTATO</span></a></li>
        <?php
          if((isset ($_SESSION['login']) == true)){
            echo "<li class='right'><a href='Logout.php'><span>SAIR</span></a></li>";
            echo "<li class='right'><span class='span'>|</span></li>";  
            echo "<li class='right'><a href='PerfilUsuario.php'><span>PAINEL</span></a></li>";
          } else {
            echo "<li class='right'><a href='Login.php'><span>LOGIN</span></a></li>";
            echo "<li class='right'><a href='CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>";
          }
        ?>
      </ul>
    </div>
  </div>


  <div id='corpo'>
    <h2>Gerenciador de Usuários</h2>

    <form id="form1" name="form1" method="post" action="">
      <table width="" border="0" align="center">
        <tr>
          <td> <label for="Descrição"> Pesquisar por:</label> 
            <select id="filtro" name="filtro">
              <option <?php if ($filtro == 1 ) echo 'selected'; ?> value="1">Título</option>
              <option <?php if ($filtro == 2 ) echo 'selected'; ?> value="2">Autor</option>
              <option <?php if ($filtro == 3 ) echo 'selected'; ?> value="3">Editora</option>
              <option <?php if ($filtro == 4 ) echo 'selected'; ?> value="4">Gênero</option>
              <option <?php if ($filtro == 5 ) echo 'selected'; ?> value="5">Ano</option>
              </select> 
            <label for="buscar"></label>
          </td>

          <td height="50" colspan="8" align="center" valign="middle"> 
            <label for="Descrição"></label> 
            <input type="text" name="buscar" id="buscar" size=50 value="<?php echo $pesquisa; ?>"/>  
            <input type="submit" name="btnBuscar" id="btnBuscar" value="buscar" /> 
            <label for="buscar"></label>
          </td>
        </tr>
    </form>


    <?php
    if ($pesquisa = ''){
    $consulta = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, V_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE LIMIT 20");
    }else{
     $consulta = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, V_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE where V_TITULO like'%".$pesquisa."%' LIMIT 20"); 
    }

    if (isset ($_POST['buscar'])){
      $filtro = $_POST['filtro'];

      if ($filtro == '1'){
        $consulta = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, V_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE where V_TITULO like'%".$_POST['buscar']."%' LIMIT 20");
        $pesquisa = $_POST['buscar'];
      }
      else if ($filtro == '2'){
        $consulta = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, V_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE where V_AUTOR like'%".$_POST['buscar']."%' LIMIT 20");
        $pesquisa = $_POST['buscar'];
      }
      else if ($filtro == '3'){
        $consulta = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, V_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE where V_EDITORA like'%".$_POST['buscar']."%' LIMIT 20");
        $pesquisa = $_POST['buscar'];
      }
      else if ($filtro == '4'){
        $consulta = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, V_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE where V_GENERO like'%".$_POST['buscar']."%' LIMIT 20");
        $pesquisa = $_POST['buscar'];
      }
      else if ($filtro == '5'){
        $consulta = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, V_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE where V_ANO like'%".$_POST['buscar']."%' LIMIT 20");
        $pesquisa = $_POST['buscar'];
      }
    }

    while ($linha=mysql_fetch_array($consulta)){
      $codigolivro = $linha["N_COD_LIVRO"];
      $titulo= $linha['V_TITULO']; 
      $autor= $linha['V_AUTOR']; 
      $ano= $linha['V_ANO']; 
      $foto= $linha['V_FOTO'];
      $observacao= $linha['V_OBSERVACAO']; 
      $editora = $linha['V_EDITORA'];
      $estado_livro= $linha['V_ESTADO_LIVRO'];   
      $genero= $linha['V_GENERO']; 
        
    ?>

    <form id="form2" name="form2" method="post" action="VisualizarLivro.php">
      <tr>
        <td class="td_foto"><img src="<?php echo $foto; ?>"width="150" height="150"></td>
        <td class="td_titulo"><?php echo $titulo; ?></td>
        <td>
        <input type='hidden' name="codigolivro" id="codigolivro" value="<?php echo $codigolivro;?>" >
        <td class="td_botao"><input type="submit" name="Ver"  id="Ver"   value="Ver" /></td>
      </tr> 
    </form>
    
      <?php } ?>
      

      </table>
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
