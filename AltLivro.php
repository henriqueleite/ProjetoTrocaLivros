<!DOCTYPE html>
<?php
  session_start();
  require_once "Conexao.php";

  if (! isset($_SESSION['codigoLivroAlt'])){
    header("Location: PerfilUsuario.php");  
    die();
  }

  $codigolivro = $_SESSION['codigoLivroAlt'];

  $queryLivro = mysql_query("SELECT * FROM LIVRO WHERE N_COD_LIVRO =".$codigolivro." ");  
  $coluna     = mysql_fetch_array($queryLivro);
    
  $titulo     = $coluna['V_TITULO'];
  $autor      = $coluna['V_AUTOR'];
  $editora    = $coluna['V_EDITORA'];
  $estado     = $coluna['V_ESTADO_LIVRO'];
  $genero     = $coluna['N_COD_CATEGORIA_IE'];
  $ano        = $coluna['V_ANO'];
  $observacao = $coluna['V_OBSERVACAO'];
  $foto       = $coluna['V_FOTO'];

  if (isset ($_POST['excluir'])){

    mysql_query("DELETE FROM LIVRO WHERE N_COD_LIVRO  =".$_POST['codigolivro']." ");
    echo "<script>alert('Livro excluído com sucesso!');</script>";
    echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>";
    die();

  } else if (isset ($_POST['alterar'])){

  
    
  }else if (isset ($_POST['btnCancelar'])){
    header("Location: VisualizarLivro.php");  //não está funcionando
    die();
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

<script LANGUAGE="JavaScript">
function mostrarResultado(box,num_max,campospan){
  var contagem_carac = box.length;
  if (contagem_carac != 0){
    document.getElementById(campospan).innerHTML = contagem_carac + "/255 caracteres digitados";
    if (contagem_carac == 1){
      document.getElementById(campospan).innerHTML = contagem_carac + "/255 caracter digitado";
    }
    if (contagem_carac >= num_max){
      document.getElementById(campospan).innerHTML = "Limite de 255 caracteres...";
    }
  }else{
    document.getElementById(campospan).innerHTML = "0/255 caracteres digitados...";
  }
}

function contarCaracteres(box,valor){
  var conta = valor - box.length;
  if(box.length >= valor){
    document.getElementById("observacao").value = document.getElementById("observacao").value.substr(0,valor);
  } 
}

</script>    
</head>
<body>
   <?php include('topo.php'); ?>

    <div id='corpo'>
     <h2>Cadastro Livro</h2>
       <div style="height: 450px;" id="lateral">
      <p style="margin-bottom: 0px;"><img style= "margin-top: -16px; border: 2px solid #133141;" src="<?php echo $foto; ?>"width="198" height="198"></p>
    </div>
          <form name="CadastroUsuario" method="post" action="" enctype="multipart/form-data">
          <table id="cad_table">
            <tr >  
              <td>
                Foto do livro*:
              </td>
              <td>
                <input style="width: 325px;" type="file" name="foto" />
              </td>
            </tr>

            <tr>
              <td>Título:*</td>
              <td><input type="text" name="titulo" id="titulo" class="txt" value ="<?php echo $titulo;?>" size=35 required/></td>
            </tr>
            <tr>
              <td>Autor:*</td>
              <td><input type="text" name="autor" id="autor" class="txt" value ="<?php echo $autor;?>" size=35 required/></td>
            </tr>
            <tr>
              <td>Editora:*</td>
              <td><input type="text" name="editora" id="editora" class="txt" value ="<?php echo $editora;?>" size=35 required/></td>
            </tr>
            <tr>
              <td>Estado do livro:* </td>
              <td><input type="text" name="estado" id="estado" class="txt" value ="<?php echo $estado;?>" size=35 required/>
            </tr>
            <tr>
              <td>Genero:*</td>
              <td> <select id="genero" name="genero">
              <?php if ($genero == 1) {  ?>
                <option value="1" selected >Comédia</option>
              <?php }else{ ?>
                <option value="1" >Comédia</option>
              <?php } ?>
              <?php if ($genero == 2) {  ?>
                <option value="2" selected >Drama</option>
              <?php }else{ ?>
                <option value="2">Drama</option>
              <?php } ?>
              <?php if ($genero == 3) {  ?>
                <option value="3" selected >Ficcão</option>
              <?php }else{ ?>
                <option value="3"  >Ficcão</option>
              <?php } ?>                 
              </select> </td>
            </tr>
            <tr>
              <td>Ano:*</td>
              <td><input type="text" name="ano" id="ano" class="txt1" value ="<?php echo $ano;?>" maxlength="10" size=35 required/></td>
            </tr>
            <tr>
              <td><label for="mensagem">Observação</label></td>
              <td><textarea name="observacao" id="observacao" rows="5" cols="26"  onkeyup="mostrarResultado(this.value,255,'spcontando');contarCaracteres(this.value,255,'sprestante')"/><?php echo $observacao;?></textarea><br>
              <span id="spcontando">0/255 caracteres digitados...</span><br /></td>
            </tr>
              <td colspan="2"><input style="  width: 200px;" class='btn' type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" > <input style="  width: 200px;" class='btn' type="submit" value="Salvar" id="btnSalvar" name="btnSalvar"><br>
              </td>
            </tr>
          </table>
        </form>
    </div>

   <?php include('rodape.php'); ?>
</body>
</html>

<?php

  if (isset ($_POST['btnSalvar'])){

    $titulo       = $_POST['titulo'];
    $autor        = $_POST['autor'];
    $editora      = $_POST['editora'];
    $estado       = $_POST['estado'];
    $genero       = $_POST['genero'];
    $ano          = $_POST['ano'];
    $observacao   = $_POST['observacao'];
    $foto         = $_FILES["foto"];

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
        move_uploaded_file($foto["tmp_name"], $caminho_imagem);
      }
    }

    if($caminho_imagem == ""){
      $queryLivro     = mysql_query("SELECT V_FOTO FROM LIVRO WHERE N_COD_LIVRO =".$codigolivro." ");  
      $coluna         = mysql_fetch_array($queryLivro);
      $caminho_imagem = $coluna['V_FOTO'];
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

      $query2 = mysql_query("UPDATE LIVRO SET V_TITULO ='".$titulo."', V_AUTOR ='".$autor."', V_EDITORA  ='".$editora."', V_ESTADO_LIVRO ='".$estado."', V_OBSERVACAO ='".$observacao."', N_COD_CATEGORIA_IE ='".$genero."', V_ANO ='".$ano."', V_FOTO ='".$caminho_imagem."' WHERE N_COD_LIVRO ='".$codigolivro."'");


      if (!$query2) {
        echo "<script>alert('Falha no cadastro!!'); history.back();</script>";
        die();
      }else{
        echo "<script>alert('Livro alterado com sucesso!!');</script>"; 
        echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>";
        die();
      }
    }
  }


?>