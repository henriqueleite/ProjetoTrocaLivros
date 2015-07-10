<?php
function valida_email($email){
			//verifica se e-mail esta no formato correto de escrita
			if (!ereg('^([a-zA-Z0-9.-])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
				return false;
		    }
		    else{
				//Valida o dominio
				$dominio=explode('@',$email);
				if(!checkdnsrr($dominio[1],'A')){
					return false;
				}
				else{return true;} // Retorno true para indicar que o e-mail é valido
			}
		}	
?>