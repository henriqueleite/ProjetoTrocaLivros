<?php
require_once "../Dados/Conexao.php";
include('../Controles/valida-email.php');

$nome = strtoupper($_POST['nome']);
$email = $_POST['email'];
$assunto = $_POST['assunto'];
$mensagen = $_POST['mensagem'];
$telefone = $_POST['telefone'];
$quebralinha="\n";

		if (empty($nome) && $nome == null) {
			echo "<script>alert('Preencha o campo nome.'); history.back();</script>";
		}elseif (empty($email)&& $email == null) {
			echo "<script>alert('Preencha seu email'); history.back();</script>";
		}elseif (empty($telefone)&& $telefone == null) {
			echo "<script>alert('Preencha seu telefone.'); history.back();</script>";
		}elseif (empty($assunto)&& $assunto == null) {
			echo "<script>alert('É importante preencher o assunto'); history.back();</script>";
		}elseif (empty($mensagen)&& $mensagen == null) {
			echo "<script>alert('Escreva algo pra ser enviado'); history.back();</script>";
		}elseif (empty($data)&& $nome == null) {
			echo "<script>alert('é incrivel mas a data do sua Maquina esta icompativel'); history.back();</script>";

			}else{
				//$query2 = mysql_query("insert into mensagen (nome, email, telefone, assunto, mensagem, data) values ('$nome','$email','$telefone','$assunto','$mensagen','$data')");
			//if (!$query2) {
			//echo "Ocorreu um Erro!!";
			//}else{
			//echo "<script>alert('confirmar envio de email'); </script>";}

			$para="$email";
			$subject ="$assunto";
			$mensagem = "<strong>Nome: </strong>".$nome; 
			$mensagem .= "<br> <strong>Mensagem: </strong>".$_POST['telefone'];
			$headers ="MINE-Version:1.1";
			$headers.="Content-type :text/html; charset=iso-8859-1".$quebralinha;
			$headers.="from:.$email.$quebralinha";
			mail($para, $subject, $messagem, $headers);
			print("Mensagem enviada com sucesso Obrigado!");
}
?>