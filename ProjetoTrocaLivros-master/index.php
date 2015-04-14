<!DOCTYPE html>
<?php
require_once "config.php";
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
            session_start();
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

      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>
      <h5> </h5>

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