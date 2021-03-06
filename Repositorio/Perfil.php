<?php
require_once "../Dados/Conexao.php";
@session_start();

if((!isset ($_SESSION['login']) == true))
{
  unset($_SESSION['login']);
  header('location:../index.php');
}

$logado = $_SESSION['login'];
$codigo = $_SESSION['codigo'];
$tipo = $_SESSION['tipo'];

if (($_SESSION['tipo'] == 1)){
  header('location:PerfilAdministrador.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Troca Livro</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="../CSS/PerfilUsuario.css">
  <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
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
   <script type="text/javascript">
  function limpaUrl() {     //função
    urlpg = $(location).attr('href');   //pega a url atual da página
    urllimpa = urlpg.split("?")[0]      //tira tudo o que estiver depois de '?'

    window.history.replaceState(null, null, urllimpa); //subtitui a url atual pela url limpa
}

setTimeout(limpaUrl, 1000) //chama a função depois de 4 segundos

  </script>
</head>
<body>
   <?php include('../Views/View_topo.php'); ?>

<?php
$user= $_SESSION['codigousuario'];
$query1 = mysql_query("SELECT V_NOME, V_CIDADE,V_SEXO, V_UF, V_EMAIL, V_CEP, V_BAIRRO, D_DATA_CADASTRO, D_DATA_NASC,D_DATA_ULTIMO_LOGIN, V_FOTO FROM usuario WHERE N_COD_USUARIO = '$user'");
$query2 = mysql_query("SELECT COUNT(*) FROM livro WHERE N_COD_USUARIO_IE = '$user' and B_ATIVO = 'T'");
$query3 = mysql_query("SELECT COUNT(*) FROM livro_desejado WHERE N_COD_USUARIO_IE = '$user'");

$query4 = mysql_query("SELECT COUNT(*), livro.N_COD_USUARIO_IE FROM troca INNER JOIN livro on livro.N_COD_LIVRO = troca.N_COD_LIVRO  WHERE livro.N_COD_USUARIO_IE = '$user' AND troca.V_STATUS = 'Pendente'");

$query5 = mysql_query("SELECT COUNT(*) FROM troca INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE WHERE (LIVRO_SOLICITADO.N_COD_USUARIO_IE = '$user' OR LIVRO_SOLICITANTE.N_COD_USUARIO_IE = '$user') AND V_STATUS = 'Aceito'");

$query7 = mysql_query("SELECT COUNT(*), livro.N_COD_USUARIO_IE FROM troca INNER JOIN livro on livro.N_COD_LIVRO = troca.N_COD_LIVRO  WHERE livro.N_COD_USUARIO_IE = '$user' AND troca.B_ATIVO = 'F'");

$query8 = mysql_query("SELECT N_COD_LIVRO, V_TITULO, V_AUTOR, V_ANO, V_FOTO, V_OBSERVACAO, V_ESTADO_LIVRO, categoria_livro.V_GENERO, V_EDITORA FROM livro INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro.N_COD_CATEGORIA_IE WHERE livro.B_ATIVO = 'T' AND N_COD_USUARIO_IE = '$user'");

$query9 = mysql_query("SELECT N_COD_LIVRO_DESEJADO, V_TITULO, D_ANO, N_COD_USUARIO_IE, N_COD_CATEGORIA_IE, categoria_livro.V_GENERO FROM livro_desejado INNER JOIN categoria_livro on categoria_livro.N_COD_CATEGORIA = livro_desejado.N_COD_CATEGORIA_IE where N_COD_USUARIO_IE = '$user'");

$query10 =  mysql_query("SELECT troca.*, (LIVRO_SOLICITADO.V_FOTO) AS FOTO_SOLICITADO, (LIVRO_SOLICITANTE.V_FOTO) AS FOTO_SOLICITANTE, (USUARIO_SOLICITADO.V_NOME) AS NOME_SOLICITANE, (USUARIO_SOLICITANTE.V_NOME) AS NOME_SOLICITADO   
FROM troca 
INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO 
INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE 
INNER JOIN usuario AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
INNER JOIN usuario AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITANTE.N_COD_USUARIO_IE 
WHERE LIVRO_SOLICITADO.N_COD_USUARIO_IE = '$user' AND troca.V_STATUS = 'PENDENTE'");

$query11 = mysql_query("SELECT * FROM ajuda inner join ajuda as ajuda_usuario on ajuda_usuario.N_COD_RESPOSTA = ajuda.N_COD_AJUDA where ajuda.N_COD_USUARIO_IE = '$user'" );

$query12 =  mysql_query("SELECT troca.*, (LIVRO_SOLICITADO.V_FOTO) AS FOTO_SOLICITADO, (LIVRO_SOLICITANTE.V_FOTO) AS FOTO_SOLICITANTE, (USUARIO_SOLICITADO.V_NOME) AS NOME_SOLICITANE, (USUARIO_SOLICITANTE.V_NOME) AS NOME_SOLICITADO   FROM troca 
  INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE INNER JOIN usuario AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
  INNER JOIN usuario AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITANTE.N_COD_USUARIO_IE WHERE (LIVRO_SOLICITADO.N_COD_USUARIO_IE = '$user' OR LIVRO_SOLICITANTE.N_COD_USUARIO_IE = '$user') AND troca.V_STATUS = 'ACEITO'");

$query13 =  mysql_query("SELECT troca.*, (LIVRO_SOLICITADO.V_FOTO) AS FOTO_SOLICITADO, (LIVRO_SOLICITADO.V_TITULO) AS DESC_LIVRO_SOLICITADO ,(LIVRO_SOLICITANTE.V_FOTO) AS FOTO_SOLICITANTE,  (USUARIO_SOLICITADO.V_NOME) AS NOME_SOLICITADO FROM troca 
  INNER JOIN livro AS LIVRO_SOLICITADO ON LIVRO_SOLICITADO.N_COD_LIVRO = troca.N_COD_LIVRO INNER JOIN livro AS LIVRO_SOLICITANTE ON LIVRO_SOLICITANTE.N_COD_LIVRO = troca.N_COD_LIVRO_SOLICITANTE INNER JOIN usuario AS USUARIO_SOLICITADO ON USUARIO_SOLICITADO.N_COD_USUARIO = LIVRO_SOLICITADO.N_COD_USUARIO_IE
  INNER JOIN usuario AS USUARIO_SOLICITANTE ON USUARIO_SOLICITANTE.N_COD_USUARIO = LIVRO_SOLICITANTE.N_COD_USUARIO_IE 
  WHERE LIVRO_SOLICITANTE.N_COD_USUARIO_IE = '$user' AND troca.V_AVALIACAO_TROCA_SOLICITANTE IS NULL AND troca.V_STATUS = 'Finalizado' ");



$mensagens = mysql_num_rows($query11);

$dados = mysql_fetch_array($query1);

$Livros = mysql_fetch_row($query2);
$LivrosDesejados = mysql_fetch_row($query3);
$Solitacoes = mysql_fetch_row($query4);
$TrocasPendentes = mysql_fetch_row($query5);
$TrocasRealizadas = mysql_fetch_row($query7);

$nome = $dados['V_NOME'];
$sexo = $dados['V_SEXO'];
$cidade = $dados['V_CIDADE'];
$uf = $dados['V_UF'];
$email = $dados['V_EMAIL'];
$cep = $dados['V_CEP'];
$bairro = $dados['V_BAIRRO'];
$foto = $dados['V_FOTO'];
  
$patternBr    = "^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9]{2}^";
$patternMySQL = "^(19|20)[0-9]{2}[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])^";

$QuantidadeLivros = $Livros[0];
$QuantidadeLivrosDesejados = $LivrosDesejados[0];
$status = $Solitacoes[1];
$QuantidadeSolicitacoes = $Solitacoes[0];
$QuantidadeTrocasPendentes = $TrocasPendentes[0];
$QuantidadeTrocasRealizadas = $TrocasRealizadas[0];
?>

<div id='corpo'>
  <h2>Perfil</h2>
  <div id='lateral'>
   <p ><img class="foto_usuario" src="<?php echo $foto; ?>"width="198" height="198"></p>
  
   </form>
      <div id='quantidaderegistro'>
    <p class='info-lateral'>Livros Publicados: <?php echo $QuantidadeLivros; ?> </p>
    <p class='info-lateral'>Livros Desejados: <?php echo $QuantidadeLivrosDesejados; ?></p>
    <p class='info-lateral'>Solicitações : <?php echo $QuantidadeSolicitacoes; ?></a></p>
    <p class='info-lateral'>Trocas Pendentes : <?php echo $QuantidadeTrocasPendentes; ?></p>
    <p class='info-lateral'>Trocas Realizadas : <?php echo $QuantidadeTrocasRealizadas; ?></p>
  </div>
</div>

<div id='centro'>

  <p class="nome_usuario"><?php echo $nome; ?></p>
  <p class="cidade_uf_usuario"><?php echo $cidade; ?>,<?php echo $uf; ?></p>
  

  <fieldset class="fieldset-info-central"><legend>Informações Pessoais</legend>
    <p class='info-central'>País: Brasil</p>
    <p class='info-central'>Estado: <?php echo $uf; ?> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp CEP: <?php echo $cep; ?></p>
    <p class='info-central'>Cidade / Município: <?php echo $cidade; ?></p>
    <p class='info-central'>Bairro: <?php echo $bairro; ?></p>
    <p class='info-central'>Endereço de Email: <?php echo $email; ?></p>
   
  </fieldset>

 
    <h2 class="MeusLivros">Livros</h2>


    <table class="listar-livro-exibicao">
      <td style="width: 60px; margin-left: -10px;">Foto</td>
      <td style="width: 40px;">Título</td>
      <td style="width: 40px;">Autor</td>
      <td style="width: 40px;">Editora</td>
      <td style="width: 40px;">Gênero</td>
      <td style="width: 35px;">Estado</td>
    </table>

    <?php
    if (mysql_num_rows($query8) <= 0){
    ?>

       <form>
        <h5 class="listar-livro">
          <table class="table-listar-livro-sem-registro">
            <tr class="listar-livro-tr">
              <td class="listar-livro-sem-registro"><p>Nenhum registro</p></td>
            </tr>
          </table>
        </h5>
      </form>

    <?php
    }else{

    while ($linha=mysql_fetch_array($query8)){
      $codigolivro = $linha["N_COD_LIVRO"];
      $titulo= $linha['V_TITULO']; 
      $autor= $linha['V_AUTOR']; 
      $ano= $linha['V_ANO']; 
      $foto= $linha['V_FOTO'];
      $observacao= $linha['V_OBSERVACAO']; 
      $editora = $linha['V_EDITORA'];
      $estado_livro= $linha['V_ESTADO_LIVRO'];   
      $genero= $linha['V_GENERO']; 
      ?>

      <form id="form2" name="form2" method="post" action="../Views/View_VisualizarLivro.php">
        <h5 class="listar-livro">
          <table class="table-listar-livro">
            <tr class="listar-livro-tr">
              <td class="listar-livro-foto"><img src="../<?php echo $foto; ?>" width="100" height="100"></td>
              <td class="listar-livro-titulo"><?php echo $titulo; ?></td> <br>
              <td class="listar-livro-autor"><?php echo $autor;?></td>
              <td class="listar-livro-genero"><?php echo $editora;?></td>
              <td class="listar-livro-genero"><?php echo $genero;?></td>
              <td class="listar-livro-estado-livro"><?php echo $estado_livro;?></td>
              <input type='hidden' name="codigolivro" id="codigolivro" value="<?php echo $codigolivro;?>" >
              <td class="listar-livro-genero"><input type="submit" name="Ver"  id="Ver"   value="Ver" /></td>
            </tr>
          </table>
        </h5>
      </form>


      <?php } 
    }?>

   
        <h2 class="MeusLivros-desejados">Livros Desejados</h2>


        <table class="listar-livro-exibidos-desejados">
          <td>Título</td>
          <td>Ano</td>
          <td class="listar-livro-exibidos-desejados-ultimo">Gênero</td>
        </table>

        <table class="listar-livro-exibidos-desejados-preenche">
          <td> </td>
        </table>

        <?php
          if (mysql_num_rows($query9) <= 0){

        ?>

          <form id="form2" name="form2" method="post" action="">
            <h5 class="listar-livro-desejados">
              <table class="table-listar-livro-desejados-sem-registro">
                <tr class="listar-livro-tr-desejados">
                  <td class="listar-livro-desejados-sem-registro"><p>Nenhum Registro</p></td> <br>
                </tr>
              </table>
            </h5>
          </form>
        <?php
      }else{
        while ($linhadesejado=mysql_fetch_array($query9)){
          $codigolivrodesejado = $linhadesejado["N_COD_LIVRO_DESEJADO"];
          $titulodesejado= $linhadesejado['V_TITULO']; 
          $anodesejado= $linhadesejado['D_ANO']; 
          $generodesejado= $linhadesejado['V_GENERO']; 
          ?>



          
            <h5 class="listar-livro-desejados">
              <table class="table-listar-livro-desejados">
                <tr class="listar-livro-tr-desejados">
                  <td class="listar-livro-titulo-desejados"><?php echo $titulodesejado; ?></td> <br>
                  <td class="listar-livro-ano-desejados"><?php echo $anodesejado;?></td>
                  <td class="listar-livro-genero-desejados"><?php echo $generodesejado;?></td>
                  <form id="form2" name="form2" method="post" action="../Views/View_EditarLivroDesejado.php">
                  <input type='hidden' name="codigolivrodesejado" id="codigolivrodesejado" value="<?php echo $codigolivrodesejado;?>" >
               
                  </form>
                  <form id="form3" name="form3" method="post" action="../Repositorio/Repositorio_ExcluirLivroDesejado.php">
                  <input type='hidden' name="codigolivrodesejado" id="codigolivrodesejado" value="<?php echo $codigolivrodesejado;?>" >
                
                  </form>
                </tr>
              </table>
            </h5>
  

          <?php }
          } ?>

          <h2 class="Solicitacoes">Solicitações</h2>

          <?php
            if (mysql_num_rows($query10) <= 0){

          ?>


            <form>
              <h5 class="listar-solicitacoes">
                <table class="table-listar-solicitacoes">
                  <tr class="listar-solicitacoes">
                    <td class="listar-solicitacoes-sem-registro"><p>Nenhum Registro</p></td>
                  </tr>
                </table>
              </h5>
            </form>
          <?php
        }else{
          while ($linhasolicitacao=mysql_fetch_array($query10)){
            $codigosolicitacao = $linhasolicitacao["N_COD_TROCA"];
            $foto_solicitado = $linhasolicitacao["FOTO_SOLICITADO"];
            $foto_solicitante= $linhasolicitacao['FOTO_SOLICITANTE']; 
            $usuario_solicitado= $linhasolicitacao['NOME_SOLICITADO']; 
            $usuario_solicitante= $linhasolicitacao['NOME_SOLICITANE']; 
            ?>



            <form id="form2" name="form2" method="POST" action="../Controles/Controle_Solicitacao.php">
              <h5 class="listar-solicitacoes">
                <table class="table-listar-solicitacoes">
                  <tr class="listar-solicitacoes">
                    <td class="listar-solicitacoes-foto-solicitado"><img src="../<?php echo $foto_solicitado; ?>"width="50" height="50"></td>
                    <td class="listar-solicitacoes-foto-troca"><img src="../Imagens/Troca.png"width="50" height="50"></td>
                    <td class="listar-solicitacoes-foto-solicitante"><img src="../<?php echo $foto_solicitante; ?>"width="50" height="50"></td>
                    <td class="listar-livro-solicitacoes-usuario-solicitado"><span style="font-weight: 100;">Usuario Solicitante: <br></span><?php echo $usuario_solicitado;?></td>
                    <td class="listar-livro-solicitacoes-usuario-solicitante"><span style="font-weight: 100;">STATUS: <br></span>AGUARDANDO</td>
                    <td><input type='hidden' name="codigosolicitacao" id="codigosolicitacao" value="<?php echo $codigosolicitacao;?>" ></td>
                    </tr>
                </table>
              </h5>
            </form>

            <?php }
            } ?>


            <h2 class="Solicitacoes">Trocas em Andamento</h2>
            <?php
              if (mysql_num_rows($query12) <= 0){
            ?>

              <form>
                <h5 class="listar-solicitacoes">
                  <table class="table-listar-solicitacoes">
                    <tr class="listar-solicitacoes">
                      <td class="listar-solicitacoes-foto-sem-registro">Nenhum Registro</td>
                    </tr>
                  </table>
                </h5>
              </form>

            <?php
          }else{
            while ($linhasolicitacao=mysql_fetch_array($query12)){
              $codigosolicitacao = $linhasolicitacao["N_COD_TROCA"];
              $foto_solicitado = $linhasolicitacao["FOTO_SOLICITADO"];
              $foto_solicitante= $linhasolicitacao['FOTO_SOLICITANTE']; 
              $usuario_solicitado= $linhasolicitacao['NOME_SOLICITADO']; 
              $usuario_solicitante= $linhasolicitacao['NOME_SOLICITANE']; 
              ?>



              <form id="form2" name="form2" method="POST" action="../Controles/Controle_VerMensagemTroca.php">
                <h5 class="listar-solicitacoes">
                  <table class="table-listar-solicitacoes">
                    <tr class="listar-solicitacoes">
                      <td class="listar-solicitacoes-foto-solicitado"><img src="../<?php echo $foto_solicitado; ?>"width="50" height="50"></td>
                      <td class="listar-solicitacoes-foto-troca"><img src="../Imagens/Troca.png"width="50" height="50"></td>
                      <td class="listar-solicitacoes-foto-solicitante"><img src="../<?php echo $foto_solicitante; ?>"width="50" height="50"></td>
                      <td class="listar-livro-solicitacoes-usuario-solicitado"><span style="font-weight: 100;">Usuario Solicitado:<br></span><?php echo $usuario_solicitado;?></td>
                      <td class="listar-livro-solicitacoes-usuario-solicitante"><span style="font-weight: 100;">Usuario Solicitante:<br></span><?php echo $usuario_solicitante;?></td>
                      <td><input type='hidden' name="codigosolicitacao" id="codigosolicitacao" value="<?php echo $codigosolicitacao;?>" ></td>
                      
                    </tr>
                  </table>
                </h5>
              </form>

              <?php } 
              } ?>

            


            </div>
          </div>
<?php include('../Views/View_rodape.php'); ?>

        </body>
        </html>



        <?php
        require_once "../Dados/Conexao.php";
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
            $largura = 3000;
    // Altura máxima em pixels
            $altura = 3000;
    // Tamanho máximo do arquivo em bytes
            $tamanho = 160000000;

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
            $caminho_imagem = "../FotoPerfilUsuario/" . $nome_imagem;

      // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);

      // Insere os dados no banco
            $sql = mysql_query("UPDATE usuario SET V_FOTO = '".$caminho_imagem."' WHERE N_COD_USUARIO = $codigo");   

      // Se os dados forem inseridos com sucesso
            if (!$sql){
              echo "<script>alert('Erro ao atualizar foto !! '); history.back();</script>";
            }else{
              echo "<meta http-equiv='refresh' content='0, url=../Repositorio/PerfilUsuario.php'>"; 
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