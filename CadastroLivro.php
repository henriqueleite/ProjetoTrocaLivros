<?php  
require_once "Conexao.php";
session_start();
if(!isset($_SESSION['login']) == true)
{
  unset($_SESSION['login']);
  header('location:index.php');
  }

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];

$query1 = mysql_query("SELECT Nome, Cidade, Uf, Foto FROM usuario WHERE Login = '$logado'");


$dados = mysql_fetch_row($query1);

$nome = $dados[0];
$cidade = $dados[1];
$uf = $dados[2];
$foto = $dados[3];

//verifica esse a sessao imprimir existe
if(isset($_SESSION['imprimir'])){
	$imprimir = $_SESSION['imprimir']; //todos as variaveis dentro da sessao é jogada dentro da variavel $imprimir
}
else{
	$imprimir['nome'] = "";
	$imprimir['autor'] = "";
	$imprimir['editora'] = "";
	$imprimir['idioma'] = "";
	$imprimir['ano'] = "";
	$imprimir['foto'] = "";
}
?>

<!DOCTYPE html>
<html>
<head>
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
      <form name="CadastroLivro" method="post" action="FuncaoCadastrarLivro.php" enctype="multipart/form-data">
    <table id="cad_table">
    <tr>
        
        <td><input type="hidden" name="idlivro" id="idlivro"/></td>
        
        
      </tr>
      <tr>
        <td>
          <?php
            if(isset($_SESSION['cadastro'])){
                echo "<font color='blue'>".$_SESSION['cadastro']."</font>";
                unset($_SESSION['cadastro']);
              }

          ?>
        </td>
      </tr>
      <tr>
        <td>Nome do Livro:*</td>
        <td><input type="text" name="nome" id="nome" class="txt"  size=35 value="<?php echo $imprimir['nome'];?>" /></td>
        <td><?php
              if(isset($_SESSION['erro'])){
                  echo "<font color='red'>".$_SESSION['erro']."</font>";
                  unset($_SESSION['erro']);
                }
          ?></td>
      </tr>
      <tr>
        <td>Autor:*</td>
        <td><input type="text" name="autor" id="autor" class="txt" size=35 value="<?php echo $imprimir['autor'];?>"/></td>
        <td><?php
              if(isset($_SESSION['erro1'])){
                  echo "<font color='red'>".$_SESSION['erro1']."</font>";
                  unset($_SESSION['erro1']);
                }
          ?></td>
      </tr>
      <tr>
        <td>Editora:*</td>
        <td><input type="text" name="editora" id="editora" class="txt" size=35 value="<?php echo $imprimir['editora'];?>"/></td>
        <td><?php
              if(isset($_SESSION['erro2'])){
                  echo "<font color='red'>".$_SESSION['erro2']."</font>";
                  unset($_SESSION['erro2']);
                }
          ?></td>
      </tr>
      <tr>
        <td>Idioma:*</td>
        <td><input type="text" name="idioma" id="idioma" class="txt2"  size=35 value="<?php echo $imprimir['idioma'];?>"/></td>
        <td><?php
              if(isset($_SESSION['erro3'])){
                  echo "<font color='red'>".$_SESSION['erro3']."</font>";
                  unset($_SESSION['erro3']);
                }
          ?></td>
      </tr>
      <tr>
        <td>Ano:*</td>
        <td><input type="text" name="ano" id="ano" class="txt1" maxlength="10" size=35 value="<?php echo $imprimir['ano'];?>"/></td>
        <td><?php
              if(isset($_SESSION['erro4'])){
                  echo "<font color='red'>".$_SESSION['erro4']."</font>";
                  unset($_SESSION['erro4']);
                }
          ?></td>
          <tr>
            <td>Foto:*</td>
            <td><input type="file" name="fotodolivro" id="fotolivro"/></td>
            <td><?php
              if(isset($_SESSION['foto'])){
                  echo "<font color='red'>".$_SESSION['foto']."</font>";
                  unset($_SESSION['foto']);
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

