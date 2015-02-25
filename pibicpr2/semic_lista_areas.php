<?
require("cab.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

echo $pb->semic_areas();

require("foot.php");	
?>