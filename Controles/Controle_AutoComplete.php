<?php

require_once "../Dados/Conexao.php";
session_start();

if(isset($_POST['queryString'])) {
    $queryString = $_POST['queryString'];
    if(strlen($queryString) >0) {
      $query = mysql_query("SELECT V_TITULO FROM LIVRO WHERE V_TITULO LIKE '$queryString%' LIMIT 10") or die("Erro na consulta");
      while ($result = mysql_fetch_array($query)) {
            echo '<li class="autocomplete" onClick="fill(\''.$result[0].'\');">'.$result[0].'</li>';
          }
    }
  } 

?>