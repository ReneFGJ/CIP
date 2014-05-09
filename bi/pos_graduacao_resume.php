<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','Pós-graduação'));

require("cab_bi.php");
require($include.'sisdoc_colunas.php');

echo '<h1>Programas de Pós-Graduação</h1>';

	/* Dados da Classe */
	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;
	
	echo $clx->resume();
?>