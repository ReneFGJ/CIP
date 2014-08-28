<?
$breadcrumbs=array();
require("cab_bi.php");

require("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;
$pp->tabela = $pp->tabela_vigente();

echo $pp->resumo_avaliadores();

require("../foot.php");	
?>