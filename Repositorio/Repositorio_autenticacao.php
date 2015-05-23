<?php
require_once "../Dados/Conexao.php";
session_start();

	$user = $_POST['usuario'];
	$pwd  = $_POST['senha'];
  $queryUsuario = mysql_query("SELECT N_COD_USUARIO, V_LOGIN, N_TIPO_USUARIO,B_ATIVO FROM usuario WHERE V_LOGIN = '$user' AND V_SENHA ='$pwd' ");  
  $coluna       = mysql_fetch_array($queryUsuario);
  $consulta     = mysql_num_rows($queryUsuario);

  if ($consulta == 1) {

    $usuarioOK = $coluna['B_ATIVO'];

    if ($usuarioOK == 'F') {
      echo "<script>alert('O usuário ".$user.", não pode mais utilizar o sistema, pois está bloqueado !! '); history.back();</script>"; 
      die();
    } 

    $_SESSION["login"]     = $user;
    $_SESSION["codigo"]    = $coluna['N_COD_USUARIO'];
    $_SESSION["tipo"]      = $coluna['N_TIPO_USUARIO'];

      if ($_SESSION["tipo"] == 1) {
          header("Location: ../Repositorio/PerfilAdministrador.php");
      }else{
          header("Location: ../Repositorio/PerfilUsuario.php");
      }
  
  } else {
    echo "<script>alert('Usuário e senha não correspondem, tente novamente !! '); history.back();</script>";
  
  


}