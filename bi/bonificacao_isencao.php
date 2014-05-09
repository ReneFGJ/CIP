<?
$breadcrumbs=array();
require("cab_bi.php");

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

require("../_class/_class_graficos.php");
$gr = new graphics;

echo $bon->grafico_isencoes();

require("../foot.php");	
?>