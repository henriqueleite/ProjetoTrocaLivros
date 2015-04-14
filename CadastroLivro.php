<!DOCTYPE html>
<html>
<head>
<?php  
require_once "Conexao.php";
session_start();
if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:index.php');
  }

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];

$query1 = mysql_query("SELECT V_NOME, V_CIDADE, V_UF, V_FOTO FROM usuario WHERE V_LOGIN = '$logado'");


$dados = mysql_fetch_row($query1);

$nome = $dados[0];
$cidade = $dados[1];
$uf = $dados[2];
$foto = $dados[3];

 $nome = "";
 $autor ="";
 $editora ="";
 $idioma = "";
 $ano = "";
 $foto1 = "";

if($_POST['cadastrar']){

    $msg = array();

    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $idioma = $_POST['idioma'];
    $ano = $_POST['ano'];
    $foto1 = $_FILES["fotodolivro"];

  // Se a foto estiver sido selecionada
    if (!empty($foto1["name"])) {
 
      // Verifica se o arquivo é uma imagem
      if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto1["type"])){
         $msg['foto'] = "Isso não é uma imagem.";
      } 

    // Se não houver nenhum erro
    if (count($msg) == "") {
    
      // Pega extensão da imagem
      preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto1["name"], $ext);
 
          // Gera um nome único para a imagem
          $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
          // Caminho de onde ficará a imagem
          $caminho_imagem = "LivrosUsuario/" . $nome_imagem;
 
      // Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($foto1["tmp_name"], $caminho_imagem);
      
      // Insere os dados no banco
      //$sql = mysql_query("UPDATE livro SET foto = '".$caminho_imagem."' WHERE N_COD_USUARIO = $codigo");
    }
  }
    if(empty($nome))
        $msg['erro'] = "Campo obrigatório";
    elseif (empty($autor)) {
      $msg['erro1'] = "Campo obrigatório";
    }
    elseif (empty($editora)) {
      $msg['erro2'] = "Campo obrigatório";
    }
    elseif (empty($idioma)) {
      $msg['erro3'] = "Campo obrigatório";
    }
    elseif (empty($ano)) {
      $msg['erro4'] = "Campo obrigatório";
    }
    else {
        $sql = ("INSERT INTO livro(Nome, Autor, Editora, Idioma, Ano, Foto) VALUES('$nome', '$autor','$editora','$idioma','$ano','$nome_imagem')");
        $qtd = mysql_query($sql);
        if($qtd){
          $msg['cadastro'] = "Cadastrado com sucesso";
          $nome = "";
          $autor = "";
          $editora = "";
          $idioma = "";
          $ano= "";
          $foto1 = "";
          
        }
        else
          $msg['cadastro'] = "Erro ao cadastrar";
    }
}
?>


    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/></script>
    <script>
    $(document).ready(function(){
    $(".text_container").click(function(){
        $(".hide").hide(1000);
    });
    $(".text_container2").click(function(){
        $(".hide").show(1000);
    });
    });
    </script>
