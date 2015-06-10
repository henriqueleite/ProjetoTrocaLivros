<?php
require_once "../Dados/Conexao.php";
session_start();

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo   = $_SESSION['tipo'];

$cod_livro_desejado = $_SESSION["COD_LIVRO_DESEJADO"];
$titulo = strtoupper($_POST['titulo']);
$genero = $_POST['genero'];
$ano = $_POST['ano'];


   if ($titulo == ""){
      echo "<script>alert('Preencha o campo Titulo'); history.back(); </script>";
    }else if ($genero  == ""){
      echo "<script>alert('Preencha o campo Genero'); history.back(); </script>";
    }else if ($ano  == ""){
      echo "<script>alert('Preencha o campo Ano'); history.back(); </script>";
    }else{

      $query2 = mysql_query("UPDATE livro_desejado SET V_TITULO = '".$titulo."', D_ANO = '".$ano."', N_COD_CATEGORIA_IE = ".$genero." WHERE N_COD_LIVRO_DESEJADO = $cod_livro_desejado");

      if (!$query2) {
        echo "<script>alert('Falha na alteração!!'); history.back();</script>";
        die();
      }else{
        echo "<script>alert('Livro alterado com sucesso!!');</script>"; 
        echo "<meta http-equiv='refresh' content='0, url=../Repositorio/PerfilUsuario.php'>";
        die();
      }
    
}
?>