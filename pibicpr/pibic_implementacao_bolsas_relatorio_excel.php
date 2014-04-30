<?
$include = '../';
require("../db.php");

echo '<BR><BR><BR>';
require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_excel.php");
$xl = new excel;

$xl->header();

echo $pb->relatorio_implementadas($dd[1],$dd[3],$dd[4]);
?>