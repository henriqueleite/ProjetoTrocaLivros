<!DOCTYPE html>
<?php
require_once "../Dados/Conexao.php";
session_start();
if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:../index.php');
}

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];

(isset($_POST["filtro"])) ? $filtro = $_POST["filtro"] : $filtro=1;

?>
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="../CSS/Historico.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
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
   <?php include('../Views/View_topo.php'); ?>
<div id="meio">

<form id="form_filtro" name="form_filtro" method="post" action="">
<select id="filtro" name="filtro">
  <OPTION <?php if ($filtro == 1 ) echo 'selected'; ?> value="1">Todos</OPTION>
  <OPTION <?php if ($filtro == 2 ) echo 'selected'; ?> value="2">Somente quando fui solicitante</OPTION>
  <OPTION <?php if ($filtro == 3 ) echo 'selected'; ?> value="3">Somente quando fui solicitado</OPTION>
<select>
  <input type="submit" name="btnBuscar" id="btnBuscar" value="OK" /> 
</form>

  <div class="tabela">

      <h2>Histórico de trocas</h2>     

    <table>
  <thead>
    <tr>    
      <th>Livros Trocados</th>
      <th>Usuario Solicitado</th>
      <th>Usuario Solicitante</th>
      <th>Data de finalização</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      $queryHistorico = mysql_query("SELECT troca.*, (usuario_solicitado.V_NOME) AS USUARIOSOLICITADO, (usuario_solicitante.V_NOME) AS USUARIOSOLICITANTE, (livro_solicitado.V_TITULO) as LIVROSOLICITADO, (livro_solicitante.V_TITULO) as LIVROSOLICITANTE 
FROM troca 
inner join livro as livro_solicitado on livro_solicitado.N_COD_LIVRO = troca.N_COD_LIVRO
inner join livro as livro_solicitante on livro_solicitante.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE 
inner join usuario as usuario_solicitado on usuario_solicitado.N_COD_USUARIO = livro_solicitado.N_COD_USUARIO_IE
inner join usuario as usuario_solicitante on usuario_solicitante.N_COD_USUARIO = livro_solicitante.N_COD_USUARIO_IE 
WHERE (usuario_solicitado.N_COD_USUARIO = $codigo or usuario_solicitante.N_COD_USUARIO = $codigo) AND troca.V_STATUS = 'Finalizado'");

      if (isset ($_POST['filtro'])){
      $filtro = $_POST['filtro'];

      if ($filtro == '1'){
        $queryHistorico = mysql_query("SELECT troca.*, (usuario_solicitado.V_NOME) AS USUARIOSOLICITADO, (usuario_solicitante.V_NOME) AS USUARIOSOLICITANTE, (livro_solicitado.V_TITULO) as LIVROSOLICITADO, (livro_solicitante.V_TITULO) as LIVROSOLICITANTE 
                                FROM troca 
                                inner join livro as livro_solicitado on livro_solicitado.N_COD_LIVRO = troca.N_COD_LIVRO
                                inner join livro as livro_solicitante on livro_solicitante.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE 
                                inner join usuario as usuario_solicitado on usuario_solicitado.N_COD_USUARIO = livro_solicitado.N_COD_USUARIO_IE
                                inner join usuario as usuario_solicitante on usuario_solicitante.N_COD_USUARIO = livro_solicitante.N_COD_USUARIO_IE 
                                WHERE (usuario_solicitado.N_COD_USUARIO = $codigo or usuario_solicitante.N_COD_USUARIO = $codigo) AND troca.V_STATUS = 'Finalizado'");

      }
      else if ($filtro == '2'){
        $queryHistorico = mysql_query("SELECT troca.*, (usuario_solicitado.V_NOME) AS USUARIOSOLICITADO, (usuario_solicitante.V_NOME) AS USUARIOSOLICITANTE, (livro_solicitado.V_TITULO) as LIVROSOLICITADO, (livro_solicitante.V_TITULO) as LIVROSOLICITANTE 
                                 FROM troca 
                                 inner join livro as livro_solicitado on livro_solicitado.N_COD_LIVRO = troca.N_COD_LIVRO
                                 inner join livro as livro_solicitante on livro_solicitante.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE 
                                 inner join usuario as usuario_solicitado on usuario_solicitado.N_COD_USUARIO = livro_solicitado.N_COD_USUARIO_IE
                                 inner join usuario as usuario_solicitante on usuario_solicitante.N_COD_USUARIO = livro_solicitante.N_COD_USUARIO_IE 
                                 WHERE usuario_solicitante.N_COD_USUARIO = $codigo AND troca.V_STATUS = 'Finalizado'");

      }
      else if ($filtro == '3'){
        $queryHistorico = mysql_query("SELECT troca.*, (usuario_solicitado.V_NOME) AS USUARIOSOLICITADO, (usuario_solicitante.V_NOME) AS USUARIOSOLICITANTE, (livro_solicitado.V_TITULO) as LIVROSOLICITADO, (livro_solicitante.V_TITULO) as LIVROSOLICITANTE 
                                FROM troca 
                                inner join livro as livro_solicitado on livro_solicitado.N_COD_LIVRO = troca.N_COD_LIVRO
                                inner join livro as livro_solicitante on livro_solicitante.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE 
                                inner join usuario as usuario_solicitado on usuario_solicitado.N_COD_USUARIO = livro_solicitado.N_COD_USUARIO_IE
                                inner join usuario as usuario_solicitante on usuario_solicitante.N_COD_USUARIO = livro_solicitante.N_COD_USUARIO_IE 
                                WHERE usuario_solicitado.N_COD_USUARIO = $codigo AND troca.V_STATUS = 'Finalizado'");

      }
    }

      if($queryHistorico)
      {
        if($resultado = mysql_fetch_array($queryHistorico) <= 0)
        {
        ?>
         <tr>        
              <td class='sem-registro'>Não retornou nenhum registro</td>
            </tr>
         <?php  
        }
        else
        {
          while($resultado = mysql_fetch_array($queryHistorico))
          {  
            $nomeLivro = $resultado['LIVROSOLICITADO'];
            $nomeLivro2 = $resultado['LIVROSOLICITANTE'];
            $nomeUsuarioDoLivro = $resultado['USUARIOSOLICITADO'];
            $nomeUsuarioDoLivro2 = $resultado['USUARIOSOLICITANTE'];
            $dataFinalizacao2 = $resultado['D_DATA_FINALIZOU'];
            $status = $resultado['V_STATUS'];

            $dataFinalizacao = implode('/', array_reverse(explode('-', $dataFinalizacao2 )));
            ?>
            <tr>        
              <td><?php echo $nomeLivro;?> &nbsp  &nbsp<img class="seta_troca" src="../Imagens/Troca.png"/> &nbsp &nbsp<?php echo $nomeLivro2;?></td>
              <td><?php echo $nomeUsuarioDoLivro;?></td>
              <td><?php echo $nomeUsuarioDoLivro2;?></td>
              <td><?php echo $dataFinalizacao;?></td>
              <td><?php echo $status;?></td>
            </tr>
            <?php          
          }
        }
      }
      else
      {
        echo "Erro na queryHistorico";
      }
      ?>
      </tbody>
    </table>
  </div><!--fim div tabela-->
</div><!--fim div meio-->
<?php include('../Views/View_rodape.php'); ?>

</body>
</html>