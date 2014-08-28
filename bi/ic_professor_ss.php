<?
$breadcrumbs=array();
require("cab_bi.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$ano = '2014';
$edital = 'PIBIC';
echo '<h3>'.$edital.'</h3>';
echo $pb->indicador_professor_orientador($ano,$edital);

$ano = '2014';
$edital = 'PIBITI';
echo '<h3>'.$edital.'</h3>';
echo $pb->indicador_professor_orientador($ano,$edital);
require("../foot.php");	
?>