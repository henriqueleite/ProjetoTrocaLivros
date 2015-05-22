<?php
include("Conexao.php");
session_start();
if(!isset($_POST['Cadastrar'])){
	header("Location: CadastroLivro.php");
}

    $msg = array();
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $idioma = $_POST['idioma'];
    $ano = $_POST['ano'];
    $foto1 = $_FILES["fotodolivro"];
	$codigo = $_SESSION['codigo'];
	
	//a sessao imprimir recebe todas as variasveis vinda do post
	$_SESSION['imprimir'] = $_POST;
  // Se a foto estiver sido selecionada
    if (!empty($foto1["name"])) {
 
      // Verifica se o arquivo é uma imagem
      if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto1["type"])){
         $msg['foto'] = "Isso não é uma imagem.";
      } 

    // Se não houver nenhum erro
    if (count($msg) == "") {
    
      // Pega extensão da imagem
      preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto1["name"], $ext);
 
          // Gera um nome único para a imagem
          $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
          // Caminho de onde ficará a imagem
          $caminho_imagem = "LivrosUsuario/" . $nome_imagem;
 
      // Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($foto1["tmp_name"], $caminho_imagem);
      
    }
  }
    if(empty($nome))
        $_SESSION['erro'] = "Campo obrigatório";
    elseif (empty($autor)) {
      $_SESSION['erro1'] = "Campo obrigatório";
    }
    elseif (empty($editora)) {
      $_SESSION['erro2'] = "Campo obrigatório";
    }
    elseif (empty($idioma)) {
      $_SESSION['erro3'] = "Campo obrigatório";
    }
    elseif (empty($ano)) {
      $_SESSION['erro4'] = "Campo obrigatório";
    }
    else {
        $sql = "insert into livro(IdUsuario, NomeLivro, Autor, Editora, Idioma, Ano, Foto) values($codigo,'$nome','$autor','$editora','$idioma','$ano','$caminho_imagem')";
        $qtd = mysql_query($sql);
        if($qtd){
          $_SESSION['cadastro'] = "Cadastrado com sucesso";
		  unset($_SESSION['imprimir']);
		  header("Location: PerfilUsuario.php"); 
        }
        else{
          $_SESSION['cadastro'] = "Erro ao cadastrar";
		  header("Location: CadastroLivro.php");
		}		
    }
	mysql_close($conecta);
?>
