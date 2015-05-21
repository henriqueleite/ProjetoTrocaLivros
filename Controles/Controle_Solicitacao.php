<!DOCTYPE html>
<?php
require_once "Conexao.php";
?>
<html>
<head>
  <?php  
  session_start();
  if((!isset ($_SESSION['login']) == true))
  {
    unset($_SESSION['login']);
    header('location:index.php');
  }

  $logado = $_SESSION['login'];
  $codigo = $_SESSION['codigo'];
  $tipo = $_SESSION['tipo'];
  ?>


  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="estilo.css">
  <link rel="stylesheet" type="text/css" href="CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="CSS/Rodape.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/></script>
  <script>
    $(document).ready(function(){
      $(".text_container").click(function(){
        $(".listar-livro").hide(1000);
      });
      $(".text_container2").click(function(){
        $(".listar-livro").show(1000);
      });
    });
  </script>
</head>
<body>
  <?php include('View_topo.php'); ?>
  <div id="troca">
    <?php
    $query4 = mysql_query("SELECT COUNT(*), usuario.V_NOME, livro.V_TITULO, troca.V_STATUS FROM troca INNER JOIN livro on livro.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE inner join usuario on usuario.N_COD_USUARIO = troca.N_COD_USUARIO_IE WHERE livro.N_COD_USUARIO_IE = '$codigo'");
    if($query4)
    {
      while($lista = mysql_fetch_assoc($query4))
      {
        $nomeUser = $lista['V_NOME'];
        $nomeLivro = $lista['V_TITULO'];
        $status = $lista['V_STATUS'];
        if($status == 'Pendente')
        {
          echo "<b>$nomeUser</b> solicitou a troca do livro <b>$nomeLivro</b> <a href='?a=aceitar'>Aceitar</a> | <a href='?a=excluir'>Excluir Solicitacao</a>";
        }
        else
        {
          echo "Voce nao tem Solicitacao";
        }
      }
    }
    else
    {
      echo "Erro na consulta";
    }



    ?>
  </div>
</body>
</html>
<?php
if(isset($_GET['a']) == 'aceitar')
{
  $query4 = mysql_query("SELECT COUNT(*), troca.N_COD_TROCA FROM troca INNER JOIN livro on livro.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE  
    inner join usuario on usuario.N_COD_USUARIO = troca.N_COD_USUARIO_IE 
    WHERE livro.N_COD_USUARIO_IE = '$codigo'");
  $lista = mysql_fetch_assoc($query4);
  $idtroca = $lista['N_COD_TROCA'];
  $query = mysql_query("UPDATE troca SET V_STATUS = 'Aceito' where  N_COD_TROCA = $idtroca");
  if($query)
  {
    echo "<script>alert('Voce aceitou trocar com $nomeUser')</script>";
    echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>";
  }

}
?>