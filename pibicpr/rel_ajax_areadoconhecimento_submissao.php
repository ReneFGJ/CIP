<?
///////////////// Versao 0.0.1f de 02/08/2008
require("cab.php");
require($include.'sisdoc_colunas.php');
require("../_class/_class_ajax_areadoconhecimento.php");
$area = new areadoconhecimento;

$sql = "update pibic_bolsa_contempladas set pb_status = 'F' where pb_ano = '2010' and pb_status = 'A' ";
$rlt = db_query($sql);


echo $area->relatorio_areas(3);

require("../foot.php");	
?>