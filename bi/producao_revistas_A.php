<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','Pós-graduação'));
require("cab_bi.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');

	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;

	require('../_class/_class_lattes.php');
	$lattes = new lattes;
	
	//pos_avaliacao_1
	
	$ano1 = 2012;
	$ano2 = 2014;
	echo $lattes->resumo_qualis_ss_qualis($ano1,$ano2);	
?>
<? require("../foot.php");	?>