// JavaScript Document

$(document).ready(function(){
	<div class="janela" id"jan_"+$_SESSION['id_troca']+"><div class="topo" id="+$_SESSION['id_troca']+"><span></span>
	</div>
	<div class="corpomensagem"><div class="mensagens"><ul class="listar"></ul>
	</div>
	<input type="text" class="mensagem" id="+$_SESSION['id_troca']+" maxlength="255"/>
	</div>
	</div>
	
   $('.comecar').live('click', function(){
	  var idtroca = $(this).attr('idtroca'); 
	
	$(this).removeClass('comecar');
		return false;  
   });
});