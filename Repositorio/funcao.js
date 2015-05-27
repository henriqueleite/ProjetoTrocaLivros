var tempo = window.setInterval(carrega, 1000);
function carrega()
{
$('#corpo').load("PerfilUsuario.php");
}