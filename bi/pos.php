<?
$breadcrumbs=array();
require("cab_bi.php");

require("../_class/_class_programa_pos.php");
$pos = new programa_pos;

echo '<h1>Programas de P�s-Gradua��o</h1>';
$link = 'pos_programas.php';
echo $pos->lista_pos_programas($link);

require("../foot.php");	
?>