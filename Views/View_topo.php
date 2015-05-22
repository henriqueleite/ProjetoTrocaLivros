<div id='cssmenu'>
  <div id='container'>
    <ul>
     <li><a href='index.php'><img style='width: 50px; margin-top: -20px; margin-bottom: -20px; border: 1px solid #036564' src="LogoTrocaLivro.png"></img></a></li>
     <li class='active'><a href='index.php'><span>ÍNICIO</span></a></li>
     <li><a href='Form_Ajuda.php'><span>COMO FUNCIONA</span></a></li>
     <li><a href='Form_Ajuda.php'><span>SOBRE</span></a></li>
     <li class='last'><a href='Form_Ajuda.php'><span>CONTATO</span></a></li>
     <li><form name="frmBusca" method="post" action="Buscar.php" >

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
  </div><!--fim div container-->
</div><!--fim div cssmenu-->