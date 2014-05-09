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
	
	$ano = 2011;
	$areas = array('00001');
	echo $lattes->resumo_qualis_ss_geral('',$areas);	
?>
<? require("../foot.php");	?>