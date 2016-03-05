<?php

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<style>
.barra-area {
	margin:100 auto;
	margin-top: 0px;
	margin-bottom: 0px;
	position:relative;
	display:block;
	width:100%;

}
.barra {
	position:relative;
	display:block;
	width:100%;
	
	}
.carga {
	height:12px;
	display:block;
	background-color:#3498db;
	width:0%;
	
}
</style>
</head>
<body>
<div class="barra-area">
    <div class="barra">
    	<span class="carga"></span>
	</div>
</div>
<script>
var width = 0;
var tempo = 40;
var carga = document.querySelector('.carga');
var barra = setInterval(function(){
	width = width + 1;
	carga.style.width = width + '%';
	if (width === 100){ 
		clearInterval(barra);
		width = 0;
	}
},tempo);
</script>
</body>
</html>