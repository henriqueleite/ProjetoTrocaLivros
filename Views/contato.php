<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link href="css/bs/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/styles.css">
      <link rel="stylesheet" href="css/footer.css">
       <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
  <link rel="shortcult icon" type="image/x-icon" href="favicon.png">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
      <link rel="shortcult icon" type="image/x-icon" href="favicon.png">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.cycle.all.js"></script>
  <script src="js/script.js"></script>

    <title>Contato</title>
    <style type="text/css">


 #envio {
  margin-left: 500px;
      background-color: #fff;
    padding: 6em 0 7em 0;}
    form {
    width: 400px;
    height: 600px;
    padding: 0 2em;
   
}
#text p{
    color: #149dd2;
    font-weight: lighter;
    font-size: 18pt;
    border-bottom: 1px solid #f1f1f1;
    width: 400px;
    padding: 5px 6px;

}
form input[type="text"] {
    padding: 9px 6px;
    width: 400px;
    margin: .4em 0;
    font-size: 11pt;
}form input[type="telefone"] {
    padding: 9px 6px;
    width: 400px;
    margin: .4em 0;
    font-size: 11pt;
}
#envio textarea {
    padding: 5px 6px;
    width: 400px;
    margin: .4em 0;
    font-size: 12pt;
}
.button {
    padding: 15px 10px;
    width: 415px;
    margin: .4em 0 0 -2px;
    font-size: 12pt;
    background-color: #149dd2;
    color:#fff;
    border: none;-webkit-transition:all 1s;
-moz-transition:all 1s;
}
.button:hover{ -webkit-transform:scale(1.2);
  -moz-transform:scale(1.2);
  background-color: #38B0DE;

}

    </style>
</head>
<body>
       <?php
    require_once "progresso.php";?>
    
      
<div id="envio">
 

    <form method="post" action="funcoes.php" >
  
              
        <div>
          <table id="tabela"><td><h3>Envie sua mensagem<h3></td><tr>
              
              <td><input type="text" name="nome" id="nome" class="txt"  placeholder="Seu Nome" /></td>

              </tr>
            <tr>
              
              <td><input type="text" name="email" id="email" class="txt"  placeholder="Seu email"/></td>
              </tr>
            <tr>
              
              <td><input type="telefone" name="telefone" id="" class="txt" maxlength="20"   placeholder="Seu telefone"/></td>
              </tr>
            <tr>
              
              <td><input type="text" name="assunto" id="assunto" class="txt" maxlength="15"  placeholder="Assunto"/></td>
              </tr>
            </tr>
            <tr><td>
              <textarea rows="8" cols="20" name="mensagem"  placeholder="Mensagem"></textarea>
              </td>
              </tr>
            <tr>
              <td colspan="2"><input type="submit" value="enviar" id="button" class="button"><br>
                &nbsp;
                
                
              <input type="reset" value="Limpar" id="button" class="button">
                
               </td>
              
              
            </table> 
            
        </div>

    </form>
    
   
     </fieldset  >


  </div>
</div>

 


</body>
</html>
