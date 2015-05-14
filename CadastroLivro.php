<!DOCTYPE html>
<?php
  session_start();
  require_once "Conexao.php";
  //$titulo = $autor = $editora = $estado = $genero = $ano = $observacao = $foto = "";

?>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
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
    <div id='cssmenu'>
      <div id='container'>
        <ul>
           <li><a href='index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
           <li class='active'><a href='index.php'><span>ÍNICIO</span></a></li>
           <li><a href='Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
           <li><a href='Form_Ajuda.php'><span>SOBRE</span></a></li>
           <li class='last'><a href='Form_Ajuda.php'><span>CONTATO</span></a></li>
           <li><form name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >

            <input type="text" name="palavra" />
            <input type="submit"  value="Buscar" />
          </li>
          </form>

            <?php
          
            if((isset ($_SESSION['login']) == true)){
               echo "<li style='float: right' class='right'><a href='Logout.php'><span>SAIR</span></a></li>";
               echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";  
               echo "<li style='float: right' class='right'><a href='PerfilUsuario.php'><span>PAINEL</span></a></li>";
            } else {
              echo "<li style='float: right' class='right'><a href='Login.php'><span>LOGIN</span></a></li>";
              echo "<li style='float: right' class='right'><a href='CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>";
            }
               ?> 

        </ul>
      </div>
    </div>

    <div id='corpo'>
     <h2>Cadastro Livro</h2>

        <form name="CadastroUsuario" method="post" action="?go=cadastrar" enctype="multipart/form-data">
          <table id="cad_table">
            <tr >  
              <td>
                Foto:
              </td>
              <td>
                <input style="width: 325px;" type="file" name="foto" />
              </td>
            </tr>

            <tr>
              <td>Título:*</td>
              <td><input type="text" name="titulo" id="titulo" class="txt"  size=35 required/></td>
            </tr>
            <tr>
              <td>Autor:*</td>
              <td><input type="text" name="autor" id="autor" class="txt"  size=35 required/></td>
            </tr>
            <tr>
              <td>Editora:*</td>
              <td><input type="text" name="editora" id="editora" class="txt"  size=35 required/></td>
            </tr>
            <tr>
              <td>Estado:*</td>
              <td> <select id="estado" name="estado">
              <option value="Novo">Novo</option>
              <option value="Semi-Novo">Semi-Novo</option>
              <option value="Velho">Velho</option>
              </select> </td>
            </tr>
            <tr>
              <td>Genero:*</td>
              <td> <select id="genero" name="genero">
              <option value="1">Comédia</option>
              <option value="2">Drama</option>
              <option value="3">Ficcão</option>
              </select> </td>
            </tr>
            <tr>
              <td>Ano:*</td>
              <td><input type="text" name="ano" id="ano" class="txt1" maxlength="10" size=35 required/></td>
            </tr>
            <tr>
              <td><label for="mensagem">Observação</label></td>
              <td><textarea name="observacao" id="observacao" rows="5" cols="26" onkeyup="mostrarResultado(this.value,255,'spcontando');contarCaracteres(this.value,255,'sprestante')"/></textarea><br>
              <span id="spcontando">0/255 caracteres digitados...</span><br /></td>
            </tr>
              <td colspan="2"><input style="  width: 390px;" class='btn' type="submit" value="Cadatrar Livro" id="buton1" name="btvalidar"><br>
              </td>
            </tr>
          </table>
        </form>
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

<?php

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo   = $_SESSION['tipo'];


if(@$_GET['go'] == 'cadastrar'){

    $titulo     = $_POST['titulo'];
    $autor      = $_POST['autor'];
    $editora    = $_POST['editora'];
    $estado     = $_POST['estado'];
    $genero     = $_POST['genero'];
    $ano        = $_POST['ano'];
    $observacao = $_POST['observacao'];
    $foto       = $_FILES["foto"];



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
      echo "<script>alert('Preencha o camp Estado'); history.back(); </script>";
    }else if ($genero  == ""){
      echo "<script>alert('Preencha o camp Genero'); history.back(); </script>";
    }else if ($ano  == ""){
      echo "<script>alert('Preencha o camp Ano'); history.back(); </script>";
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
}
?>