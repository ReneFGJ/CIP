<?
require("cab.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_ic_relatorio_parcial.php");
$rf = new ic_relatorio_parcial;

require("../_class/_class_parecer_pibic.php");
$pb = new parecer_pibic;

echo $rf->relatorio_parcial_reprovado((date("Y")-1));

echo $hd->foot();
?>