<?php
session_start();
require_once("../Dados/Conexao.php");
  if(isset($_POST['btnSalvar']))
  {
    $codigolivro = $_SESSION['codigoLivroAlt'];
    $titulo       = strtoupper($_POST['titulo']);
    $autor        = strtoupper($_POST['autor']);
    $editora      = strtoupper($_POST['editora']);
    $estado       = $_POST['estado'];
    $genero       = $_POST['genero'];
    $ano          = $_POST['ano'];
    $observacao   = strtoupper($_POST['observacao']);
    /*$foto         = $_FILES["foto"];

    $error;
    // Recupera os dados dos campos

    // Se a foto estiver sido selecionada
    if (!empty($foto)) {
    
      // Largura máxima em pixels
      $largura = 1920;
      // Altura máxima em pixels
      $altura = 1080;
      // Tamanho máximo do arquivo em bytes
      $tamanho = 1600000;
   
        // Verifica se o arquivo é uma imagem
      if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
         $error[1] = "Isso não é uma imagem.";
      } 
    
      // Pega as dimensões da imagem
      $dimensoes = getimagesize($foto["tmp_name"]);
    
      // Verifica se a largura da imagem é maior que a largura permitida
      if($dimensoes[0] > $largura) {
        $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
      }
   
      // Verifica se a altura da imagem é maior que a altura permitida
      if($dimensoes[1] > $altura) {
        $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
      }
      
      // Verifica se o tamanho da imagem é maior que o tamanho permitido
      if($foto["size"] > $tamanho) {
          $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
      }
   

      // Se não houver nenhum erro
      if (count($error) == 0) {

        // Pega extensão da imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
   
        // Gera um nome único para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        // Caminho de onde ficará a imagem
        $caminho_imagem = "FotoLivroUsuario/" . $nome_imagem;
   
        // Faz o upload da imagem para seu respectivo caminho
        move_uploaded_file($foto["tmp_name"], "../".$caminho_imagem);
      }
    }
    else
    {
      $queryLivro     = mysql_query("SELECT V_FOTO FROM LIVRO WHERE N_COD_LIVRO =".$codigolivro." ");  
      $coluna         = mysql_fetch_array($queryLivro);
      $caminho_imagem = $coluna['V_FOTO'];
    }*/


    if ($titulo == ""){
      echo "<script>alert('Preencha o campo Titulo'); history.back(); </script>";
    }else if ($autor == ""){
      echo "<script>alert('Preencha o campo Autor'); history.back(); </script>";
    }else if ($editora  == ""){
     echo "<script>alert('Preencha o campo Editora'); history.back(); </script>";
    }else if ($estado  == ""){
      echo "<script>alert('Preencha o campo Estado'); history.back(); </script>";
    }else if ($genero  == ""){
      echo "<script>alert('Preencha o campo Genero'); history.back(); </script>";
    }else if ($ano  == ""){
      echo "<script>alert('Preencha o campo Ano'); history.back(); </script>";
    }else{

      $query2 = mysql_query("UPDATE livro SET V_TITULO ='$titulo', V_AUTOR ='$autor', V_EDITORA  ='$editora', V_ESTADO_LIVRO ='$estado', V_OBSERVACAO ='$observacao', N_COD_CATEGORIA_IE ='$genero', V_ANO ='$ano' WHERE N_COD_LIVRO ='$codigolivro'");


      if (!$query2) {
        echo "<script>alert('Falha no cadastro!!'); history.back();</script>";
        die();
      }else{
        echo "<script>alert('Livro alterado com sucesso!!');</script>";         
        echo "<meta http-equiv='refresh' content='0, url=../Views/View_VisualizarLivro.php?id=$codigolivro'>";
        die();
      }
  
  }

}
if(isset($_POST["btnCancelar"]))
{
    header("Location: ../Views/View_VisualizarLivro.php");  //não está funcionando
    die();
  }
?>