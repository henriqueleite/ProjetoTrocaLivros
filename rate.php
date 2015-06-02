<?php
require_once "Dados/Conexao.php";

$id = $_POST['id'];
$rate = explode('#', $_POST['rating']);
$r = $rate[1];

mysql_query("UPDATE comentario SET V_VOTOS = V_VOTOS + 1, V_PONTOS = V_PONTOS + '$r' WHERE N_COD_LIVRO_IE = $id");
?>