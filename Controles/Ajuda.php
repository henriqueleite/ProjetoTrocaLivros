<meta http-equiv="Content-Type" content="text/html, charset=utf-8">
<?php
ini_set('display_errors', 0 );
error_reporting(0);
require_once "../Dados/Conexao.php";
session_start();

$titulo = $_POST["titulo"];
$tipo = $_POST["tipo"];
$mensagem = $_POST["mensagem"];
$codigo = $_SESSION['codigo'];


session_start();
if((!isset ($_SESSION['login']) == true))
{
echo "<script>alert('Você precisa estar logado para enviar uma mensagem !!'); </script>";
echo "<meta http-equiv='refresh' content='0, url=../Views/View_Form_Ajuda.php'>";
}else{
$query = mysql_query("insert into ajuda (V_TITULO, N_COD_USUARIO_IE, V_TIPO, V_MENSAGEM) values ('$titulo', '$codigo', '$tipo','$mensagem')");

if ($query){
	echo "<script>alert('Mensagem enviada com sucesso !!'); </script>";
	echo "<meta http-equiv='refresh' content='0, url=../Views/View_Form_Ajuda.php'>";
}else{
	echo "<script>alert('Erro no envio da mensagem, tente novamente !!'); </script>";
	echo "<meta http-equiv='refresh' content='0, url=../Views/View_Form_Ajuda.php'>";
}
}


?>