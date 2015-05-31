<!DOCTYPE html>
<?php
require_once "../Dados/Conexao.php";
session_start();

if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:../index.php');
}
$mensagem = '';
$codigo = $_SESSION['codigo'];



?>
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
  <link rel="stylesheet" type="text/css" href="../CSS/ChatTroca.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
  <script type='text/javascript' src='../js/chat.js'></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
</script>

   <script type="text/javascript">
    function atualizar(){

    $.ajax({
      url:"../Controles/Controle_Chat.php",
      method: "GET"
    })
    .done(function(Data);
      $("#chat-box").html(Data);
      
      setTimeout(atualizar();,15000);
    });
}

$(function () {
  atualizar();
})

    </script>
</head>
<body onload="setInterval('atualizar()',1000)">
 <div id='cssmenu'>
  <div id='container'>
    <ul>
     <li><a href='#'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
     <li class='active'><a href='#'><span>ÍNICIO</span></a></li>
     <li><a href='Views/View_Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
     <li><a href='Views/View_Form_Ajuda.php'><span>SOBRE</span></a></li>
     <li class='last'><a href='Views/View_Form_Ajuda.php'><span>CONTATO</span></a></li>
     <li><form name="frmBusca" method="post" action="iew_Buscar.php" >

      <input type="text" name="palavra" />
      <input type="submit"  value="Buscar" />
    </li>
  </form>

  <?php

  if((isset ($_SESSION['login']) == true)){
   echo "<li style='float: right' class='right'><a href='../Controles/Controle_Logout.php'><span>SAIR</span></a></li>";
   echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";  
   echo "<li style='float: right' class='right'><a href='../Repositorio/PerfilUsuario.php'><span>PAINEL</span></a></li>";
 } else {
  echo "<li style='float: right' class='right'><a href='../Views/View_Login.php'><span>LOGIN</span></a></li>";
  echo "<li style='float: right' class='right'><a href='../Views/View_CadastroUsuario.php'><span>CADASTRAR-SE</span></a></li>";
}
?> 

    </ul>
  </div><!--fim div container-->
</div><!--fim div cssmenu-->



  <div id='corpo'>  

    <a href="http://dribbble.com/shots/966016-Messages?list=users" style="color:#09c; padding:20px; display:block; clear:both; text-align:center;"></a>
