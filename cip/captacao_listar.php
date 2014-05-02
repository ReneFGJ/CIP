<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
require($include."sisdoc_menus.php");

require("../_class/_class_captacao.php");
$cap = new captacao;
echo '<h1>Lista de captações</h1>';

echo $cap->captacao_listar($dd[0]);

require("../foot.php");	
?>