<?php
require_once "../Dados/Conexao.php";
session_start();

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo   = $_SESSION['tipo'];

$cod_livro_desejado = $_POST["codigolivrodesejado"];



      $query2 = mysql_query("DELETE FROM livro_desejado WHERE N_COD_LIVRO_DESEJADO = $cod_livro_desejado; ");

      if (!$query2) {
        echo "<script>alert('Falha na exclusão!!'); history.back();</script>";
        die();
      }else{
        echo "<script>alert('Livro excluído com sucesso!!');</script>"; 
        echo "<meta http-equiv='refresh' content='0, url=../Repositorio/PerfilUsuario.php'>";
        die();
      }
    
?>