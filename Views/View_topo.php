<div id='container'>
      <nav class="menu">
          <a href='#' class="logo"></a>
          <ul>
              <li><a href="../index.php">Início</a></li>
              <li><a href="../Views/View_Form_Ajuda.php">Como Funciona</a></li>
              <li><a href="../Views/View_Form_Ajuda.php">Contato</a></li>
              </ul>
          
              
          <div class="links-group">

              <?php
              
                if((isset ($_SESSION['login']) == true)){
                    echo "<a href='../Repositorio/PerfilUsuario.php' class='login painel'>Painel</a>";
                    echo "<a href='../Controles/Controle_Logout.php' class='cadastre-se sair'>Sair</a>";
                 //echo "<li style='float: right' class='right'><span style='margin-top: 12px; position: absolute; margin-left: -2px; color: #999999; opacity: 0.4; '>|</span></li>";

               } else {

              echo "<a href='../Views/View_Login.php' class='login painel'>Login</a>";
              echo "<a href='../Views/View_CadastroUsuario.php' class='cadastre-se'>Cadastre-se</a>";
            }

              ?>

          </div>

      </nav>

  </div><!--fim div container-->
<form name="frmBusca" method="post" action="View_Buscar.php" class="search">
              <input type="search" name="palavra" class="input_pesquisa" placeholder="Faça sua busca">
              <input type="submit" value="Buscar">
              </form>

