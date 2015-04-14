<!DOCTYPE html>
<?php
require_once "Conexao.php";
?>
<html>
<head>
<?php  
session_start();
if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:index.php');
  }

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];
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
           <li class='active' style="float: right" class="right"><a href='Painel.php'><span>PAINEL</span></a></li> 
           <li>
           <form name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >
            <input type="text" name="palavra" />
            <input type="submit"  value="Buscar" />
          </li>
          </form>
        </ul>
      </div>
    </div>

<?php
$query1 = mysql_query("SELECT V_NOME, V_CIDADE, V_UF, V_EMAIL, V_CEP, V_BAIRRO, D_DATA_CADASTRO, V_IDADE, D_DATA_ULTIMO_LOGIN, V_FOTO FROM usuario WHERE V_LOGIN = '$logado'");


$dados = mysql_fetch_row($query1);

$nome = $dados[0];
$cidade = $dados[1];
$uf = $dados[2];
$email = $dados[3];
$cep = $dados[4];
$bairro = $dados[5];
$datacadastro = $dados[6];
$idade = $dados[7];
$datalogin = $dados[8];
$foto = $dados[9];
?>

    <div style='height:800px;' id='corpo'>
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
  

    <fieldset style="margin-top: 10px;"><legend>Informações Pessoais</legend>
      <p>País: Brasil</p>
      <p>Estado: <?php echo $uf; ?> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp CEP: <?php echo $cep; ?></p>
      <p>Cidade / Município: <?php echo $cidade; ?></p>
      <p>Bairro: <?php echo $bairro; ?></p>
      <p>Endereço de Email: <?php echo $email; ?></p>
      <p>Idade: <?php echo $idade; ?> Anos</p>
      <p>Data de Cadastro: <?php echo date('d/m/Y', strtotime($datacadastro)); ?></p>
      <p>Data Último Login: <?php echo date('d/m/Y \á\s H:i:s', strtotime($datalogin)); ?></p>

    </fieldset>
    <div>
      <h4>Meus Livros</h4> <b class="text_container">-</b><p class="text_container2">+</p>
      <div id="box-livro-1"><!--div that we want to hide-->
        <img src="FotoPerfilUsuario/896943baf92bb9ffde64925c18e4ffa8.jpg" width="100" height="150">
        <div id="informacao">
          <p><span class="titulo">Nome do livro</span></p>
          <p><span class="nomeusuario">Nome do usuario</span></p>
          <p><span class="autor">Nome do autor do livro</span></p>
          <p><span class="solicitar">Botao para solicitar</span></p>
        </div>
      </div>
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