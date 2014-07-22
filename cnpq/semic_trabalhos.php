<?
$breadcrumbs=array();
require("cab_cnpq.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

echo $pb->semic_mostra_trabalhos($dd[1],date("Y")-1);

require("../foot.php");	
?>