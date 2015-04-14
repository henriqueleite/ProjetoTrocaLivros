<!DOCTYPE html>
<?php
require_once "config.php";
?>
<html>
<head>
    <title>Ajuda</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>


<style type="text/css">
body {
    font-size: 13px;
    font-family: arial, Tahoma, sans-serif;
    position: absolute;
    left: 38%;
    top: 20%;
}
div{
    box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 8px;
    -moz-box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 8px;
    -webkit-box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 8px;
    padding: 20px;
}

a { color:#000; }

h2 {
    margin-bottom: 20px;
    color: #133141;
}
input, textarea {
    padding: 10px;
    border: 1px solid #E5E5E5;
    width: 200px;
    color: #999999;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
    -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
    -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
}
textarea {
    width: 400px;
    height: 150px;
    max-width: 400px;
    line-height: 18px;
}
input:hover, textarea:hover,
input:focus, textarea:focus {
    border-color: 1px solid #C9C9C9;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
    -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
    -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;     
}
.form label {
    margin-bottom: 10px;
    color: #999999;
    display: block;
}
.submit input {
    width: 100px;
    height: 40px;
    background-color: #133141;
    color: #FFF;
    border-radius: 3px;
    moz-border-radius: 3px;
    -webkit-border-radius: 3px;                     
}
</style>
</head>


<body>
    <div>
    <h2>Formulário de Ajuda</h2>
    <form method="post" Action="Ajuda.php" class="form">
    <p class="name">
        <label for="name">Título</label>
        <input type="text" name="titulo" id="titulo" size="50" placeholder="Título" required/>
    </p>
    <p class="email">
         <label for="name">Tipo</label>
         <select name="tipo" id="tipo" required>
            <option value="1">Dúvida</option>
            <option value="2">Sugestão</option>
</select>
    </p>
    <p class="text">
        <label for="mensagem">Mensagem</label>
        <textarea name="mensagem" id="mensagem" placeholder="Escreva sua mensagem" required/></textarea>
    </p>
    <p class="submit">
        <input type="submit" value="Enviar" />
    </p>
    </form>
    </div>
    
</body>

</html>
<?php
$con = @mysql_connect("localhost", "root", "") or die("Não foi possível conectar com o servidor de dados!");
mysql_select_db("ajuda", $con) or die("Banco de dados não localizado!");
$query = mysql_query("select * from ajuda", $con);
$total = mysql_num_rows($query);
echo '<h2> Total de Registros: '.$total.'</h2>';
?>