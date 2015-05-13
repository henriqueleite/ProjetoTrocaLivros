<!DOCTYPE html>
<?php

session_start();

require_once "Conexao.php";


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

    <div id='corpo'>
      Corpo do Site</br>
      Corpo do Site</br>
      Corpo do Site</br>
      Corpo do Site</br>
      Corpo do Site</br>
      Corpo do Site</br>
      Corpo do Site</br>
      Corpo do Site</br>
      <h2 style='margin-top: 20px' class='index'>DESTAQUES</H2>

      <?php 
         $query = mysql_query("SELECT livro.V_TITULO, usuario.V_NOME, livro.N_COD_LIVRO FROM livro
         inner join usuario on
         usuario.N_COD_USUARIO = livro.N_COD_USUARIO_IE");

         while ($lista = mysql_fetch_assoc($query))
         {
           $id = $lista['N_COD_LIVRO'];
           $titulo = $lista['V_TITULO'];
           $nomeUser = $lista['V_NOME'];
         
         echo "<p>$titulo, $nomeUser, <a href='?s=$id'>Solicitar</a></p>";
               
       }
      ?>
      <?php
         if(isset($_GET['s']))
         {
             $id = $_GET['s'];
             $codigoUser = $_SESSION['codigo'];


             $sql = mysql_query("SELECT usuario.N_COD_USUARIO from livro inner join usuario on usuario.N_COD_USUARIO = livro.N_COD_USUARIO_IE where livro.N_COD_LIVRO = $id");
             $resul = mysql_fetch_row($sql);
             $userid = $resul[0];

             if($codigoUser == $userid)
             {
                  echo "Voce nao pode solicitar o seu proprio livro";
             }
             else
             {
                  $data = date('Y/m/d');
                  $update = mysql_query("INSERT INTO troca(N_COD_USUARIO_IE, N_COD_LIVRO_SOLICITANTE, D_DATA, V_STATUS) VALUES ($codigoUser, $id, '$data', 'Pendente')");
                  if($update)
                  {
                       echo "Solicitacao enviada";
                       //$_SESSION['codigolivro'] = $codigoLivro;
                  }
                  else
                  {
                       echo "Erro ao solicitar";
                  }
             } 

         }
      ?>
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