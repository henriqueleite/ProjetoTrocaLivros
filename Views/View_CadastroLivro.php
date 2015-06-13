<?php
  session_start();
  require_once "../Dados/Conexao.php";
  //$titulo = $autor = $editora = $estado = $genero = $ano = $observacao = $foto = "";
  if((!isset ($_SESSION['login']) == true))
  {
    unset($_SESSION['login']);
    header('location:index.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Troca Livro</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../CSS/CadastrarAlterarLivro.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Menu.css">
    <link rel="stylesheet" type="text/css" href="../CSS/menu-new.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Rodape.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"/>
    </script>

<script LANGUAGE="JavaScript">

function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
      if (tecla==8 || tecla==0) return true;
  else  return false;
    }
}
function mostrarResultado(box,num_max,campospan){
  var contagem_carac = box.length;
  if (contagem_carac != 0){
    document.getElementById(campospan).innerHTML = contagem_carac + "/255 caracteres digitados";
    if (contagem_carac == 1){
      document.getElementById(campospan).innerHTML = contagem_carac + "/255 caracter digitado";
    }
    if (contagem_carac >= num_max){
      document.getElementById(campospan).innerHTML = "Limite de 255 caracteres...";
    }
  }else{
    document.getElementById(campospan).innerHTML = "0/255 caracteres digitados...";
  }
}

function contarCaracteres(box,valor){
  var conta = valor - box.length;
  if(box.length >= valor){
    document.getElementById("observacao").value = document.getElementById("observacao").value.substr(0,valor);
  } 
}

</script>    
</head>
<body>
   <?php include('../Views/View_topo.php'); ?>

    <div id='corpo'>
     <h2>Cadastro Livro</h2>

        <form name="CadastroUsuario" method="post" action="../Repositorio/Repositorio_inserirLivro.php" enctype="multipart/form-data">
          <table id="cad_table">
            <tr >  
              <td>
                Foto:
              </td>
              <td>
                <input style="width: 325px;" type="file" name="foto" required />
              </td>
            </tr>

            <tr>
              <td>Título:*</td>
              <td><input type="text" name="titulo" id="titulo" class="txt"  size=35 required/></td>
            </tr>
            <tr>
              <td>Autor:*</td>
              <td><input type="text" name="autor" id="autor" class="txt"  size=35 required/></td>
            </tr>
            <tr>
              <td>Editora:*</td>
              <td><input type="text" name="editora" id="editora" class="txt"  size=35 required/></td>
            </tr>
            <tr>
              <td>Estado:*</td>
              <td> <select id="estado" name="estado">
              <option value="NOVO">Novo</option>
              <option value="SEMI-NOVO">Semi-Novo</option>
              <option value="VELHO">Velho</option>
              </select> </td>
            </tr>
            <tr>
              <td>Genero:*</td>
              <td> <select id="genero" name="genero">
              <option value="1">Comédia</option>
              <option value="2">Drama</option>
              <option value="3">Ficcão</option>
              </select> </td>
            </tr>
            <tr>
              <td>Ano:*</td>
              <td><input type="text" name="ano" id="ano" class="txt1" onkeypress='return SomenteNumero(event)' maxlength="10" size=6 required/></td>
            </tr>
            <tr>
              <td><label for="mensagem">Observação</label></td>
              <td><textarea name="observacao" id="observacao" rows="5" cols="26" onkeyup="mostrarResultado(this.value,255,'spcontando');contarCaracteres(this.value,255,'sprestante')"/></textarea><br>
              <span id="spcontando">0/255 caracteres digitados...</span><br /></td>
            </tr>
              <td colspan="2"><input style="  width: 390px;" class='btn' type="submit" value="Cadastrar Livro" id="buton1" name="btvalidar"><br>
              </td>
            </tr>
          </table>
        </form>
    </div>

   <?php include('../Views/View_rodape.php'); ?>
</body>
</html>
