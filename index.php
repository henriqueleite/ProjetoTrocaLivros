<!DOCTYPE html>
<?php
session_start();
require_once"config.php";
require_once"Conexao.php";
?>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
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

    <div id="corpo">
    	<div id="imagem">
    		<img src="#" />
        </div><!--fim div imagem-->
        <div id="ultimosdisponivel">
        	<h2>Ultimos Livros Disponiveis</h2>
        </div><!--fim div ultimosdisponivel-->
        <div id="box-livro">
		  <?php 
		  	//faz uma consulta e tras os ultimos registros cadastrados e limitado a 4 registros
            $sql = mysql_query("SELECT livro.NomeLivro, livro.Ano, livro.Foto, usuario.Nome FROM `livro` inner join usuario on usuario.IdUsuario = livro.IdUsuario order by livro.NomeLivro desc limit 4");
            while ($dados = mysql_fetch_assoc($sql))
            {
              $foto = $dados['Foto'];
              $nome = $dados['Nome'];
              $ano = $dados['Ano'];
			  $nomelivro = $dados['NomeLivro'];
              echo "<div id='box-info-livro'>
						<div class='imagem-livro'> 
							<img src='$foto' width='100' height='150'/>
						</div>
						<div class='info-livro'>
							&raquo<a href='#'><span class='nomelivro'><b>$nomelivro</b></span></a></br>
							&raquo<a href='#'><span class='nomeuser'>$nome</span></a>&#9823</br></br>
							<p>$ano</p></br>
							<p><a href='#'>Solicitar</a></p>						
						</div>
					</div>";
			}
          ?>
      </div><!--fim div box-livro-->

    </div><!-- fim div corpo -->

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