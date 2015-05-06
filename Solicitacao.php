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
    <div id="troca">
        <?php
          $query4 = mysql_query("SELECT COUNT(*), usuario.V_NOME, livro.V_TITULO, troca.V_STATUS FROM troca INNER JOIN livro on livro.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE inner join usuario on usuario.N_COD_USUARIO = troca.N_COD_USUARIO_IE WHERE livro.N_COD_USUARIO_IE = '$codigo'");
          while($lista = mysql_fetch_assoc($query4))
          {
            $nomeUser = $lista['V_NOME'];
            $nomeLivro = $lista['V_TITULO'];
            $status = $lista['V_STATUS'];
            if($status == 'Pendente')
            {
              echo "<b>$nomeUser</b> solicitou a troca do livro <b>$nomeLivro</b> <a href='?a=aceitar'>Aceitar</a> | <a href='?a=excluir'>Excluir Solicitacao</a>";
            }
            else
            {
              echo "Voce nao tem Solicitacao";
            }
          }
          

        ?>
    </div>
</body>
</html>
<?php
if(isset($_GET['a']) == 'aceitar')
{
  $query4 = mysql_query("SELECT COUNT(*), troca.N_COD_TROCA FROM troca INNER JOIN livro on livro.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE  
inner join usuario on usuario.N_COD_USUARIO = troca.N_COD_USUARIO_IE 
WHERE livro.N_COD_USUARIO_IE = '$codigo'");
  $lista = mysql_fetch_assoc($query4);
  $idtroca = $lista['N_COD_TROCA'];
  $query = mysql_query("UPDATE troca SET V_STATUS = 'Aceito' where  N_COD_TROCA = $idtroca");
  if($query)
  {
    echo "<script>alert('Voce aceitou trocar com $nomeUser')</script>";
    echo "<meta http-equiv='refresh' content='0, url=PerfilUsuario.php'>";
  }
 
}
?>