// JavaScript Document

$(document).ready(function(){
	$('#mensagem').delegate('.mensagem','keydown', function(e)){
	 	var campo = $(this);
		var mensagem = campo.val();
		var troca = $_SESSION['id_troca'];
		var usuario = $_SESSION['codigo'];
		
		
		if(e.keyCode == 13){
			if(mensagem != ''){
				
				$.post('../sys/chat.php',{
				acao: 	'inserir',
				mensagem: mensagem,
				para: troca,
				de: usuario
				}); 
				
			}
		}
	});
});