<?
$breadcrumbs=array();
require("cab_bi.php");

$dd1=$dd[1]; /* Programa de Pos */
$datai = 2010;
$dataf = date("Y");

require("../_class/_class_programa_pos.php");
$pos = new programa_pos;

echo '<H1>Programa de Pós-Graduação</h1>';

echo '<h3>Programas de Mestrado e Doutorado (Stricto sensu)</h3>';

echo $pos->programas_pos_notas_cronologico();

require("../foot.php");	
?>