</head>
<body>
    <div id='cssmenu'>
      <div id='container'>
        <ul>
           <li><a href='index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
           <li><a href='index.php'><span>ÍNICIO</span></a></li>
           <li><a href='Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
           <li><a href='Form_Ajuda.php'><span>SOBRE</span></a></li>
           <li class='last'><a href='Form_Ajuda.php'><span>CONTATO</span></a></li>
           <li style="float: right" class="right"><a href='Logout.php'><span>SAIR</span></a></li>
           <li style="float: right" class="right"><span style="margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; ">|</span></li>  
           <li class='active' style="float: right" class="right"><a href='PerfilUsuario.php'><span>PAINEL</span></a></li> 
           <li>
           <form name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >
            <input type="text" name="palavra" />
            <input type="submit"  value="Buscar" />
          </li>
          </form>
        </ul>
      </div>
    </div>
    <div id="corpo">
      <h2>Painel</h2>
      <div id='lateral'>

        <p style="margin-bottom: 0px;"><img style= "margin-top: -16px; border: 2px solid #133141;" src="<?php echo $foto; ?>"width="198" height="198"></p>
            <form action="?go=salvarfoto" method="post" enctype="multipart/form-data" name="cadastro" >
            Foto de exibição:<br />
            <input style="width: 200px;" type="file" name="foto" /><br />
            <input  type="submit" value="Mudar Foto" class="btnPerfil" id="btnPerfil">
            </form>
              <input  type="submit" value="Editar Perfil" onclick="location.href='EditarUsuario.php'" class="btnPerfil" id="btnPerfil"> 
              <input type="submit" value="Cadastre seu livro" onclick="location.href='CadastroLivro.php'" class="btnLivro" id="btnLivro">
      </div>
      <div id='centro'>

    <p style="text-transform: uppercase; font-size: 20pt; margin-bottom:0px;"><?php echo $nome; ?></p>
    <p style="text-transform: uppercase; font-size: 12pt; margin-top:0px;margin-bottom:0px;"><?php echo $cidade; ?>,<?php echo $uf; ?></p>
  
    <fieldset><legend>Cadastro de Livro</legend>
      <form name="CadastroLivro" method="post" action="" enctype="multipart/form-data">
    <table id="cad_table">
      <tr>
        <td>
          <?php
            if(isset($msg['cadastro'])){
                echo "<font color='blue'>".$msg['cadastro']."</font>";
                unset($msg['cadastro']);
              }

          ?>
        </td>
      </tr>
      <tr>
        <td>Nome do Livro:*</td>
        <td><input type="text" name="nome" id="nome" class="txt"  size=35 value="<?php echo $nome;?>" /></td>
        <td><?php
              if(isset($msg['erro'])){
                  echo "<font color='red'>".$msg['erro']."</font>";
                  unset($msg['erro']);
                }
          ?></td>
      </tr>
      <tr>
        <td>Autor:*</td>
        <td><input type="text" name="autor" id="autor" class="txt" size=35 value="<?php echo $autor;?>"/></td>
        <td><?php
              if(isset($msg['erro1'])){
                  echo "<font color='red'>".$msg['erro1']."</font>";
                  unset($msg['erro1']);
                }
          ?></td>
      </tr>
      <tr>
        <td>Editora:*</td>
        <td><input type="text" name="editora" id="editora" class="txt" size=35 value="<?php echo $editora;?>"/></td>
        <td><?php
              if(isset($msg['erro2'])){
                  echo "<font color='red'>".$msg['erro2']."</font>";
                  unset($msg['erro2']);
                }
          ?></td>
      </tr>
      <tr>
        <td>Idioma:*</td>
        <td><input type="text" name="idioma" id="idioma" class="txt2"  size=35 value="<?php echo $idioma;?>"/></td>
        <td><?php
              if(isset($msg['erro3'])){
                  echo "<font color='red'>".$msg['erro3']."</font>";
                  unset($msg['erro3']);
                }
          ?></td>
      </tr>
      <tr>
        <td>Ano:*</td>
        <td><input type="text" name="ano" id="ano" class="txt1" maxlength="10" size=35 value="<?php echo $ano;?>"/></td>
        <td><?php
              if(isset($msg['erro4'])){
                  echo "<font color='red'>".$msg['erro4']."</font>";
                  unset($msg['erro4']);
                }
          ?></td>
          <tr>
            <td>Foto:*</td>
            <td><input type="file" name="fotodolivro" id="fotolivro"/></td>
            <td><?php
              if(isset($msg['foto'])){
                  echo "<font color='red'>".$msg['foto']."</font>";
                  unset($msg['foto']);
                }
          ?></td>
          </tr>
      </tr>
        <td colspan="2"><input class='btn' type="submit" value="Cadastrar" id="buton1" name="cadastrar"><br>        
        </td>
      </tr>
    </table>
    </form>
      
    </fieldset>
    <div id="meuslivros">
      <h4>Meus Livros</h4> <b class="text_container"></b><p class="text_container2"></p>
      <div id="box-livro-1"><!--div that we want to hide-->
          <div id="informacao">
        <?php  
          require_once("Conexao.php");
          $sql = "SELECT * FROM livro";
          $resultado = mysql_query($sql, $conecta);
          
        ?>
        <table id="tabela-livro">
          <tr>
            <th><p><span class="foto">Foto</span></p></th>
            <th><p><span class="titulo">Nome do livro</span></p></th>
            <th><p><span class="nomeusuario">Autor</span></p></th>
            <th><p><span class="autor">Editora</span></p></th>
            <th><p><span class="autor">Idioma</span></p></th>
            <th><p><span class="autor">Ano</span></p></th>
          </tr>
          <?php
          while ($user = mysql_fetch_assoc($resultado)) 
          {
              $nomelivro = $user['Nome'];
              $autorlivro = $user['Autor'];
              $editoralivro = $user['Editora'];
              $idiomalivro = $user['Idioma'];
              $anolivro = $user['Ano'];
              $fotolivro = $user['Foto'];

              echo "<tr>
                    <td><img src='LivrosUsuario/$fotolivro' width='50' height='50'></td>
                    <td>$nomelivro</td>
                    <td>$autorlivro</td>
                    <td>$editoralivro</td>
                    <td>$idiomalivro</td>
                    <td>$anolivro</td>                    
                    </tr>";
            }
            mysql_close($conecta);
            
          ?>
        </table>
        <br>
        <br>
        <br>
        <br>

            <input type="button" value="solicitar">
          </div>
        </div><!-- fim div box-livro-1-->
      </div><!--end div_text_container-->
    </div>
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
require_once "Conexao.php";
$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];

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
          $caminho_imagem = "FotoPerfilUsuario/" . $nome_imagem;
 
      // Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($foto["tmp_name"], $caminho_imagem);
      
      // Insere os dados no banco
      $sql = mysql_query("UPDATE usuario SET V_FOTO = '".$caminho_imagem."' WHERE N_COD_USUARIO = $codigo");   
      
      // Se os dados forem inseridos com sucesso
      if (!$sql){
        echo "<script>alert('Usuário e senha não correspondem, tente novamente !! '); history.back();</script>";
      }else{
        echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>"; 
      }
    }
  
    // Se houver mensagens de erro, exibe-as
    if (count($error) != 0) {
      foreach ($error as $erro) {
        echo $erro . "<br />";
        echo "<script>alert('".$erro."!! '); history.back();</script>";
      }
    }
  }

}
?>