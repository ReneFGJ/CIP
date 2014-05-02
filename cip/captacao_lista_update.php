<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captaчуo'));

require("cab.php");
require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");

$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
$cap = new captacao;
echo $cap->last_update();
	
require("../foot.php");	?>