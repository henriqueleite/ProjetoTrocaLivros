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
        $(".listar-livro").hide(1000);
    });
    $(".text_container2").click(function(){
        $(".listar-livro").show(1000);
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
$query2 = mysql_query("SELECT COUNT(*) FROM livro WHERE N_COD_USUARIO_IE = '$codigo'");
$query3 = mysql_query("SELECT COUNT(*) FROM livro_desejado WHERE N_COD_USUARIO_IE = '$codigo'");
$query4 = mysql_query("SELECT COUNT(*), livro.N_COD_USUARIO_IE FROM troca INNER JOIN livro on livro.N_COD_LIVRO = troca.N_COD_LIVRO  WHERE livro.N_COD_USUARIO_IE = '$codigo'");
$query5 = mysql_query("SELECT COUNT(*), troca.N_COD_LIVRO, livro.N_COD_USUARIO_IE FROM local_troca INNER JOIN troca ON troca.N_COD_TROCA = local_troca.N_COD_TROCA_IE INNER JOIN livro on troca.N_COD_LIVRO = livro.N_COD_LIVRO INNER JOIN usuario on livro.N_COD_USUARIO_IE = usuario.N_COD_USUARIO WHERE usuario.N_COD_USUARIO = '$codigo'");
$query6 = mysql_query("SELECT COUNT(*), troca.N_COD_LIVRO, livro.N_COD_USUARIO_IE FROM local_troca INNER JOIN troca ON troca.N_COD_TROCA = local_troca.N_COD_TROCA_IE INNER JOIN livro on troca.N_COD_LIVRO_SOLICITANTE = livro.N_COD_LIVRO INNER JOIN usuario on livro.N_COD_USUARIO_IE = usuario.N_COD_USUARIO WHERE usuario.N_COD_USUARIO = '$codigo'");
$query7 = mysql_query("SELECT COUNT(*), livro.N_COD_USUARIO_IE FROM troca INNER JOIN livro on livro.N_COD_LIVRO = troca.N_COD_LIVRO  WHERE livro.N_COD_USUARIO_IE = '$codigo' AND B_ATIVO = 'F'");
$query8 = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, D_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE WHERE N_COD_USUARIO_IE = '$codigo'");

$dados = mysql_fetch_assoc($query1);

$Livros = mysql_fetch_row($query2);
$LivrosDesejados = mysql_fetch_row($query3);
$Solitacoes = mysql_fetch_row($query4);
$TrocasPendentesRecebidas = mysql_fetch_row($query5);
$TrocasPendentesFeitas = mysql_fetch_row($query6);
$TrocasRealizadas = mysql_fetch_row($query7);

$nome = $dados['V_NOME'];
$cidade = $dados['V_CIDADE'];
$uf = $dados['V_UF'];
$email = $dados['V_EMAIL'];
$cep = $dados['V_CEP'];
$bairro = $dados['V_BAIRRO'];
$datacadastro = $dados['D_DATA_CADASTRO'];
$idade = $dados['V_IDADE'];
$datalogin = $dados['D_DATA_ULTIMO_LOGIN'];
if ($dados['V_FOTO']) {
$foto = $dados['V_FOTO'];
}else{
$foto = "FotoPerfilUsuario/foto_padrao.jpg";
}

$QuantidadeLivros = $Livros[0];
$QuantidadeLivrosDesejados = $LivrosDesejados[0];
$QuantidadeSolicitacoes = $Solitacoes[0];
$QuantidadeTrocasPendentes = $TrocasPendentesRecebidas[0] + $TrocasPendentesFeitas[0];
$QuantidadeTrocasRealizadas = $TrocasRealizadas[0];



?>

    <div style="height: 2000px;" id='corpo'>
      <h2>Painel</h2>
      <div id='lateral'>

        <p style="margin-bottom: 0px;"><img style= "margin-top: -16px; border: 2px solid #133141;" src="<?php echo $foto; ?>"width="198" height="198"></p>
            <form action="?go=salvarfoto" method="post" enctype="multipart/form-data" name="cadastro" >
            Foto de exibição:<br />
            <input style="width: 200px;" type="file" name="foto" /><br />
            <input  type="submit" value="Mudar Foto" class="btnPerfil" id="btnPerfil">
            </form>
              <input  type="submit" value="Editar Perfil" onclick="location.href='EditarUsuario.php'" class="btnPerfil" id="btnPerfil"> 
            <div id='quantidaderegistro'>
              <p class='info-lateral'>Livros Publicados: <?php echo $QuantidadeLivros; ?> </p>
              <p class='info-lateral'>Livros Desejados: <?php echo $QuantidadeLivrosDesejados; ?></p>
              <p class='info-lateral'>Solicitações : <?php echo $QuantidadeSolicitacoes; ?></p>
              <p class='info-lateral'>Trocas Pendentes : <?php echo $QuantidadeTrocasPendentes; ?></p>
              <p class='info-lateral'>Trocas Realizadas : <?php echo $QuantidadeTrocasRealizadas; ?></p>
            </div>

      </div>
      <div id='centro'>

    <p style="text-transform: uppercase; font-size: 20pt; margin-bottom:0px; margin-top: 0px;"><?php echo $nome; ?></p>
    <p style="text-transform: uppercase; font-size: 12pt; margin-top:0px;margin-bottom:0px; margin-top: 0px;"><?php echo $cidade; ?>,<?php echo $uf; ?></p>
  

    <fieldset style="margin-top: 10px;"><legend>Informações Pessoais</legend>
      <p class='info-central'>País: Brasil</p>
      <p class='info-central'>Estado: <?php echo $uf; ?> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp CEP: <?php echo $cep; ?></p>
      <p class='info-central'>Cidade / Município: <?php echo $cidade; ?></p>
      <p class='info-central'>Bairro: <?php echo $bairro; ?></p>
      <p class='info-central'>Endereço de Email: <?php echo $email; ?></p>
      <p class='info-central'>Idade: <?php echo $idade; ?> Anos</p>
      <p class='info-central'>Data de Cadastro: <?php echo date('d/m/Y', strtotime($datacadastro)); ?></p>
      <p class='info-central'>Data Último Login: <?php echo date('d/m/Y \á\s H:i:s', strtotime($datalogin)); ?></p>

    </fieldset>
   <div>

    <h4 class="centro-esquerda"><a href="CadastroLivro.php">Cadastrar Livro</a><h4>
    <h4>Meus Livros</h4> <b class="text_container">-</b><p class="text_container2">+</p>
    <div><!--div that we want to hide-->

            <table class="listar-livro-exibicao">

        <td style="width: 60px; margin-left: -10px;">Foto</td>
        <td style="width: 40px;">Título</td>
        <td style="width: 40px;">Autor</td>
        <td style="width: 40px;">Editora</td>
        <td style="width: 35px;">Estado</td>
        <td style="width: 40px;">Ano</td>
        <td style="width: 40px;">Gênero</td>
        <td style="width: 30px;">Obs</td>

      </table>


      <?php
      while ($linha=mysql_fetch_array($query8)){
        $codigolivro = $linha["N_COD_LIVRO"];
        $titulo= $linha['V_TITULO']; 
        $autor= $linha['V_AUTOR']; 
        $ano= $linha['D_ANO']; 
        $foto= $linha['V_FOTO'];
        $observacao= $linha['V_OBSERVACAO']; 
        $editora = $linha['V_EDITORA'];
        $estado_livro= $linha['V_ESTADO_LIVRO'];   
        $genero= $linha['V_GENERO']; 
      ?>

      <form id="form2" name="form2" method="post" action="VisualizarLivro.php">
      <h5 class="listar-livro">
      <table class="table-listar-livro">
      <tr class="listar-livro-tr">
      <td class="listar-livro-foto"><img src="<?php echo $foto; ?>"width="100" height="100"></td>
      <td class="listar-livro-titulo" align="center" valign="middle" bgcolor="#FFFFCC"><?php echo $titulo; ?></td> <br>
      <td class="listar-livro-autor" align="center" valign="middle" bgcolor="#FFFFCC"><?php echo $autor;?></td>
      <td class="listar-livro-genero" align="center" valign="middle" bgcolor="#FFFFCC"><?php echo $editora;?></td>
      <td class="listar-livro-estado-livro" align="center" valign="middle" bgcolor="#FFFFCC"><?php echo $estado_livro;?></td>
      <td class="listar-livro-ano" align="center" valign="middle" bgcolor="#FFFFCC"><?php echo $ano;?></td>
      <td class="listar-livro-genero" align="center" valign="middle" bgcolor="#FFFFCC"><?php echo $genero;?></td>
      <td class="listar-livro-observacao" align="center" valign="middle" bgcolor="#FFFFCC"><?php echo $observacao;?></td>
      <input type='hidden' name="codigolivro" id="codigolivro" value="<?php echo $codigolivro;?>" >
      <td class="listar-livro-genero" align="center" valign="middle" bgcolor="#FFFFCC"><input type="submit" name="Ver"  id="Ver"   value="Ver" /></td>
      </tr>
      </table>
    </form>
    </h5>
    
     <?php } ?>
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