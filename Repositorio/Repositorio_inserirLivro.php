
<?php
require_once "../Dados/Conexao.php";
session_start();
$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo   = $_SESSION['tipo'];
$titulo = strtoupper($_POST['titulo']);
$autor = strtoupper($_POST['autor']);
$editora = strtoupper($_POST['editora']);
$estado = $_POST['estado'];
$genero = $_POST['genero'];
$ano = $_POST['ano'];
$observacao = strtoupper($_POST['observacao']);
$foto = $_FILES["foto"];



    //echo "<script>alert(".$foto["name"]."); history.back();</script>";

    $error = "Sem Erro";
    $caminho_imagem = '';
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
         $error = "Isso não é uma imagem.";
      } 
  
    // Pega as dimensões da imagem
    $dimensoes = getimagesize($foto["tmp_name"]);

  
    // Verifica se a largura da imagem é maior que a largura permitida
    if($dimensoes[0] > $largura) {
      $error = "A largura da imagem não deve ultrapassar ".$largura." pixels";
    }
 
    // Verifica se a altura da imagem é maior que a altura permitida
    if($dimensoes[1] > $altura) {
      $error = "Altura da imagem não deve ultrapassar ".$altura." pixels";

    }
    
    // Verifica se o tamanho da imagem é maior que o tamanho permitido
    if($foto["size"] > $tamanho) {
        $error = "A imagem deve ter no máximo ".$tamanho." bytes";
    }
 

    // Se não houver nenhum erro
    if ($error == 'Sem Erro') {
      // Pega extensão da imagem
      preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
 
          // Gera um nome único para a imagem
          $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
          // Caminho de onde ficará a imagem
          $caminho_imagem = "FotoLivroUsuario/" . $nome_imagem;
 
      // Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($foto["tmp_name"], $caminho_imagem);

    }
  }else{
    $caminho_imagem = "";
  }

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

      $query2 = mysql_query("INSERT INTO LIVRO (V_TITULO, V_AUTOR, V_EDITORA, V_ESTADO_LIVRO, V_OBSERVACAO, N_COD_CATEGORIA_IE, V_ANO, V_FOTO, N_COD_USUARIO_IE) VALUES ('".$titulo."', '".$autor."', '".$editora."', '".$estado."', '".$observacao."', '".$genero."', '".$ano."', '".$caminho_imagem."', '".$codigo."')");


      if (!$query2) {
        echo "<script>alert('Falha no cadastro!!'); history.back();</script>";
        die();
      }else{
        echo "<script>alert('Livro cadastrado com sucesso!!');</script>"; 
        echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>";
        die();
      }
    
}
?>