<!DOCTYPE html>
<?php
require_once "../Dados/Conexao.php";
session_start();

$idtroca = $_POST["codigosolicitacao"];

unset($_SESSION['id_troca']);
$_SESSION["id_troca"] = $idtroca;

header("Location: ../Views/View_ChatTroca.php");
?>