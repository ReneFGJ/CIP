<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','Pуs-graduaзгo'));

require("cab_pos.php");
require($include.'sisdoc_colunas.php');

	/* Dados da Classe */
	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;
	
	echo $clx->resume_icone();
?>