<div class="container">
  <div class="header">
    <h2>Messages</h2>
  </div>
  <div class="chat-box" id="chat-box">
           <?php
          $query = mysql_query("SELECT mensagens_troca.*, USUARIO_MENSAGEM.V_NOME, USUARIO_MENSAGEM.N_COD_USUARIO, USUARIO_MENSAGEM.V_FOTO, USUARIO_MENSAGEM.V_SEXO, mensagens_troca.D_DATA_MENSAGEM from mensagens_troca INNER JOIN troca ON troca.N_COD_TROCA = mensagens_troca.N_COD_TROCA_IE
                      INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = TROCA.N_COD_LIVRO
                      INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = TROCA.N_COD_LIVRO_SOLICITANTE
                      INNER JOIN usuario AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
                      INNER JOIN usuario AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
                      INNER JOIN usuario as USUARIO_MENSAGEM ON USUARIO_MENSAGEM.N_COD_USUARIO = mensagens_troca.N_USUARIO_DE 
                      WHERE mensagens_troca.N_COD_TROCA_IE = ".$_SESSION['id_troca']." order by mensagens_troca.n_cod_mensagens_troca desc;");
          while ($consulta = mysql_fetch_array($query)){
          $mensagem = $consulta["V_MENSAGEM"];  
          $usuario = $consulta["V_NOME"];
          $cod_usuario = $consulta["N_COD_USUARIO"];
          $foto_usuario = $consulta["V_FOTO"];
          $datamensagem = $consulta["D_DATA_MENSAGEM"];
          $datadehoje = date("Y-m-d H:i:s");
          $sexo = $consulta["V_SEXO"];

          $start_date = new DateTime($datadehoje);
          $since_start = $start_date->diff(new DateTime($datamensagem));
          /*echo $since_start->days.' dias total<br>';
          echo $since_start->y.' Anos<br>';
          echo $since_start->m.' Meses<br>';
          echo $since_start->d.' dias<br>';
          echo $since_start->h.' horas<br>';
          echo $since_start->i.' minutos<br>';
          echo $since_start->s.' segundos<br>';*/
          $tempo = '';
        
            if ($since_start->y > 0){
              $tempo = 'há '.$since_start->y.' Anos(s)';
            }else if ($since_start->m > 0){
              $tempo = 'há '.$since_start->m.' Mes(ses)';
            }else if ($since_start->d > 0){
              $tempo = 'há '.$since_start->d.' Dia(s)';
            }else if ($since_start->h > 0){
              $tempo = 'há '.$since_start->h.' Hora(s)';
            }else if ($since_start->i > 0){
              $tempo = 'há '.$since_start->i.' Minuto(s)';
            }else if ($since_start->s > 0){
              $tempo = 'há '.$since_start->s.' Segundo(s)';
            }else{
              $tempo = 'Agora';
            }

          if ($codigo == $cod_usuario){
               echo '<div class="message-box left-img">';
               echo '<div class="picture">';
               if ($foto_usuario != ''){
               echo ' <img src="'.$foto_usuario.'"/>';
             }else{
                if ($sexo == 'F') {
                    $foto_usuario = "../FotoPerfilUsuario/foto_padraoF.jpg";
                } else {
                    $foto_usuario = "../FotoPerfilUsuario/foto_padraoM.jpg";
                }
                echo ' <img src="'.$foto_usuario.'"/>';
             }
                echo ' <span class="time">'.$tempo.'</span>';
                echo '</div>';
               echo ' <div class="message">';
               echo '  <span>'.$usuario.'</span>';
              echo ' <p>'.$mensagem.'</p>';
              echo ' </div>';
                echo '</div>';     
          }else{

            echo '<div class="message-box right-img">';    
             echo '<div class="picture">';    
               if ($foto_usuario != ''){
               echo ' <img src="'.$foto_usuario.'"/>';
             }else{
                if ($sexo == 'F') {
                    $foto_usuario = "../FotoPerfilUsuario/foto_padraoF.jpg";
                } else {
                    $foto_usuario = "../FotoPerfilUsuario/foto_padraoM.jpg";
                }
                echo ' <img src="'.$foto_usuario.'"/>';
             }
              echo '  <span class="time-right">'.$tempo.'</span>';    
              echo ' </div>';    
               echo '<div class="message">';    
               echo ' <span>'.$usuario.'</span>';    
              echo '  <p>'.$mensagem.'</p>';    
             echo '  </div>';    
             echo '</div>';    
          }

          } 
          ?>  
  
    
  </div>
  
  <div class="enter-message">
    <form method="post" action="../Repositorio/Repositorio_Chat.php">
      <input type="text" class="mensagem" id="mensagem" name="mensagem" placeholder="Digite sua mensagem.."/>
      <input type="submit" class="send" value="Enviar"/>
    </form>
   </div>
</div>

  
     <?PHP 
	$query2 = mysql_query("SELECT (LIVRO_SOLICITADO.V_FOTO) AS FOTOSOLICITADO, (LIVRO_SOLICITANTE.V_FOTO) AS FOTOSOLICITANTE, (LIVRO_SOLICITADO.V_TITULO) AS LIVRONOMESOLICITADO, 
							(LIVRO_SOLICITANTE.V_TITULO) AS LIVRONOMESOLICITANTE 
							FROM mensagens_troca 
							INNER JOIN troca ON troca.N_COD_TROCA = mensagens_troca.N_COD_TROCA_IE
							INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO
							INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE
							WHERE mensagens_troca.N_COD_TROCA_IE = ".$_SESSION['id_troca']." LIMIT 1");
	while($dados = mysql_fetch_array($query2)){
	$FOTOSOLICITADO = $dados["FOTOSOLICITADO"]; 
	$FOTOSOLICITANTE = $dados["FOTOSOLICITANTE"];
	$LIVRONOMESOLICITADO = $dados["LIVRONOMESOLICITADO"];
	$LIVRONOMESOLICITANTE = $dados["LIVRONOMESOLICITANTE"];
	}
	?>
    <div class="livros">
	<table class="table_livros">
    <tr>
    <th><img src=../<?php echo $FOTOSOLICITADO ?> width="100px" height="100px"/></td>
    <th><img src=../Imagens/Troca.png width="50px" height="50px"/></td>
    <th>	<img src=../<?php echo $FOTOSOLICITANTE ?> width="100px" height="100px;"/></td>
    </tr>
    <tr>
    <td>    <P><?php echo $LIVRONOMESOLICITADO ?></P></td>
    <td>    <P> </P></td>
    <td>    <P><?php echo $LIVRONOMESOLICITANTE ?></P></td>
    </tr>
    </table>

	<input class="btn_finalizar" type="button" value="Solicitar Finalização da troca"/>
    </div>
    

  </div>
<!--<?php include('View_rodape.php'); ?>-->
</body>
</html>