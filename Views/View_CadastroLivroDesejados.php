<?php
  session_start();
  require_once "../Dados/Conexao.php";
  if((!isset ($_SESSION['login']) == true))
  {
    unset($_SESSION['login']);
    header('location:../index.php');
  }

?>
<!DOCTYPE html>
<script type="text/javascript" src="jquery-1.3.js"></script>
<script type="text/javascript">
  function lookup(titulo) {
    if(titulo.length == 0) {
      // Hide the suggestion box.
      $('#suggestions').hide();
    } else {
      $.post("../Controles/Controle_AutoComplete.php", {queryString: ""+titulo+""}, function(data){
        if(data.length >0) {
          $('#suggestions').show();
          $('#autoSuggestionsList').html(data);
        }
      });
    }
  } // lookup
  
  function fill(thisValue) {
    $('#titulo').val(thisValue);
    setTimeout("$('#suggestions').hide();", 200);
  }
</script>

<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../CSS/CadastrarAlterarLivroDesejado.css">
    <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script> 
</head>
<body>
     <?php include('../Views/View_topo.php'); ?>

  <div onClick="lookup('');" id='corpo'>
     <h2>Cadastro Livro Desejado</h2>

        <form name="CadastroUsuario" method="post" action="../Repositorio/Repositorio_Livrodesejado.php" enctype="multipart/form-data">
          <table id="cad_table">
            <tr>
              <td>Título:*</td>
              <td><input type="text" name="titulo" onKeyUp="lookup(this.value);" id="titulo" class="txt"  size=35 required/></td>
              <div class="suggestionsBox" id="suggestions" >
              <div class="suggestionList" id="autoSuggestionsList">
           
              </div>
              </div>  
            </tr>
            <tr>
              <td>Genero:*</td>
              <td> <select id="genero" name="genero">
              <option value="1">Comédia</option>
              <option value="2">Drama</option>
              <option value="3">Ficção</option>
              <option value="4">Gibi</option>
              <option value="5">Didatico</option>
              <option value="6">Historia</option>
              <option value="7">Matemática</option>
              <option value="8">Musica</option>
              <option value="9">Quadrinhos</option>
              <option value="10">Sexo</option>
              <option value="11">Terror</option>
              <option value="12">Cronica</option>
              <option value="13">Vestibular</option>
              <option value="14">Poesia</option>
              <option value="15">Biblia</option>
              <option value="16">Romance</option>
              <option value="17">Biologia</option>
              <option value="18">Auto ajuda</option>
              <option value="19">Religioso</option>
              <option value="20">Infantil</option>
              <option value="21">Concurso</option>
              </select> </td>
            </tr>
            <tr>
              <td>Ano:*</td>
              <td><input type="text" name="ano" id="ano" class="txt1" maxlength="10" size=4 required/></td>
            </tr>
              <td colspan="2"><input style="  width: 390px;" class='btn' type="submit" value="Cadastrar Livro Desejado" id="buton1" name="btvalidar"><br>
              </td>
            </tr>
          </table>
        </form>
    </div>
      </br>
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
    </br>
  </br>
  </br>
  </br>
  </br>

   <?php include('../Views/View_rodape.php'); ?>
</body>
</html>

