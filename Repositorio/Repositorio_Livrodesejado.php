<?php
require_once "../Dados/Conexao.php";
session_start();

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo   = $_SESSION['tipo'];
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

      $query2 = mysql_query("INSERT INTO livro_desejado (V_TITULO, D_ANO, N_COD_CATEGORIA_IE, N_COD_USUARIO_IE) VALUES ('".$titulo."', '".$ano."',  '".$genero."', '".$codigo."')");

      if (!$query2) {
        echo "<script>alert('Falha no cadastro!!'); history.back();</script>";
        die();
      }else{
        echo "<script>alert('Livro cadastrado com sucesso!!');</script>"; 
        echo "<meta http-equiv='refresh' content='0, url=../Repositorio/PerfilUsuario.php'>";
        die();
      }
    
}
?>