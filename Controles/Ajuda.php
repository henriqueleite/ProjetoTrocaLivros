<meta http-equiv="Content-Type" content="text/html, charset=utf-8">
<?php
require_once "./Dados/Conexao.php";

$titulo = $_POST["titulo"];
$tipo = $_POST["tipo"];
$mensagem = $_POST["mensagem"];
$codigo = null;


session_start();
if((!isset ($_SESSION['login']) == true))
{
echo "<script>alert('Você precisa estar logado para enviar uma mensagem !!'); </script>";
echo "<meta http-equiv='refresh' content='0, url=Form_Ajuda.php'>";
}else{
$codigo = $_SESSION['codigo'];


$query = mysql_query("insert into ajuda (V_TITULO, N_COD_USUARIO_IE, V_TIPO, V_MENSAGEM) values ('$titulo', '$codigo', '$tipo','$mensagem')");

if ($query){
	echo "<script>alert('Mensagem enviada com sucesso !!'); </script>";
	echo "<meta http-equiv='refresh' content='0, url=Form_Ajuda.php'>";
}else{
	echo "<script>alert('Erro no envio da mensagem, tente novamente !!'); </script>";
	echo "<meta http-equiv='refresh' content='0, url=Form_Ajuda.php'>";
}
}


?>