<?
$breadcrumbs=array();
require("cab_bi.php");
require($include.'sisdoc_debug.php');

require("../_class/_class_docentes.php");
$doc = new docentes;

echo $doc->pesquisadores();

require("../foot.php");	
?>