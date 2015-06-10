<?php
require_once "../Dados/Conexao.php";
@session_start();

$idtroca = $_POST["codigosolicitacao"];

unset($_SESSION['id_troca']);
$_SESSION["id_troca"] = $idtroca;
echo "<meta http-equiv='refresh' content='0, url=../Views/View_ChatTroca.php'>"

?>