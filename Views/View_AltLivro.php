<?php
  //testes

require_once "../Dados/Conexao.php";
session_start();

if (!isset($_SESSION['codigoLivroAlt'])){
  header("Location: ../Repositorio/PerfilUsuario.php");  
  die();
}

$codigolivro = $_SESSION['codigoLivroAlt'];

$queryLivro = mysql_query("SELECT * FROM livro WHERE N_COD_LIVRO =".$codigolivro." ");  
$coluna     = mysql_fetch_array($queryLivro);

$titulo     = $coluna['V_TITULO'];
$autor      = $coluna['V_AUTOR'];
$editora    = $coluna['V_EDITORA'];
$estado     = $coluna['V_ESTADO_LIVRO'];
$genero     = $coluna['N_COD_CATEGORIA_IE'];
$ano        = $coluna['V_ANO'];
$observacao = $coluna['V_OBSERVACAO'];
$foto       = $coluna['V_FOTO'];

?>
<!DOCTYPE html>
  <html>
  <head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="../CSS/CadastrarAlterarLivro.css">
    <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
  </script>

  <script LANGUAGE="JavaScript">

    function SomenteNumero(e){
      var tecla=(window.event)?event.keyCode:e.which;   
      if((tecla>47 && tecla<58)) return true;
      else{
        if (tecla==8 || tecla==0) return true;
        else  return false;
      }
    }

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
   <?php include('View_topo.php'); ?>

<div id='corpo'>
 <h2>Cadastro Livro</h2>
 <div style="height: 450px;" id="lateral">
   <p style="margin-bottom: 0px;"><img style= "margin-top: -16px; border: 2px solid #133141;" src="../<?php echo $foto; ?>"width="198" height="198"></p>
   <form action="?go=salvarfoto" method="post" enctype="multipart/form-data" name="form" class="form" id="form" >
     <div class="upload">
       <p>Mudar Foto</p>
       <input class="btn_foto" onchange="form.submit()" type="file" name="foto" /><br />
     </div>
   </form>
 </div>

 <form name="CadastroUsuario" method="post" action="../Repositorio/Repositorio_editalivro.php" enctype="multipart/form-data">
  <table id="cad_table">
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
        <?php
         $selecte = mysql_query("select * from categoria_livro where N_COD_CATEGORIA=".$genero."");
         $row =mysql_fetch_array($selecte);
         $codig = $row['N_COD_CATEGORIA'];
         $gene = $row['V_GENERO'];
        ?>
        <td> <select id="genero" name="genero">
          <option value="<?php echo $codig;?>" selected><?php echo $gene; ?></option>
         <?php
            $comando= mysql_query("select * from categoria_livro");
          while ($linha=mysql_fetch_array($comando)) {
            $id = $linha['N_COD_CATEGORIA'];
            $categoria = $linha['V_GENERO'];
              
           
            

            ?>            
              <option value="<?php echo $id;?>"><?php echo $categoria; ?></option>
             <?php } ?>
        </select> </td>
      </tr>
      <tr>
        <td>Ano:*</td>
        <td><input type="text" name="ano" id="ano" class="txt1" onkeypress='return SomenteNumero(event)' value ="<?php echo $ano;?>" maxlength="10" size=6 required/></td>
      </tr>
      <tr>
        <td><label for="mensagem">Observação</label></td>
        <td><textarea name="observacao" id="observacao" rows="5" cols="26"  onkeyup="mostrarResultado(this.value,255,'spcontando');contarCaracteres(this.value,255,'sprestante')"/><?php echo $observacao;?></textarea><br>
          <span id="spcontando">0/255 caracteres digitados...</span><br /></td>
        </tr>
        <td colspan="2">
          <input style="  width: 200px; cursor:default;" class='btn' onclick="location.href='../Repositorio/PerfilUsuario.php'" value="Cancelar" id="btnCancelar" name="btnCancelar">
          <input style="  width: 200px;" class='btn' type="submit" value="Salvar" id="btnSalvar" name="btnSalvar"><br>
        </td>
      </tr>
    </table>
  </form>
</div>

<?php include('View_rodape.php'); ?>
</body>
</html>
<?php
if (@$_GET['go'] == 'salvarfoto') {
  $error;
  // Recupera os dados dos campos
  $foto = $_FILES["foto"];

  // Se a foto estiver sido selecionada
  if (!empty($foto["name"])) {

    // Largura máxima em pixels
    $largura = 1920;
    // Altura máxima em pixels
    $altura = 1080;
    // Tamanho máximo do arquivo em bytes
    $tamanho = 1600000;

      // Verifica se o arquivo é uma imagem
    if(!preg_match("/^image\/(gif|bmp|png|jpg|jpeg)$/", $foto["type"])){
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

      // Insere os dados no banco
    $sql = mysql_query("UPDATE livro SET V_FOTO = '$caminho_imagem' WHERE N_COD_LIVRO = $codigolivro");   

      // Se os dados forem inseridos com sucesso
    if (!$sql){
      echo "<script>alert('Erro ao atualizar foto !! ');history.back();</script>";
    }else{
      echo "<meta http-equiv='refresh' content='0'>"; 
    }
  }

    // Se houver mensagens de erro, exibe-as
  if (count($error) != 0) {
    foreach ($error as $erro) {
      echo $erro . "<br />";
      echo "<script>alert('".$erro."!! ');</script>";
    }
  }
}

}
?>

